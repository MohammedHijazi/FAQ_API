<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $hidden=[
        'created_at','updated_at'
    ];
    protected $fillable=[
        'name','fields'
        ];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
