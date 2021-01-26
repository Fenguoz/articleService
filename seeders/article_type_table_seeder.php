<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;

class ArticleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\ArticleType::insert([
            ['key' => 'ABOUT_US','name' => '关于我们'],
            ['key' => 'BUY_PROTOCOL','name' => '用户协议'],
            ['key' => 'USER_PROTOCOL','name' => '购买协议'],
            ['key' => 'PRIVACY_PROTOCOL','name' => '隐私协议'],
            ['key' => 'RECHARGE_INSTRUCTION','name' => '充值说明'],
            ['key' => 'WITHDRAW_INSTRUCTION','name' => '提现说明'],
            ['key' => 'EXCHANGE_INSTRUCTION','name' => '闪兑说明'],
            ['key' => 'TRANSFER_INSTRUCTION','name' => '转账说明'],
        ]);
    }
}
