<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'name', 'phone', 'email', 'company', 'Email', 'date', 'photo'
  ];
  public $timestamps = false;
}
