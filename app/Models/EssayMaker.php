<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayMaker extends Model
{
    use HasFactory;

    protected $table = 'essay_makers';
    protected $fillable = ['text'];
}
