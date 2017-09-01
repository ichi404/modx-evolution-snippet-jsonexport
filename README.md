Modx-jsonExport
====

ModxでJsonを出力するためのSnippetです。  
単体でなくModxのPlugin「custominput」<https://github.com/ichi404/modx-evolution-plugin-custominput>と組み合わせて使います。

## Description
Modxのcustominputで保存されたデータjsonデータを読み込み、指定のチャンクを通して出力します。

## Usage
    [[JsonExport?hash=`[*テンプレート変数名*]`&tpl=`$tpl`(,&format=`$format`, &class=`$class`, &total=`$total`, &page=`$page`)]]

### 変数
$tpl    : 出力1件分のチャンク名  
$format : 出力結果をwrapするhtml（デフォルトはul class="listgroup"）  
$class  : 出力結果全体に付与するclass名($formatを設定している場合は適用されません)  
$total  : 最大出力件数（デフォルトは全件）  
$page   : 開始ページ数（$totalを指定しなければ動作しません）  


### $tplのチャンク内で最初から使用できる変数
num   : 1から始まるインデックス  
zeron : 0から始まるインデックス  
name  : テンプレート変数側で設定されているrelの値  
【値が画像URLの場合】  
変数名_width,変数名_heightとして画像サイズが変数として格納されます。  

### $formatについて
Dittoで使用しているformatと同じ仕組みです。必要に応じでDittoのformatsディレクトリから持ってきて下さい。  
  
※もしJSON内に{selecttxt:"無効"}というデータが含まれている場合、そのデータは出力されません。  

## Install
/assets/snippets/ディレクトリへこのディレクトリを入れてupdateを行って下さい。  
※手動でインストールしたい場合は、jsonexport.install_base.tplをコピペして下さい。


## Licence

[MIT](https://github.com/tcnksm/tool/blob/master/LICENCE)

## Author

[ichi404](https://github.com/ichi404)