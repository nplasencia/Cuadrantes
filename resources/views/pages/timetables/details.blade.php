@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="box">

                <header class="dark">
                    <div class="icons">
                        <i class="glyphicon glyphicon-time"></i>
                    </div>
                    <h5>Crear nuevo horario</h5>

                    @include('partials.window_options')
                </header>

                <div class="body collapse in">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <div class="row">
                        <form class="form-horizontal" method="POST" action="{{ route('timetable.store', [$line->id]) }}">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="period_id">Periodo semana</label>
                                <div class="col-lg-4">
                                    <select name="period_id" id="period_id" class="form-control chosen-select" >
                                        <option value="" disabled selected>Selecciona un periodo...</option>
                                        @foreach($periods as $period)
                                            <option value="{{ $period->id }}" @if( old('period_id') == $period->id )selected="selected"@endif>
                                                @lang('timetables.'.$period->code)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="route_id">Destino</label>
                                <div class="col-lg-4">
                                    <select name="route_id" id="route_id" class="form-control chosen-select">
                                        <option value="" disabled selected>Selecciona un destino...</option>
                                        @foreach($routes as $route)
                                            <option value="{{ $route->id }}" @if( old('route_id') == $route->id )selected="selected"@endif>
                                                {{ $route->destiny }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="by">Por...</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="by" id="by" value="{{ old('by') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-4" for="time">Hora salida</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input name="time" type="time" id="time" class="form-control" value="{{ old('time') }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label class="col-lg-12 text-center">
                                        <b>¿Horario de paso?</b>
                                        <input class="uniform" type="checkbox" name="pass" value="1">
                                    </label>
                                </div>
                            </div>

                            <div class="form-actions no-margin-bottom text-center">
                                <a class="btn btn-default btn-sm" href="{{ route('line.resume') }}">Cancelar</a>
                                <input type="submit" value="Guardar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @forelse($timeArray as $period)
                <div class="box">
                    <header class="dark">
                        <div class="icons">
                            <i class="glyphicon glyphicon-time"></i>
                        </div>
                        <h5>{{ trans('timetables.'.$period['period']) }}</h5>

                        @include('partials.window_options')
                    </header>

                    <div class="body">

                        <div class="row">
                            @forelse($period['routes'] as $route)
                                <div class="col-lg-6 ui-sortable">
                                    <div class="box ui-sortable-handle">
                                        <header>
                                            <h5>Hacia {{ $route['destiny'] }} ({{ $route['id'] }})</h5>
                                            @include('partials.window_options_min')
                                        </header>
                                        <div id="{{ $period['period'].str_replace(' ','_',$route['destiny']) }}" class="body collapse in" aria-expanded="true">

                                            <table class="table table-bordered responsive-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-center">Hora salida</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($route['times'] as $time)
                                                        <tr>
                                                            <td>{{ $time->id }}</td>
                                                            <td class="text-center">
                                                                {!! $time->time !!}
                                                                @if($time->pass == true)
                                                                    <br>(Horario de paso - {{ $time->by }})
                                                                @elseif(isset($time->by) && $time->by!='')
                                                                    <br>({{ $time->by }})
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="vertical-align: middle;">
                                                                <a href="{{ route('timetable.destroy', [$line->id, $time->id]) }}" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs">
                                                                    <i class="glyphicon glyphicon-remove"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <h5>Esto no debería aparecer nunca</h5>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5>Esto no debería aparecer nunca</h5>
                            @endforelse
                        </div>
                    </div>
                </div><!--box-->
            @empty
                <div class="box text-center">
                    <h2>Esta línea no tiene horarios definidos</h2>
                </div>
            @endforelse
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@stop
@push('scripts')
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery.uniform.min.js') }}"></script>

    <script>
        $(function() {
            $(".uniform").uniform();
            $(".chosen-select").chosen();
        });
    </script>
@endpush