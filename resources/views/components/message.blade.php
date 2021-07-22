@if (session('message'))
    <div class="p-3 d-flex justify-content-center">
        <div class="alert alert-success">
            {{ session('message') }}
        </div>

    </div>
@endif
