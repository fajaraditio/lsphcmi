<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SchemesTableSeeder::class);
        $this->call(CompetenceTableSeeder::class);
        $this->call(TestSessionsSeeder::class);
        $this->call(FeedbackComponentsSeeder::class);
        $this->call(ScoringSeeder::class);
    }
}
