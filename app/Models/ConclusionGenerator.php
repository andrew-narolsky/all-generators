<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConclusionGenerator extends Model
{
    use HasFactory;

    protected $table = 'conclusion_generator';
    protected $fillable = ['title', 'text'];
}
