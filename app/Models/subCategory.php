<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;
    protected $table = "subcategories";
    protected $guarded = ["id"];

    public function category()
    {
        return $this->belongsTo(category::class, "categoryId", "id");
    }
}
