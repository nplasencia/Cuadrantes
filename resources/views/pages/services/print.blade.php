@extends('layouts.print')
@section('content')

    <table class="table table-striped table-bordered">
        <tbody>
            @foreach($viewServices as $serviceNumber => $timetables)
                <tr>
                    <td class="text-center" style="vertical-align: middle;">
                        Servicio {{ $serviceNumber }}
                    </td>
                    @foreach($timetables as $timetable)

                        <td style="vertical-align: middle;text-align: center;">
                            <div class="btn btn-sm btn-default text-center"
                               style="background-color: {{ $timetable->backgroundColor }} !important; color: {{$timetable->textColor}} !important;">
                                {{ $timetable->formattedTime }}<br>
                                {!! $timetable->originTitle !!}<br>
                                Línea {{ $timetable->route->line->number }}
                            </div>
                        </td>
                    @endforeach
                </tr>

            @endforeach
        </tbody>
    </table>

@endsection
