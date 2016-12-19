@extends('layouts.print')
@section('content')

    <table class="table table-striped table-bordered">
        <tbody>
            @foreach($cuadrantes as $serviceNumber => $cuadrante)
                <tr>
                    <td class="text-center" style="vertical-align: middle;">
                        Servicio {{ $cuadrante->service->number }}
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        @if (!empty($cuadrante->driver))
                            {{ $cuadrante->driver->completeName }}
                        @else
                            No hay conductores disponibles
                        @endif
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        @if (!empty($cuadrante->bus))
                            {{ $cuadrante->bus->license }}
                        @else
                            No asignado
                        @endif
                    </td>
                    @foreach($cuadrante->service->orderedTimetables as $timetable)

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
