@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                <div id="sortableTable" class="body collapse in">

                    @include('partials.msg_success')

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('line.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nueva línea</span>
                            </a>
                        </div>

                    </div>

                    <table id="linesTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
                        <thead>
                        <tr>

                            <th class="text-center">Número</th>
                            <th class="text-center">Nombre</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lines as $line)
                            <tr>

                                <td>{{ $line->number }}</td>
                                <td>{{ $line->name }}</td>
                                <td align="right">
                                    <div class="btn-group">
                                        <a href="{{ route('timetable.details', $line->id) }}" data-toggle="tooltip" data-original-title="Horarios" data-placement="bottom" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-time"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('line.details', $line->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('line.destroy', $line->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
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
            $('#linesTableResume').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('line.ajaxResume') !!}",
                columns: [
                    { data: 'number'},
                    { data: 'name'},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                "aoColumnDefs": [
                    { "sClass": "text-right", "aTargets": [2] }
                ]
            });
        });
    </script>
@endpush