@foreach ($list as $key => $displayName)
<label class="radio">
    @if (old($name) === null)
        @if ($key == $value)
            <input type="radio" name={{ $name }} value={{ $key }} checked>
        @else
            <input type="radio" name={{ $name }} value={{ $key }}>
        @endif
    @else
        @if ($key == old($name))
            <input type="radio" name={{ $name }} value={{ $key }} checked>
        @else
            <input type="radio" name={{ $name }} value={{ $key }}>
        @endif
    @endif
    {{ $displayName }}
</label>
@endforeach