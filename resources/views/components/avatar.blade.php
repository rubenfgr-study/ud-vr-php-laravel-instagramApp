@if (Auth::user()->image)
    <div class="avatar-container">
        <img class="avatar" src="{{ route('user.image', ['filename' => Auth::user()->image]) }}">
    </div>
@endif
