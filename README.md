# KOEチケットページ

## 慶応のサーバーの使い方についての基礎知識

* 慶応のサーバーの使い方については、[このページ](http://koe.sfc.keio.ac.jp/joho.pdf)を参考に

## 概要

* KOEのチケットのはけ具合を確認するためのページ
* このフォルダは、`/pub/WWW/koe`のフォルダに、`ticket_php`という名前でおいてある

# 使い方

## プログラム変えるとき
1. `git clone`して、自分の開発環境で開発
2. `git add` コマンドで修正したファイルをGitに追加
3. `git push origin master`でリモートリポジトリにディプロイ
4. SFCのサーバーの`/pub/WWW/koe/ticket_php`フォルダへ行き、`git pull`コマンドを打つ。すると、コードがアップデートされる

## 新しくページを配置するとき。
1. SFCのサーバーの`/pub/WWW/koe`フォルダへ行き、ticket_phpフォルダをコピーする。コマンドは、`cp ticket_php コンサート名`. (ex: `cp ticket_php 17win_ticket`)
2. 新しく作ったフォルダへ行き(`mv コンサート名` ex:`mv 17win_tiekct`)、`load.php`ファイルの5,6行目を書き換える(`vim load.php`コマンドから編集できるようになる。)
    - 5行目はコンサートの名前。
    - 6行目は代のリスト。フォームで選択するところに反映される。
    - vimのコマンドについては、ググる
3. `data/attend_data.csv`, `data/delete_data.csv`, `data/edit_data.csv`ファイルの中身を、全部の行消す。もしくは一旦ファイルを消して、同じ名前のファイルをtouchコマンドで作る。
    - ファイルがない状態にしないように！！
4. 基本的には、これで新しいページの作成が完了する。（ページのURLは、`http://koe.sfc.keio.ac.jp/コンサート名/index.php`になる。コンサート名は、手順2で指定したもの。17年冬コンだったら、`http://koe.sfc.keio.ac.jp/17win_ticket/index.php`）

## 新しくメンバーを招待するとき
- https://qiita.com/chari/items/ee16bf16715f4bbcbd9b このページ参照。全員Ownerとして招待して良いと思う。

## ファイルの説明

* `index.php` : メインページ
* `load.php` : ファイルの読み込み。全ページ共通のデータなど。
* `rank.php` : ランキングのページ
* `hitory.php` : 履歴表示のページ
* `form.php` : フォーム入力の確認のページ
* `confirm.php` : フォーム入力完了のページ。csvファイルに書き込み
* `edit.php` : フォームの回答を編集するページ
* `edit_form.php` : 変更内容を確認するページ
* `edit_comfirm.php` : 編集・削除完了のページ
* `delete_comfirm.php` : 削除内容を確認するページ. csvファイルに書き込み

* `data/attend_data.csv` : フォームの入力した情報が保存されるファイル。
* `data/delete_data.csv` : 削除したフォームの回答データが保存されるファイル。（中身は、番号。`attend_data.csv`の中で、何行目のデータが削除されたものか、という情報が入っている）
* `data/edit_data.csv` :　編集されたフォームの回答データを保存
* `data/guest.txt` : フォームで選べる招待した客の種類を格納しているファイル

* `img`フォルダ : 画像が入ってるフォルダ. うまく使ってください。
