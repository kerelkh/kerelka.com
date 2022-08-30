<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\StatusPost;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getStatus() {
        return $this->belongsTo(StatusPost::class, 'status_id', 'id');
    }

    public function getCategory() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
