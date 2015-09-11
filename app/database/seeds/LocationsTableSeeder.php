<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class LocationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
			Location::create([

				'location_name' => $faker->company,
				'location_street' => $faker->streetAddress,
				'location_city' => $faker->city,
				'location_state' => $faker->stateAbbr,
				'location_zip' => $faker->postcode
				
				
			]);
		}
	}

}