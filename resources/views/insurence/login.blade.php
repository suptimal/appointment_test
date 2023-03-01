@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Login: ') }} {{ $insurence->name }} </div>
                <div class="card-body">
                    <form action="{{ route('insurence.login', ['name' => $insurence->name]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="kvnumber" class="form-label">{{ __('Versicherungsnummer')}}</label>
                      <input type="text" value="{{old('kvnumber')}}"
                        class="form-control" name="kvnumber" id="kvnumber" aria-describedby="{{ __('Versicherungsnummer') }}">
                        @error('kvnumber')<div><small class="text-danger">{{ $message }}</small></div>@enderror
                        <small id="{{ __('Versicherungsnummer') }}" class="form-text text-muted">Versicherungsnummer des Versicherten</small>
                    </div>
                    <div class="mb-3">
                        <label for="birthdate" class="form-label">{{__('Geburstdatum')}}</label>
                        <input type="date" value="{{old('birthdate')}}"
                        class="form-control" name="birthdate" id="birthdate" aria-describedby="{{__('Geburstdatum')}}">
                        @error('birthdate')<div><small class="text-danger">{{ $message }}</small></div>@enderror
                      <small id="Geburtsdatum" class="form-text text-muted">Geburtsdatum des Versicherten</small>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Login</button>
                </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
