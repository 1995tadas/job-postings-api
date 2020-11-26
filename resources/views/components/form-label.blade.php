<label class="mb-2 uppercase font-bold text-lg text-grey-darkest"
       @if(isset($for)) for="{{$for}}" @endif>
    {{$slot}}
</label>
