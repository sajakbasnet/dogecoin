<?php

namespace Database\Seeders;

use App\Model\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $englishBackend = Language::where('id', 1)->first();
        if (! $englishBackend) {
            Language::create([                
                'name' => 'English',
                'language_code' => 'en',
                'group' => 'backend',
            ]);
        }
        $englishFrontend = Language::where('id', 2)->first();
        if (! $englishFrontend) {
            Language::create([                
                'name' => 'English',
                'language_code' => 'en',
                'group' => 'frontend',
            ]);
        }
        $japaneseBackend = Language::where('id', 3)->first();
        if (! $japaneseBackend) {
            Language::create([              
                'name' => 'Japanese',
                'language_code' => 'ja',
                'group' => 'backend',
            ]);
        }
        $japaneseFrontend = Language::where('id', 4)->first();
        if (! $japaneseFrontend) {
            Language::create([              
                'name' => 'Japanese',
                'language_code' => 'ja',
                'group' => 'frontend',
            ]);
        }
    }
}
