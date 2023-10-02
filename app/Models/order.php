<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(user::class, "userId", "id");
    }

    public function category()
    {
        return $this->belongsTo(category::class, "categoryId", "id");
    }

    public function subCategory()
    {
        return $this->belongsTo(subCategory::class, "subCategoryId", "id");
    }
}
