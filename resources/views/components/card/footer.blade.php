<div {{ $attributes->merge(['class' => 'flex items-center justify-between mt-auto text-gray-500 text-sm']) }}>
    <p {{ $attributes->merge(['class' => 'uppercase']) }}>
        {{ $alignment }}
    </p>

    <p>
        {{ $speed }}
    </p>
</div>
