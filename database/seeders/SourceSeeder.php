<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert($this->getData());
    }

    private function getData(): array
	{
		$faker = Factory::create('en_EN');
		$data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $faker->text(mt_rand(100, 200)),
                'link' => $faker->url(),
                'updated_at' => now(),
                'created_at' => now()
            ];
        }

		return $data;
	}
}
