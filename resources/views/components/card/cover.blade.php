<div {{ $attributes->merge(['class' => 'rounded-md overflow-hidden']) }}>
    <img {{ $attributes->merge(['src' => $image, 'alt' => $alt, 'class' => 'w-full h-60 object-cover']) }}>
</div>
