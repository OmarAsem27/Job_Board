@props(['size' => 'base'])
@php
    $classesTag = 'bg-white/10 hover:bg-white/25 font-bold rounded-xl transitions-colors duration-300';

    if ($size === 'base') {
        $classesTag .= ' text-sm px-5 py-1';
    }
    if ($size === 'small') {
        $classesTag .= ' text-2xs px-3 py-1';
    }
@endphp


<a href="#" class="{{ $classesTag }}">{{ $slot }}</a>
