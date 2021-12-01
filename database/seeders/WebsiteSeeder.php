<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Website::create(['name' => 'website-one.com']);
        Website::create(['name' => 'website-two.com']);
        Website::create(['name' => 'website-three.com']);
    }
}
