<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;



class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $imageDir = public_path('img');
    
        $images = glob($imageDir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
    
        
        if (!empty($images)) {
            $randomImagePath = $images[array_rand($images)];
            $imageFilename = basename($randomImagePath);
    
            DB::table('products')->insert([
                'name' => Str::random(6),
                'price' => rand(100, 999),
                'image' => 'img/' . $imageFilename 
            ]);
        }
    }
    
}
