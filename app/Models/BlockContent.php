<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockContent extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'block_id', 'block_template_id'];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
