<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        $json = File::get('database/data/city.list.json');
        $data = json_decode($json);
        foreach ($data as $city) {
            $this->command->info('Migrating ' . $city->name);
            City::create([
                'open_weather_identifier' => $city->id,
                'name' => $city->name,
                'state' => $city->state,
                'country' => $city->country,
                'lon' => $city->coord->lon,
                'lat' => $city->coord->lat,
            ]);
        }

    }
}
