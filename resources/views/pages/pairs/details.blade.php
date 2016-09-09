@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header class="dark">
                    <div class="icons">
                        <i class="fa fa-users"></i>
                    </div>
                    <h5>Conductores de la pareja</h5>

                    @include('partials.window_options')
                </header>

                <div class="body" style="min-height: 356px;">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <form class="form-horizontal" method="POST" action="{{ route('pair.driverAdd', $pairNumber) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-5" for="driver_id">Conductor</label>
                            <div class="col-lg-3">
                                <select name="driver_id" id="driver_id" class="form-control chosen-select" onchange="this.form.submit()">
                                    <option value="" disabled selected>Selecciona un conductor...</option>
                                    @foreach($driversWithoutPair as $driver)
                                        <option value="{{ $driver->id }}" @if( old('driver_id') == $driver->id )selected="selected"@endif>
                                            {{ $driver->completeName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                        @if(isset($pairs) && sizeof($pairs)>0)
                            <div style="width: 50%; margin: 0px auto;">
                                <table class="table table-bordered responsive-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Conductor</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pairs as $pair)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $pair->driver->completeName }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <form method="POST" action="{{ route('pair.driverDestroy', [$pair->pair_id, $pair->driver->id]) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
                                                            <i class="glyphicon glyphicon-remove"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div style="position: absolute; height: 100%; width: 100%; vertical-align: middle;">
                                <h3 class="text-center">Esta pareja aún no tiene conductores asignados</h3>
                            </div>
                        @endif

                </div>
            </div><!--box-->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@stop
@push('scripts')
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>

    <script>
        (function($){
            $(".chosen-select").chosen();



        }(jQuery));
    </script>
@endpush