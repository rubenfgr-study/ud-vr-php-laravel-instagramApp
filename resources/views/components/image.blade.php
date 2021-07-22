<div class="card m-3">

    <a class="text-decoration-none" href="{{ route('user.profile', ['id' => $image->user->id]) }}">
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
    </a>


    <div class="card-body d-flex flex-row flex-wrap flex-sm-nowrap gap-3">
        <div class="image_card_body">
            @if (str_starts_with($image->image_path, 'http'))
                <img src="{{ $image->image_path }}" alt="">
            @else
                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
            @endif
        </div>
        <div>
            <div class="text-xs text-secondary">{{ longTimeFilter($image->created_at) }}
            </div>
            <div class="text-wrap">
                {{ $image->description }}
            </div>
        </div>

    </div>

    <div class="d-flex justify-content-start align-items-center ps-3">
        @include('components.likes')

        <span>
            <a class="btn btn-sm btn-warning ms-5" href="{{ route('image.detail', ['id'=> $image->id]) }}">Comentarios
                <span>({{ sizeof($image->comments) }})</span></a>
        </span>

    </div>

</div>
