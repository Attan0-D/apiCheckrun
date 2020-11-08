<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'name' => "Saindo de casa"
        ]);

        Category::create([
            'id' => 2,
            'name' => "Saindo do Trabalho"
        ]);

        Category::create([
            'id' => 3,
            'name' => "Lista de Compras"
        ]);

        Category::create([
            'id' => 4,
            'name' => "Meus Estudos"
        ]);

        Category::create([
            'id' => 5,
            'name' => "Outros"
        ]);
    }
}
