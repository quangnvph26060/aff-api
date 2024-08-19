<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&lsaquo;</span>
        </li>
    @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
    @endif

    <!-- Hiển thị số trang -->
    <li class="page-item active" aria-current="page"><span class="page-link">{{ $paginator->currentPage() }}</span></li>

    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
    @else
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&rsaquo;</span>
        </li>
    @endif
</ul>
<style scoped>
/* CSS cho phân trang */
.pagination {
    overflow: hidden;
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
    align-items: center;
}

.pagination li {
    margin: 0 5px;
   
}

.pagination a {
    display: block;
    padding: 8px 10px;
    text-decoration: none;
    color: #333;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.pagination a:hover {
    background-color: #e9e9e9;
}

.pagination .active span {
    font-weight: bold;
    background-color: #ccc;
    color: #fff;
    border-radius: 10px;
}

.pagination .disabled span {
    color: #ccc;
    cursor: not-allowed;
  
    padding: 8px 10px;
    text-decoration: none;
    color: #333;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 3px;
}
</style>