<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_fr' => 'Plats Chauds',
                'name_en' => 'Hot Dishes',
                'name_it' => 'Piatti Caldi',
                'slug' => 'hot-dishes',
            ],
            [
                'name_fr' => 'Plats Froids',
                'name_en' => 'Cold Dishes',
                'name_it' => 'Piatti Freddi',
                'slug' => 'cold-dishes',
            ],
            [
                'name_fr' => 'Soupes',
                'name_en' => 'Soup',
                'name_it' => 'Zuppe',
                'slug' => 'soup',
            ],
            [
                'name_fr' => 'Grillades',
                'name_en' => 'Grill',
                'name_it' => 'Grigliate',
                'slug' => 'grill',
            ],
            [
                'name_fr' => 'Entrées',
                'name_en' => 'Appetizer',
                'name_it' => 'Antipasti',
                'slug' => 'appetizer',
            ],
            [
                'name_fr' => 'Desserts',
                'name_en' => 'Dessert',
                'name_it' => 'Dolci',
                'slug' => 'dessert',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
