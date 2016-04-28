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
                        <i class="fa fa-car"></i>
                    </div>
                    <h5>Datos guagua</h5>

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

                    {!! Form::open(['route' => ['bus.update', $bus->id], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'popup-validation']) !!}
                        <div class="form-group">
                            <label class="control-label col-lg-4">Matrícula</label>
                            <div class="col-lg-4">
                                <input type="text" class="validate[required] form-control" name="busLicense" id="busLicense" value="{{ $bus->license }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Marca</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona una marca..." class="form-control chzn-select" name="brand">
                                    @foreach($busBrands as $busBrand)
                                        <option value="{{ $busBrand->name }}"
                                                @if( $bus->brand == $busBrand->name)
                                                selected="selected"
                                                @endif
                                        >
                                            {{ $busBrand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Plazas sentadas</label>
                            <div class=" col-lg-4">
                                <input class="validate[required,minSize[8]] form-control" type="number" name="seats" id="seats" value="{{ $bus->seats }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Plazas de pie</label>
                            <div class=" col-lg-4">
                                <input class="validate[required] form-control" type="number" name="stands" id="stands" value="{{ $bus->stands }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Fecha de matriculación</label>
                            <div class=" col-lg-4">
                                <input class="validate[required] form-control" type="date" name="registration" id="registration" value="{{ $bus->registration }}"/>
                            </div>
                        </div>

                        <div class="form-actions no-margin-bottom text-center">
                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </div>
                    {!! Form::close() !!}
                </div>
            </div><!--box-->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@endsection