@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                @include('partials.msg_success')

                <div id="sortableTable" class="body collapse in">
                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
                        <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Marca</th>
                            <th>Plazas<br>sentadas</th>
                            <th>Plazas<br>de pie</th>
                            <th>Total plazas</th>
                            <th>Matriculación</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buses as $bus)
                            <tr>
                                <td>{{ $bus->license }}</td>
                                <td>{{ $bus->brand }}</td>
                                <td>{{ $bus->seats }}</td>
                                <td>{{ $bus->stands }}</td>
                                <td>{{ $bus->seats + $bus->stands }}</td>
                                <td>{{ date('d-m-Y', strtotime($bus->registration)) }}</td>
                                <td align="left">

                                    <div class="btn-group">
                                        <a href="{{ route('bus.details', $bus->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-default">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>


                                    <div class="btn-group">
                                        <a href="{{ route('bus.destroy', $bus->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-default">
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
                                Mostrando del {{ ($buses->currentPage()-1) * $buses->perPage() + 1}} al {{ $buses->currentPage() * $buses->perPage() }} de {{ $buses->total() }} guaguas
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            {!! $buses->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection