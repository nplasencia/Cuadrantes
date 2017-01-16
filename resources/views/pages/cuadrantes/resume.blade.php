@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="box">

                <div class="body collapse in">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <form id="form-date" class="form-horizontal" method="POST" action="{{ route('cuadrantes.resumePost') }}">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-lg-2">
                                <div class="btn-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="date" id="date" class="form-control datepicker" value="{{ $date->format('d/m/Y') }}"/>
                                    </div>
                                </div>
                                <a href="{{ route('cuadrantes.user') }}" class="btn btn-success">
                                    <i class="fa fa-spinner"></i>
                                    <span class="link-title">&nbsp;Recalcular cuadrantes</span>
                                </a>
                            </div>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="glyphicon glyphicon-time"></i>
                                    </div>
                                    <h5>Descansos</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    @forelse($restingDrivers as $driver)
                                        <p>{{ $driver->completeName }}</p>
                                    @empty
                                        <span>No hay conductores que descansen este día</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="glyphicon glyphicon-time"></i>
                                    </div>
                                    <h5>Vacaciones</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    @forelse($holidaysDrivers as $driver)
                                        <p>{{ $driver->completeName }}</p>
                                    @empty
                                        <p>No hay conductores de vacaciones este día</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="glyphicon glyphicon-time"></i>
                                    </div>
                                    <h5>Bajas</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    @forelse($offWorkDrivers as $offWork)
                                        <p>{{ $offWork->driver->completeName }}</p>
                                    @empty
                                        <p>No hay conductores de baja este día</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="glyphicon glyphicon-time"></i>
                                    </div>
                                    <h5>Cuadrantes</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    <div class="row" style="margin-left: 0px; margin: 10px 0px;">
                                        <div class="btn-group">
                                            <a href="{{ route('cuadrantes.print', $date->format('Y-m-d')) }}" class="btn btn-success" target="_blank">
                                                <i class="fa fa-print"></i>
                                                <span class="link-title">&nbsp;Imprimir cuadrante</span>
                                            </a>
                                        </div>
                                    </div>

                                    <form action="{{  route('cuadrantes.update') }}" class="form-horizontal" method="POST" id="cuadranteForm">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="selectedBuses" value="">
                                        <input type="hidden" name="selectedDrivers" value="">
                                        <input type="hidden" name="date" id="date" value="{{ $date->format('d/m/Y') }}">
                                        <table id="cuadrantesTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Número de servicio</th>
                                                    <th class="text-center">Conductor</th>
                                                    <th class="text-center">Guagua</th>
                                                    <th class="text-center">¿Sustituto?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cuadrantes as $cuadrante)
                                                <tr data-service="{{ $cuadrante->service->id }}">
                                                    <td>Servicio {{ $cuadrante->service->number }} ({{ trans('pages/services.'.$cuadrante->service->time) }})</td>

                                                    <td>
                                                        @if ($date->isPast())
                                                            @if(!empty($cuadrante->driver))
                                                                {{ $cuadrante->driver->completeName }}
                                                            @else
                                                                No asignado
                                                            @endif
                                                        @else
                                                            <select data-placeholder="Selecciona un conductor ..." class="chosen-select drivers" name="drivers">
                                                                <option value="">No seleccionar conductor</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}"
                                                                            @if(!empty($cuadrante->driver))
                                                                                @if( $cuadrante->driver->id == $driver->id )selected="selected"@endif
                                                                            @endif
                                                                    >{{ $driver->completeName }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>


                                                    <td>
                                                        @if ($date->isPast() && !$date->isToday())
                                                            @if(!empty($cuadrante->bus))
                                                                {{ $cuadrante->bus->nameLicense }}
                                                            @else
                                                                No asignado
                                                            @endif
                                                        @else
                                                            <select data-placeholder="Selecciona una guagua ..." class="chosen-select buses" name="buses">
                                                                <option value="">No seleccionar guagua</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}"
                                                                            @if(!empty($cuadrante->bus))
                                                                            @if( $cuadrante->bus->id == $bus->id )selected="selected"@endif
                                                                            @endif
                                                                    >{{ $bus->nameLicense }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>

                                                    @if ($cuadrante->substitute)
                                                        <td>Sí</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="form-actions no-margin-bottom text-center">
                                            <button type="submit" class="btn btn-default text-center" id="saveButton">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@stop
@push('scripts')
    <script src="{{ asset('assets/js/libs/jquery.uniform.min.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>

    <script>

        var driversServices = [];
        var busesServices = [];

        @foreach($cuadrantes as $cuadrante)
            @if(!empty($cuadrante->driver))
                driversServices[{{ $cuadrante->service->id }}] = {{  $cuadrante->driver->id }};
            @endif

            @if(!empty($cuadrante->bus))
                busesServices[{{ $cuadrante->service->id }}] = {{  $cuadrante->bus->id }};
            @endif
        @endforeach

        $(function() {
            $(".datepicker").datepicker();
            $(".chosen-select").chosen();
        });

        $(document).ready(function () {

            $("#saveButton").hide();

            $(".datepicker").change(function(e) {
                e.preventDefault();
                var form = $("#form-date");
                form.submit();
            });

            $(".drivers").change(function(e) {
                e.preventDefault();
                $("#saveButton").show();
                var serviceId = $(this).parents('tr').data('service');
                driversServices[serviceId] = $(this).val();
            });

            $(".buses").change(function(e) {
                e.preventDefault();
                $("#saveButton").show();
                var serviceId = $(this).parents('tr').data('service');
                busesServices[serviceId] = $(this).val();
            });

            $("#saveButton").click(function (e) {
                e.preventDefault();
                $('input[name="selectedBuses"]').val(busesServices);
                $('input[name="selectedDrivers"]').val(driversServices);
                $("#cuadranteForm").submit();
            })
        });

    </script>
@endpush