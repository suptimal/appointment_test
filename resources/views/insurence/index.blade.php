@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row row-cols-2 g-2">
            @foreach ($insurences as $i)  
            <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Insurence: ') }} {{ $i->name }} - {{ $i->full_name  }}</div>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-4">{{ __('kk_label') }}:</div>
                            <div class="col-8">{{ $i->kk_label }}</div>
                        </div>

                        <div class="row">
                            <div class="col-4">{{ __('login') }}:</div>
                            <div class="col-8">
                                <a href="{{ route('insurence.login', ['name' => $i->name])  }}">{{ $i->name }}</a>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">{{ __('appointment') }}:</div>
                            <div class="col-8">
                                <a href="{{ route('insurence.appointmentPlaner', ['name' => $i->name])  }}">{{ $i->name }}</a>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">{{ __('versicherte') }}:</div>
                            <div class="col-8">
                                <a href="{{ route('insurence.insured', ['name' => $i->name])  }}">{{ $i->kk_label }}</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            @endforeach

    </div>
</div>
@endsection
