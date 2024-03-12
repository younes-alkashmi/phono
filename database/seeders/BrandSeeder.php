<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $brands = $this->brands();
        foreach($brands as $brand)
        Brand::create([
            'name' => $brand,
        ]);
    }

    public function brands(){
        return [
            'SAMSUNG',
            'APPLE',
            'HUAWEI',
            'NOKIA',
            'SONY',
            'LG',
            'HTC',
            'MOTOROLA',
            'LENOVO',
            'XIAOMI',
            'GOOGLE',
            'HONOR',
            'OPPO',
            'REALME',
            'ONEPLUS',
            'VIVO',
            'MEIZU',
            'BLACKBERRY',
            'ASUS',
            'ALCATEL',
            'ZTE',
            'MICROSOFT',
            'VODAFONE',
            'ENERGIZER',
            'CAT',
            ];
    }
}
