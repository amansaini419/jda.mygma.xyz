@extends('layouts.master')

@section('body')
<div class="card rounded-3">
    <div class="card-body text-center">
        @if($voting)
            <h5 class="card-title fw-semibold mb-4 text-uppercase fs-6">{{ $voting->title }}</h5>
            <p class="card-text">{!! $voting->description !!}</p>
            <p class="card-text">Voting Start Date<br><strong>{{ $voting->start_date }}</strong></p>
            <p class="card-text">Voting End Date<br><strong>{{ $voting->end_date }}</strong></p>
        @endif
    </div>
</div>
@php
    $categories->load('nominees');
@endphp
@foreach ($categories as $category)
    <div class="card rounded-3 text-center">
        <div class="card-header fx-bold text-uppercase fs-6">{{ $category->name }}</div>
        <div class="card-body text-center">
            <div class="flex flex-row justify-content-center align-item-center flex-wrap">
                @foreach ($category->nominees as $nominee)
                    @if(strtolower($nominee->name) != 'no vote')
                        <div class="d-inline-block" style="width: 320px;">
                            <div class="mx-auto mb-3 border border-light rounded-circle bg-light" style="width: 150px; height: 150px;">
                                <img src="{{ Storage::url($nominee->image) }}" class="nominee-img img-fluid rounded-circle w-100 h-100" alt="{{ $nominee->name }}" />
                            </div>
                            <h3 class="card-title fw-bold mb-2 fs-5 text-uppercase">{{ $nominee->name }}</h3>
                            <blockquote class="blockquote">
                                <p class="mb-4"><em>{{ $nominee->tagline }}</em></p>
                            </blockquote>
                        </div>
                    @endif
                @endforeach
            </div>
            {{-- <a href="{{ route('category', ['slug' => $category->slug]) }}" class="stretched-link"></a> --}}
            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        </div>
    </div>
@endforeach
</div>
@endsection
