<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'it@4sigma.de',
            'password' => Hash::make('admin'),
            'is_admin' => true,
        ]);

        $sbk = \App\Models\Insurence::factory()->create([
            'name' => 'SBK',
            'full_name' => 'Siemens-Betriebskrankenkasse',
        ]);

        \App\Models\Insured::factory()->create([
            'first_name' => 'Max',
            'last_name' => 'Mustermann',
            'kvnumber' => 'A123456789',
            'birthdate' => '1984-12-03',
            'kk_label' => $sbk->kk_label,
        ]);

        $bkk_bmw = \App\Models\Insurence::factory()->create([
            'name' => 'BMW-BKK',
            'full_name' => 'Betriebskrankenkasse der BMW AG',
        ]);

        \App\Models\Insured::factory()->create([
            'first_name' => 'Max',
            'last_name' => 'Mustermann',
            'kvnumber' => 'A123456789',
            'birthdate' => '1984-12-03',
            'kk_label' => $bkk_bmw->kk_label,
        ]);
    }
}
