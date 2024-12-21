
{messages class="site-errors"}
<span id="error-container" class="text-danger"></span>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="ServicesZapierClient"}

<button id="ServicesZapierClient-filter" class="btn  ">{__("Filter")}</button>
<button id="ServicesZapierClient-init" class="btn  ">{__("Init")}</button>
<button id="ServicesZapierClient-New" class="btn btn-sm pull-right" title="{__('new Client')}"><i
            class="fa fa-plus" style="margin-right:10px;"></i>{__('New Client')}</button>
<table class="tabl-list footable table table-striped">
    <thead>
    <tr class="table-info">

        <thead>
    <tr class="list-header">
        <th data-hide="phone" style="display: table-cell;">#</th>
        {if $pager->getNbItems()>5}
            <th data-hide="phone" style="display: table-cell;">&nbsp;</th>
        {/if}

        <th>
            <span>{__('Name')|capitalize}</span>
        </th>

<th>
            <span>{__('Client id')|capitalize}</span>
        </th>


        <th>
            <span>{__('Client secret')|capitalize}</span>

        </th>

        <th>
            <span>{__('Redirect uri')}</span>

        </th>


        <th>
            {__('Scope')}

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
    </tr>
    {foreach $pager as $item}
        <tr class="ServicesZapierClient list"
            id="ServicesZapierClient-{$item->get('client_id')}">
            <td class="ServicesZapierClient-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>
                    <input class="ServicesZapierClient-selection" type="checkbox"
                           id="{$item->get('client_id')}" name="{$item->get('client_id')}"/>
                </td>
            {/if}
            {*  <td><span>{$item->get('client_id')}</span></td>   *}
            <td>
                {$item->get('name')}
            </td>
            <td>
                {$item->get('client_id')}
            </td>
            <td>
                {$item->get('client_secret')}
            </td>
            <td>
                {$item->get('redirect_uri')}

            </td>
            <td>
                {$item->get('scope')}

            </td>
            <td>

                <a href="#" title="{__('edit')}" class="ServicesZapierClient-View"
                   id="{$item->get('client_id')}">
                    <img src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>

                <a href="#" title="{__('delete')}" class="ServicesZapierClient-Delete"
                   id="{$item->get('client_id')}" name="{$item->get('client_id')}">
                    <img src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>


            </td>
        </tr>
    {/foreach}

</table>
{if !$pager->getNbItems()}
    <span>{__('No Client')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="ServicesZapierClient-all"/>
        <a style="opacity:0.5" class="ServicesZapierClient-actions_items" href="#"
           title="{__('delete')}" id="ServicesZapierClient-Delete">
            <img src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>
    {/if}
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ServicesZapierClient"}

<div class="" style="top:100px;position: fixed;left: 20px;z-index: 1000;">
    <a href="javascript:void(0);" style="margin-right: 20px;" id="Cancel">
        <i class="mdi mdi-arrow-left-bold-circle text-danger fs-36"></i>
    </a>
</div>
<script type="text/javascript">

    function getSiteClientFilterParameters() {
        var params = {
            filter: {
                order: {},
                search: {},
                equal: {},
                   nbitemsbypage: $("[name=ServicesZapierClient-nbitemsbypage]").val(),
                token: '{$formFilter->getCSRFToken()}'
            }
        };

        $(".ServicesZapierClient-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });


        if ($(".ServicesZapierClient-order_active").attr("name"))
            params.filter.order[$(".ServicesZapierClient-order_active").attr("name")] = $(".ServicesZapierClient-order_active").attr("id");
        $(".ServicesZapierClient-search").each(function () {
            params.filter.search[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function updateSiteClientFilter() {
        return $.ajax2({
            data: getSiteClientFilterParameters(),
            url: "{url_to('services_zapier_ajax',['action'=>'ListPartialClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    }

    function updateSitePager(n) {
        page_active = $(".ServicesZapierClient-pager .ServicesZapierClient-active").html() ? parseInt($(".ServicesZapierClient-pager .ServicesZapierClient-active").html()) : 1;
        records_by_page = $("[name=ServicesZapierClient-nbitemsbypage]").val();
        start = (records_by_page != "*") ? (page_active - 1) * records_by_page + 1 : 1;
        $(".ServicesZapierClient-count").each(function (id) {
            $(this).html(start + id)
        }); // Update index column
        nb_results = parseInt($("#ServicesZapierClient-nb_results").html()) - n;
        $("#ServicesZapierClient-nb_results").html((nb_results > 1 ? nb_results + " {__('results')}" : "{__('one result')}"));
        $("#ServicesZapierClient-end_result").html($(".Client-count:last").html());
    }

    {* =====================  P A G E R  A C T I O N S =============================== *}

    $("#ServicesZapierClient-init").click(function () {
        $.ajax2({
            url: "{url_to('services_zapier_ajax',['action'=>'ListPartialClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });

    $('.ServicesZapierClient-order').click(function () {
        $(".ServicesZapierClient-order_active").attr('class', 'ServicesZapierClient-order');
        $(this).attr('class', 'ServicesZapierClient-order_active');
        return updateSiteClientFilter();
    });

    $(".ServicesZapierClient-search").keypress(function (event) {
        if (event.keyCode == 13)
            return updateSiteClientFilter();
    });

    $("#ServicesZapierClient-filter").click(function () {
        return updateSiteClientFilter();
    });
    $(".ServicesZapierClient-equal").change(function () {
        return updateSiteClientFilter();
    });

    $("[name=ServicesZapierClient-nbitemsbypage]").change(function () {
        return updateSiteClientFilter();
    });


    $(".ServicesZapierClient-pager").click(function () {
        return $.ajax2({
            data: getSiteClientFilterParameters(),
            url: "{url_to('services_zapier_ajax',['action'=>'ListPartialClient'])}?" + this.href.substring(this.href.indexOf("?") + 1, this.href.length),
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });

    $("#ServicesZapierClient-New").click(function () {

        return $.ajax2({
            url: "{url_to('services_zapier_ajax',['action'=>'NewClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });

    $(".ServicesZapierClient-View").click(function () {
        return $.ajax2({
            data: { ServicesZapierClient: $(this).attr('id')},
            loading: "#loading",
            url: "{url_to('services_zapier_ajax',['action'=>'ViewClient'])}",
            errorTarget: ".site-errors",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });


    $(".ServicesZapierClient-Delete").click(function () {
        if (!confirm('{__("Client \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
        return $.ajax2({
            data: { ServicesZapierClient: $(this).attr('id')},
            url: "{url_to('services_zapier_ajax',['action'=>'DeleteClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            success: function (resp) {
                if (resp.action == 'deleteServicesZapierClient') {
                    $("tr#ServicesZapierClient-" + resp.id).remove();
                    if ($('.ServicesZapierClient').length == 0)
                        return updateSiteClientFilter()

                }
            }
        });
    });


</script>
