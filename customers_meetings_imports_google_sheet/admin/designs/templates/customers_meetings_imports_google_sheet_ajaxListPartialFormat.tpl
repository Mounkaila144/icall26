
{if $formFilter->getSettings()->checkToken()}
{messages class="site-errors"}
<span id="error-container" class="text-danger"></span>
<div id="info-message" class="text-success" style="display: none;"></div>
<div id="error-message" class="text-danger" style="display: none;"></div>


<div id="logModal" style="display:none" class="dialogs" title="{__('Logs')}"></div>

<div id="infoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{__('Import')}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{__('Close')}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Icône de chargement ou de pause -->
                <div id="loading-icon" class="text-center mb-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">{__('Loading...')}</span>
                    </div>
                </div>

                <!-- Barre de progression -->
                <div id="progress-bar-container" class="progress mb-3">
                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuemin="0"
                         aria-valuemax="100">0%
                    </div>
                </div>

                <!-- Section des statistiques -->
                <div class="row">
                    <div class="col-6">
                        <ul id="statsList" class="list-unstyled">
                            <li><strong>{__('Total rows')}:</strong> <span id="totalRows">0</span></li>
                            <li class="text-success"><strong>{__('Successfully inserted rows')}:</strong> <span
                                        id="successCount">0</span></li>
                            <li class="text-danger"><strong>{__('Rows with errors')}:</strong> <span
                                        id="errorCount">0</span></li>
                            <li><strong>{__('Remaining rows')}:</strong> <span id="remainingRows">0</span></li>
                        </ul>
                    </div>
                    <!-- Boutons alignés en bas et à droite -->
                    <div class="col-6 d-flex flex-column justify-content-end align-items-end">
                        <div class="d-flex">
                            <button id="pauseBtn" class="btn  mx-1"><i class="fa fa-pause"></i> {__('Pause')}</button>
                            <button id="resumeBtn" class="btn mx-1" style="display: none;"><i
                                        class="fa fa-play"></i> {__('Resume')}</button>
                            <button id="stopBtn" class="btn  mx-1"><i class="fa fa-stop"></i> {__('Stop')}</button>
                        </div>
                    </div>
                </div>

                <!-- Liste des messages -->
                <ul id="infoList" class="text-center overflow-auto text-danger" style="max-height: 60vh;"></ul>
            </div>
        </div>
    </div>
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetingImportGoogleSheetFormat"}

<button id="CustomerMeetingImportGoogleSheetFormat-filter" class="btn  ">{__("Filter")}</button>
<button id="CustomerMeetingImportGoogleSheetFormat-init" class="btn  ">{__("Init")}</button>
<button id="CustomerMeetingImportGoogleSheetFormat-New" class="btn btn-sm pull-right" title="{__('new format')}"><i
            class="fa fa-plus" style="margin-right:10px;"></i>{__('New format')}</button>
<table class="tabl-list footable table table-striped">
    <thead>
    <tr class="table-info">

        <thead>
    <tr class="list-header">
        <th data-hide="phone" style="display: table-cell;">#</th>
        {if $pager->getNbItems()>5}
            <th data-hide="phone" style="display: table-cell;">&nbsp;</th>
        {/if}
        </th>
        <th style="text-align: center;">
            <div class="d-flex justify-content-center">
                <span>{__('Name')}</span>
                <div class="d-flex mx-2">
                    <a href="#"
                       class="mx-1 CustomerMeetingImportGoogleSheetFormat-order{$formFilter.order.name->getValueExist('asc','_active')}"
                       id="asc" name="name"><img
                                src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}'
                                alt="{__('order_asc')}"/></a>
                    <a href="#"
                       class="mx-1 CustomerMeetingImportGoogleSheetFormat-order{$formFilter.order.name->getValueExist('desc','_active')}"
                       id="desc" name="name"><img
                                src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}'
                                alt="{__('order_desc')}"/></a>
                </div>
            </div>
        </th>


        <th>
            <span>{__('file')|capitalize}</span>

        </th>


        <th>
            <span>{__('Leaf')|capitalize}</span>

        </th>

        <th>
            <span>{__('Line')}</span>

        </th>


        <th>
            {__('processed rows')}

        </th>
        <th >
            {__('success count')}

        </th>
        <th >
            {__('error count')}

        </th>
        <th>
            {__('remaining count')}

        </th>
        <th>
            <span>{__('status')}</span>

        </th>


        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}
            <td></td>
        {/if}
        {*     <td>{* id *}
        {* </td>        *}
        <td>{* name *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>
            {html_options  class="CustomerMeetingImportGoogleSheetFormat-equal" name="status" options=$formFilter->equal.status->getOption('choices') selected=(string)$formFilter.equal.status}

        </td>
         <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
        <tr class="CustomerMeetingImportGoogleSheetFormat list"
            id="CustomerMeetingImportGoogleSheetFormat-{$item->get('id')}">
            <td class="CustomerMeetingImportGoogleSheetFormat-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>
                    <input class="CustomerMeetingImportGoogleSheetFormat-selection" type="checkbox"
                           id="{$item->get('id')}" name="{$item->get('name')}"/>
                </td>
            {/if}
            {*  <td><span>{$item->get('id')}</span></td>   *}
            <td>
                {$item->get('name')}
            </td>
            <td>
                {$item->get('file_name')}
            </td>
            <td>
                {$item->get('leaf_name')}

            </td>
            <td >
                <span class="CustomerMeetingImportGoogleSheetFormat-number-of-lines">{$item->get('number_of_lines')}</span>
                <a href="#" title="{__('update number of lines')}"
                   class="CustomerMeetingImportGoogleSheetFormat-updateNumberOfLines"
                   id="{$item->get('id')}">
                    <i class="fa fa-refresh text-primary"></i> <!-- Icône fa-refresh avec couleur primaire -->
                </a>

            </td>

            <td>
                <span class="CustomerMeetingImportGoogleSheetFormat-Processed">{$item->get('processed_rows')}</span>

            </td>
            <td>
                <span class="CustomerMeetingImportGoogleSheetFormat-Success">{$item->get('success_count')}</span>

            </td>
            <td class="CustomerMeetingImportGoogleSheetFormat-Error">
                {if $item->get('success_count')>0}
                    <button class="btn btn-sm log " id="{$item->get('id')}" title="{__('Logs')}"><i class="fa fa-eye text-danger"></i>
                       {$item->get('error_count')}</button>
                {/if}
            </td>
            <td>
                <span class="CustomerMeetingImportGoogleSheetFormat-Restant">{$item->get('number_of_lines')-$item->get('processed_rows')}</span>



            </td>
            <td>

                {if $item->get('status') == 0}
                    <span class="text-white badge bg-secondary">
            <i class="fa fa-hourglass-o"></i> {__('not started')}
        </span>
                {elseif $item->get('status') == 1}
                    <span class="text-white badge bg-danger">
            <i class="fa fa-exclamation-triangle"></i> {__('interrupted')}
        </span>
                {elseif $item->get('status') == 2}
                    <span class="text-white badge bg-success">
            <i class="fa fa-check-circle"></i> {__('finished')}
        </span>
                {/if}
            </td>



            <td>

                    <button {if $item->get('status') == 2}style="display: none" {/if} class="btn btn-sm import mt-2" data-total="{$item->get('number_of_lines')}"
                            id="{$item->get('id')}">{__('import')}</button>
                <button class="btn btn-sm Reset mt-2" id="{$item->get('id')}" title="{__('Reset')}">
                    {__('Reset')}
                </button>

                <a href="#" title="{__('edit')}" class="CustomerMeetingImportGoogleSheetFormat-View"
                   id="{$item->get('id')}">
                    <img src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>

                <a href="#" title="{__('delete')}" class="CustomerMeetingImportGoogleSheetFormat-Delete"
                   id="{$item->get('id')}" name="{$item->get('name')}">
                    <img src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>


            </td>
        </tr>
    {/foreach}

</table>
{if !$pager->getNbItems()}
    <span>{__('No format')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="CustomerMeetingImportGoogleSheetFormat-all"/>
        <a style="opacity:0.5" class="CustomerMeetingImportGoogleSheetFormat-actions_items" href="#"
           title="{__('delete')}" id="CustomerMeetingImportGoogleSheetFormat-Delete">
            <img src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>
    {/if}
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetingImportGoogleSheetFormat"}

<div class="" style="top:100px;position: fixed;left: 20px;z-index: 1000;">
    <a href="javascript:void(0);" style="margin-right: 20px;" id="Cancel">
        <i class="mdi mdi-arrow-left-bold-circle text-danger fs-36"></i>
    </a>
</div>
<script type="text/javascript">

    function getSiteFormatFilterParameters() {
        var params = {
            filter: {
                order: {},
                search: {},
                equal: {},
                   nbitemsbypage: $("[name=CustomerMeetingImportGoogleSheetFormat-nbitemsbypage]").val(),
                token: '{$formFilter->getCSRFToken()}'
            }
        };

        $(".CustomerMeetingImportGoogleSheetFormat-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });


        if ($(".CustomerMeetingImportGoogleSheetFormat-order_active").attr("name"))
            params.filter.order[$(".CustomerMeetingImportGoogleSheetFormat-order_active").attr("name")] = $(".CustomerMeetingImportGoogleSheetFormat-order_active").attr("id");
        $(".CustomerMeetingImportGoogleSheetFormat-search").each(function () {
            params.filter.search[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function updateSiteFormatFilter() {
        return $.ajax2({
            data: getSiteFormatFilterParameters(),
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialFormat'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-format-base"
        });
    }

    function updateSitePager(n) {
        page_active = $(".CustomerMeetingImportGoogleSheetFormat-pager .CustomerMeetingImportGoogleSheetFormat-active").html() ? parseInt($(".CustomerMeetingImportGoogleSheetFormat-pager .CustomerMeetingImportGoogleSheetFormat-active").html()) : 1;
        records_by_page = $("[name=CustomerMeetingImportGoogleSheetFormat-nbitemsbypage]").val();
        start = (records_by_page != "*") ? (page_active - 1) * records_by_page + 1 : 1;
        $(".CustomerMeetingImportGoogleSheetFormat-count").each(function (id) {
            $(this).html(start + id)
        }); // Update index column
        nb_results = parseInt($("#CustomerMeetingImportGoogleSheetFormat-nb_results").html()) - n;
        $("#CustomerMeetingImportGoogleSheetFormat-nb_results").html((nb_results > 1 ? nb_results + " {__('results')}" : "{__('one result')}"));
        $("#CustomerMeetingImportGoogleSheetFormat-end_result").html($(".Format-count:last").html());
    }

    {* =====================  P A G E R  A C T I O N S =============================== *}

    $("#CustomerMeetingImportGoogleSheetFormat-init").click(function () {
        $.ajax2({
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialFormat'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-format-base"
        });
    });

    $('.CustomerMeetingImportGoogleSheetFormat-order').click(function () {
        $(".CustomerMeetingImportGoogleSheetFormat-order_active").attr('class', 'CustomerMeetingImportGoogleSheetFormat-order');
        $(this).attr('class', 'CustomerMeetingImportGoogleSheetFormat-order_active');
        return updateSiteFormatFilter();
    });

    $(".CustomerMeetingImportGoogleSheetFormat-search").keypress(function (event) {
        if (event.keyCode == 13)
            return updateSiteFormatFilter();
    });

    $("#CustomerMeetingImportGoogleSheetFormat-filter").click(function () {
        return updateSiteFormatFilter();
    });
    $(".CustomerMeetingImportGoogleSheetFormat-equal").change(function () {
        return updateSiteFormatFilter();
    });

    $("[name=CustomerMeetingImportGoogleSheetFormat-nbitemsbypage]").change(function () {
        return updateSiteFormatFilter();
    });


    $(".CustomerMeetingImportGoogleSheetFormat-pager").click(function () {
        return $.ajax2({
            data: getSiteFormatFilterParameters(),
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialFormat'])}?" + this.href.substring(this.href.indexOf("?") + 1, this.href.length),
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-format-base"
        });
    });

    $("#CustomerMeetingImportGoogleSheetFormat-New").click(function () {

        return $.ajax2({
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'NewFormat'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-format-base"
        });
    });

    $(".CustomerMeetingImportGoogleSheetFormat-View").click(function () {
        return $.ajax2({
            data: { CustomerMeetingImportGoogleSheetFormat: $(this).attr('id')},
            loading: "#loading",
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ViewFormat'])}",
            errorTarget: ".site-errors",
            target: "#tab-site-panel-dashboard-x-list-format-base"
        });
    });

    $(".log").click(function () {
        $("#logModal").dialog( {  autoOpen: false,  height: 'auto', width:'50%',  modal: true });

      return  $.ajax2({
            data: { filter: { format_id: this.id, nbitemsbypage:50 } },
            url: "{url_to('customers_meetings_imports_google_sheet_ajax', ['action' => 'ListPartialLog'])}",
            target: "#logModal",
            success: function()
            {
                $("#logModal").dialog('open');
            }

    })
    });
    $(".import").click(function () {
        var formatId = this.id;
        var totalRows = parseInt($(this).data('total'));
        var processedRows = 0, successCount = 0, errorCount = 0;
        var offset = null, isPaused = false, isStopped = false;

        // Récupérer l'état actuel depuis le serveur
        $.ajax2({
            data: { format: { format_id: formatId } },
            url: "{url_to('customers_meetings_imports_google_sheet_ajax', ['action' => 'GetImportStatus'])}",
            success: function(response) {

                processedRows = parseInt(response.processedRows) || 0;
                successCount = parseInt(response.successCount) || 0;
                errorCount = parseInt(response.errorCount) || 0;
                offset = response.nextOffset;

                // Afficher le modal et démarrer l'importation
                $("#infoModal").modal({
                    backdrop: false
                }).modal('show');
                $("#loading-icon").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">{__('loading')}...</span></div>');
                $("#pauseBtn").show();
                $("#resumeBtn").hide();

                updateUI();

                executeBatch();
            },

        });

        function updateUI() {
            var progress = ((processedRows / totalRows) * 100).toFixed(0);
            $("#progress-bar").css("width", progress + "%").attr("aria-valuenow", progress).text(progress + "%");
            $("#totalRows").text(totalRows);
            $("#successCount").text(successCount);
            $("#errorCount").text(errorCount);
            $("#remainingRows").text(totalRows - processedRows);
        }

        $("#pauseBtn").click(function() {
            isPaused = true;
            $(this).hide();
            $("#resumeBtn").show();
            $("#loading-icon").html('<i class="fa fa-pause text-primary" style="font-size: 2rem;"></i>');
            $("#infoList").append("<li><em>{__('Import paused')}.</em></li>");
        });

        $("#resumeBtn").click(function() {
            isPaused = false;
            $(this).hide();
            $("#pauseBtn").show();
            $("#loading-icon").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Chargement...</span></div>');
            $("#infoList").append("<li><em>{__("Resuming import")}...</em></li>");
            executeBatch();
        });

        $("#stopBtn").click(function() {
            isStopped = true;
            $("#infoModal").modal('hide');
            return updateSiteFormatFilter()
        });

        function executeBatch() {
            if (isStopped || isPaused) return;

            $.ajax2({
                data: { format: { format_id: formatId, offset: offset } },
                url: "{url_to('customers_meetings_imports_google_sheet_ajax', ['action' => 'Import'])}",
                success: function(response) {
                    if (response.error) {
                        $("#infoList").append("<li><strong>{__('Error')} :</strong> " + response.error + "</li>");
                        $("#loading-icon").hide();
                        return;
                    }

                    if (response.infos && response.infos.length) {
                        response.infos.forEach(function(info) {
                            $("#infoList").append("<li>" + info + "</li>");
                        });
                    }

                    successCount = parseInt(response.totalSuccessCount);
                    errorCount = parseInt(response.totalErrorCount);
                    processedRows = parseInt(response.totalProcessedRows);
                    offset = response.nextOffset;

                    updateUI();

                    if (response.isCompleted) {
                        $("#loading-icon").hide();
                        $("#pauseBtn, #resumeBtn").hide();
                        return $.ajax2({
                            data: getSiteFormatFilterParameters(),
                            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialFormat'])}",
                            errorTarget: ".site-errors",
                            target: "#tab-site-panel-dashboard-x-list-format-base"

                        });
                    } else {
                        executeBatch();
                    }
                },
                error: function(xhr, status, error) {
                    $("#infoList").append("<li><strong>Une erreur est survenue :</strong> " + error + "</li>");
                    $("#loading-icon").hide();
                }
            });
        }
    });

    $(".CustomerMeetingImportGoogleSheetFormat-Delete").click(function () {
        if (!confirm('{__("Format \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
        return $.ajax2({
            data: { CustomerMeetingImportGoogleSheetFormat: $(this).attr('id')},
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'DeleteFormat'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            success: function (resp) {
                if (resp.action == 'deleteCustomerMeetingImportGoogleSheetFormat') {
                    $("tr#CustomerMeetingImportGoogleSheetFormat-" + resp.id).remove();
                    if ($('.CustomerMeetingImportGoogleSheetFormat').length == 0)
                        return updateSiteFormatFilter()

                }
            }
        });
    });


    $(".CustomerMeetingImportGoogleSheetFormat-updateNumberOfLines").click(function () {
        $("#info-message, #error-message").text('');
        return $.ajax2({
            data: { CustomerMeetingImportGoogleSheetFormat: $(this).attr('id') },
            url: "{url_to('customers_meetings_imports_google_sheet_ajax', ['action' => 'UpdateNumberOfLines'])}",
            success: function(resp) {
                if (resp.action === 'updateLinesCustomerMeetingImportGoogleSheetFormat') {
                    let row = $("tr#CustomerMeetingImportGoogleSheetFormat-" + resp.id);
                    row.find(".CustomerMeetingImportGoogleSheetFormat-number-of-lines").text(resp.value);
                    row.find(".CustomerMeetingImportGoogleSheetFormat-restant").text(
                        parseInt(row.find(".CustomerMeetingImportGoogleSheetFormat-restant").text()) + parseInt(resp.restant)
                    );
                    row.find(".import").attr("data-total", resp.value).show();
                    if(resp.status==1) {
                        row.find(".badge").removeClass("bg-secondary bg-success").addClass("bg-danger")
                            .html('<i class="fa fa-exclamation-triangle"></i>{__('interrupted')}');
                    }
                    $("#info-message").text(resp.info).show();
                }

            },
            error: function(resp) {
                $("#error-message").text(resp.error).show();
            }
        });
    });
    // Stockez les traductions dans des variables JavaScript
$(".Reset").click(function () {
        $("#info-message").text('');
        return $.ajax2({
            data: { CustomerMeetingImportGoogleSheetFormat: $(this).attr('id') },
            url: "{url_to('customers_meetings_imports_google_sheet_ajax', ['action' => 'Reset'])}",
            success: function(resp) {
                if (resp.action === 'Reset') {
                    var row = $("#CustomerMeetingImportGoogleSheetFormat-" + resp.id);
                    row.find(".CustomerMeetingImportGoogleSheetFormat-number-of-lines").text(resp.value);
                    row.find(".CustomerMeetingImportGoogleSheetFormat-Processed").text(0);
                    row.find(".CustomerMeetingImportGoogleSheetFormat-Restant").text(0);
                    row.find(".CustomerMeetingImportGoogleSheetFormat-Success").text(0);
                    row.find(".log").remove();
                    row.find(".import").attr("data-total", resp.value).show();
                    row.find(".badge")
                        .removeClass("bg-danger bg-success")
                        .addClass("bg-secondary")
                        .html('<i class="fa fa-hourglass-o"></i> ' + "{__('not started')}");

                    $("#info-message").text(resp.info).show();
                }
            },
            error: function(resp) {
                $("#error-message").text(resp.error).show();
            }
        });
    });

</script>
{else}
    {component name="/utils_google_sheet/oauthBtn"}
{/if}