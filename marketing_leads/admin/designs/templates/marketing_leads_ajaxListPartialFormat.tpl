{messages class="site-errors"}
<h3>{__('Import formats')}</h3>    
<div>   
    <a href="#" id="Formats-Cancel" class="btn"><i class="fa fa-times" style="color:#000; margin-right:10px;"></i>
        {__('Cancel')}</a> 
    <a href="#" id="Formats-NewFromFile" class="btn"><i class="fa fa-plus" style="color:#000; margin-right:10px;"></i>
        {__('New from file')}</a> 
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="ImportFormat"}
<button id="ImportFormat-filter" class="btn-table">{__("Filter")}</button> 
<button id="ImportFormat-init" class="btn-table">{__("Init")}</button>
<div class="containerDivResp">
<table cellpadding="0" cellspacing="0" class="tabl-list footable table">  
    <thead> 
        <tr  class="list-header">     
        <th data-hide="phone" style="display: table-cell;" >#</th>      
            <th data-hide="phone" style="display: table-cell;" >
                <span>{__('Name')}</span>               
            </th>     
            <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
        </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>   
       <td>{* title *}</td>     
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="ImportFormat list" id="ImportFormat-{$item->get('id')}"> 
        <td class="ImportFormat-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>          
        <td> 
            {$item->get('name')}
        </td>          
        <td>               
            <a href="#" title="{__('Edit')}" class="ImportFormat-View" id="{$item->get('id')}">
                <i class="fa fa-edit" alt='{__("Edit")}'></i></a>                                      
            <a href="#" title="{__('Delete')}" class="ImportFormat-Delete" id="{$item->get('id')}" name="{$item->get('name')}">
                <i class="fa fa-trash" alt='{__("Delete")}'/>
            </a>               
        </td>
    </tr>    
    {/foreach}  
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No format')}</span>
{else}
    {*{if $pager->getNbItems()>5}
        <input type="checkbox" id="ImportFormat-all" /> 
        <a style="opacity:0.5" class="ImportFormat-actions_items" href="#" title="{__('delete')}" id="ImportFormats-Delete">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    {/if}*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ImportFormat"} 
  
<script type="text/javascript">
    
    function getSiteImportFormatFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { },                                                                                                                                    
                            nbitemsbypage: $("[name=ImportFormat-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    } };
        if ($(".ImportFormat-order_active").attr("name"))
            params.filter.order[$(".ImportFormat-order_active").attr("name")] =$(".ImportFormat-order_active").attr("id");   
        $(".ImportFormat-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }

    function updateImportFormatFilter()
    {          
        return $.ajax2({ data: getSiteImportFormatFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}" , 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
                    });
    }

    function updatePager(n)
    {
        page_active=$(".ImportFormat-pager .ImportFormat-active").html()?parseInt($(".ImportFormat-pager .ImportFormat-active").html()):1;
        records_by_page=$("[name=ImportFormat-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".ImportFormat-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#ImportFormat-nb_results").html())-n;
        $("#ImportFormat-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#ImportFormat-end_result").html($(".ImportFormat-count:last").html());
    }
    
    {* =====================  P A G E R  A C T I O N S =============================== *}  

    $("#ImportFormat-init").click(function() {               
        $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions-wp-landing-page-site-list"}); 
    }); 

    $('.ImportFormat-order').click(function() {
        $(".ImportFormat-order_active").attr('class','ImportFormat-order');
        $(this).attr('class','ImportFormat-order_active');
        return updateImportFormatFilter();
    });

    $(".ImportFormat-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateImportFormatFilter();
    });

    $("#ImportFormat-filter").click(function() { return updateImportFormatFilter(); }); 

    $(".ImportFormat-equal[name=is_active],[name=ImportFormat-nbitemsbypage]").change(function() { return updateImportFormatFilter(); }); 

    // $("[name=ImportFormat-name]").change(function() { return updateImportFormatFilter(); }); 

    $(".ImportFormat-pager").click(function () {                      
        return $.ajax2({ data: getSiteImportFormatFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });  

   {* =================== A C T I O N S ================================ *}

    $('#Formats-Cancel').click(function(){                                           
        return $.ajax2({                           
                        url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"}); 
    }); 

    $('#Formats-New').click(function(){                                           
        return $.ajax2({                           
                        url: "{url_to('marketing_leads_ajax',['action'=>'NewFormat'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"}); 
    });

    $('#Formats-NewFromFile').click(function(){                                           
        return $.ajax2({                           
                        url: "{url_to('marketing_leads_ajax',['action'=>'NewFormatFromFile'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"}); 
    });

    $('.ImportFormat-View').click(function(){                                           
        return $.ajax2({ data : { WpFormsLeadsImportFormat: $(this).attr('id') },                          
                         url: "{url_to('marketing_leads_ajax',['action'=>'ViewFormat'])}",
                         errorTarget: ".site-errors",
                          loading: "#tab-site-dashboard-x-settings-loading",
                         target: "#actions-wp-landing-page-site-list"}); 
    }); 

    $(".ImportFormat-Delete").click( function () { 
        if (!confirm('{__("Format \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ WpFormsLeadsImportFormat: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'DeleteFormat'])}",
                        errorTarget: ".site-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='DeleteFormat')
                            {    
                                $("#ImportFormat-"+resp.id).remove();  
                                if ($('.ImportFormat.list').length==0)
                                    return $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}",
                                                    errorTarget: ".site-errors",
                                                    target: "#actions-wp-landing-page-site-list"});
                                updateSitePager(1);
                            }       
                        }
            });                                        
    });
</script>