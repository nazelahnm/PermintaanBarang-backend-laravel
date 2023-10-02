<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    protected $table = "notifications";
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(user::class, "userId", "id");
    }

    public function order()
    {
        return $this->belongsTo(order::class, "orderId", "id");
    }
}
