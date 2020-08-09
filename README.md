# README
- URL: http://healthylife-app.site/


## サービス概要
- 食事で摂取した栄養を記録し、管理できるサービスです
- 健康的な食生活を送るために、みんなのおすすめレシピを共有できます


## できること

- BMI値をグラフで管理
- １週間分の摂取した栄養素を表に出力した数値で確認できる
- ユーザー登録、編集、削除
- レシピの投稿、編集、削除
- レシピ検索
- ハッシュタグ、タグ検索
- お気に入りレシピ登録
- レシピへのコメント投稿


## アカウント

- Eメールアドレス：gest@gest.com
- パスワード：gestgest

## サービスイメージ

### トップ画面

- 新着レシピ一覧画面
- ゲストユーザーもアクセス可能
- ゲストユーザーはレシピ詳細、ユーザー詳細のみに遷移可能

![healthylifeimage1](https://user-images.githubusercontent.com/59483718/89257342-eecf7800-d660-11ea-8c5b-9546cd464ff8.jpg)


### ユーザーマイページ

- 各ユーザーの詳細ページ
- 各ユーザーの投稿一覧が表示される
- ユーザー自身のページではプロフィールが編集できる

![healthylifeimage2](https://user-images.githubusercontent.com/59483718/89257010-4e795380-d660-11ea-92f4-19b2fb2beda1.jpg)


### グラフによるBMI値管理(マイデータ画面)

- 身長と体重を登録することで日々のBMI値をグラフで管理できる

<img width="717" alt="bmi-graph-image" src="https://user-images.githubusercontent.com/59483718/89257091-7799e400-d660-11ea-84c3-def354b38dc2.png">


### 摂取栄養素の視覚化(マイデータ画面)

<img width="903" alt="ate-graph-image" src="https://user-images.githubusercontent.com/59483718/89257072-6cdf4f00-d660-11ea-9cd1-29545642317e.png">


## 実装した機能

- Dockerでのローカル環境構築
- レスポンシブ対応
- seedsを使用したCSVファイルデータのテーブル作成
- chart.jsによるグラフ表示
- Vue.jsによるいいねボタン
- Vue.jsによるインクリメンタルサーチ
- jQueryを用いた画像保存前プレビュー
- jQueryを用いたレシピ削除前、ユーザー退会前の確認アラート表示
- AWS(ECR,ECS,RDS)でのデプロイ
- 画像ストレージにS3を設定
- route53による独自ドメインの設定
- ページネーション
- アイコン未登録時の初期画像表示

## 使用した言語

- PHP(Laravel)、HTML、CSS、javascript(Vue.js,jQuery,chart.js)

## ER図

<img width="1097" alt="healthylife-er" src="https://user-images.githubusercontent.com/59483718/89265672-cc912680-d66f-11ea-8b0c-5f7c46f31183.png">


## 今後実装したい機能、改善点

- レシピのいいね数TOP10を表示
- 人気のハッシュタグを表示
- コメント通知機能
- CSVファイルの食材名のデータ編集
- 食材データの食材名をわかりやすく調整
- 単体食材以外の栄養素登録(コンビニ弁当とバーコード読み取りなど)