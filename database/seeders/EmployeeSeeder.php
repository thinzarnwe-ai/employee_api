<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    private const TOTAL = 10000;

    private const CHUNK = 1000;

    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $faker->seed(20260620);
        $now = now();
        $rows = [];

        for ($i = 1; $i <= self::TOTAL; $i++) {
            $firstName = $faker->firstName();
            $lastName = $faker->lastName();

            $rows[] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => Str::lower("{$firstName}.{$lastName}.{$i}@example.com"),
                'phone' => $faker->numerify('+1-###-###-####'),
                'address' => str_replace("\n", ', ', $faker->address()),
                'salary' => $faker->numberBetween(30000, 200000),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($rows) === self::CHUNK) {
                DB::table('employees')->insert($rows);
                $rows = [];
            }
        }

        if ($rows !== []) {
            DB::table('employees')->insert($rows);
        }

        $this->command->info(self::TOTAL . ' employees seeded.');
    }
}
