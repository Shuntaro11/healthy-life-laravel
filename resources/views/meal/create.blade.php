@extends('template')
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
        @include("header")
        
        <div class="page-title">マイデータ</div>
        <div class="show-user-name">{{ Auth::user()->name }}</div>
        <div class="image-wrapper show-user-image-wrapper">
            <img class="inside-image" src="{{ Auth::user()->user_image }}" onerror="this.src='/noicon.png'">
        </div>
        <a href="/users/{{Auth::user()->id}}/edit">
            <div class="user-edit-link">プロフィール編集</div>
        </a>
        
        <div class="body-value-container">
            <div class="post-form-container body-value-form-container">
                <p class="container-title">体重・身長</p>
                <form action="/body_values" method="post" enctype="multipart/form-data">
                    @csrf
                    <p class="form-label">日付</p>
                    <div><input type="date" name="date" value={{$today}} class="post-input input-date"></div>
                    <p class="form-label">体重(kg)</p>
                    <div><input type="number" step="0.1" min="20" max="500" name="weight" class="post-input input-quantity"></div>
                    
                    @if ($errors->first('weight'))
                        <p class="validation validation-message">※{{$errors->first('weight')}}</p>
                    @endif
                                        
                    <p class="form-label">身長(cm)</p>
                    @if ($height === 0)
                        <div><input type="number" step="0.1" min="50" max="300" name="height" class="post-input input-quantity"></div>
                    @else
                        <div><input type="number" step="0.1" min="50" max="300" name="height" value={{$height}} class="post-input input-quantity"></div>
                    @endif
                    
                    
                    @if ($errors->first('height'))
                        <p class="validation validation-message">※{{$errors->first('height')}}</p>
                    @endif
                    
                    <button type="submit" class="form-button">登録</button>
                </form>
            </div>
            
            <div class="bmi-container">
                <p class="container-title">BMI値 (過去14日間)</p>
                <div class="bmi-chart">
                    <canvas id="bmi-chart">
                        <script>

                            var w = $('.bmi-chart').width();
                            var h = $('.bmi-chart').height();
                            $('#bmi-chart').attr('width', w);
                            $('#bmi-chart').attr('height', h);

                            const days = @json($days);
                            const bmis = @json($bmis);

                            var ctx = document.getElementById("bmi-chart");
                            var myLineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                labels: days,
                                datasets: [
                                    {
                                    label: 'BMI',
                                    data: bmis,
                                    borderColor: "#df5f4a",
                                    pointBackgroundColor : "#fff",
                                    pointBorderColor : "#2a324e",
                                    lineTension: 0,
                                    borderWidth: 2,
                                    pointBorderWidth: 3,
                                    backgroundColor: "rgba(0,0,0,0)",
                                    },
                                ],
                                },
                                options: {

                                    title: {
                                        display: false,
                                    },
                                    
                                    legend: {
                                        display: false,
                                    },

                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                stepSize: 0.5,
                                            },
                                        }]
                                    },

                                    maintainAspectRatio: false,
                                }
                            });
                        </script>
                    </canvas>
                </div>
            </div>
        </div>
        <div class="post-form-container">
            <form action="/meals" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <p class="container-title">食べたものを登録する</p>
                    <p class="form-label">日付</p>
                    <div><input type="date" name="ate_at" value={{$today}} class="post-input input-date"></div>
                    <p class="form-label">食材</p>
                    <div id="app">
                        <food-name-search></food-name-search>
                    </div>
                    
                        @if ($errors->first('food_name'))
                            <p class="validation validation-message">※{{$errors->first('food_name')}}</p>
                        @endif
                    
                    <p class="form-label">量(g)</p>
                    <div><input type="number" name="quantity" class="post-input input-quantity"></div>

                        @if ($errors->first('quantity'))
                            <p class="validation validation-message">※{{$errors->first('quantity')}}</p>
                        @endif

                    <button class="form-button" type="submit">登録</button>
                </div>
            </form>
        </div>
        <p class="container-title">栄養素の摂取量(直近１週間)</p>
        <p class="notice-message-md">スクロールで表全体が確認できます</p>
        <div class="ate-nutrition-table">
            <div class="ate-table-row first-row">
                <div class="ate-table-cell left-cell"></div>
                <div class="ate-table-cell">カロリー(kcal)</div>
                <div class="ate-table-cell">タンパク質(g)</div>
                <div class="ate-table-cell">脂質(g)</div>
                <div class="ate-table-cell">炭水化物(g)</div>
                <div class="ate-table-cell">ビタミンB1(mg)</div>
                <div class="ate-table-cell">ビタミンC(mg)</div>
                <div class="ate-table-cell">食塩(g)</div>
                <div class="ate-table-cell">食物繊維(g)</div>
                <div class="ate-table-cell">カルシウム(mg)</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">今日</div>
                <div class="ate-table-cell">{{ $todaysEnergy }}</div>
                <div class="ate-table-cell">{{ $todaysProtein }}</div>
                <div class="ate-table-cell">{{ $todaysFat }}</div>
                <div class="ate-table-cell">{{ $todaysCarbon }}</div>
                <div class="ate-table-cell">{{ $todaysVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $todaysVitaminc }}</div>
                <div class="ate-table-cell">{{ $todaysSalt }}</div>
                <div class="ate-table-cell">{{ $todaysDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $todaysCalcium }}</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">昨日</div>
                <div class="ate-table-cell">{{ $yesterdaysEnergy }}</div>
                <div class="ate-table-cell">{{ $yesterdaysProtein }}</div>
                <div class="ate-table-cell">{{ $yesterdaysFat }}</div>
                <div class="ate-table-cell">{{ $yesterdaysCarbon }}</div>
                <div class="ate-table-cell">{{ $yesterdaysVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $yesterdaysVitaminc }}</div>
                <div class="ate-table-cell">{{ $yesterdaysSalt }}</div>
                <div class="ate-table-cell">{{ $yesterdaysDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $yesterdaysCalcium }}</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">２日前</div>
                <div class="ate-table-cell">{{ $twoDaysAgoEnergy }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoProtein }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoFat }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoCarbon }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoVitaminc }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoSalt }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $twoDaysAgoCalcium }}</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">３日前</div>
                <div class="ate-table-cell">{{ $threeDaysAgoEnergy }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoProtein }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoFat }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoCarbon }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoVitaminc }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoSalt }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $threeDaysAgoCalcium }}</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">４日前</div>
                <div class="ate-table-cell">{{ $fourDaysAgoEnergy }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoProtein }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoFat }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoCarbon }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoVitaminc }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoSalt }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $fourDaysAgoCalcium }}</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">５日前</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoEnergy }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoProtein }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoFat }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoCarbon }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoVitaminc }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoSalt }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $fiveDaysAgoCalcium }}</div>
            </div>
            <div class="ate-table-row">
                <div class="ate-table-cell left-cell">６日前</div>
                <div class="ate-table-cell">{{ $sixDaysAgoEnergy }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoProtein }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoFat }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoCarbon }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoVitaminb1 }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoVitaminc }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoSalt }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoDietaryFiber }}</div>
                <div class="ate-table-cell">{{ $sixDaysAgoCalcium }}</div>
            </div>
        </div>
        
        <p class="container-title">最近食べたもの</p>
        <p class="notice-message-md">スクロールで表全体が確認できます</p>
        <div class="ate-food-table">
            <div class="ate-index-row ate-index-row-first">
                <div class="ate-table-cell ate-table-cell-left">カロリー(kcal)</div>
                <div class="ate-table-cell">タンパク質(g)</div>
                <div class="ate-table-cell">脂質(g)</div>
                <div class="ate-table-cell">炭水化物(g)</div>
                <div class="ate-table-cell">ビタミンB1(mg)</div>
                <div class="ate-table-cell">ビタミンC(mg)</div>
                <div class="ate-table-cell">食塩(g)</div>
                <div class="ate-table-cell">食物繊維(g)</div>
                <div class="ate-table-cell">カルシウム(mg)</div>
            </div>
            
            <div class="ate-index">
                @foreach($meals as $meal)
                    <div class="ate-food-name-container">
                        <div class="ate-food-name">
                            ［{{ $meal->ate_at }}］
                            {{ $meal->food_ingredient->food_name }}
                            ［{{ $meal->quantity }}g］
                        </div>
                        <form method="post" action="/meals/{{$meal->id}}">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field()}}
                            <button type="submit" class="delete-link">このデータを削除</button>
                        </form>

                    </div>
                    <div class="ate-index-row">
                        <div class="ate-table-cell ate-table-cell-left">{{ ($meal->food_ingredient->energy_kcal) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->protein) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->fat) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->carbon) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->vitamin_b1) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->vitamin_c) * ($meal->quantity / 100)}}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->salt) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->dietary_fiber) * ($meal->quantity / 100) }}</div>
                        <div class="ate-table-cell">{{ ($meal->food_ingredient->calcium) * ($meal->quantity / 100) }}</div>
                    </div>
                @endforeach
            </div>

        </div>
        
        @include("nav-bar")
        @include("footer")
        
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>