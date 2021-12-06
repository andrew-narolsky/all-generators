<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'template_id', 'seo_title', 'seo_description'];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
