<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobArea extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'postings_translation_id'];

    public $timestamps = false;
}
