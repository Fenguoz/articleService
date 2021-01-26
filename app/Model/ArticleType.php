<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property string $key 
 * @property string $name 
 */
class ArticleType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}