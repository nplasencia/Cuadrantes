@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                @include('partials.msg_success')

                <div id="sortableTable" class="body collapse in">

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('driver.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nuevo conductor</span>
                            </a>
                        </div>

                        @include('partials.searchbox')

                    </div>

                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
                        <thead>
                        <tr>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Extensión</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">CAP</th>
                            <th class="text-center">Carnet conducir</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td>{{ $driver->last_name }}</td>
                                <td>{{ $driver->first_name }}</td>
                                <td>{{ $driver->dni }}</td>
                                <td>{{ $driver->telephone }}</td>
                                <td>{{ $driver->extension }}</td>
                                <td>{{ $driver->email }}</td>
                                <td>{{ date('d-m-Y', strtotime($driver->cap)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($driver->driver_expiration)) }}</td>
                                <td align="right">
                                    <div class="btn-group">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('driver.details', $driver->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('driver.destroy', $driver->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @include ('partials.pagination')

                </div>
            </div>
        </div>
    </div>
@endsection