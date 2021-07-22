<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración de mi cuenta') }}
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

            <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="Auth::user()->name"
                        required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="Auth::user()->email"
                        required />
                </div>

                <!-- Nick Address -->
                <div class="mt-4">
                    <x-label for="nick" :value="__('Nick')" />

                    <x-input id="nick" class="block mt-1 w-full" type="text" name="nick" :value="Auth::user()->nick"
                        required />
                </div>

                <!-- Surname Address -->
                <div class="mt-4">
                    <x-label for="surname" :value="__('Surname')" />

                    <x-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                        :value="Auth::user()->surname" required />
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <x-label for="image" :value="__('Imagen')" />
                    @include('components.avatar')
                    <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="Auth::user()->image"
                        required />
                </div>


                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Guardar cambios') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>

</x-app-layout>
