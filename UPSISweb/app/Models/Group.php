<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    public $primaryKey = 'id';

    public $timestamp = true;

    // protected $guarded = [];
    // public function students()
    // { 
  
    //     return $this->hasMany(Student::class);
    // }
}
