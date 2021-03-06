@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row" style="margin-left: 0px; margin: 10px 0px;">
                <div class="btn-group">
                    <a href="{{ route('service.print', $period_id) }}" class="btn btn-success" target="_blank">
                        <i class="fa fa-print"></i>
                        <span class="link-title">&nbsp;Imprimir servicios</span>
                    </a>
                </div>

            </div>

            @forelse($viewServices as $time => $viewService)
                <div class="box">
                    <header class="dark">
                        <div class="icons">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <h5>{{ $title }} @lang('services.'.$time)</h5>

                        @include('partials.window_options')
                    </header>

                    <div class="body collapse in" style="overflow-x: hidden;">

                        @include('partials.msg_success')

                        @include('partials.errors')

                        <table class="table table-striped table-bordered nowrap" id="{{ $time }}">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    @foreach($hours[$time] as $hour)
                                        <th>{{ $hour }}:00</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($viewService as $serviceId => $serviceIdNumber)

                                    @foreach($serviceIdNumber as $serviceNumber => $serviceHours)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Servicio {{ $serviceNumber }}<br><br>
                                                <div class="btn-group">
                                                    <a href="{{ route('service.details', $serviceId) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="{{ route('service.destroy', $serviceId) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            @foreach($hours[$time] as $hour)
                                                    <td style="vertical-align: middle;">
                                                        @if(isset($serviceHours[$hour]))
                                                            @foreach($serviceHours[$hour] as $timetable)
                                                                <a data-placement="bottom" data-original-title="Servicio {{ $serviceNumber }}"
                                                                   data-toggle="tooltip" class="btn btn-sm btn-default text-center"
                                                                   style="background-color: {{ $timetable->backgroundColor }}; color: {{$timetable->textColor}};">
                                                                    {{ $timetable->formattedTime }}<br>
                                                                    {!! $timetable->originTitle !!}<br>
                                                                    Línea {{ $timetable->route->line->number }}
                                                                </a>
                                                            @endforeach
                                                         @endif
                                                    </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="box text-center">
                    <h2>No se han encontrado servicios para este periodo</h2>
                </div>
            @endforelse
        </div>
    </div>

@stop
@push('scripts')
    <script src="{{ asset('/assets/js/datatables.min.js') }}"></script>


    <script>
        $(function() {
            $('#morning, #afternoon').DataTable({
                scrollY:        "500px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                searching:      false,
                info:           false,
                ordering:       false,
                fixedColumns:   true,
            });
        });
    </script>
@endpush