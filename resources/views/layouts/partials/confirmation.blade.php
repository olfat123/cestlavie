<div class="uk-modal" id="confirmationModal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Are you sure?</h3>
        </div>
        <p>This action cannot be reversed.</p>
        <div class="uk-modal-footer uk-text-right">
            <form method="POST" class="ajax" id="confirmForm">
                @csrf
                <button type="button" class="md-btn md-btn-flat uk-modal-close">
                    @lang('common.cancel')</button>
                <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">
                    @lang('common.confirm')
                </button>
            </form>
        </div>
    </div>
</div>
