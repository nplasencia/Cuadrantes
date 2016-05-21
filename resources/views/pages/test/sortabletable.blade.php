@extends('layouts.default')
@section('content')
<div id="dataTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    <div class="row">
        <div class="col-sm-6">
            <div class="dataTables_length" id="dataTable_length">
                <label> Show
                    <select name="dataTable_length" aria-controls="dataTable" class="form-control input-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    entries
                </label>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="dataTable_filter" class="dataTables_filter">
                <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="dataTable"></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 234px;">
                        Rendering engine
                    </th>
                    <th class="sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 291px;" aria-sort="descending">
                        Browser</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 269px;">
                        Platform(s)
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 202px;">
                        Engine version
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 154px;">
                        CSS grade
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                Showing 1 to 10 of 57 entries
            </div>
        </div>
        <div class="col-sm-6">
            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
            </div>
        </div>
    </div>
</div>
@endsection