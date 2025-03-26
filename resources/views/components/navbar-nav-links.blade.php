@php
    $classes = $active
        ? 'nav-link active text-primary hover:text-accent font-medium text-sm font-secondary transition-colors duration-200 py-2 relative'
        : 'nav-link text-dark hover:text-accent font-medium text-sm font-secondary transition-colors duration-200 py-2 relative';
@endphp
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
