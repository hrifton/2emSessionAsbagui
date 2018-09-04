<?php

use App\Model\user\artists;
use Illuminate\Database\Seeder;

class ArtistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    factory(Artists::class,100)->create();
    }
}
