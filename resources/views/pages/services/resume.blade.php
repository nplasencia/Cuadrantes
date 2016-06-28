@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            @foreach($viewServices as $time => $viewService)
                <div class="box">
                    <header class="dark">
                        <div class="icons">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <h5>Servicios laborales @lang('services.'.$time)</h5>

                        @include('partials.window_options')
                    </header>

                    <div class="body collapse in">

                        @include('partials.msg_success')

                        @include('partials.errors')

                        <table class="table table-striped" id="example{{ $time }}" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th style="border-right: 1px solid #ddd; background-color: white;">&nbsp;</th>
                                    @foreach($hours[$time] as $hour)
                                        <th style="border-right: 1px solid #ddd;">{{ $hour }}:00</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewService as $serviceNumber => $serviceHours)
                                    <tr>
                                        <td style="border-right: 1px solid #ddd; background-color: white;">
                                            Servicio {{ $serviceNumber }}<br>
                                            <div class="btn-group">
                                                <div class="btn-group pull-right">
                                                    <a href="{{ route('service.details', $serviceNumber) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="btn-group">
                                                <div class="btn-group pull-right">
                                                    <a href="{{ route('service.destroy', $serviceNumber) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach($hours[$time] as $hour)
                                                <td style="border-right: 1px solid #ddd;">
                                                    @if(isset($serviceHours[$hour]))
                                                        @foreach($serviceHours[$hour] as $timetable)
                                                            <a data-placement="bottom" data-original-title="Servicio {{ $serviceNumber }}"
                                                               data-toggle="tooltip" class="btn btn-sm btn-default text-center"
                                                               style="background-color: {{ $timetable['colour'] }}; color: {{$timetable['text']}};">
                                                                {{ $timetable['time'] }}<br>
                                                                {!! $timetable['origin'] !!}<br>
                                                                Línea {{ $timetable['line'] }}
                                                            </a>
                                                        @endforeach
                                                     @endif
                                                </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection