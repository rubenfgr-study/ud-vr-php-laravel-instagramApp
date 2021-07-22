<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de usuarios') }}
        </h2>
    </x-slot>

    <div class="p-3">
        <form action="{{ route('user.users') }}" method="GET">

            <div class="row align-items-center">
                <div class="form-group col">
                    <input type="text" class="form-control" name="search" id="search" aria-describedby="helpId"
                        placeholder="Nick, nombre o apellidos...">
                </div>
                <div class="form-group col">
                    <input type="submit" value="Buscar" class="btn btn-sm btn-success">
                </div>

            </div>
        </form>

    </div>

    @foreach ($users as $user)
        @include('components.user', ['user' => $user])
    @endforeach

    <div class="d-flex flex-column">
        {{ $users->links() }}
    </div>

</x-app-layout>
