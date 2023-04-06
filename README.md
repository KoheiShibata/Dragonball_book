<p align="center">
<img width="440" height="100" alt="スクリーンショット 2023-01-28 9 39 02" src="https://user-images.githubusercontent.com/115211493/224544776-3689be13-34dd-46c5-935f-33dea0fb34dd.png">
</p>

# Dragonball Pbook 〜ドラゴンボール図鑑〜

## Demo
### 一般ユーザー機能
### https://kohei-techis.com/
<Basic認証>
- ユーザー名 : dragonball
- パスワード : pbook
<div align="center">
　<video controls src="https://user-images.githubusercontent.com/115211493/226309265-7a409b9f-8d42-40cf-a544-1f804aeeb6bc.mp4"></video>
</div>

### 管理ユーザー機能
### https://kohei-techis.com/characters
<ログイン>　
- email : dragonball@pbook.com
- password : ZZ4genen
<div align="center">
　<video controls src="https://user-images.githubusercontent.com/115211493/226309596-1f3b1bb3-a124-4ee2-aeef-4fbf1505adef.mp4"></video>
</div>

## Description
WEB上で全シーズンのドラゴンボール登場キャラクターを閲覧、検索できるWEBアプリケーションです。<br>
headerメニューの検索モーダルから条件に合ったキャラクターを検索できます。<br>
キャラクター画像をクリックするとキャラクターの詳細情報を確認できます。<br>

管理者としてログインすればキャラクター、シーズン、カテゴリーを登録 / 編集 / 削除ができます。<br>
※著作権の関係上Basic認証を採用しています。

## Features
- 選択したシーズン、カテゴリー,名前でキャラクターの検索
- 選択したキャラクターの詳細情報
- キャラクターのステータス(10段階評価)を確認できる
- ログインするとキャラクター・シーズン・カテゴリーの登録 / 編集 / 削除ができる


## Requirement
- Laravel v9.41.0
- php v8.0.23
- apache
- MYSQL 10.3.37-MariaDB

## Usage
- 一般ユーザの場合
1. Basic認証
2. 全シーズンの登場キャラクターを閲覧できる
3. トップページから閲覧したいシーズンを選択する
4. headerメニューから検索modalを表示(名前、シーズン、カテゴリーによる絞り込み)
5. キャラクター詳細情報はキャラクター画像をクリック

- 管理ユーザの場合
1. Basic認証 & ログイン
2. headerメニューから移動
3. 項目に沿って情報を入力すると登録できる（season登録は、既に登録済み or ドラゴンボールに存在しないシーズンは登録できません）
4. キャラクター画像 or テーブルをクリックでmodal表示 (詳細情報表示 / 編集 / 削除ができる)
5. season or tribe の削除について、ユーザー画面で使用中のモノは、削除できないようにしています。

## How to install & Start-up
```
$ git clone https://github.com/KoheiShibata/Dragonball_book.git
$ cp .env.example .env
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan storage:link
```

## Author
koheiShibata
