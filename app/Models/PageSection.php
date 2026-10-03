<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $table = 'page_sections';

    public $timestamps = false;

    protected $fillable = [
        'section',
        'content',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }
}
