@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header class="dark">
                    <div class="icons">
                        <i class="fa fa-car"></i>
                    </div>
                    <h5>Datos guagua</h5>

                    @include('partials.window_options')
                </header>

                <div class="body">

                    @include('partials.msg_success')

                    @include('partials.errors')

                    <form class="form-horizontal" method="POST"
                          action="@if(isset($bus) && $bus != null){{ Route('bus.update', $bus->id) }}@else{{ route('bus.create') }}@endif">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="brand">Marca</label>
                            <div class="col-lg-4">
                                <select data-placeholder="Selecciona una marca ..." class="form-control chosen-select" name="brand_id" id="brand">
                                    <option value=""></option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            @if(isset($bus) && $bus != null)
                                                @if( $bus->brand_id == $brand->id )selected="selected"@endif
                                            @else
                                                @if( old('brand_id') == $brand->id )selected="selected"@endif
                                            @endif
                                        >{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="license">Matrícula</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="license" id="license"
                                       value="@if(isset($bus) && $bus != null){{ $bus->license }}@else{{ old('license') }}@endif" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="seats">Plazas sentadas</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="number" name="seats" id="seats"
                                       value="@if(isset($bus) && $bus != null){{ $bus->seats }}@else{{ old('seats') }}@endif">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="stands">Plazas de pie</label>
                            <div class=" col-lg-4">
                                <input class="form-control" type="number" name="stands" id="stands"
                                       value="@if(isset($bus) && $bus != null){{ $bus->stands }}@else{{ old('stands') }}@endif">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4" for="registration">Fecha de matriculación</label>
                            <div class=" col-lg-4">
                                <input data-provide="datepicker" class="form-control" type="text" name="registration" id="registration"
                                       value="@if(isset($bus) && $bus != null){{ $bus->registrationFormatted }}@else{{ old('registration') }}@endif">
                            </div>
                        </div>

                        <div class="form-actions no-margin-bottom text-center">
                            <a class="btn btn-default btn-sm" href="{{ route('bus.resume') }}">@lang('general.cancel')</a>
                            <input type="submit" value="@lang('general.save')" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div><!--box-->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@stop
@push('scripts')
    <script src="{{ asset('assets/js/libs/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.min.js') }}"></script>

    <script>
        (function($){
            $(".chosen-select").chosen();
        }(jQuery));
    </script>
@endpush