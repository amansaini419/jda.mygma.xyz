@extends('layouts.master')

@php
    $isSelectedAll = $categories->count() === $selectedCandidates->count();
@endphp

@section('body')

    <h4 class="text-center my-5 fs-6 fw-bold">SELECTED NOMINEE</h4>

    <div class="row g-4">
        <div class="col-md-12">
            <div class="card rounded-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase">Category</th>
                            <th class="text-uppercase">Selected</th>
                            <th class="text-uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selectedCandidates as $selectedCandidate)
                            <tr>
                                <td class="fw-bold text-uppercase">{{ $selectedCandidate->category->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="border border-light rounded-circle bg-light" style="width: 50px; height: 50px;">
                                            <img src="{{ Storage::url($selectedCandidate->nominee->image) }}" class="nominee-img img-fluid rounded-circle w-100 h-100" alt="{{ $selectedCandidate->nominee->name }}" />
                                        </div>
                                        <div class="ms-2">
                                            <h4 class="fw-bold mb-1 text-uppercase fs-5">{{ $selectedCandidate->nominee->name }}</h4>
                                            <blockquote class="blockquote small mb-0">
                                                <p class="mb-0"><em>{{ $selectedCandidate->nominee->tagline }}</em></p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($isVoted)
                                        <h4 class="text-uppercase fw-medium fs-6 mb-0"><span class="text-success">voted <i class="ti ti-check"></i></span></h4>
                                    @else
                                        <a href="{{ route('category', ['slug' => $selectedCandidate->category->slug]) }}" class="btn btn-primary btn-lg rounded-pill text-uppercase fw-medium">change selection</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="border-0">
                                @if($isSelectedAll && !$isVoted)
                                    <form action="{{ route('vote') }}" method="post" class="mx-auto mb-4 text-center">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-lg rounded-pill text-uppercase fw-medium">CONFIRM AND SUBMIT VOTES</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- @foreach ($selectedCandidates as $selectedCandidate)
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
    @endforeach --}}

@endsection
