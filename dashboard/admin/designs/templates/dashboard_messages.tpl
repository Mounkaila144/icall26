<div id="successModal" class="modal fade zoomIn" tabindex="-1"  aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="">
            <div class="modal-body text-center  d-flex flex-column">
                <div class="swal2-html-container" id="swal2-html-container">
                    <div class="mt-3">
                        <div data-aos="zoom-in-right">
                            <img src="{url('assets/images/done.svg','web')}" height="300" width="300">
                        </div>
                        <div class="mt-4 pt-2 fs-15 badge bg-primary">
                            <h4 class="text-white successModal-text">
                                {foreach $messages->getDecodedMessages('info') as $message}
                                    {$message}
                                {/foreach}
                                {foreach $messages->getDecodedMessages('error') as $message}
                                    {$message}
                                {/foreach}
                                {foreach $messages->getDecodedMessages('warning') as $message}
                                    {$message}
                                {/foreach}
                            </h4>
                            <p class="text-muted mx-4 mb-0 text-white-50 successModal-text-d"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->