@props(['href' => null])

@if ($href)
    <a href="{{ $href }}">
        <img src="{{ asset('images/sublogo.png') }}" {{ $attributes->merge(['alt' => config('app.name', 'Laravel')]) }}>
    </a>
@else
    <img src="{{ asset('images/sublogo.png') }}" {{ $attributes->merge(['alt' => config('app.name', 'Laravel')]) }}>
@endif
