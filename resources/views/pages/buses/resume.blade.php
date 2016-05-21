@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="box">

                @include('partials.msg_success')

                <div id="sortableTable" class="body collapse in">

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('bus.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nueva guagua</span>
                            </a>
                        </div>

                        @include('partials.searchbox')

                    </div>

                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
                        <thead>
                        <tr>
                            <th class="text-center">Matrícula</th>
                            <th class="text-center">Marca</th>
                            <th class="text-center">Plazas sentadas</th>
                            <th class="text-center">Plazas de pie</th>
                            <th class="text-center">Total plazas</th>
                            <th class="text-center">Matriculación</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buses as $bus)
                            <tr data-id="{{ $bus->id }}" class="bus">
                                <td>{{ $bus->license }}</td>
                                <td>{{ $bus->brand->name }}</td>
                                <td>{{ $bus->seats }}</td>
                                <td>{{ $bus->stands }}</td>
                                <td>{{ $bus->seats + $bus->stands }}</td>
                                <td>{{ date('d-m-Y', strtotime($bus->registration)) }}</td>
                                <td align="right">
                                    <div class="btn-group">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('bus.details', $bus->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('bus.destroy', $bus->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
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