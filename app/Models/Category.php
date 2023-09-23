<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'is_active'];

    public function products()
    {
                            // related        foreignKey    LocalKey
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
