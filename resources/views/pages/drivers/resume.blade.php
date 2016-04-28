@extends('layouts.default')
@section('content')

    @include('partials.msg_success')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                @include('partials.msg_success')

                <div id="sortableTable" class="body collapse in">
                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
                        <thead>
                        <tr>
                            <th>Apellidos</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Extensión</th>
                            <th>Email</th>
                            <th>CAP</th>
                            <th>Carnet conducir</th>
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
                                <td align="left">

                                    <div class="btn-group">
                                        <a href="{{ route('driver.details', $driver->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-default">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>


                                    <div class="btn-group">
                                        <a href="{{ route('driver.destroy', $driver->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-default">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                Mostrando del {{ ($drivers->currentPage()-1) * $drivers->perPage() + 1}} al {{ $drivers->currentPage() * $drivers->perPage() }} de {{ $drivers->total() }} conductores
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            {!! $drivers->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection