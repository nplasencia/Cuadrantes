@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="box">

                @include('partials.msg_success')

                <div class="body collapse in">

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('bus.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nueva guagua</span>
                            </a>
                        </div>
                    </div>

                    <table id="busesTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table" cellspacing="0" width="100%">
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
                                    <div class="btn-group pull-right">
                                        <a href="{{ route('bus.details', $bus->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <a href="{{ route('bus.destroy', $bus->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('/assets/js/datatable_defaults.js') }}"></script>

    <script>
        $(function() {
            $('#busesTableResume').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('bus.ajaxResume') !!}",
                columns: [
                    { data: 'license', name: 'license'},
                    { data: 'brand.name', name: 'brand.name'},
                    { data: 'seats', name: 'seats'},
                    { data: 'stands', name: 'stands'},
                    { data: 'total', searchable: false},
                    { data: 'registration', name: 'registration'},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                "aoColumnDefs": [
                    { "sClass": "text-right", "aTargets": [6] }
                ]
            });
        });
    </script>
@endpush