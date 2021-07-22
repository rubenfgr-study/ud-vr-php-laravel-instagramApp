<?php $user_like = false; ?>
@foreach ($image->likes as $like)
    @if (Auth::user()->id == $like->user_id)
        <?php $user_like = true; ?>
    @endif
@endforeach

@if ($user_like)
    <a class="btn-like" imageId="{{ $image->id }}"><i
            class="bi bi-heart-fill position-relative top-1"></i>&nbsp;<span>{{ sizeof($image->likes) }}</span></a>

@else
    <a class="btn-dislike" imageId="{{ $image->id }}"><i
            class="bi bi-heart position-relative top-1"></i>&nbsp;<span>{{ sizeof($image->likes) }}</span></a>

@endif
