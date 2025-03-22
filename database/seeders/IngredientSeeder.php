<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            [
                'reference' => 'POULET',
                'name_fr' => 'Poulet',
                'name_en' => 'Chicken',
                'name_it' => 'Pollo',
                'is_active' => true,
            ],
            [
                'reference' => 'RIZ',
                'name_fr' => 'Riz',
                'name_en' => 'Rice',
                'name_it' => 'Riso',
                'is_active' => true,
            ],
            [
                'reference' => 'TOMATE',
                'name_fr' => 'Tomate',
                'name_en' => 'Tomato',
                'name_it' => 'Pomodoro',
                'is_active' => true,
            ],
            [
                'reference' => 'OIGNON',
                'name_fr' => 'Oignon',
                'name_en' => 'Onion',
                'name_it' => 'Cipolla',
                'is_active' => true,
            ],
            [
                'reference' => 'AIL',
                'name_fr' => 'Ail',
                'name_en' => 'Garlic',
                'name_it' => 'Aglio',
                'is_active' => true,
            ],
            [
                'reference' => 'POIVRE',
                'name_fr' => 'Poivre',
                'name_en' => 'Pepper',
                'name_it' => 'Pepe',
                'is_active' => true,
            ],
            [
                'reference' => 'SEL',
                'name_fr' => 'Sel',
                'name_en' => 'Salt',
                'name_it' => 'Sale',
                'is_active' => true,
            ],
            [
                'reference' => 'HUILE-OLIVE',
                'name_fr' => 'Huile d\'olive',
                'name_en' => 'Olive oil',
                'name_it' => 'Olio d\'oliva',
                'is_active' => true,
            ],
            [
                'reference' => 'BOEUF',
                'name_fr' => 'Boeuf',
                'name_en' => 'Beef',
                'name_it' => 'Manzo',
                'is_active' => true,
            ],
            [
                'reference' => 'CAROTTE',
                'name_fr' => 'Carotte',
                'name_en' => 'Carrot',
                'name_it' => 'Carota',
                'is_active' => true,
            ],
            [
                'reference' => 'PDT',
                'name_fr' => 'Pomme de terre',
                'name_en' => 'Potato',
                'name_it' => 'Patata',
                'is_active' => true,
            ],
            [
                'reference' => 'CREME',
                'name_fr' => 'Crème',
                'name_en' => 'Cream',
                'name_it' => 'Panna',
                'is_active' => true,
            ],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
