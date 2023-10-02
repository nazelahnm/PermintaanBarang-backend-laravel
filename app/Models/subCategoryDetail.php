<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategoryDetail extends Model
{
    use HasFactory;
    protected $table = "subcategorydetails";
    protected $guarded = ["id"];

    public function subCategory()
    {
        return $this->belongsTo(subCategory::class, "subCategoryId", "id");
    }
}
