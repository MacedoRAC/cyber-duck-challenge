<?php

namespace Database\Seeders;

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
         User::factory()->create([
             'name' => 'Administrator',
             'email' => 'admin@admin.com'
         ]);

         if(config('app.env') === 'local') {
             $this->call(CompanyEmployeeSeeder::class);
         }
    }
}
