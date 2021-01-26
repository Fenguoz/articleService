<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article', function (Blueprint $table) {
            $table->unique('key');
            $table->bigIncrements('id')->comment('文章id');
            $table->unsignedInteger('category_id')->comment('分类id')->nullable(false);
            $table->string('key')->nullable()->comment('索引key');
            $table->string('title', 255)->default('')->comment('文章标题')->nullable(false);
            $table->text('content')->nullable()->comment('文章内容');
            $table->string('description', 255)->default('')->comment('文章描述');
            $table->string('cover')->default('')->comment('文章图片');
            $table->unsignedTinyInteger('display')->default(1)->comment('是否显示');
            $table->unsignedTinyInteger('recommend')->default(0)->comment('是否推荐');
            $table->unsignedTinyInteger('sort')->default(100)->comment('排序');
            $table->string('keywords')->default('')->comment('关键字');
            $table->unsignedInteger('hits')->default(0)->comment('阅读量');
            $table->string('author')->default('')->comment('作者');
            $table->unsignedTinyInteger('type')->default(2)->comment('文章类型（1不跳转 2文章详情 3应用页面跳转 4WebView链接 5浏览器链接）');
            $table->string('link')->default('')->comment('链接（不跳转和文章详情时为空）');
            $table->string('lang', 50)->default('zh-CN')->comment('语言');
            $table->string('video')->default('')->comment('视频');
            $table->timestamps();
            $table->softDeletes();
        });
        Db::statement("ALTER TABLE `article` comment'文章表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
}
