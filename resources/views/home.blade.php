@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-regclose">
                <div class="card-header">AVISO ALERTA</div>

                <div class="card-body-regclose">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    El Usuario tiene una sesión iniciada
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
