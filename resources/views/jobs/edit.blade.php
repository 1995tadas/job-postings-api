<x-app-layout>
    <x-job-form action="{{route('job.update',['id' => $id])}}" :postingsTranslations="$postingsTranslations">
        @method('PUT')
    </x-job-form>
</x-app-layout>
