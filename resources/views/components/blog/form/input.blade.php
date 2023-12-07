@props(['type' => 'text', 'name', 'placeholder', 'required' => 'true', 'value'])

<input value='{{ $value }}' {{ $requirecd == true ? 'required' : '' }} type="{{ $type }}" id="{{ $name }}" name='{{ $name }}' class="form-control" placeholder="{{ $placeholder }}">

@error($name)
<samll class="text-danger">{{ $message }}</samll>
@enderror