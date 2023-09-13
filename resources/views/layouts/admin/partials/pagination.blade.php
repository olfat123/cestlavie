@if($collection->currentPage() != 1 || ( $collection->currentPage() != $collection->lastPage()))
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid">
                <div class="uk-width-medium-1-1">
                    {{$collection->links()}}
                </div>
            </div>
        </div>
    </div>
@endif