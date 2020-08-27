<?php

use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('contents')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        factory(App\Models\Content::class, 25)->create();
    }
}
