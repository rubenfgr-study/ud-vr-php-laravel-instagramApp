<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach ($images as $image)
        @include('components.image', ['image' => $image])
    @endforeach

    <div class="d-flex flex-column">
        {{ $images->links() }}
    </div>

</x-app-layout>
