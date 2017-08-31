//<?php
/**
 * JsonExport
 * 
 * テンプレート変数などのJSONデータを指定形式で出力します
 *
 * @category 	snippet
 * @version     1.0 - August 31, 2017
 * @internal	@properties 
 * @internal	@modx_category Content
 */

//【使い方】
//[[JsonExport?hash=`[*テンプレート変数名*]`&tpl=`$tpl`(,&format=`$format`, &class=`$class`, &total=`$total`, &page=`$page`)]]
//
//$tpl    : 出力1件分のチャンク名
//$format : 出力結果をwrapするhtml（※defaultは<ul class="listgroup"></ul>）
//$class  : 出力結果全体に付与するclass名($formatを設定している場合は適用されません)
//$total  : 最大出力件数
//$page   : $totalを指定した時のpage番号
//
//
//$tplのチャンク内で最初から使用できる変数
//num   : 1から始まるインデックス
//zeron : 0から始まるインデックス
//name  : テンプレート変数側で設定されているrelの値
//【値が画像URLの場合】
//変数名_width,変数名_heightとして画像サイズが変数として格納されます。
//
//$formatについて
//Dittoで使用しているformatと同じ仕組みです。必要に応じでDittoのformatsディレクトリから持ってきて下さい。
//
//もしJSON内に{selecttxt:"無効"}というデータが含まれている場合、そのデータは出力されません。


require_once($modx->config['base_path'] ."assets/snippets/jsonexport/json.php");
require_once($modx->config['base_path'] ."assets/snippets/jsonexport/jsonexport.php");
$hash = new JsonExport($hash, $tpl, $format, $class, $total, $page);
return $hash->render();