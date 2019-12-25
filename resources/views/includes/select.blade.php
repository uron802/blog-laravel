<div class="select">
    <select name='{{ $name }}'>
    @foreach ($option as $key => $optionName)
        @if ($key == $value)
        <option selected>{{ $optionName }}</option>
        @else
        <option>{{ $optionName }}</option>
        @endif
    @endforeach
    </select>
</div>