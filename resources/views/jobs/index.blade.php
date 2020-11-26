<x-app-layout>
    <div class="flex h-screen items-center justify-center w-full bg-red-100">
        <div class="w-full h-full md:w-1/12 md:w-9/12 bg-white rounded shadow-lg p-8 sm:m-4 ">
            <h1 class="block w-full text-center text-grey-darkest text-m md:text-3xl uppercase mb-4">
                {{__('jobs.index')}}
            </h1>
            @auth
                <a href="{{route('job.create')}}">
                    <button type="button" class="mb-5 bg-blue-500 p-2 text-white rounded text-xs md:text-m">
                        {{__('jobs.new')}}
                    </button>
                </a>
            @endauth
            <div class="flex flex-col justify-between">
                @if(!$postingsTranslations->isEmpty())
                    <div class="bg-blue-300 px-5 pt-3 rounded">
                        @foreach($postingsTranslations as $translation)
                            <a href="{{route('job.show',['id'=>$translation->posting_id])}}"
                               class="text-xs md:text-lg block px-5 py-2 mb-3 bg-gray-100 hover:bg-gray-300 hover:font-bold rounded uppercase">{{Str::limit($translation->title,20,'...')}}</a>
                        @endforeach
                    </div>
                    {{$postingsTranslations->links()}}
                @else
                    <h3 class="mx-auto text-lg md:text-3xl">{{__('jobs.empty')}}</h3>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
