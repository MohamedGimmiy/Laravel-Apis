<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticateContract;
class Author extends Model implements AuthenticateContract
{
    use HasFactory , HasApiTokens, Authenticatable;
    public $timestamps = false;
    protected $guarded = [];

    public function books(){
        return $this->hasMany(Book::class);
    }


}
