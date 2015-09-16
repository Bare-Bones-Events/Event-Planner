<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CalendarEventsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
			CalendarEvent::create([

				'event_name' => $faker->bs,
				'creator_id' => User::all()->random()->id,
				'location_id' => Location::all()->random()->id,
				'start_time' => $faker->time,
				'end_time' => $faker->time,
				'cost' => $faker->numberBetween($min = 25, $max = 500),
				'description' => $faker->text($maxNbChars = 200),
				'event_image' => $faker->image



			]);
		}
	}

}
