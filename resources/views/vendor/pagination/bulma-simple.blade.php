@if ($paginator->hasPages())
<nav class="pagination is-centered" role="navigation" aria-label="pagination">
    @if (!$paginator->onFirstPage())
    <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
    @endif
    @if ($paginator->hasMorePages())
    <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
    @endif
</nav>
@endif
