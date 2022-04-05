<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Crops',
                'slug' => 'crops',
                'created_at' => '2020-03-07 15:10:58',
                'updated_at' => '2020-03-07 15:10:58',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'order' => 2,
                'name' => 'Vegetables',
                'slug' => 'vegetables',
                'created_at' => '2020-03-07 15:11:36',
                'updated_at' => '2020-03-07 15:11:36',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => NULL,
                'order' => 3,
                'name' => 'Fruits',
                'slug' => 'fruits',
                'created_at' => '2020-03-14 10:02:06',
                'updated_at' => '2020-03-14 10:02:06',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'order' => 4,
                'name' => 'Livestocks',
                'slug' => 'livestocks',
                'created_at' => '2020-03-14 10:02:28',
                'updated_at' => '2020-03-14 10:02:41',
            ),
            
        ));
        
        
    }
}