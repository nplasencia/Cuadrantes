@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                <div id="sortableTable" class="body collapse in">

                    @include('partials.msg_success')

                    <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                        <div class="btn-group">
                            <a href="{{ route('driver.create') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span class="link-title">&nbsp;Nuevo conductor</span>
                            </a>
                        </div>

                    </div>

                    <table id="driversTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
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
                            <th class="text-center">Descansos</th>
                            <th class="text-center">Vacaciones</th>
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
                                <td>
                                    @if (isset($driver->cap))
                                        {{ date('d-m-Y', strtotime($driver->cap)) }}
                                    @endif
                                </td>
                                <td>
                                    @if (isset($driver->driver_expiration))
                                        {{ date('d-m-Y', strtotime($driver->driver_expiration)) }}
                                    @endif
                                </td>
                                <td>
                                    @if (isset($driver->restDays) && sizeof($driver->restDays)==2)
                                        Sí
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    @if (isset($driver->holidays))
                                        Sí
                                    @else
                                        No
                                    @endif
                                </td>
                                <td align="right">
                                    <div class="btn-group">
                                        <a href="{{ route('driver.details', $driver->id) }}" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('driver.destroy', $driver->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
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
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>

    <script>
        $(function() {
            $('#driversTableResume').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('driver.ajaxResume') !!}",
                "fnDrawCallback": function() {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                columns: [
                    { data: 'last_name'},
                    { data: 'first_name'},
                    { data: 'dni'},
                    { data: 'telephone'},
                    { data: 'extension'},
                    { data: 'email'},
                    { data: 'cap', searchable: false },
                    { data: 'driver_expiration', searchable: false },
                    { data: 'restDays', searchable: false },
                    { data: 'holidays', searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                "aoColumnDefs": [
                    { "sClass": "text-right", "aTargets": [ 10 ] }
                ],
                //dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<span class="fa fa-file-excel-o"></span>',
                        exportOptions: {
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            }
                        }
                    }
                ],
            });
        });
    </script>
@endpush