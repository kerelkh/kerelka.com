<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPost extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPost() {
        return $this->hasMany(Post::class, 'status_id', 'id');
    }
}
