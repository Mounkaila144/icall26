{component name="/site/sublink"}
<div>{messages class="site-errors"}</div>
<div><h3>{__("Settings Google Config")}</h3></div>
<div class="justify-content-center">
    <div class="card text-center">
        <div class="card-header">
            <a class="btn pull-left" href="javascript:void(0);" id="cancel_google_setting"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>

            {if $settings->checkToken()}
                <button title="{__('logout')}" id="LogoutGoogle" class="mx-4 btn btn-sm pull-right">{__("logout")}</button>
            {else}
                <div class="pull-right"> {component name="/utils_google_sheet/oauthBtn"}</div>
            {/if}
        </div>
        <div class="card-body">

            <div class="form-group col-12 mt-2">
                <label for="access_token">{__('Access Token')}</label>
                <input type="text" value="{$settings->get('access_token')}" class="form-control text-center" id="access_token" name="access_token" disabled>
            </div>
            <div class="form-group col-12 mt-2">
                <label for="refresh_token">{__('Refresh Token')}</label>
                <input type="text" value="{$settings->get('refresh_token')}" class="form-control text-center" id="refresh_token" name="refresh_token" disabled>
            </div>

            <div class="container">  <!-- Added container -->
                <div class="row justify-content-center"> <!-- Centered row -->
                    <div class="col-md-9 col-sm-12 mt-3">  <!-- Adjust column sizes for responsiveness -->
                        <label for="redirect_uri" class="fw-bold text-center">{__('Redirect Url')}</label>
                        <input type="text" value="{$settings->get('redirect_uri')}" class="form-control text-center" id="redirect_uri" name="redirect_uri">
                    </div>

                    <!-- File Section -->
                    <div class="col-md-3 col-sm-12 mt-3"> <!-- Adjust column sizes for responsiveness -->
                        <label for="fileUpload" class="fw-bold text-center">{__('File')}</label>
                        <div class="d-flex justify-content-center align-items-center">
                            <div id="UtilsGoogleSheet-error_file"></div>
                            <div id="UtilsGoogleSheet-file_container" {if !$settings->checkFile()}style="display:none;"{/if}>
                                <a id="file" class="text-primary mx-2" title="{__('View')}">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </div>
                            <input class="file" type="file" name="UtilsGoogleSheet[file]" style="display:none;" id="fileUpload" />
                            <a id="UploadButton" class="text-primary mx-2" title="{__('Upload')}">
                                <i class="fa fa-upload fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>  <!-- End container -->

            <div class="col-12">
                <button title="{__('Save')}" id="Save-Settings" class="mt-4 btn">{__("Save")}</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal pour afficher le contenu du fichier secret.json -->
<div id="secretModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="secretModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{__('Secret File Content')}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{__('Close')}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {if $settings->getConfigs()|@count > 0}
                    <table class="table table-bordered table-striped table-hover">
                        {foreach from=$settings->getConfigs() key=key item=value}
                            {if is_array($value)}
                                <tr>
                                    <th colspan="2" class="table-primary text-center">{$key}</th>
                                </tr>
                                {foreach from=$value key=subkey item=subvalue}
                                    <tr>
                                        <th class="table-secondary">{$subkey}</th>
                                        <td>
                                            {if is_array($subvalue)}
                                                {foreach from=$subvalue item=finalvalue}
                                                    {$finalvalue}<br/>
                                                {/foreach}
                                            {else}
                                                {$subvalue}
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                            {else}
                                <tr>
                                    <th class="table-secondary">{$key}</th>
                                    <td>{$value}</td>
                                </tr>
                            {/if}
                        {/foreach}
                    </table>
                {else}
                    <p class="text-warning text-center">{__('No configurations found.')}</p>
                {/if}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">{__('Close')}</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('#cancel_google_setting').click(function(){ return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
        loading: "#tab-site-dashboard-x-settings-loading",
        target: "#tab-dashboard-x-settings"
    });
    });
    // Afficher le contenu du fichier secret.json dans une modal
    $("#file").click(function () {
        $('#secretModal').modal('show');
    });

    // Bouton d'upload
    $('#UploadButton').click(function () {
        $('#fileUpload').click();
    });

    // Upload automatique après sélection du fichier




    // Déconnexion de Google
    $("#LogoutGoogle").click(function () {
        if (!confirm('{__("Google connexion will be logout. Confirm ?")}')) return false;
        return $.ajax2({
            url: "{url_to('utils_google_sheet_ajax',['action'=>'Logout'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            success: function (resp) {
                if (resp.action == 'Logout') {
                    return $.ajax2({
                        url: "{url_to('utils_google_sheet_ajax',['action'=>'Settings'])}",
                        errorTarget: ".site-errors",
                        loading: "#loading",
                        target: "#tab-dashboard-x-settings"
                    });
                }
            }
        });
    });
    $('#Save-Settings').click(function () {
        $('#UtilsGoogleSheet-secretFileLoading').show();

        $.ajax2({
            url: "{url_to('utils_google_sheet_ajax',['action'=>'Settings'])}",
            data: { UtilsGoogleSheet: { token: "{mfForm::getToken('UtilsGoogleSheetSettingsForm')}",
                    redirect_uri: $('#redirect_uri').val() }
            },
            files: ".file", // Inclure les fichiers avec la classe 'file'
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-dashboard-x-settings",
            complete: function () {
                $('#UtilsGoogleSheet-secretFileLoading').hide();
            }
        });
    });
</script>
