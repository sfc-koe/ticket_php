# KOEチケットページ

# 概要

* KOEのチケットのはけ具合を確認するためのページ
* SFCのサーバーの`/pub/WWW/koe`フォルダに`ticket_php`という名前で置いてある

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
4. 基本的には、これで新しいページの作成が完了する。（ページのURLは、`http://koe.sfc.keio.ac.jp/コンサート名/index.php`になる。17年冬コンだったら、`http://koe.sfc.keio.ac.jp/17win_ticket/index.php`）

## 新しくメンバーを招待するとき
- https://qiita.com/chari/items/ee16bf16715f4bbcbd9b このページ参照。全員Ownerとして招待して良いと思う。
