<?php

namespace App\Services;

use App\Models\JobArea;

class JobAreaService
{
    public function createJobArea(string $content, int $postings_translation_id): object
    {
        return JobArea::create([
            'content' => ucfirst($content),
            'postings_translation_id' => $postings_translation_id
        ]);
    }

    public function updateJobArea(object $jobArea, ?string $content): bool
    {
        return $jobArea->update([
            'content' => ucfirst($content),
        ]);
    }
}
