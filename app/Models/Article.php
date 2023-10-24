<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];


    public function articleUser()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function articleCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function articleCity()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
