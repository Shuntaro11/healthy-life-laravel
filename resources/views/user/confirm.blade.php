@extends('template')
    <body>
        @include("header")
        <div class="recommend-container">
          <h2 class="bold-text">日々の食事を見える化する健康管理アプリ</h2>
          <h3 class="bold-text">ヘルシーライフの<span class="orange-text">全ての機能</span>が利用可能に。</h3>
          <h5><span class="bold-text">お気に入りレシピ</span>登録、<span class="bold-text">摂取栄養素の管理</span>、<span class="bold-text">BMI値をグラフ化</span>などできることが満載。<br>毎日の食事を健康的に楽しんでいる方がどんどん増えています。<br>健康は食事から。スポーツ、ダイエット、ご家族の健康管理などにお役立てください。</h5>
          <a class="recommend-btn" href="{{ route('register') }}">今すぐ無料登録する</a>
          <h3 class="title-bar" >日々のBMI値をグラフで管理！</h3>
          <img class="graph-image" src="/bmi-graph-image.png">
          <h3 class="title-bar" >摂取した栄養素が数値でわかる！</h3>
          <img class="graph-image" src="/ate-graph-image.png">
          <h3 class="title-bar" >たくさんのレシピの中からお気に入りを保存！</h3>
          <img class="graph-image food-index-image" src="/food-index-image.jpg">
          <a class="recommend-btn" href="{{ route('register') }}">無料登録へ進む</a>
        </div>
        @include("footer")
    </body>
</html>