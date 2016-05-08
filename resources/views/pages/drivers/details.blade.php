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
                          action="@if(isset($driver) && $driver != null){{ Route('driver.update', $driver->id) }}@else{{ Route('driver.create') }}@endif">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-4">Apellidos</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                       value="@if(isset($driver) && $driver != null){{ $driver->last_name }}@else{{ old('last_name') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Nombre</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                       value="@if(isset($driver) && $driver != null){{ $driver->first_name }}@else{{ old('first_name') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">DNI</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="text" name="dni" id="dni"
                                       value="@if(isset($driver) && $driver != null){{ $driver->dni }}@else{{ old('dni') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Teléfono</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="number" name="telephone" id="telephone"
                                       value="@if(isset($driver) && $driver != null){{ $driver->telephone }}@else{{ old('telephone') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Extensión</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="number" name="extension" id="extension"
                                       value="@if(isset($driver) && $driver != null){{ $driver->extension }}@else{{ old('extension') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">E-mail</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="email" name="email" id="email"
                                       value="@if(isset($driver) && $driver != null){{ $driver->email }}@else{{ old('email') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">CAP</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="date" name="cap" id="cap"
                                       value="@if(isset($driver) && $driver != null){{ $driver->cap }}@else{{ old('cap') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Carnet de conducir</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="date" name="driver_expiration" id="driver_expiration"
                                       value="@if(isset($driver) && $driver != null){{ $driver->driver_expiration }}@else{{ old('driver_expiration') }}@endif" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4">Días de descanso</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona los días" multiple class="form-control chzn-select" tabindex="8" name="restDays[]">
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

                        @if(!isset($driver) || $driver == null)
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="holidays1">Vacaciones primera quincena</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="holidays1" id="holidays1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="holidays2">Vacaciones segunda quincena</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="holidays2" id="holidays2" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-actions no-margin-bottom text-center">
                            <a class="btn btn-default btn-sm" href="{{ Route('driver.resume') }}">Cancelar</a>
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div><!--box-->

            @if(isset($driver) && $driver != null)
                <div class="box">
                    <header class="dark">
                        <div class="icons">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <h5>Vacaciones</h5>

                        @include('partials.window_options')
                    </header>
                    <div id="dateRangePickerBlock" class="body">
                        <form class="form-horizontal" method="POST"
                              action="@if(isset($driver) && $driver != null){{ Route('driver.update', $driver->id) }}@else{{ Route('driver.create') }}@endif">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="control-label col-lg-4" for="holidays1">Vacaciones primera quincena</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="holidays1" id="holidays1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="holidays2">Vacaciones segunda quincena</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="holidays2" id="holidays2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions no-margin-bottom text-center">
                                <a class="btn btn-default btn-sm" href="{{ Route('driver.resume') }}">Cancelar</a>
                                <input type="submit" value="Guardar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div><!--box-->
            @endif
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@endsection