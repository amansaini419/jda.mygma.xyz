@extends('layouts.master')

@section('body')
<div class="row justify-content-center align-items-center align-self-center" style="height: 80vh;">
    <div class="col-auto">
        <div class="card rounded-3 shadow border-0" style="width: 350px;">
            <div class="card-body text-center">
                <p class="mb-5"><img src="{{ Storage::url(env('COMPANY_LOGO')) }}" width="100" alt="logo"></p>
                <h4 class="card-title fw-bold mb-4 fs-6 text-uppercase">login</h4>
                <livewire:login />
            </div>
        </div>
    </div>
</div>
@endsection
