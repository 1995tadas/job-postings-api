<input class="border py-2 px-3 text-grey-darkest w-full" type="text" name="{{$name}}" value="{{$value}}"
       @if(isset($id)) id="{{$id}}" @endif maxlength="255" {{isset($required)?'required':''}}
>
