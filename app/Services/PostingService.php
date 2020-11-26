<?php

namespace App\Services;

use App\Models\JobArea;
use App\Models\Posting;

class PostingService
{
    public function addLanguageCodeAsArrayKey(object $postingsTranslations): array
    {
        $reformattedTranslation = [];
        foreach ($postingsTranslations->toArray() as $postingsTranslation) {
            $reformattedTranslation[$postingsTranslation['language']] = $postingsTranslation;
        }

        return $reformattedTranslation;
    }

    public function store(object $request): void
    {
        $posting = $this->createPosting(auth()->user()->id);
        if ($posting) {
            $postingsTranslationService = new PostingsTranslationService();
            foreach (config('app.available_locales') as $language) {
                $postingsTranslation = $postingsTranslationService->createPostingsTranslation(
                    $language,
                    $request->title[$language],
                    $request->description[$language],
                    $request->salary[$language],
                    $posting->id
                );
                if ($postingsTranslation) {
                    $jobAreaService = new JobAreaService();
                    foreach ($request->areas[$language] as $content) {
                        if (!empty($content)) {
                            $jobAreaService->createJobArea($content, $postingsTranslation->id);
                        }
                    }
                } else {
                    abort(404);
                }
            }
        } else {
            abort(404);
        }
    }

    public function createPosting(int $user_id): object
    {
        return Posting::create(['user_id' => $user_id]);
    }

    public function update(object $request, int $posting_id)
    {
        $posting = Posting::findOrFail($posting_id);
        $postingsTranslationService = new PostingsTranslationService();
        foreach (config('app.available_locales') as $language) {
            $postingsTranslation = $posting->postingsTranslationsByLanguage($language)->firstOrFail();
            $updated = $postingsTranslationService->updatePostingsTranslation(
                $postingsTranslation,
                $request->title[$language],
                $request->description[$language],
                $request->salary[$language]
            );
            if ($updated) {
                $jobAreas = JobArea::where('postings_translation_id', $postingsTranslation->id);
                $jobAreasCount = $jobAreas->count();
                $jobAreaService = new JobAreaService();
                foreach ($request->areas[$language] as $newAreaIndex => $newJobArea) {
                    if ($newAreaIndex + 1 <= $jobAreasCount) {
                        $currentJobArea = $jobAreas->skip($newAreaIndex)->first();
                        $jobAreaService->updateJobArea($currentJobArea, $newJobArea);
                    } else {
                        if ($newJobArea) {
                            $jobAreaService->createJobArea($newJobArea, $postingsTranslation->id);
                        }
                    }
                }
            }
        }
    }
}
