<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$this->createEnvUser();
		$this->createFakeUsers();
		
	}

	protected function createFakeUsers()
	{
		$faker = Faker::create();

		foreach(range(1, 30) as $index)
		{
			User::create([
				'first_name' 	=> $faker->firstName,
				'last_name' 	=> $faker->lastName,
				'email' 		=> $faker->safeEmail,
				'username' 		=> $faker->userName,
				'password' 		=> $faker->password,
				'image'			=> $faker->image

			]);
		}
	}

	protected function createEnvUser()
	{
		$user = new User();
		$user->first_name = $_ENV['USER_FIRST_NAME'];
		$user->last_name = $_ENV['USER_LAST_NAME'];
		$user->email = $_ENV['USER_EMAIL'];
		$user->username = $_ENV['USER_USERNAME'];
		$user->password = $_ENV['USER_PASS'];
		$user->image = $_ENV['USER_IMAGE'];
		$user->role = $_ENV['USER_ROLE'];
		$user->save();
	}

}