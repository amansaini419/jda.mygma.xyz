@extends('layouts.master')

@php
    $isSelectedAll = $categories->count() === $selectedCandidates->count();
@endphp

@section('body')

    <h4 class="text-center my-5 fs-6 fw-bold">SELECTED NOMINEE</h4>
    @if($isSelectedAll && !$isVoted)
        <form action="{{ route('vote') }}" method="post" class="mx-auto mb-4 text-center">
            @csrf
            <button type="submit" class="btn btn-warning btn-lg rounded-pill text-uppercase fw-medium">CONFIRM SELECTION</button>
        </form>
    @endif

    <div class="row g-4">
        @foreach ($selectedCandidates as $selectedCandidate)
            <div class="col-md-4">
                <div class="card rounded-3 text-center">
                    <div class="card-header fx-bold text-uppercase fs-6">{{ $selectedCandidate->category->name }}</div>
                    <div class="card-body text-center pb-0">
                        <div class="mx-auto mb-3 border border-light rounded-circle bg-light" style="width: 150px; height: 150px;">
                            <img src="{{ Storage::url($selectedCandidate->nominee->image) }}" class="nominee-img img-fluid rounded-circle w-100 h-100" alt="{{ $selectedCandidate->nominee->name }}" />
                        </div>
                        <h3 class="card-title fw-bold mb-2 fs-5 text-uppercase">{{ $selectedCandidate->nominee->name }}</h3>
                        <blockquote class="blockquote">
                            <p class="mb-4"><em>{{ $selectedCandidate->nominee->tagline }}</em></p>
                        </blockquote>
                        {{-- <a href="{{ route('category', ['slug' => $category->slug]) }}" class="stretched-link"></a> --}}
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                    </div>
                    <div class="card-footer bg-transparent">
                        @if($isVoted)
                            <h4 class="text-uppercase fw-medium fs-6"><span class="text-success">voted <i class="ti ti-check"></i></span></h4>
                        @else
                            <a href="{{ route('category', ['slug' => $selectedCandidate->category->slug]) }}" class="btn btn-primary btn-lg rounded-pill text-uppercase fw-medium">change selection</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
