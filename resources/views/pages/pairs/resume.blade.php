@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="box">

                <div class="body collapse in">

                    @include('partials.msg_success')

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('bus.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nueva pareja</span>
                            </a>
                        </div>
                    </div>

                    <table id="pairsTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="text-center">Número pareja</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Nombre</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pairs as $pair)
                            <tr data-id="{{ $pair->id }}">
                                <td>{{ $pair->pair_id }}</td>
                                <td>{{ $pair->driver->last_name }}</td>
                                <td>{{ $pair->driver->first_name }}</td>
                                <td align="right">
                                    <div class="btn-group pull-right">
                                        <a href="{{ route('bus.details', $pair->pair_id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <a href="{{ route('bus.destroy', $pair->pair_id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
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
    <script src="{{ asset('/assets/js/datatables.min.js') }}"></script>

    <script>
        $(function() {
            $('#pairsTableResume').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('pair.ajaxResume') !!}",
                "fnDrawCallback": function() {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                columns: [
                    { data: 'pair_id', name: 'pair_id'},
                    { data: 'driver.last_name', name: 'driver.last_name'},
                    { data: 'driver.first_name', name: 'driver.first_name'},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                "aoColumnDefs": [
                    { "sClass": "text-right", "aTargets": [3] }
                ]
            });
        });
    </script>
@endpush