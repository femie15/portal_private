@props([
    'title' => null,
])

@php
    $attributes = $attributes->class([
        'container my-3',
    ])->merge([
        //
    ]);
@endphp

@section('title', $title)

<div {{ $attributes }}>
    @if($title)
        <h1> <i class="entypo-flag" style="color: {{ session()->get('theme') }}"></i> {{ $title }}</h1>
    @endif

    {{ $slot }}
</div>
