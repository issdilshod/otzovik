@if($list->lastPage()>1)
<?php 
    /**
     * calculate pagination
     */
    $rangePagination = 6; // pagination range
    $startNumber = $list->currentPage() - floor($rangePagination/2); // current page center
    if (($startNumber+$rangePagination)>$list->lastPage()){ // fix the end
        $startNumber -= (($startNumber+$rangePagination) - $list->lastPage() - 1);  
    }
    if ($startNumber<=1){ // fix the start
        $startNumber = 1; 
    }
?>
<div class="col-12 text-right">
    <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item @if ($list->currentPage()==1) disabled @endif">
            <a class="page-link" href="{{url()->current().'?page='.$list->currentPage()-1}}">{{__('pagination_prev')}}</a>
        </li>

        
        @for ($i = $startNumber, $j = 1; ($i <= $list->lastPage() && $j <= $rangePagination); $i++, $j++)
            <li class="page-item @if($list->currentPage()==$i) active @endif">
                <a class="page-link" href="{{url()->current().'?page='.$i}}">{{$i}}</a>
            </li>
        @endfor

        <li class="page-item @if ($list->currentPage()==$list->lastPage()) disabled @endif">
            <a class="page-link" href="{{url()->current().'?page='.$list->currentPage()+1}}">{{__('pagination_next')}}</a>
        </li>
    </ul>
</div>
@endif
<div class="col-12 text-right mb-2">
    <div>
        {{__('pagination_shown')}} {{ $list->count() }} {{__('pagination_from')}} {{ $list->total() }}
    </div>
</div>