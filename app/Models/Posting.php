<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function postingsTranslations()
    {
        return $this->hasMany(PostingsTranslation::class);
    }

    public function postingsTranslationsByLanguage($language)
    {
        return $this->postingsTranslations()->where('language', $language);
    }
}