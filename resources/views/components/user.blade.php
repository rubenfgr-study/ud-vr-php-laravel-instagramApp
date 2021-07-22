
<a href="{{ route('user.profile', ['id' => $user->id]) }}" class="text-decoration-none">

    <div class="m-3 row border border-1 rounded-3 bg-light">
        <div class="col-sm-4 col-12 d-flex justify-content-center align-items-center">
            @if ($user->image && str_starts_with($user->image, 'http'))
                <img class="card-img-top avatar" src="{{ $user->image }}" alt="">
            @elseif ($user->image)
                <img class="card-img-top avatar" src="{{ route('user.image', ['filename' => $user->image]) }}" alt="">
            @else
                <img src="" alt="">
            @endif
        </div>

        <div class="col-sm-8 col-12">
            <h2 class="text-blue-400">{{ '@'.$user->nick }}</h2>
            <h4>{{ $user->name.' '.$user->surname }}</h4>
            <p>{{ $user->email }}</p>
            <p class="text-green-700">{{ 'Se unió: '.longTimeFilter($user->created_at)}}</p>
        </div>
    </div>


</a>
