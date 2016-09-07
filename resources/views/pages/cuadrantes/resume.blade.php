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

                        <div class="form-group text-center">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date" id="date" class="form-control datepicker" value="{{ $date->format('d/m/Y') }}"/>
                                </div>
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
                                    @forelse($downDrivers as $driver)
                                        <p>{{ $driver->completeName }}</p>
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
                                            <tr>
                                                <td>Servicio {{ $cuadrante->service->number }}</td>
                                                @if (isset($cuadrante->driver))
                                                    <td>{{ $cuadrante->driver->completeName }}</td>
                                                @else
                                                    <td>No quedan conductores disponibles</td>
                                                @endif
                                                <td>{{ $cuadrante->bus }}</td>
                                                @if ($cuadrante->substitute)
                                                    <td>Sí</td>
                                                @else
                                                    <td>No</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

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

    <script>

        $(function() {
            $(".datepicker").datepicker();
        });

        $(document).ready(function () {

            $(".datepicker").change(function(e) {
                e.preventDefault();
                var form = $('#form-date');
                form.submit();
            });
        });

    </script>
@endpush