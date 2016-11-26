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
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <h5>Añadir nuevo festivo</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    <form class="form-horizontal" method="POST" action="{{ route('festive.save') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="control-label col-lg-4" for="date">Fecha</label>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" name="date" id="date" class="form-control datepicker" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Descripción</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" name="description" id="description" placeholder="Descripción"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label class="col-lg-12 text-center">
                                                    <b>¿Repetitivo?</b>
                                                    <input class="uniform" type="checkbox" name="always" value="1" checked style="margin-left: 5px;">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-actions no-margin-bottom text-center">
                                            <a class="btn btn-default btn-sm" href="{{ URL::previous() }}">@lang('general.cancel')</a>
                                            <input type="submit" value="@lang('general.save')" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($festives->count() > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <h5>Días festivos</h5>

                                    @include('partials.window_options')
                                </header>

                                <div class="body collapse in">
                                    <table id="festivesTableResume" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Repetitivo</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($festives as $festive)
                                            <tr data-id="{{ $festive->id }}">
                                                <td>{{ $festive->dateFormatted }}</td>
                                                <td>{{ $festive->description }}</td>
                                                <td class="text-center"><input class="uniform" type="checkbox" name="always" @if($festive->always)checked @endif disabled></td>
                                                <td align="center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('festive.destroy', $festive->id) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
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

    <script src="{{ asset('assets/js/datepicker.min.js') }}"></script>

    <script>
        $(function() {

            $(".datepicker").datepicker();

            $(".chosen-select").chosen();

            $('#festivesTableResume').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('festive.ajaxResume') !!}",
                "searching": false,
                "fnDrawCallback": function() {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                "order": [[ 0, "asc" ]],
                columns: [
                    { data: 'festiveDate', name: 'fesitveDate'},
                    { data: 'description', name: 'description'},
                    { data: 'always', name: 'always', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                "aoColumnDefs": [
                    { "sClass": "text-center", "aTargets": [2, 3] }
                ]
            });
        });

        $(document).ready(function () {

            $(".datepicker").change(function(e) {
                e.preventDefault();
                var form = $('#form-date');
                form.submit();
            });
        });
    </script>
@endpush