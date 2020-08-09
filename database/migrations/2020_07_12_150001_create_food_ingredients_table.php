<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('food_name');
            $table->integer('energy_kcal');
            $table->float('protein', 4, 1);
            $table->float('fat', 4, 1);
            $table->float('carbon', 5, 1);
            $table->float('dietary_fiber', 4, 1);
            $table->string('natrium');
            $table->string('kalium');
            $table->string('calcium');
            $table->string('magnesium');
            $table->float('iron', 4, 1);
            $table->float('zinc', 4, 1);
            $table->string('vitamin_k');
            $table->float('vitamin_b1', 4, 2);
            $table->float('vitamin_b2', 4, 2);
            $table->float('vitamin_b6', 4, 2);
            $table->float('vitamin_b12', 4, 1);
            $table->string('folic_acid');
            $table->string('vitamin_c');
            $table->float('salt', 4, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_ingredients');
    }
}
