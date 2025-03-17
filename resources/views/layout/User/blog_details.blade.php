@extends('layout.user.mylayout')

@section('user_content')
<div class="card">
    <div class="image">
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
    </div>
    <div class="content-wrapper">
        <span class="title">{{ $post->title }}</span>
        <div class="date-time">
            <span class="date"><i class="far fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
            <span class="time"><i class="far fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
        </div>
        <span class="category">Category: {{ $post->category->slug }}</span>

        <p class="content">{!! $post->content !!}</p>
    </div>
</div>
@endsection

<style>
    .card {
        max-width: 900px; /* Adjust width dynamically */
        width: 90%;
        height: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #fff;
        padding: 1.5em;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        margin: 2em auto; /* Centers the card */
    }

    .card .image {
        width: 100%;
        height: 100%; /* Fixed height for consistency */
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        border-radius: 8px;
    }

    .card .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .content-wrapper {
        width: 100%;
        padding: 1em;
    }

    .title {
        font-size: 1.8em;
        font-weight: bold;
        color: #333;
        margin-top: 1em;
    }

    .date-time {
        display: flex;
        justify-content: space-between;
        width: 100%;
        font-size: 0.9em;
        color: gray;
        margin-top: 0.5em;
        flex-wrap: wrap;
    }

    .date-time .date, 
    .date-time .time {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .category {
        font-size: 1em;
        color: #555;
        margin-top: 0.5em;
        font-weight: 600;
    }

    .content {
        font-size: 1em;
        color: #444;
        margin-top: 1em;
        line-height: 1.6;
        text-align: justify;
    }

    /* Responsiveness */
    @media (max-width: 1024px) {
        .card {
            max-width: 750px;
            padding: 1em;
        }
        .title {
            font-size: 1.5em;
        }
        .content {
            font-size: 0.95em;
        }
    }

    @media (max-width: 768px) {
        .card {
            max-width: 95%;
        }
        .title {
            font-size: 1.4em;
        }
        .content {
            font-size: 0.9em;
        }
        .date-time {
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }
    }
</style>
