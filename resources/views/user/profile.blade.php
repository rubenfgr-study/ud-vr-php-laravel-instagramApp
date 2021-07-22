<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('components.user', ['user' => $user])

    @foreach ($user->images as $image)
        @include('components.image', ['image' => $image])
    @endforeach


</x-app-layout>
