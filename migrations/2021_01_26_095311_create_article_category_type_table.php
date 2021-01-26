<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class CreateArticleCategoryTypeTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_category_type', function (Blueprint $table) {
            $table->primary('key');
            $table->string('key', 50)->comment('索引key');
            $table->string('name', 100)->comment('名字');
        });
        Db::statement("ALTER TABLE `article_category_type` comment'文章分类类型表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_category_type');
    }
}
