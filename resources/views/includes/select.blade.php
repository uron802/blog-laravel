<div class="select">
    <select name='{{ $name }}'>
    @foreach ($option as $key => $optionName)
        @if (old($name) === null)
            @if ($key == $value)
            <option selected>{{ $optionName }}</option>
            @else
            <option>{{ $optionName }}</option>
            @endif
        @else
            @if ($key == old($name))
            <option selected>{{ $optionName }}</option>
            @else
            <option>{{ $optionName }}</option>
            @endif
        @endif
    @endforeach
    </select>
</div>