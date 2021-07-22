<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subir imagen') }}
        </h2>
    </x-slot>

    <x-guest-layout>
        @include('components.message')
        <x-auth-card>

            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">

                @csrf

                <!-- Image -->
                <div class="mt-4">
                    <x-label for="image_path" :value="__('Imagen')" />
                    @include('components.avatar')
                    <x-input id="image_path" class="block mt-1 w-full" type="file" name="image_path" required />
                </div>

                <!-- Description -->
                <div class="mt-3">
                    <x-label for="description" :value="__('Descripción')" />

                    <textarea cols="30" rows="5" class="form-control" id="description" class="block mt-1 w-full"
                        type="text" name="description" required autofocus></textarea>
                </div>


                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Enviar') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>

</x-app-layout>
