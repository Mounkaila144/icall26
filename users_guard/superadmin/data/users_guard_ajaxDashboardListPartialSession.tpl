{messages class="site-errors"}
<h3>{__('Sessions')}</h3>  
    <div>
        <a href="{url_to('users_guard',['action'=>'ExportCsvSessions'])}?{$formFilter->getParametersForUrl( ['equal','search'])}" class="btn UserSessions-Export"  title="{__('Sessions Export')}" >
            <i class="fa fa-caret-square-o-down" style="margin-right: 10px"></i>{__('Export')}
        </a>
        <a href="#" id="Session-Cancel" class="btn UserSessions-Cancel"  title="{__('Cancel')}" >
            <i class="fa fa-times" style="margin-right: 10px"></i>{__('Cancel')}
        </a>
    </div>
   {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Session"}
<div>
    <button style="width:135px" id="Session-filter" class="btn-table">{__("Filter")}</button>   
    <button style="width:135px" id="Session-init" class="btn-table">{__("Init")}</button>
</div>
<div class="containerDivResp">
<table class="tabl-list  footable table" cellspacing="0">    
    <thead>
        <tr class="list-header">
            <th data-hide="phone" style="display: table-cell;">#</th>
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Username')}</span>      
                <div>
                    <a href="#" class="Session-order{$formFilter.order.username->getValueExist('asc','_active')}" id="asc" name="username"><img  src='{url("/icons/sort_asc`$formFilter.order.username->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="Session-order{$formFilter.order.username->getValueExist('desc','_active')}" id="desc" name="username"><img  src='{url("/icons/sort_desc`$formFilter.order.username->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th>
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('IP')}</span>
                <div>
                    <a href="#" class="Session-order{$formFilter.order.ip->getValueExist('asc','_active')}" id="asc" name="ip"><img  src='{url("/icons/sort_asc`$formFilter.order.ip->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="Session-order{$formFilter.order.ip->getValueExist('desc','_active')}" id="desc" name="ip"><img  src='{url("/icons/sort_desc`$formFilter.order.ip->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th> 
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Start time')}</span> 
                <div>
                    <a href="#" class="Session-order{$formFilter.order.start_time->getValueExist('asc','_active')}" id="asc" name="start_time"><img  src='{url("/icons/sort_asc`$formFilter.order.start_time->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="Session-order{$formFilter.order.start_time->getValueExist('desc','_active')}" id="desc" name="start_time"><img  src='{url("/icons/sort_desc`$formFilter.order.start_time->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th> 
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Last time')}</span> 
                <div>
                    <a href="#" class="Session-order{$formFilter.order.last_time->getValueExist('asc','_active')}" id="asc" name="last_time"><img  src='{url("/icons/sort_asc`$formFilter.order.last_time->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="Session-order{$formFilter.order.last_time->getValueExist('desc','_active')}" id="desc" name="last_time"><img  src='{url("/icons/sort_desc`$formFilter.order.last_time->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th>  
        </tr>  
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>    
        <td>{* username *}
            <input type="text" name="username" value="{$formFilter.search.username}" size="5" class="Session-search">
        </td>      
        <td>{* ip *}
            <input type="text" name="ip" value="{$formFilter.search.ip}" size="5" class="Session-search">
        </td>  
        <td>{* start time *}
            <input  class="Session-search inputWidth" id="session_start_time" type="text" size="6" name="start_time" value="{format_date((string)$formFilter.search.start_time,'a')}"/>
        </td>
        <td>{* last time *}
            <input  class="Session-search inputWidth" id="session_last_time" type="text" size="6" name="last_time" value="{format_date((string)$formFilter.search.last_time,'a')}"/>
        </td>
    </tr>   
    {foreach $pager as $item}
    <tr class="Session list"> 
        <td class="Session-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>        
        <td>                
            {$item->getUser()->get('username')}                
        </td>  
        <td>
            {$item->get('ip')}  
        </td> 
        <td>
            {format_date($item->get('start_time'),['d','q'])}  
        </td> 
        <td>
            {format_date($item->get('last_time'),['d','q'])}  
        </td> 
    </tr>    
    {/foreach}    
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No session')}</span>
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Session"}  
<script type="text/javascript">
 
    {* =================================== dates ================================ *}
        
    var dates = $( "#session_start_time, #session_last_time" ).datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function( selectedDate ) {
				//var option = this.id == "billing_opened_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				//dates.not( this ).datepicker( "option", option, date );
                } } );
    function getSiteSessionFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { },
                                token:'{$formFilter->getCSRFToken()}',
                                nbitemsbypage: $("[name=Session-nbitemsbypage]").val()
                     } };
        if ($(".Session-order_active").attr("name"))
            params.filter.order[$(".Session-order_active").attr("name")] =$(".Session-order_active").attr("id");   
        $(".Session-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }
        
    function updateSiteSessionFilter()
    {  
        return $.ajax2({ data: getSiteSessionFilterParameters(), 
                        url:"{url_to('users_guard_ajax',['action'=>'DashboardListPartialSession'])}" , 
                        loading: "#tab-dashboard-superadmin-loading", 
                        target: "#actions"
                    });
    }
    
    function updateSitePager(n)
    {
        page_active=$(".Session-pager .Session-active").html()?parseInt($(".Session-pager .Session-active").html()):1;
        records_by_page=$("[name=Session-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".Session-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#Session-nb_results").html())-n;
        $("#Session-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#Session-end_result").html($(".Session-count:last").html());
    }
    
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#Session-init").click(function() {      
        $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'DashboardListPartialSession'])}",
                loading: "#tab-dashboard-superadmin-loading", 
                target: "#actions"}); 
    }); 
    
    $('.Session-order').click(function() {
        $(".Session-order_active").attr('class','Session-order');
        $(this).attr('class','Session-order_active');
        return updateSiteSessionFilter();
    });
           
    $(".Session-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteSessionFilter();
    });
            
    $("#Session-filter").click(function() { return updateSiteSessionFilter(); }); 

    $("[name=Session-nbitemsbypage]").change(function() { return updateSiteSessionFilter(); }); 
          
    // $("[name=Session-name]").change(function() { return updateSiteSessionFilter(); }); 
           
    $(".Session-pager").click(function () {        
        return $.ajax2({ data: getSiteSessionFilterParameters(), 
                    url:"{url_to('users_guard_ajax',['action'=>'DashboardListPartialSession'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                    loading: "#tab-dashboard-superadmin-loading", 
                    target: "#actions"
        });
    });
    {* =====================  A C T I O N S =============================== *}  

    $("#Session-Cancel").click(function() {      
        $.ajax2({ url:"{url_to('users_dashboard_ajax',['action'=>'DashboardListPartial'])}",
                loading: "#tab-dashboard-superadmin-loading", 
                target: "#actions"}); 
    }); 
</script>    