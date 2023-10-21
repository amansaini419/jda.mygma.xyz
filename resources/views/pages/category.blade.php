@extends('layouts.master')

@section('body')
    <h1 class="text-uppercase text-center">{{ $category->name }}</h1>
    <hr>
    <div class="d-flex align-item-center justify-content-center flex-wrap">
        @forelse ($category->nominees as $nominee)
        <div class="card rounded-3 shadow border-0 m-3 h-100" style="width: 320px;">
            {{-- <div class="position-relative">
                <span class="position-absolute bg-success text-white rounded-circle fw-bolder lh-1 p-1" style="font-size: 2rem; top: 10px; right: 10px;"><i class="ti ti-check"></i></span>
                <span class="position-absolute bg-danger text-white rounded-circle fw-bolder lh-1 p-1" style="font-size: 2rem; top: 10px; right: 10px;"><i class="ti ti-x"></i></span>
            </div> --}}
            <div class="card-body text-center">
                <div class="mx-auto mb-3 border border-light rounded-circle bg-light" style="width: 150px; height: 150px;">
                    <img src="{{ Storage::url($nominee->image) }}" class="nominee-img img-fluid rounded-circle w-100 h-100" alt="{{ $nominee->name }}" />
                </div>
                <h5 class="card-title fw-bold mb-2 fs-5 text-uppercase">{{ $nominee->name }}</h5>
                <blockquote class="blockquote">
                    <p class="mb-4"><em>{{ $nominee->tagline }}</em></p>
                </blockquote>
                @if(!isUserLogin())
                    <div class="d-grid">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill text-uppercase fw-medium">login to vote</a>
                    </div>
                @else
                    @if($votedNominee)
                        <h2 class="text-uppercase fw-medium fs5">
                        @if($votedNominee->id === $nominee->id)
                            <span class="text-success">voted <i class="ti ti-check"></i></span>
                        @else
                            <span class="text-error">not voted <i class="ti ti-x"></i></span>
                        @endif
                        </h2>
                    @else
                        <form class="d-grid" action="{{ route('nominee.vote', ['nominee' => $nominee->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill text-uppercase fw-medium">vote now</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        @empty
            <h4 class="text-center text-uppercase fw-medium">no nominees in this category</h4>
        @endforelse
    </div>
@endsection
