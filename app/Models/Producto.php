<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable=['nombre','precio','cantidad','photo','user_id'];
    protected $hidden=['created_at','updated_at'];
    public function user(){
        return$this->belongsTo(User::class);
    }
}
