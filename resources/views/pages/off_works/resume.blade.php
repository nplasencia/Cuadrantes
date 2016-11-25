@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="box">

                <div class="body collapse in">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="fa fa-user-times"></i>
                                    </div>
                                    <h5>Añadir nueva baja</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    <form class="form-horizontal text-center" method="POST" action="{{ route('offWork.save') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group text-center col-lg-12">
                                            <div class="col-lg-4">
                                                <select title="Conductor" data-placeholder="Selecciona un conductor ..." class="form-control" name="driver_id" id="driver_id">
                                                    <option value=""></option>
                                                    @foreach($drivers as $driver)
                                                        <option value="{{ $driver->id }}">{{ $driver->formalCompleteName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" name="offWork" id="offWork" class="form-control range-picker"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-actions no-margin-bottom text-center">
                                                    <input type="submit" value="@lang('general.save')" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($offWorks->count() > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="fa fa-user-times"></i>
                                    </div>
                                    <h5>Bajas</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    <table id="offWorksTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Conductor</th>
                                            <th class="text-center">Desde</th>
                                            <th class="text-center">Hasta</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($offWorks as $offWork)
                                            <tr data-id="{{ $offWork->id }}">
                                                <td>{{ $offWork->driver->completeName }}</td>
                                                <td>{{ $offWork->fromFormatted }}</td>
                                                <td>{{ $offWork->toFormatted }}</td>
                                                <td align="center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('offWork.destroy', $offWork->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                                                            <i class="fa fa-remove"></i>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/daterangepicker.js"></script>

    <script>
        $(function() {

            $('.range-picker').daterangepicker({
                autoUpdateInput: false,
                separator: ' - ',
                drops: 'down',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Guardar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    firstDay: 1
                }
            });

            $('.range-picker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('.range-picker').on('cancel.daterangepicker', function() {
                $(this).val('');
            });


            $(".chosen-select").chosen();

            $('#offWorksTableResume').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('offWork.ajaxResume') !!}",
                "searching": false,
                "fnDrawCallback": function() {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                "order": [[ 1, "asc" ]],
                columns: [
                    { data: 'driverName', name: 'driverName'},
                    { data: 'from', name: 'from'},
                    { data: 'to', name: 'to'},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                "aoColumnDefs": [
                    { "sClass": "text-center", "aTargets": [3] }
                ]
            });
        });
    </script>
@endpush