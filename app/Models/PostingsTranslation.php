<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostingsTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['language', 'title', 'description', 'salary', 'posting_id'];

    public function jobAreas()
    {
        return $this->hasMany(JobArea::class);
    }
}
