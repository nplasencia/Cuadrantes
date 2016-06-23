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

                        <table class="table table-striped" id="example{{ $time }}">
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
                                            Servicio {{ $serviceNumber }}
                                        </td>
                                        @foreach($hours[$time] as $hour)
                                                <td style="border-right: 1px solid #ddd;">
                                                    @if(isset($serviceHours[$hour]))
                                                        @foreach($serviceHours[$hour] as $timetable)
                                                            <a data-placement="bottom" data-original-title="Servicio {{ $serviceNumber }}"
                                                               data-toggle="tooltip" class="btn btn-sm btn-default text-center"
                                                               style="background-color: {{ $timetable['colour'] }};">
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