<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Post
 * @package App\Models
 * @version September 30, 2021, 4:04 pm UTC
 *
 * @property string $title
 * @property string $body
 * @property string $image
 */
class Post extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'posts';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'body',
        'image',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'body' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class, 'post_categories');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
