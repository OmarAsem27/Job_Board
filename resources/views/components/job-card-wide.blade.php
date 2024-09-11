@props(['job'])

<x-panel class="flex gap-x-6 ">

    <div>
        {{-- <x-employer-logo /> --}}
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-700">
            {{ $job->employer->name }}
        </a>
        <h3 class="font-bold text-xl mt-3 transition-colors duration-300 group-hover:text-blue-600"> {{ $job->title }}
        </h3>
        <p class="text-sm text-gray-400 mt-auto ">{{ $job->salary }}</p>
    </div>

    <div class=" ">
        @foreach ($job->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>
</x-panel>
