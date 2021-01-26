<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;

class ArticleCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\ArticleCategory::insert([
            ['id' => 1,'name' => '帮助中心','parent_id' => 0,'key' => 'HELP','display' => 1,'sort' => 100],
            ['id' => 2,'name' => '资讯','parent_id' => 0,'key' => 'NEWS','display' => 1,'sort' => 100],
            ['id' => 3,'name' => '公告','parent_id' => 0,'key' => 'ANNOUNCEMENT','display' => 1,'sort' => 100],
            ['id' => 4,'name' => '首页Banner','parent_id' => 0,'key' => 'BANNER','display' => 1,'sort' => 100],
            ['id' => 5,'name' => '其他','parent_id' => 0,'key' => 'OTHER','display' => 1,'sort' => 100],
        ]);
    }
}
