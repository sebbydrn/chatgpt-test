<div>
    <button
        type="{{ $type }}"
        class="{{ $classNames }}"
        id="{{ $id }}"
        @if($clickMethod)
            wire:click="{{ $clickMethod }}"
        @endif
        @if($attributeNames)
            @foreach($attributeNames as $key => $value)
                {{ $key }}="{{ $value }}"
            @endforeach
        @endif
    >
        {{ $slot }}
    </button>
</div>
