# Healthy Life

[Healthy Life](http://healthylife-app.site/)

食事で摂取した栄養を記録し、管理できるサービスです。健康的な食生活を送るために、みんなのおすすめレシピを検索・保存できます。

URL: http://healthylife-app.site/



## ゲスト用アカウント

```
Eメールアドレス：gest@gest.com
パスワード：gestgest
```



## 使用した技術

- Laravel
- HTML,CSS/SCSS
- Vue.js
- jQuery
- chart.js
- Docker
- CircleCi
- AWS(ECR,ECS,RDS)



## 実装した機能

- Dockerでのローカル環境構築
- レスポンシブ対応
- seedsを使用したCSVファイルデータでのテーブル作成
- chart.jsによるグラフ表示
- Vue.jsによるいいねボタン
- Vue.jsによるインクリメンタルサーチ
- jQueryを用いた画像保存前プレビュー
- jQueryを用いたレシピ削除前、ユーザー退会前の確認アラート表示
- ユニットテストの実装
- CircleCIによる自動テスト
- APIを使用した公式Twitterへの自動投稿
- AWS(ECR,ECS,RDS)でのデプロイ
- 画像ストレージにS3を設定
- route53による独自ドメインの設定
- ページネーション
- アイコン未登録時の初期画像表示




## できること

- ２週間分のBMI値をグラフで管理
- 摂取した栄養素を表に出力し確認できる
- ユーザー登録、編集、削除
- レシピの投稿、編集、削除
- レシピ検索
- ハッシュタグ、タグ検索
- お気に入りレシピ登録
- レシピへのコメント投稿
- アプリ公式Twitterへの自動投稿



## サービスイメージ

## トップ画面

- 新着レシピ一覧画面
- ゲストユーザーもアクセス可能
- ゲストユーザーはレシピ詳細、ユーザー詳細のみに遷移可能

![healthylifeimage1](https://user-images.githubusercontent.com/59483718/89257342-eecf7800-d660-11ea-8c5b-9546cd464ff8.jpg)



## ユーザーマイページ

- 各ユーザーの詳細ページ
- 各ユーザーの投稿一覧が表示される
- ユーザー自身のページではプロフィールが編集できる

![healthylifeimage2](https://user-images.githubusercontent.com/59483718/89257010-4e795380-d660-11ea-92f4-19b2fb2beda1.jpg)



## グラフによる管理(マイデータ画面)

- 身長と体重を登録することで日々のBMI値をグラフで管理できる

<img width="600" alt="bmi-graph-image" src="https://user-images.githubusercontent.com/59483718/89257091-7799e400-d660-11ea-84c3-def354b38dc2.png">

- 摂取栄養素の視覚化

<img width="600" alt="ate-graph-image" src="https://user-images.githubusercontent.com/59483718/89257072-6cdf4f00-d660-11ea-9cd1-29545642317e.png">



## 公式twitterによる自動投稿

<img width="600" alt="healthylifeimage4" src="https://user-images.githubusercontent.com/59483718/90241019-36c27c00-de65-11ea-97de-e4751dfb3de6.png">

<img width="600" alt="healthylifeimage3" src="https://user-images.githubusercontent.com/59483718/90240963-25796f80-de65-11ea-9e48-642c6ec5eda4.jpg">



## ER図

<img width="1097" alt="healthylife-er" src="https://user-images.githubusercontent.com/59483718/89265672-cc912680-d66f-11ea-8b0c-5f7c46f31183.png">



## 今後実装したい機能、改善点

- CircleCI Orbsによる自動デプロイ(学習中)
- レシピのいいね数TOP10を表示
- 人気のハッシュタグを表示
- コメント通知機能
- CSVデータの食材名をわかりやすく調整
- バーコードがついてる商品の栄養素読み取り(Yahoo商品検索APIなどを利用)