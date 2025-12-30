@php
    $width = $width ?? 400;
    $height = $height ?? 300;
    $seed = $seed ?? 'default';
    $alt = $alt ?? 'Image';
    $class = $class ?? 'img-fluid';
    
    // Generate fallback URL with specific dimensions
    $fallbackUrl = "https://picsum.photos/{$width}/{$height}?random={$seed}";
@endphp

@if($src)
    <img src="{{ $src }}" 
         alt="{{ $alt }}" 
         class="{{ $class }}"
         onerror="this.onerror=null; this.src='{{ $fallbackUrl }}';">
@else
    <img src="{{ $fallbackUrl }}" 
         alt="{{ $alt }}" 
         class="{{ $class }}">
@endif