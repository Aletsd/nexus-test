<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\CarModel;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brandsData = [
            [
                "id" => 1,
                "name" => "Acura",
                "models" => [
                    ["name" => "ILX", "average_price" => 303176],
                    ["name" => "MDX", "average_price" => 448193],
                    ["name" => "NSX", "average_price" => 3818225],
                ]
            ],
            [
                "id" => 2,
                "name" => "Audi",
                "models" => [
                    ["name" => "A3", "average_price" => 350000],
                    ["name" => "Q5", "average_price" => 700000],
                ]
            ],
        ];

        foreach ($brandsData as $brandData) {
            $brand = Brand::create([
                'id' => $brandData['id'],
                'name' => $brandData['name']
            ]);

            foreach ($brandData['models'] as $modelData) {
                CarModel::create(array_merge($modelData, ['brand_id' => $brand->id]));
            }
        }
    }
}
