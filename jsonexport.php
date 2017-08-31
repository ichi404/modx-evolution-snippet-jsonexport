<?php
class JsonExport {
    public $val, $html='';
    
    function JsonExport($hash = null, $tpl = null, $format = null, $class = null, $total = null, $page = 1) {
        global $modx;
        if($hash === null) return '';
        if($tpl === null) return '';
        if($page === null) $page = 1;
        $JSON = new Services_JSON();
        
        //Jsonデータをオブジェクトへ変換
        $hash = $JSON->decode($hash);
        //カウント用変数
        $n=1;
        
        //表示件数が設定されていれば設定された件数を取得
        if(!is_null($total)){
            if($page != 1){
                $hash = array_slice($hash, $total*($page-1), $total*($page-1));
                $n = $total*($page-1)+1;
            }else{
                $hash = array_slice($hash, 0, $total);
            }
        }
        
        foreach( (array)$hash as $key => $val) {
            //jsonデータをオブジェクトへ変換
            $ary_val = get_object_vars ($val);
            //もしselecttxtに”無効”が指定されていれば出力しない
            if($ary_val['selecttxt'] === '無効'){ continue; }
            
            //改行文字をbrへ変換
            foreach ($ary_val as $key => $value) {
                $ary_val[$key] = nl2br($value);
            }
            //カウンタを追加
            $ary_val += array('num' => $n);
            //カウンタを追加(0スタート)
            $ary_val += array('zeron' => $n-1);
            $this->getImage($ary_val);//画像の場合、サイズを取得
            //$this->formatValue();//改行文字をbrへ変換
            //チャンクを取得
            $this->html .= $modx->parseChunk($tpl, $ary_val, "[+", "+]");
            //カウンタを回す
            $n++;
        };
        
        //format
        if($format == null){
            $class = !is_null($class) ? ' class="'.$class.'"' : ' class="list-group"';
            $this->html = '<ul'.$class.'>'.$this->html.'</ul>';
        }elseif(!is_null($format)){
    	    include 'formats/'.$format.'format.inc.php';
    	    $this->html = $header.$this->html.$footer;
        }
    }
    //画像サイズを取得
    function getImage(&$ary_val) {
        foreach ($ary_val as $key => $value) {
            if(isset($value) && file_exists($value)){
                if(exif_imagetype($value)){
                    list($width, $height) = getimagesize($value);
                    $ary_val[$key.'_width'] = $width;
                    $ary_val[$key.'_height'] = $height;
                }
            };
        }
    }
    //改行文字をbrへ変換
    function formatValue() {
        foreach($this->val as $key => $val){
			  $this->val[$key] = nl2br($val);
        }
    }
	function render(){
		echo $this->html;
	}
}
?>