<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getCategory() {
        return $this->belongsTo(DesignCategory::class, 'design_category_id', 'id');
    }
}
