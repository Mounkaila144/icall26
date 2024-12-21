{messages class="site-errors"}
<h3>{__('Import files history')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="ImportFile-Settings" title="{__('Settings')}"><i class="fa fa-plus" style="margin-right:10px;"></i>
        {__('Settings')}</a>   
    <a href="javascript:void(0);" class="btn" id="ImportFile-Formats" title="{__('Formats')}"><i class="fa fa-plus" style="margin-right:10px;"></i>
        {__('Formats')}</a>   
    <a href="javascript:void(0);" class="btn" id="ImportFile-Return" title="{__('Return')}"><i class="fa fa-arrow-left" style="margin-right:10px;"></i>
        {__('Return')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="ImportFile"}
<button id="ImportFile-filter" class="btn-table">{__("Filter")}</button> 
<button id="ImportFile-init" class="btn-table">{__("Init")}</button>
<div class="containerDivResp">
<table cellpadding="0" cellspacing="0" class="tabl-list footable table">  
    <thead> 
    <tr  class="list-header">     
        <th data-hide="phone" style="display: table-cell;" >#</th>      
        <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Name')}</span>               
        </th>     
        <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Importer')}</span>               
        </th>     
        <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Log file')}</span>               
        </th>     
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>   
       <td>{* name *}</td>     
       <td>{* importer *}</td>     
       <td>{* log file *}</td>     
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="ImportFile list" id="ImportFile-{$item->get('id')}"> 
        <td class="ImportFile-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>          
            <td> 
                {$item->get('name')}
            </td>    
            <td> 
                {$item->getUser()|upper}
            </td>    
            <td>
                {if $item->hasLogFile()}
                    {$item->get('file_log')}
                    <a id="log-file" target="_blank" href="{$item->getLogFile()->getUrl()}" download><i class="fa fa-download" title="{__('download')}"></i></a>
                    <a id="{$item->get('id')}" class="ViewLogFile" href="javascript:void(0);" ><i class="fa fa-eye" title="{__('View log')}"></i></a>
                {/if}
            </td>
            <td>               
                <a href="#" title="{__('Edit')}" class="ImportFile-View" id="{$item->get('id')}">
                    <i class="fa fa-edit" alt='{__("Edit")}'></i></a>                                      
                <a href="#" title="{__('Delete')}" class="ImportFile-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                    <i class="fa fa-trash" alt='{__("Delete")}'/>
                </a>               
            </td>
    </tr>    
    {/foreach}  
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No file')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="ImportFile-all" /> 
        <a style="opacity:0.5" class="ImportFile-actions_items" href="#" title="{__('delete')}" id="ImportFiles-Delete">
            <i class="fa fa-trash" alt='{__("Delete")}'/>
        </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ImportFile"} 
  
<script type="text/javascript">

    function getSiteImportFileFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                     is_active : $(".ImportFile-equal[name=is_active] option:selected").val()  
                                },
                            lang: $("img.ImportFile").attr('id'),                                                                                                               
                            nbitemsbypage: $("[name=ImportFile-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                     } };
        if ($(".ImportFile-order_active").attr("name"))
            params.filter.order[$(".ImportFile-order_active").attr("name")] =$(".ImportFile-order_active").attr("id");   
        $(".ImportFile-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }

    function updateSiteImportFileFilter()
    {          
        return $.ajax2({ data: getSiteImportFileFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}" , 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
                    });
    }

    function updateSitePager(n)
    {
        page_active=$(".ImportFile-pager .ImportFile-active").html()?parseInt($(".ImportFile-pager .ImportFile-active").html()):1;
        records_by_page=$("[name=ImportFile-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".ImportFile-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#ImportFile-nb_results").html())-n;
        $("#ImportFile-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#ImportFile-end_result").html($(".ImportFile-count:last").html());
    }

    {* ==================================  P A G E R  A C T I O N S =============================== *}  

    $("#ImportFile-init").click(function() {               
        $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions-wp-landing-page-site-list"}); 
    }); 

    $('.ImportFile-order').click(function() {
        $(".ImportFile-order_active").attr('class','ImportFile-order');
        $(this).attr('class','ImportFile-order_active');
        return updateSiteImportFileFilter();
    });

    $(".ImportFile-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteImportFileFilter();
    });

    $("#ImportFile-filter").click(function() { return updateSiteImportFileFilter(); }); 

    $(".ImportFile-equal[name=is_active],[name=ImportFile-nbitemsbypage]").change(function() { return updateSiteImportFileFilter(); }); 

    // $("[name=ImportFile-name]").change(function() { return updateSiteImportFileFilter(); }); 

    $(".ImportFile-pager").click(function () {                      
        return $.ajax2({ data: getSiteImportFileFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    {* ==================================  A C T I O N S =============================== *}  

    $("#ImportFile-Settings").click( function () {             
        return $.ajax2({                    
            url: "{url_to('marketing_leads_ajax',['action'=>'Settings'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });

    $("#ImportFile-Formats").click( function () {             
        return $.ajax2({                    
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });

    $(".ViewLogFile").click( function() {
        return $.ajax2({
            data: { Import: $(this).attr("id") },
            url: "{url_to('marketing_leads_ajax',['action'=>'ViewLog'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });

    $("#ImportFile-Return").click( function() {
        return $.ajax2({
            url: "{url_to('marketing_leads_ajax',['action'=>'Settings'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });
        
</script>    