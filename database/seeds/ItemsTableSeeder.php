<?php

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Item::truncate();
        Item::insert([
            ['name' => 'Sullen Rampart', 'hash_name' => 'Sullen%20Rampart', 'app_id' => 570],
            ['name' => 'Reaper\'s Wreath', 'hash_name' => 'Reaper%27s%20Wreath', 'app_id' => 570],
            /*['name' => 'Apogee of the Guardian Flame', 'hash_name' => 'Apogee%20of%20the%20Guardian%20Flame', 'game_id' => 570],
            ['name' => 'Immortal Treasure II 2017', 'hash_name' => 'Immortal%20Treasure%20II%202017', 'game_id' => 570],
            ['name' => 'Exalted Feast of Abscession', 'hash_name' => 'Exalted%20Feast%20of%20Abscession', 'game_id' => 570],
            ['name' => 'Feast of Abscession', 'hash_name' => 'Feast%20of%20Abscession', 'game_id' => 570],
            ['name' => 'Sullen Harvest', 'hash_name' => 'Sullen%20Harvest', 'game_id' => 570],
            ['name' => 'Sylvan Vedette', 'hash_name' => 'Sylvan%20Vedette', 'game_id' => 570],
            ['name' => 'Hydrakan Latch', 'hash_name' => 'Hydrakan%20Latch', 'game_id' => 570],
            ['name' => 'Bracers of the Cavern Luminar', 'hash_name' => 'Bracers%20of%20the%20Cavern%20Luminar', 'game_id' => 570],*/
        ]);
    }
}
