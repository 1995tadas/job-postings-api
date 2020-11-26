<div class="flex items-center justify-center w-full bg-red-100">
    <div class="w-full md:w-6/12 bg-white rounded shadow-lg p-8 m-0 sm:m-4">
        <h1 class="block w-full text-center text-grey-darkest text-3xl mb-6 uppercase">
            {{!$postingsTranslations?__('form.store'):__('form.update')}}
        </h1>
        <form class="mb-4" action="{{$action}}" method="post">
            {{ $slot }}
            @csrf
            @foreach(['en','lt'] as $language)
                <h2 class="block w-full text-center text-grey-darkest text-lg mb-6 uppercase">
                    @if($language ==='en')
                        {{__('form.english')}}
                    @elseif($language ==='lt')
                        {{__('form.lithuanian')}}
                    @endif
                </h2>
                <div class="flex flex-col mb-4">
                    <x-form-label for="{{$language}}-title">{{__('form.title')}}</x-form-label>
                    @error("title.$language")
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                    <x-form-input
                        value="{{old('title.'.$language)?old('title.'.$language):($postingsTranslations?$postingsTranslations[$language]['title']:null)}}"
                        id="{{$language}}-title" required='true' name="title[{{$language}}]"></x-form-input>
                </div>
                <div class="flex flex-col mb-4">
                    <x-form-label for="{{$language}}-description">{{__('form.description')}}</x-form-label>
                    @error("description.$language")
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                    <x-form-textarea
                        value="{{old('description.'.$language)?old('description.'.$language):($postingsTranslations?$postingsTranslations[$language]['description']:null)}}"
                        id="{{$language}}-description" name="description[{{$language}}]"></x-form-textarea>
                </div>
                <div class="flex flex-col mb-4">
                    <x-form-label for="{{$language}}-salary">{{__('form.salary')}}</x-form-label>
                    @error("salary.$language")
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                    <x-form-textarea
                        value="{{old('salary.'.$language)?old('salary.'.$language):($postingsTranslations?$postingsTranslations[$language]['salary']:null)}}"
                        id="{{$language}}-salary" name="salary[{{$language}}]"></x-form-textarea>
                </div>
                <div class="flex flex-col mb-10">
                    <x-form-label>{{__('form.areas')}}</x-form-label>
                    @for($i=0; $i<=5; $i++)
                        @error("areas.$language.$i")
                        <x-form-error>
                            {{$message}}
                        </x-form-error>
                        @enderror
                        <div class="mb-2">
                            <x-form-input
                                value="{{old('areas.'.$language.'.'.$i)?old('areas.'.$language.'.'.$i):(isset($postingsTranslations[$language]['job_areas'][$i])?$postingsTranslations[$language]['job_areas'][$i]['content']:null)}}"
                                name="areas[{{$language}}][]"></x-form-input>
                        </div>
                    @endfor
                </div>
            @endforeach
            <button
                class="rounded border shadow-md px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none mx-auto block">
                {{__('form.save')}}
            </button>
        </form>
    </div>
</div>
