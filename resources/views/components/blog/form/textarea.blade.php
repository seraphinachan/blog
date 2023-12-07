@props(['name', 'placeholder', 'value'])

<textarea rows="5" required id="{{ $name }}" name='{{ $name }}' class="form-control" placeholder="{{ $placeholder }}">
  {{ $value }}
</textarea>

@error($name)
<samll class="text-danger">{{ $message }}</samll>
@enderror