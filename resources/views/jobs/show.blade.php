<x-app-layout>
    <div class="flex min-h-screen h-full items-center justify-center w-full bg-red-100">
        <div class="w-full md:w-6/12 bg-white rounded shadow-lg p-8 m-0 sm:m-4">
            <h1 class="text-center text-grey-darkest text-2xl uppercase break-words">{{$postingsTranslation->title}}</h1>
            <span class="my-10 text-lg block uppercase text-blue-300"><i class="fas fa-paperclip"></i> {{__('form.description')}}</span>
            <p class="text-sm text-justify break-words">{{$postingsTranslation->description}}</p>
            <span class="my-10 text-lg block uppercase text-blue-300"><i class="fas fa-wallet"></i> {{__('form.salary')}}</span>
            <p class="text-sm text-justify break-words">{{$postingsTranslation->salary}}</p>
            @if(!$postingsTranslation->jobAreas->isEmpty())
                <span class="my-10 text-lg block uppercase text-blue-300"><i class="fas fa-award"></i> {{__('form.areas')}}</span>
                <ul class="ml-5 text-sm list-disc">
                    @foreach($postingsTranslation->jobAreas as $jobArea)
                        @if($jobArea->content)
                            <li>{{$jobArea->content}}</li>
                        @endif
                    @endforeach
                </ul>
            @endif
            @if(auth()->check() && (auth()->user()->id === $user_id))
                <button
                    class="rounded border shadow-md px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none mx-auto block">
                    <a href="{{route('job.edit',['id'=>$postingsTranslation->posting_id])}}">{{__('jobs.edit')}}</a>
                </button>
            @endif
        </div>
    </div>
</x-app-layout>
