<?php

use Illuminate\Database\Seeder;

class FoodIngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/seeds/csvs/FoodIngredients.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $list = [];

        $now = new DateTime();
        
        foreach($file as $line) {
            $list[] = [
                "food_name" => $line[0],
                "energy_kcal" => $line[1],
                "protein" => $line[2],
                "fat" => $line[3],
                "carbon" => $line[4],
                "dietary_fiber" => $line[5],
                "natrium" => $line[6],
                "kalium" => $line[7],
                "calcium" => $line[8],
                "magnesium" => $line[9],
                "iron" => $line[10],
                "zinc" => $line[11],
                "vitamin_k" => $line[12],
                "vitamin_b1" => $line[13],
                "vitamin_b2" => $line[14],
                "vitamin_b6" => $line[15],
                "vitamin_b12" => $line[16],
                "folic_acid" => $line[17],
                "vitamin_c" => $line[18],
                "salt" => $line[19],
                "created_at" => $now,
                "updated_at" => $now,
            ];
        }

        DB::table("food_ingredients")->insert($list);
    }
}
