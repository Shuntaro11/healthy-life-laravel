<template>
    
    <div class="selected-food-display">

        <p class="selected-food-name" v-if="selectedFood != ''">
            {{ selectedFood }}
            <input type="hidden" name="food_name" :value="selectedFood">
        </p>

        <div class="search-food-result">
            <div class="search-food">
                <input class="search-food-input" type="text" v-model="keyword" placeholder="食材名を検索してください">
            </div>
            <ul class="food-name-list">
                <li class="each-food-name" v-for="food_ingredient in food_ingredients" :key="food_ingredient.food_name">
                    <p v-on:click="select(food_ingredient.food_name)">
                        {{ food_ingredient.food_name }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                keyword: "",
                food_ingredients: {},
                selectedFood: ''
            }
        },
        methods: {
            search() {
                axios.get('/api/food_ingredients?food_name=' + this.keyword)
                    .then(res => {
                        this.food_ingredients = res.data;
                    })
                    .catch(error => {
                        console.log('データの取得に失敗しました。');
                    });
            },
            select: function (food_name) {
                this.selectedFood = food_name;
                this.food_ingredients = []
            }
        },
        watch: {
            keyword() {
                this.search();
            }
        }
    }
</script>