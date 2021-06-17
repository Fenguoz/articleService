<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id 
 * @property int $category_id 
 * @property string $key 
 * @property string $title 
 * @property string $content 
 * @property string $description 
 * @property string $cover 
 * @property int $display 
 * @property int $recommend 
 * @property int $sort 
 * @property string $keywords 
 * @property int $hits 
 * @property string $author 
 * @property int $type 
 * @property string $link 
 * @property string $lang 
 * @property string $video 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 */
class Article extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'title', 'content', 'description', 'cover', 'display', 'key', 'recommend', 'author', 'hits', 'type', 'link', 'lang', 'video', 'keywords', 'sort'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'category_id' => 'integer', 'display' => 'integer', 'recommend' => 'integer', 'sort' => 'integer', 'hits' => 'integer', 'type' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
    /**
     * getList
     * 
     * @param array $where 查询条件
     * @param array $order 排序条件
     * @param int $pageSize 页条数
     * @param int $currentPage 页数
     * @return array
     */
    public function getList($where = [], $order = [], $pageSize = 0, $currentPage = 1)
    {
        $query = $this->query()->select(
            $this->table . '.id',
            $this->table . '.category_id',
            $this->table . '.title',
            $this->table . '.content',
            $this->table . '.description',
            $this->table . '.cover',
            $this->table . '.display',
            $this->table . '.keywords',
            $this->table . '.recommend',
            $this->table . '.author',
            $this->table . '.hits',
            $this->table . '.type',
            $this->table . '.link',
            // $this->table . '.lang',
            $this->table . '.video',
            $this->table . '.created_at'
        );
        // 循环增加查询条件
        foreach ($where as $k => $v) {
            if ($k === 'title') {
                $query = $query->where($this->table . '.' . $k, 'LIKE', '%' . $v . '%');
                continue;
            }
            if ($k === 'start_time') {
                $query = $query->where($this->table . '.created_at', '>', $v . ' 00:00:00');
                continue;
            }
            if ($k === 'end_time') {
                $query = $query->where($this->table . '.created_at', '<', $v . ' 23:59:59');
                continue;
            }
            if ($k == 'category_ids') {
                $query = $query->whereIn($this->table . '.category_id', $v);
                continue;
            }
            if ($v || $v != null) {
                $query = $query->where($this->table . '.' . $k, $v);
            }
        }
        // 追加排序
        if ($order && is_array($order)) {
            foreach ($order as $k => $v) {
                $query = $query->orderBy($this->table . '.' . $k, $v);
            }
        }
        // 是否分页
        if ($pageSize) {
            $offset = ($currentPage - 1) * $pageSize;
            $query = $query->offset($offset)->limit($pageSize);
        }
        return $query->with('category')->get();
    }
    /**
     * getCount
     * 
     * @param array $where
     * @return int
     */
    public function getCount($where = [])
    {
        $query = $this->query();
        foreach ($where as $k => $v) {
            if ($k === 'title') {
                $query = $query->where($this->table . '.' . $k, 'LIKE', '%' . $v . '%');
                continue;
            }
            if ($k === 'start_time') {
                $query = $query->where($this->table . '.created_at', '>', $v . ' 00:00:00');
                continue;
            }
            if ($k === 'end_time') {
                $query = $query->where($this->table . '.created_at', '<', $v . ' 23:59:59');
                continue;
            }
            if ($k == 'category_ids') {
                $query = $query->whereIn($this->table . '.category_id', $v);
                continue;
            }
            $query = $query->where($this->table . '.' . $k, $v);
        }
        $query = $query->count();
        return $query > 0 ? $query : 0;
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id')
            ->select(['id', 'name', 'parent_id', 'key']);
    }

    public static function isExistArticleKey(string $key, string $lang): bool
    {
        return Article::where('key', $key)->where('lang', $lang)->exists();
    }
}
