@extends('layouts.default')
@section('content')
    <style>
        .form-control.col-lg-6 {
            width: 50% !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header class="dark">
                    <div class="icons">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <h5>Datos personales</h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
                        <nav style="padding: 8px;">
                            <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                <i class="fa fa-minus"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                <i class="fa fa-expand"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                                <i class="fa fa-times"></i>
                            </a>
                        </nav>
                    </div><!-- /.toolbar -->
                </header>

                <div id="div-2" class="body">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    {!! Form::open(['route' => 'driver.create', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'popup-validation']) !!}
                        <div class="form-group">
                            {!! Form::label('lastName', 'Apellidos', ['class'=>'control-label col-lg-4']) !!}
                            <div class="col-lg-4">
                                {!! Form::text('lastName', null, [
                                        'class' => 'validate[required] form-control',
                                        'value' => old('lastName')
                                    ])
                                !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Nombre</label>
                            <div class="col-lg-4">
                                <input type="text" class="validate[required] form-control" name="firstName" id="firstName" value="{{ old('firstName') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">DNI</label>
                            <div class=" col-lg-4">
                                <input class="validate[required,minSize[8]] form-control" type="text" name="dni" id="dni" value="{{ old('dni') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Teléfono</label>
                            <div class=" col-lg-4">
                                <input class="validate[required] form-control" type="number" name="telephone" id="telephone" value="{{ old('telephone') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Extensión</label>
                            <div class=" col-lg-4">
                                <input class="validate[required] form-control" type="number" name="extension" id="extension" value="{{ old('extension') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">E-mail</label>
                            <div class=" col-lg-4">
                                <input class="validate[required,custom[email]] form-control" type="email" name="email" id="email" value="{{ old('email') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">CAP</label>
                            <div class=" col-lg-4">
                                <input class="validate[required] form-control" type="date" name="cap" id="cap" value="{{ old('cap') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Carnet de conducir</label>
                            <div class=" col-lg-4">
                                <input class="validate[required] form-control" type="date" name="license" id="license" value="{{ old('license') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Días de descanso</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona los días" multiple class="form-control chzn-select" tabindex="8" name="restDays[]" value="{{ old('restDays[]') }}">
                                    @foreach($weekdays as $weekday)
                                        <option value="{{ $weekday->id }}">
                                            {{ $weekday->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--<div id="dateRangePickerBlock" class="body">
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="reservation">Vacaciones primera quincena</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="reservation1" id="reservation1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="reservation">Vacaciones segunda quincena</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="reservation2" id="reservation2" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                        <div class="form-actions no-margin-bottom text-center">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    {!! Form::close() !!}
                </div>
            </div><!--box-->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@endsection