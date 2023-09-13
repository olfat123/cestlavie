@if ($paginator->hasPages())
    <div class="product-result-foot">
        <div class="pagination-contain center wow fadeInUp">
            <div class="pagination-wrap">
                <div class="pagination">
                    @if ($paginator->onFirstPage())
                    @else
                        <a class="pagination-btn prev" href="{{ $paginator->previousPageUrl() }}">
                            <img src="{{ asset('assets/images/icons/btn-arrow-prev-black.png')}}" alt=""/>
                            <span>السابق</span>
                        </a>
                    @endif
                    {{-- Pagination Elements --}}
                    <ul>
                        @foreach ($elements as $element)
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="active">{{ $page }}</li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                    @if ($paginator->hasMorePages())
                        <a class="pagination-btn next" href="{{ $paginator->nextPageUrl() }}">
                            <span>التالي</span>
                            <img src="{{ asset('assets/images/icons/btn-arrow-next-black.png')}}" alt=""/>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif