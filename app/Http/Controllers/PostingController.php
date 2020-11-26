<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostingRequest;
use App\Models\Posting;
use App\Models\PostingsTranslation;
use App\Services\LocaleService;
use App\Services\PostingService;

class PostingController extends Controller
{
    public function store(PostingRequest $request): \Illuminate\Http\RedirectResponse
    {
        $postingService = new PostingService();
        $postingService->store($request);
        return redirect()->route('job.index');
    }

    public function edit($id)
    {
        $posting = Posting::findOrFail($id);
        $postingsTranslations = $posting->postingsTranslations()->with('jobAreas')->get();
        if (!$postingsTranslations) {
            abort(404);
        }

        $postingService = new PostingService();
        $postingsTranslations = $postingService->addLanguageCodeAsArrayKey($postingsTranslations);
        return view('jobs.edit', compact('postingsTranslations', 'id'));
    }

    public function index()
    {
        $localeService = new LocaleService();
        $language = $localeService->getLocale();
        $posting = Posting::get()->pluck('id');
        $postingsTranslations = PostingsTranslation::whereIn('posting_id', $posting)->where('language', $language)->select('posting_id', 'title')->latest()->paginate(10);
        return view('jobs.index', compact('postingsTranslations'));
    }

    public function show(Posting $id)
    {
        $localeService = new LocaleService();
        $language = $localeService->getLocale();
        $postingsTranslation = PostingsTranslation::where('language', $language)->where('posting_id', $id->id)->with('jobAreas')->firstOrFail();
        return view('jobs.show', ['postingsTranslation' => $postingsTranslation, 'user_id' => $id->user_id]);
    }

    public function update(PostingRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $postingService = new PostingService();
        $postingService->update($request, $id);
        return redirect()->route('job.show', ['id' => $id]);
    }
}
