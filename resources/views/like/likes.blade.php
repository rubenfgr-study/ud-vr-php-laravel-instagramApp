<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach ($likes as $like)
        @include('components.image', ['image' => $like->image])
    @endforeach

    <div class="d-flex flex-column">
        {{ $likes->links() }}
    </div>

</x-app-layout>
