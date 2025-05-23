<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeGenderSearch($query, $gender) {
        if (!empty($gender) && $gender != 4) {
            $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id) {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date) {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }

    public function scopeKeywordSearch($query, $keyword) {
        if (!empty($keyword)) {
            $query->where(DB::raw("CONCAT(last_name, first_name)"), 'like', '%' . $keyword . '%')
                ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        }
    }
}
