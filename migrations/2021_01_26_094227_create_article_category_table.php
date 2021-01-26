<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class CreateArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_category', function (Blueprint $table) {
            $table->unique('key');
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable(false)->comment('分类名称');
            $table->unsignedInteger('parent_id')->nullable(false)->comment('父ID');
            $table->string('key', 50)->nullable()->comment('索引key');
            $table->unsignedTinyInteger('display')->default(1)->comment('是否显示(0否 1是)');
            $table->unsignedTinyInteger('sort')->default(100)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
        Db::statement("ALTER TABLE `article_category` comment'文章分类表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_category');
    }
}
