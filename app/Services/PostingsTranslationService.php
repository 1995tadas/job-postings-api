<?php

namespace App\Services;

use App\Models\PostingsTranslation;

class PostingsTranslationService
{
    public function createPostingsTranslation(string $language, string $title, string $description, string $salary, int $posting_id): object
    {
        return PostingsTranslation::create([
            'language' => $language,
            'title' => ucfirst($title),
            'description' => ucfirst($description),
            'salary' => ucfirst($salary),
            'posting_id' => $posting_id
        ]);
    }

    public function updatePostingsTranslation(object $postingsTranslation, string $title, string $description, string $salary): bool
    {
        return $postingsTranslation->update([
            'title' => ucfirst($title),
            'description' => ucfirst($description),
            'salary' => ucfirst($salary)
        ]);
    }
}
