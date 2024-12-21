<div class="row">
    <div class="col">
        {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetingImportGoogleSheetLog"}
    </div>
    <div class="col d-flex justify-content-end"> <!-- alignement à droite avec d-flex et justify-content-end -->
        <div class="ms-auto">
            <button id="CustomerMeetingImportGoogleSheetLog-filter" class="btn">{__("Filter")}</button>
            <button id="CustomerMeetingImportGoogleSheetLog-init" class="btn">{__("Init")}</button>
        </div>
    </div>
</div>
<table class="tabl-list footable table table-hover table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th><span style="text-align: left; padding-left: 0;">{__('Log')}</span></th>
    </tr>
    </thead>
    <tbody>
    {foreach $pager as $item}
        <tr class="CustomerMeetingImportGoogleSheetLog list" id="CustomerMeetingImportGoogleSheetLog-{$item->get('id')}">
            <td class="CustomerMeetingImportGoogleSheetFormat-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            <td style="text-align: left; padding-left: 0;">
                {$item->get('log')}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>


{if !$pager->getNbItems()}
    <span>{__('No log')}</span>
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetingImportGoogleSheetLog"}
<script type="text/javascript">


    function getSiteLogFilterParameters() {
        var params = {
            filter: {
                order: {},
                search: {},
                equal: {},
                format_id: {$format_id},
                   nbitemsbypage: $("[name=CustomerMeetingImportGoogleSheetLog-nbitemsbypage]").val(),
            }
        };
        if ($(".CustomerMeetingImportGoogleSheetLog-order_active").attr("name"))
            params.filter.order[$(".CustomerMeetingImportGoogleSheetLog-order_active").attr("name")] = $(".CustomerMeetingImportGoogleSheetLog-order_active").attr("id");
        $(".CustomerMeetingImportGoogleSheetLog-search").each(function () {
            params.filter.search[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function updateSiteLogFilter() {
        return $.ajax2({
            data: getSiteLogFilterParameters(),
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialLog'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#logModal"
        });
    }

    function updateSitePager(n) {
        page_active = $(".CustomerMeetingImportGoogleSheetLog-pager .CustomerMeetingImportGoogleSheetLog-active").html() ? parseInt($(".CustomerMeetingImportGoogleSheetLog-pager .CustomerMeetingImportGoogleSheetLog-active").html()) : 1;
        records_by_page = $("[name=CustomerMeetingImportGoogleSheetLog-nbitemsbypage]").val();
        start = (records_by_page != "*") ? (page_active - 1) * records_by_page + 1 : 1;
        $(".CustomerMeetingImportGoogleSheetLog-count").each(function (id) {
            $(this).html(start + id)
        }); // Update index column
        nb_results = parseInt($("#CustomerMeetingImportGoogleSheetLog-nb_results").html()) - n;
        $("#CustomerMeetingImportGoogleSheetLog-nb_results").html((nb_results > 1 ? nb_results + " {__('results')}" : "{__('one result')}"));
        $("#CustomerMeetingImportGoogleSheetLog-end_result").html($(".Log-count:last").html());
    }

    {* =====================  P A G E R  A C T I O N S =============================== *}

    $("#CustomerMeetingImportGoogleSheetLog-init").click(function () {
        $.ajax2({
            data:{ filter: { format_id: {$format_id},}},
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialLog'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#logModal"
        });
    });

    $('.CustomerMeetingImportGoogleSheetLog-order').click(function () {
        $(".CustomerMeetingImportGoogleSheetLog-order_active").attr('class', 'CustomerMeetingImportGoogleSheetLog-order');
        $(this).attr('class', 'CustomerMeetingImportGoogleSheetLog-order_active');
        return updateSiteLogFilter();
    });

    $(".CustomerMeetingImportGoogleSheetLog-search").keypress(function (event) {
        if (event.keyCode == 13)
            return updateSiteLogFilter();
    });

    $("#CustomerMeetingImportGoogleSheetLog-filter").click(function () {
        return updateSiteLogFilter();
    });

    $("[name=CustomerMeetingImportGoogleSheetLog-nbitemsbypage]").change(function () {
        return updateSiteLogFilter();
    });


    $(".CustomerMeetingImportGoogleSheetLog-pager").click(function () {
        return $.ajax2({
            data: getSiteLogFilterParameters(),
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialLog'])}?" + this.href.substring(this.href.indexOf("?") + 1, this.href.length),
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#logModal"
        });
    });


</script>
