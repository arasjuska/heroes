<div {{ $attributes->merge(['class' => 'my-2']) }}>
    <h3 {{ $attributes->merge(['class' => 'hover:text-gray-500']) }}>
        {{ $slot }}
    </h3>
</div>
