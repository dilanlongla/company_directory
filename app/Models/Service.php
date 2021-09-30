<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Service
 * @package App\Models
 * @version September 30, 2021, 4:06 pm UTC
 *
 * @property string $title
 * @property string $body
 */
class Service extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'services';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'body'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'body' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
