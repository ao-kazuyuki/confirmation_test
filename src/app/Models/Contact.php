<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeKeyWordSearch($query, $keyword, $gender, $category_id,$created_at){
        if(!empty($keyword)){
            $query->where(function($q) use ($keyword){
                  $q->where('first_name', 'like', '%'. $keyword. '%')
                    ->orwhere('last_name', 'like', '%'. $keyword. '%')
                    ->orwhere('email', 'like', '%'. $keyword. '%');
            });
        }
        if(!empty($gender)){
            $query->where('gender', $gender);
        }
        if(!empty($category_id)){
            $query->where('category_id', $category_id);
        }
        if(!empty($created_at)){
            $query->whereDate('created_at', $created_at );
        }
        return $query;
    }
}
