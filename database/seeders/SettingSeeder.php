<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sosmedLink = [
            'facebook' => null,
            'instagram' => null,
        ];

        Setting::create([
            'name' => 'Toko Online',
            'description' => '-',
            'email' => null,
            'phone' => null,
            'address' => null,
            'social_media' => json_encode($sosmedLink),
        ]);
    }
}
