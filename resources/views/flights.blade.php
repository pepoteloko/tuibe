@extends('layout.basic')

@section('page_title', $title)

@section('content')
    <div class="title m-b-md">
        Laravel
    </div>

    <div class="row">

        @if($errors->any())
            <div class="col-12">
                @foreach($errors->getMessages() as $this_error)
                    <div class="alert alert-warning" role="alert">
                        {{$this_error[0]}}
                    </div>
                @endforeach
            </div>
        @endif

        @if(count($flights) == 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        No hay vuelos
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Outbound
                    </div>
                    <div class="card-body">
                    @foreach($flights['out'] as $flight)
                        <div class="{{ $loop->iteration % 2 ? 'even' : 'odd' }}">
                            <div class="col-xs-1">
                                <input type="radio" name="from">
                            </div>
                            <div class="col-xs-8">
                            {{ $flight->depart->airport->name }} {{ $flight->time1 }} - {{ $flight->arrival->airport->name }} {{ $flight->time2 }}
                            </div>
                            <div class="col-xs-3">
                            {{ $flight->price }}€
                            @if($flight->seatsAvailable < 10)
                                <br><small>Only {{ $flight->seatsAvailable }} tickets available at {{ $flight->price }}€</small>
                            @endif
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .even {
            background-color: azure;
        }
    </style>
@stop
