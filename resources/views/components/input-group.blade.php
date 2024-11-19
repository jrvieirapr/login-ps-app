<div class="mb-4">
    <label for="{{ $id ?? $name }}" class="block text-gray-700">{{ $label }}</label>

    @if($type === 'textarea')
        <textarea 
            id="{{ $id ?? $name }}" 
            name="{{ $name }}" 
            class="w-full border border-gray-300 p-2 rounded {{ $hasError() ? 'border-red-500' : '' }} {{ $class ?? '' }}" 
            {{ $attributes }}>
            {{ $value ?? '' }}
        </textarea>
    @else
        <input 
            id="{{ $id ?? $name }}" 
            name="{{ $name }}" 
            type="{{ $type }}" 
            value="{{ $value ?? '' }}" 
            class="w-full border border-gray-300 p-2 rounded {{ $hasError() ? 'border-red-500' : '' }} {{ $class ?? '' }}" 
            {{ $attributes }}>
    @endif

    @if ($hasError())
        <p class="text-red-500 text-sm mt-1">{{ $errorMessage() }}</p>
    @endif
</div>
