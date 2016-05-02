<div class="row">
    <div class="col-sm-5">
        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
            Mostrando del {{ ($paginationClass->currentPage()-1) * $paginationClass->perPage() + 1}} al
            @if(($paginationClass->currentPage() * $paginationClass->perPage())>$paginationClass->total())
                {{ $paginationClass->total() }}
            @else
                {{ $paginationClass->currentPage() * $paginationClass->perPage() }}
            @endif
            de {{ $paginationClass->total() }} registros
        </div>
    </div>
</div>
<div class="row text-center">
    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
        {!! $paginationClass->render() !!}
    </div>
</div>