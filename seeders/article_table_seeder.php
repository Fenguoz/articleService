<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Article::insert([
            ['id' => 1,'category_id' => 5,'key' => 'ABOUT_US','title' => '关于我们'],
            ['id' => 2,'category_id' => 5,'key' => 'BUY_PROTOCOL','title' => '用户协议'],
            ['id' => 3,'category_id' => 5,'key' => 'USER_PROTOCOL','title' => '购买协议'],
            ['id' => 4,'category_id' => 5,'key' => 'PRIVACY_PROTOCOL','title' => '隐私协议'],
            ['id' => 5,'category_id' => 5,'key' => 'RECHARGE_INSTRUCTION','title' => '充值说明'],
            ['id' => 6,'category_id' => 5,'key' => 'WITHDRAW_INSTRUCTION','title' => '提现说明'],
            ['id' => 7,'category_id' => 5,'key' => 'EXCHANGE_INSTRUCTION','title' => '闪兑说明'],
            ['id' => 8,'category_id' => 5,'key' => 'TRANSFER_INSTRUCTION','title' => '转账说明'],
            ['id' => 9,'category_id' => 1,'key' => null,'title' => '帮助中心'],
            ['id' => 10,'category_id' => 2,'key' => null,'title' => '资讯'],
            ['id' => 11,'category_id' => 3,'key' => null,'title' => '公告'],
            ['id' => 12,'category_id' => 4,'key' => null,'title' => '首页Banner'],
        ]);
    }
}
