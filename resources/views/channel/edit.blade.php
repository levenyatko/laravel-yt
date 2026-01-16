@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Edit channel') }}</h1>
                    </div>
                    <div class="card-body">
                        <livewire:channel.edit-channel :channel="$channel" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
