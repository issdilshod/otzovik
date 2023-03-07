<?php

use App\Services\Admin\Misc\PaginatorService;

$paginatorService = new PaginatorService($list->currentPage(), $list->lastPage(), 3, true);

?>

@if($paginatorService::hasMore())

<div class="col-12 text-right">
    <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item">
            <a class="page-link" href="{{$paginatorService::getUrl($paginatorService::prevPage())}}">{{__('pagination_prev')}}</a>
        </li>

        @for ($i = $paginatorService::$startNumber; $i<=$paginatorService::$endNumber; $i++)
            <li class="page-item @if ($i==$paginatorService::$currentPage){{'active'}}@endif">
                <a class="page-link" href="{{$paginatorService::getUrl($i)}}">{{$i}}</a>
            </li>
        @endfor

        <li class="page-item">
            <a class="page-link" href="{{$paginatorService::getUrl($paginatorService::nextPage())}}">{{__('pagination_next')}}</a>
        </li>
    </ul>
</div>

@endif

<div class="col-12 text-right mb-2">
    <div>
        {{__('pagination_shown')}} {{ $list->count() }} {{__('pagination_from')}} {{ $list->total() }}
    </div>
</div>