<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;

class ArticleCategoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\ArticleCategoryType::insert([
            ['key' => 'HELP','name' => '帮助中心'],
            ['key' => 'NEWS','name' => '资讯'],
            ['key' => 'ANNOUNCEMENT','name' => '公告'],
            ['key' => 'BANNER','name' => '首页Banner'],
            ['key' => 'OTHER','name' => '其他'],
        ]);
    }
}
