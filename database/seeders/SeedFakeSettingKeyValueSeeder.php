<?php

namespace Modules\Setting\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Setting\app\Models\Setting;

class SeedFakeSettingKeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'logo'=>'logo',
            'title'=>'title',
            'meta_keywords'=>'meta_keywords',
            'meta_description'=>'meta_description',
            'robot_index'=>'robot_index',
            'favicon'=>'favicon',
            'footer_logo'=>'footer_logo',
            'email'=>'email',
            'start_market'=>'start_market',
            'end_market'=>'end_market',
            'admin_avatar'=>'admin_avatar',
            'side_bar_color'=>'red',
            'top_bar_color'=>'black',
        ];

        foreach($array as $key => $value){
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value,
            ]);
        }
    }
}
