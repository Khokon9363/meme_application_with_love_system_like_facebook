@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Welcome to ').config('app.name') }}
                    <div class="float-right">
                        <a class="btn btn-sm btn-outline-info" data-toggle="collapse" href="#collapseStoreForm">
                            {{ __('Add Post') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <livewire:meme/>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection