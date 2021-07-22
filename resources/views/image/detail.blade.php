<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="card m-3">
        <div class="d-flex gap-3 align-items-center p-2">
            <div class="pub_avatar">
                @if (str_starts_with($image->user->image, 'http'))
                    <img class="card-img-top avatar" src="{{ $image->user->image }}" alt="">
                @else
                    <img class="card-img-top avatar"
                        src="{{ route('user.image', ['filename' => $image->user->image]) }}" alt="">
                @endif
            </div>
            <h4 class="card-title">
                <b>{{ $image->user->name . ', ' . $image->user->surname }}</b>
                <span class="fs-6 text-indigo-600">{{ '@' . $image->user->nick }}</span>
            </h4>

        </div>

        <div class="card-body">
            <div class="detail_avatar">
                @if (str_starts_with($image->image_path, 'http'))
                    <img src="{{ $image->image_path }}" alt="">
                @else
                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                @endif
            </div>
            <div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="text-xs text-secondary">{{ longTimeFilter($image->created_at) }}</div>
                    <div class="d-flex align-items-center gap-2">
                        @include('components.likes')
                        @if (Auth::user()->id === $image->user_id)
                            <a href="{{ route('image.edit', ['image' => $image->id]) }}"
                                class="btn btn-sm btn-outline-primary">Actualizar</a>

                            {{-- INIT MODAL --}}

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Borrar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea eliminar la imagen?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <a href="{{ route('image.delete', ['image' => $image->id]) }}"
                                                class="btn btn-danger">Borrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- END MODAL --}}

                        @endif
                    </div>
                </div>
                <div class="text-wrap">
                    {{ $image->description }}
                </div>
            </div>

        </div>

        <div class="p-2">

            <h3>Comentarios ({{ sizeof($image->comments) }})</h3>
            <hr>

            <form class="p-3" action="{{ route('comment.store') }}" method="POST">

                @csrf

                <input type="hidden" class="form-control" name="image_id" value="{{ $image->id }}">

                <div class="form-group">
                    <label for="">Comentario</label>
                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
                        rows="3" required></textarea>

                    <span class="invalid-feedback"
                        role="alert"><strong>{{ $errors->first('content') }}</strong></span>
                </div>

                <button type="submit" class="mt-2 btn btn-success">Enviar</button>

            </form>

            <hr>

            @foreach ($image->comments as $comment)
                <div class="card p-3 mb-2">
                    <div>
                        <span class="">{{ $comment->user->name }}</span>
                        <span class="text-xs text-secondary">{{ longTimeFilter($comment->created_at) }}</span>
                    </div>
                    <div class="text-wrap">
                        {{ $comment->content }}
                    </div>
                    @if (Auth::user()->id === $comment->user_id || $comment->image->user_id === Auth::user()->id)
                        <div>
                            <a class="btn btn-sm btn-danger"
                                href="{{ route('comment.delete', ['id' => $comment->id]) }}">Eliminar</a>

                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </div>



</x-app-layout>
