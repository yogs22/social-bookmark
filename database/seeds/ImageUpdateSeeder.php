<?php

use Illuminate\Database\Seeder;
use App\Models\Content;

class ImageUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = Content::all();
        foreach ($contents as $content) {
            $content->image_url = 'https://picsum.photos/400?random='.mt_rand(1,5);
            $content->update();

            echo "Content" . $content->name;
        }
    }
}
