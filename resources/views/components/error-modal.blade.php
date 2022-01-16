<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header errorModal">
                <h5 class="modal-title"><i class="fas fa-exclamation"></i>&nbsp;Error Message</h5>
            </div>
            <div class="modal-body">
                {{ Session::get('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
            </div>
        </div>
    </div>
</div>
