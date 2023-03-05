<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    public function run()
    {
        DB::transaction(function () {
            $birthdayCake = Category::updateOrCreate(
                ['name' => 'Ad günü'],
                [
                    'description' => 'Ad günü tortları'
                ]
            );

            $birthdayCake->addMediaFromUrl(asset('images/categories/birthdayCake.jpg'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $babycake = Category::updateOrCreate(
                ['name' => 'Uşaq tortları'],
                [
                    'description' => 'Uşaqlar üçün olan tortlar'
                ]
            );

            $babycake->addMediaFromUrl(asset('images/categories/babycake.jpg'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $weddingCake = Category::updateOrCreate(
                ['name' => 'Toy torları'],
                [
                    'description' => 'Uşaqlar üçün olan tortlar'
                ]
            );

            $weddingCake->addMediaFromUrl(asset('images/categories/weddingCake.jpg'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $cupCake = Category::updateOrCreate(
                ['name' => 'CupCake'],
                [
                    'description' => 'Uşaqlar üçün olan tortlar'
                ]
            );

            $cupCake->addMediaFromUrl(asset('images/categories/cupcake.jpg'))->toMediaCollection('primary');
        });

    }
}
