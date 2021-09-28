<?php

namespace Database\Seeders;

use App\Models\Record;
use App\Models\User;
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
        User::factory()->count(10)
            ->has(
                Record::factory()->count(5)
            )->create();
    }
}
