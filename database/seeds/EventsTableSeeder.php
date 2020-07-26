<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\Event::class, 5)->create()->each(function ($event){
           $event->member()->save(factory(\App\Member::class)->make());
       });
    }
}
