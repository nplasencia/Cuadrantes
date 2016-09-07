@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header class="dark">
                    <div class="icons">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <h5>Datos personales</h5>

                    @include('partials.window_options')
                </header>

                <div class="body">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <form class="form-horizontal" method="POST"
                          action="@if(isset($driver) && $driver != null){{ route('driver.update', $driver->id) }}@else{{ route('driver.create') }}@endif">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="last_name">Apellidos</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                       value="@if(isset($driver) && $driver != null){{ $driver->last_name }}@else{{ old('last_name') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="first_name">Nombre</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                       value="@if(isset($driver) && $driver != null){{ $driver->first_name }}@else{{ old('first_name') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="dni">DNI</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="text" name="dni" id="dni"
                                       value="@if(isset($driver) && $driver != null){{ $driver->dni }}@else{{ old('dni') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="telephone">Teléfono</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="number" name="telephone" id="telephone"
                                       value="@if(isset($driver) && $driver != null){{ $driver->telephone }}@else{{ old('telephone') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="extension">Extensión</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="number" name="extension" id="extension"
                                       value="@if(isset($driver) && $driver != null){{ $driver->extension }}@else{{ old('extension') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="email">E-mail</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="email" name="email" id="email"
                                       value="@if(isset($driver) && $driver != null){{ $driver->email }}@else{{ old('email') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="cap">CAP</label>
                            <div class=" col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control datepicker" name="cap" id="cap"
                                       value="@if(isset($driver) && $driver != null){{ $driver->capFormatted }}@else{{ old('cap') }}@endif" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="driver_expiration">Carnet de conducir</label>
                            <div class=" col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control datepicker" name="driver_expiration" id="driver_expiration"
                                       value="@if(isset($driver) && $driver != null){{ $driver->expirationFormatted }}@else{{ old('driver_expiration') }}@endif" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="restDays">Días de descanso</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona los días" multiple class="form-control chosen-select" multiple tabindex="8" name="restDays[]" id="restDays">
                                    @foreach($weekdays as $weekday)
                                        <option value="{{ $weekday->id }}"
                                                @if(isset($driver) && $driver != null)
                                                    @if( $driver->isRestDay($weekday) ) selected="selected"@endif
                                                @else
                                                    @if( old('restDays') == $weekday->id ) selected="selected"@endif
                                                @endif
                                        >
                                            {{ $weekday->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="holidays1">Vacaciones primera quincena</label>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="holidays1" id="holidays1" class="form-control range-picker"
                                           value="@if(isset($driver) && $driver != null){{ $driver->getHolidaysFormatted(0) }}@else{{ old('holidays1') }}@endif" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="holidays2">Vacaciones segunda quincena</label>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="holidays2" id="holidays2" class="form-control range-picker"
                                           value="@if(isset($driver) && $driver != null){{ $driver->getHolidaysFormatted(1) }}@else{{ old('holidays2') }}@endif" />
                                </div>
                            </div>
                        </div>

                        <div class="form-actions no-margin-bottom text-center">
                            <a class="btn btn-default btn-sm" href="{{ route('driver.resume') }}">Cancelar</a>
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div><!--box-->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@stop
@push('scripts')
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/datepicker.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/daterangepicker.js"></script>

    <script>
        (function($){
            $(".chosen-select").chosen();

            $(".datepicker").datepicker();

            $('.range-picker').daterangepicker({
                autoUpdateInput: false,
                separator: ' - ',
                drops: 'up',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Guardar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    firstDay: 1
                }
            });

            $('.range-picker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('.range-picker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        }(jQuery));
    </script>
@endpush