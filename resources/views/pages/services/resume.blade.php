@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                @include('partials.msg_success')

                <div class="body collapse in">

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('line.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nueva línea</span>
                            </a>
                        </div>

                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="border-right: 1px solid #ddd;">&nbsp;</th>
                                @foreach($hours as $hour)
                                    <th style="border-right: 1px solid #ddd;">{{ $hour }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewServices as $serviceNumber => $serviceHours)
                                <tr>
                                    <td style="border-right: 1px solid #ddd;">
                                        Servicio {{ $serviceNumber }}
                                    </td>
                                    @foreach($hours as $hour)
                                            <td style="border-right: 1px solid #ddd;">
                                                @if(isset($serviceHours[$hour]))
                                                    @foreach($serviceHours[$hour] as $timetable)
                                                        <a data-placement="bottom" data-original-title="Servicio {{ $serviceNumber }}" data-toggle="tooltip" class="btn btn-sm btn-default text-center" style="background-color: {{ $timetable['colour'] }};">
                                                            {{ $timetable['time'] }}<br>
                                                            {{ $timetable['origin'] }}<br>
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
        </div>
    </div>
@endsection