<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'Laravel' => 'laravel',
            'React Js' => 'react',
            'Vue Js' => 'vue'
        ];

        foreach ($arr as $key => $value) {
            $create = Subject::create([
                'name' => $key,
                'slug' => $value
            ]);
        }
    }
}
