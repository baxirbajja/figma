<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
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
                'name' => 'Hot Dishes',
                'icon' => 'bi-fire',
                'sort_order' => 1,
            ],
            [
                'name' => 'Cold Dishes',
                'icon' => 'bi-snow',
                'sort_order' => 2,
            ],
            [
                'name' => 'Soup',
                'icon' => 'bi-cup-hot',
                'sort_order' => 3,
            ],
            [
                'name' => 'Grill',
                'icon' => 'bi-grid',
                'sort_order' => 4,
            ],
            [
                'name' => 'Appetizer',
                'icon' => 'bi-egg-fried',
                'sort_order' => 5,
            ],
            [
                'name' => 'Dessert',
                'icon' => 'bi-cake',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'sort_order' => $category['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
