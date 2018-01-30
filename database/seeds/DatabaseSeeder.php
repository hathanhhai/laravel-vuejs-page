<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;
use App\Recipe;
use App\RecipeDirection;
use App\RecipeIngredient;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::truncate();

        foreach (range(1,10)as $item){
            User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>bcrypt('123456'),
                'api_token'=>str_random(60)
            ]);
        }
        //$this->call(RecipeTableSeeder::class);


         ////

         $faker =  Factory::create();

         RecipeIngredient::truncate();
         RecipeDirection::truncate();
         Recipe::truncate();
 
         foreach(range(1,10) as $item){
             $recipe = Recipe::create([
                 'user_id'=>$item,
                 'name'=>$faker->sentence,
                 'description'=>$faker->paragraph(mt_rand(5,15)),
                 'image'=>'test.png'
 
 
             ]);
 
 
             foreach (range(1,mt_rand(3,12)) as $item1){
                 RecipeIngredient::create([
                     'recipe_id'=>$recipe->id,
                     'name'=>$faker->word,
                     'qty'=>mt_rand(1,12).'kg'
                 ]);
             }
 
             foreach (range(1,mt_rand(5,12)) as $item2){
 
                 RecipeDirection::create([
                     'recipe_id'=>$recipe->id,
                     'description'=>$faker->sentence
                 ]);
             }
 
 
         }
            ///////////




    }
}
