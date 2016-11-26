@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header class="dark">
                    <div class="icons">
                        <i class="fa fa-tasks"></i>
                    </div>
                    <h5>Datos del servicio</h5>

                    @include('partials.window_options')
                </header>

                <div class="body collapse in">
                    @include('partials.msg_success')

                    @include('partials.errors')

                    <form class="form-horizontal" method="POST"
                          action="@if(isset($service) && $service != null){{ route('service.update', $service->id) }}@else{{ route('service.save') }}@endif">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-4">Periodo</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona un periodo ..." class="form-control chosen-select" name="period_id">
                                    <option value=""></option>
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}"
                                            @if(isset($service) && $service != null)
                                                @if( $service->period_id == $period->id )selected="selected"@endif
                                            @else
                                                @if( old('period_id') == $period->id )selected="selected"@endif
                                            @endif
                                        >{{ $period->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">¿Mañana o tarde?</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona ..." class="form-control chosen-select" name="time">
                                    <option value=""></option>
                                    @foreach($times as $time)
                                        <option value="{{ $time }}"
                                            @if(isset($service) && $service != null)
                                                @if( $service->time == $time )selected="selected"@endif
                                            @else
                                                @if( old('time') == $time )selected="selected"@endif
                                            @endif
                                        >@lang('pages/services.'.$time)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Número de servicio</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name="number" id="number"
                                       value="@if(isset($service) && $service != null){{ $service->number }}@else{{ old('number') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label class="col-lg-12 text-center">
                                    <b>¿Auxiliar?</b>
                                    <input class="uniform" type="checkbox" name="aux" value="1"
                                           @if((isset($service) && $service != null && $service->aux) || old('aux'))checked="checked"@endif>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions no-margin-bottom text-center">
                            @if(isset($service) && $service != null)
                                <a class="btn btn-default btn-sm" href="{{ route('service.resume', $service->period_id) }}">@lang('general.cancel')</a>
                            @else
                                <a class="btn btn-default btn-sm" href="{{ URL::previous() }}">@lang('general.cancel')</a>
                            @endif
                            <input type="submit" value="@lang('general.save')" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
            @if(isset($service) && $service != null)
                <div class="box">
                    <header class="dark">
                        <div class="icons">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <h5>Horarios del servicio</h5>

                        @include('partials.window_options')
                    </header>

                    <div class="body collapse in">

                        <form class="form-horizontal" method="POST" action="{{ route('service.addTimetable', $service->id) }}">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="control-label col-lg-4" for="routeSelect">Línea</label>
                                <div class="col-lg-4">
                                    <select class="form-control chosen-select" name="route_id" id="routeSelect">
                                        <option value="" disabled selected>Selecciona la línea ...</option>
                                        @foreach($routes as $route)
                                            <option value="{{ $route->id }}">Línea {{ $route->line->number }} - Salida desde {{ $route->origin }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-4" for="timetableSelect">Horario</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="timetable_id" id="timetableSelect">
                                        <option value="" disabled selected>Selecciona primero la línea ...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-4" for="colour">Color</label>
                                <div class="col-lg-4">
                                    <input type="text" name="colour" id="colour" class="pick-a-color form-control" value="{{ old('colour') }}">
                                </div>
                            </div>

                            <div class="form-group form-actions text-center margin-bottom">
                                <input type="submit" value="Añadir" class="btn btn-primary">
                            </div>

                        </form>

                        <form id="form-timetable" method="POST" action="{{ route('timetable.serviceTimetables', ':route_id') }}">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $service->period_id }}" name="period_id">
                        </form>

                        <div class="form-group text-center">
                            @if (sizeof($service->timetables) == 0)
                                <h3>No se han insertado horarios para este servicio</h3>
                            @else
                                <table class="table table-bordered responsive-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Línea</th>
                                        <th class="text-center">Origen</th>
                                        <th class="text-center">Hora salida</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($service->timetables as $timetable)
                                        <tr style="background-color: {{ $timetable->backgroundColor }}; color: {{ $timetable->textColor }}">
                                            <td>{{ $timetable->route->line->number }}</td>
                                            <td class="text-center">
                                                {{ $timetable->route->origin }}
                                            </td>
                                            <td class="text-center">
                                                {{ $timetable->time }}
                                                @if($timetable->pass == true)
                                                    <br>(Horario de paso - {{ $timetable->by }})
                                                @elseif(isset($timetable->by) && $timetable->by!='')
                                                    <br>({{ $timetable->by }})
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <a href="{{ route('service.destroyTimetable',[$service->id, $timetable->id]) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="form-group text-center">
                                            <h3>No se han insertado horarios para este servicio</h3>
                                        </div>
                                    @endforelse
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery.uniform.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/pickacolor.min.js') }}"></script>

    <script>
        $(function() {
            $(".uniform").uniform();
            $(".chosen-select").chosen();
            $(".pick-a-color").pickAColor({
                showAdvanced: false,
                showHexInput: false
            });
        });

        $(document).ready(function () {

            $('#routeSelect').change(function(e) {
                e.preventDefault();

                var form = $('#form-timetable');

                var select = $(this);
                var selectTimetable = $('#timetableSelect');

                var action = form.attr('action').replace(':route_id', select.val());
                select.prop('disabled', 'disabled');
                $.post(action, form.serialize(), function (response) {
                    selectTimetable.find('option').remove();
                    $.each(response, function(i, v){
                        selectTimetable.append('<option value="' + v[0] + '">' + v[1] + '</option>');
                    })
                }).fail(function(response){
                    //Mensaje de error
                });
                select.prop('disabled', false);

            });

        });
    </script>
@endpush