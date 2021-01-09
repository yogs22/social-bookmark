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
            $content->image_url = 'https://picsum.photos/400/300?random='.mt_rand(1,9);
            $content->update();

            $this->command->info($content->title);
        }
    }
}
