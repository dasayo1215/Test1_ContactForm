<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //categoriesテーブルのダミーデータ作成
        $this->call(CategoriesTableSeeder::class);
        //contactsテーブルのダミーデータ作成
        $this->call(ContactsTableSeeder::class);
    }
}
