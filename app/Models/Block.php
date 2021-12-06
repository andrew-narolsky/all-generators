<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public function template()
    {
        return $this->belongsTo(Template::class)->withPivot('id');
    }

    public function content()
    {
        return $this->belongsTo(BlockContent::class, 'id', 'block_id');
    }
}
