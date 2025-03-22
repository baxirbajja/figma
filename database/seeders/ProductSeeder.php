<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name_fr' => 'Poulet Rôti aux Herbes',
                'name_en' => 'Herb Roasted Chicken',
                'name_it' => 'Pollo Arrosto alle Erbe',
                'description' => 'Délicieux poulet rôti aux herbes de Provence',
                'price' => 15.99,
                'delivery_price' => 18.99,
                'sku' => 'POULET-ROTI-001',
                'category_id' => Category::where('name_fr', 'Plats Chauds')->first()->id,
                'ingredients' => [
                    ['id' => Ingredient::where('reference', 'POULET')->first()->id, 'quantity' => 200],
                    ['id' => Ingredient::where('reference', 'HUILE-OLIVE')->first()->id, 'quantity' => 30],
                    ['id' => Ingredient::where('reference', 'AIL')->first()->id, 'quantity' => 10],
                ],
            ],
            [
                'name_fr' => 'Boeuf Bourguignon',
                'name_en' => 'Beef Bourguignon',
                'name_it' => 'Manzo alla Borgognona',
                'description' => 'Traditionnel boeuf bourguignon mijoté au vin rouge',
                'price' => 19.99,
                'delivery_price' => 22.99,
                'sku' => 'BOEUF-BOURG-001',
                'category_id' => Category::where('name_fr', 'Plats Chauds')->first()->id,
                'ingredients' => [
                    ['id' => Ingredient::where('reference', 'BOEUF')->first()->id, 'quantity' => 250],
                    ['id' => Ingredient::where('reference', 'CAROTTE')->first()->id, 'quantity' => 2],
                    ['id' => Ingredient::where('reference', 'OIGNON')->first()->id, 'quantity' => 1],
                ],
            ],
            [
                'name_fr' => 'Soupe de Légumes',
                'name_en' => 'Vegetable Soup',
                'name_it' => 'Zuppa di Verdure',
                'description' => 'Soupe maison aux légumes frais de saison',
                'price' => 8.99,
                'delivery_price' => 10.99,
                'sku' => 'SOUPE-LEG-001',
                'category_id' => Category::where('name_fr', 'Soupes')->first()->id,
                'ingredients' => [
                    ['id' => Ingredient::where('reference', 'CAROTTE')->first()->id, 'quantity' => 2],
                    ['id' => Ingredient::where('reference', 'PDT')->first()->id, 'quantity' => 200],
                    ['id' => Ingredient::where('reference', 'OIGNON')->first()->id, 'quantity' => 1],
                ],
            ],
            [
                'name_fr' => 'Gratin Dauphinois',
                'name_en' => 'Potato Gratin',
                'name_it' => 'Gratin di Patate',
                'description' => 'Gratin de pommes de terre à la crème',
                'price' => 12.99,
                'delivery_price' => 14.99,
                'sku' => 'GRATIN-DAUPH-001',
                'category_id' => Category::where('name_fr', 'Plats Chauds')->first()->id,
                'ingredients' => [
                    ['id' => Ingredient::where('reference', 'PDT')->first()->id, 'quantity' => 400],
                    ['id' => Ingredient::where('reference', 'CREME')->first()->id, 'quantity' => 200],
                    ['id' => Ingredient::where('reference', 'AIL')->first()->id, 'quantity' => 5],
                ],
            ],
        ];

        foreach ($products as $productData) {
            $ingredients = $productData['ingredients'];
            unset($productData['ingredients']);
            
            $product = Product::create($productData);
            
            foreach ($ingredients as $ingredient) {
                $product->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }
        }
    }
}
