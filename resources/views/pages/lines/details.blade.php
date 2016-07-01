@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header class="dark">
                    <div class="icons">
                        <i class="fa fa-bus"></i>
                    </div>
                    <h5>Datos de la línea</h5>

                    @include('partials.window_options')
                </header>

                <div class="body">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <form class="form-horizontal" method="POST"
                          action="@if(isset($line) && $line != null){{ route('line.update', $line->id) }}@else{{ route('line.create') }}@endif">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="number">Número</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="number" id="number"
                                       value="@if(isset($line) && $line != null){{ $line->number }}@else{{ old('number') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="name">Nombre</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="name" id="name"
                                       value="@if(isset($line) && $line != null){{ $line->name }}@else{{ old('name') }}@endif" />
                            </div>
                        </div>

                        <div class="form-actions no-margin-bottom text-center">
                            <a class="btn btn-default btn-sm" href="{{ route('line.resume') }}">Cancelar</a>
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div><!--box-->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@endsection