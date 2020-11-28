<?php

namespace App\Services;

use App\Models\JobArea;
use App\Models\Posting;

class PostingService
{
    public function store(object $request): \Illuminate\Http\JsonResponse
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
                if ($postingsTranslation && isset($request->areas[$language]) && is_array($request->areas[$language])) {
                    $jobAreaService = new JobAreaService();
                    $areaItemsCount = 0;
                    foreach ($request->areas[$language] as $content) {
                        $areaItemsCount++;
                        if (!empty($content) && $areaItemsCount <= 5) {
                            $jobAreaService->createJobArea($content, $postingsTranslation->id);
                        }
                    }
                }
            }

            return response()->json(['message' => 'Saved successfully!'], 201);
        }

        return response()->json(['error' => 'Internal server error'], 500);
    }

    public function createPosting(int $user_id): object
    {
        return Posting::create(['user_id' => $user_id]);
    }

    public function update(object $request, int $posting_id): \Illuminate\Http\JsonResponse
    {
        $posting = Posting::find($posting_id);
        if ($posting) {
            $postingsTranslationService = new PostingsTranslationService();
            foreach (config('app.available_locales') as $language) {
                $postingsTranslation = $posting->postingsTranslationsByLanguage($language)->firstOrFail();
                $updatedPostingsTranslation = $postingsTranslationService->updatePostingsTranslation(
                    $postingsTranslation,
                    $request->title[$language],
                    $request->description[$language],
                    $request->salary[$language]
                );
                if ($updatedPostingsTranslation && isset($request->areas[$language]) && is_array($request->areas[$language])) {
                    $jobAreas = JobArea::where('postings_translation_id', $postingsTranslation->id);
                    $oldAreaItemsCount = $jobAreas->count();
                    $jobAreaService = new JobAreaService();
                    $areaItemsCount = 0;
                    foreach ($request->areas[$language] as $newAreaIndex => $newAreaValue) {
                        $areaItemsCount++;
                        if ($areaItemsCount <= 5) {
                            $currentJobArea = $jobAreas->skip($newAreaIndex)->first();
                            if (empty($newAreaValue)) {
                                if ($currentJobArea) {
                                    $jobAreaService->deleteJobArea($currentJobArea);
                                }
                            } else if ($newAreaIndex + 1 <= $oldAreaItemsCount) {
                                $jobAreaService->updateJobArea($currentJobArea, $newAreaValue);
                            } else {
                                $jobAreaService->createJobArea($newAreaValue, $postingsTranslation->id);
                            }
                        }
                    }
                }
            }

            return response()->json(['message' => 'Record successfully updated!'], 201);
        }

        return response()->json(['error' => 'Record with id ' . $posting_id . ' don\'t exist '], 404);
    }
}
