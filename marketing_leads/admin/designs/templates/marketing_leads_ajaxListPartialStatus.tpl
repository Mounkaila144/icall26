{messages class="site-errors"}
<h3>{__('Leads Status')}</h3>    
<div>
    <a href="#" class="btn" id="MarketingLeadsStatus-New" title="{__('new status')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New status')}</a>     
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MarketingLeadsStatus"}
<div>
<button id="MarketingLeadsStatus-filter" class="btn-table">{__("Filter")}</button> 
<button id="MarketingLeadsStatus-init" class="btn-table">{__("Init")}</button>
</div>
<div>       
    <img class="MarketingLeadsStatus" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="MarketingLeadsStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<div class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}            
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="MarketingLeadsStatus-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="MarketingLeadsStatus-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Color')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Icon')}</span>  

        </th>
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="MarketingLeadsStatus-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="MarketingLeadsStatus-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}      
       <td>{* name *}</td>
       <td>{* color *}</td>
       <td>{* icon *}</td>
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="MarketingLeadsStatus list" {if $item->hasMarketingLeadsWpFormsStatusI18n()}id="MarketingLeadsStatus-{$item->getMarketingLeadsWpFormsStatusI18n()->get('id')}"{/if} name="MarketingLeadsStatus-{$item->get('id')}"> 
        <td class="MarketingLeadsStatus-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasMarketingLeadsWpFormsStatusI18n()}
                        <input class="MarketingLeadsStatus-selection" type="checkbox" id="{$item->get('id')}" name="{$item->getMarketingLeadsWpFormsStatusI18n()->get('value')}"/>   
                    {/if}
                </td>
            {/if}           
            <td>                
                {$item->get('name')}
            </td>
            <td> 
                {if $item->get('color')}
                    <div style="background:{$item->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>
                {/if}
            </td>
            <td>{* icon *}
                {if $item->get('icon')} 
                    <img src="{$item->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                {/if}    
            </td>
            <td>
                {if $item->hasMarketingLeadsWpFormsStatusI18n()}
                    {$item->getMarketingLeadsWpFormsStatusI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="MarketingLeadsStatus-View" id="{$item->get('id')}">
                    <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasMarketingLeadsWpFormsStatusI18n()}
                <a href="#" title="{__('delete')}" class="MarketingLeadsStatus-Delete" id="{$item->getMarketingLeadsWpFormsStatusI18n()->get('id')}"  name="{$item->getMarketingLeadsWpFormsStatusI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>  
</div>
{if !$pager->getNbItems()}
    <span>{__('No status')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="MarketingLeadsStatus-all" /> 
        <a style="opacity:0.5" class="MarketingLeadsStatus-actions_items" href="#" title="{__('delete')}" id="MarketingLeadsStatus-Delete">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/></a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MarketingLeadsStatus"}
<script type="text/javascript">
 
    function getSiteMarketingLeadsStatusFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MarketingLeadsStatus-name] option:selected").val()  
                                },
                            lang: $("img.MarketingLeadsStatus").attr('id'),                                                                                                               
                            nbitemsbypage: $("[name=MarketingLeadsStatus-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                     } };
        if ($(".MarketingLeadsStatus-order_active").attr("name"))
            params.filter.order[$(".MarketingLeadsStatus-order_active").attr("name")] =$(".MarketingLeadsStatus-order_active").attr("id");   
        $(".MarketingLeadsStatus-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }
        
    function updateSiteMarketingLeadsStatusFilter()
    {   
       return $.ajax2({ data: getSiteMarketingLeadsStatusFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}" , 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }
    
    function updateSitePager(n)
    {
        page_active=$(".MarketingLeadsStatus-pager .MarketingLeadsStatus-active").html()?parseInt($(".MarketingLeadsStatus-pager .MarketingLeadsStatus-active").html()):1;
        records_by_page=$("[name=MarketingLeadsStatus-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MarketingLeadsStatus-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MarketingLeadsStatus-nb_results").html())-n;
        $("#MarketingLeadsStatus-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MarketingLeadsStatus-end_result").html($(".MarketingLeadsStatus-count:last").html());
    }
        
    {* ===================== L A N G U A G E =============================== *}

    $("#MarketingLeadsStatus-ChangeLang").click(function() {      
        $("#dialogListLanguages").dialog("open");
    });

    $("#dialogListLanguages").bind('select',function(event){                
        $(".MarketingLeadsStatus[name=lang]").attr({                           
                                id: event.selected.id,
                                src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                title: event.selected.lang
                            });
        $("#MarketingLeadsStatusChangeLang").show();
        updateSiteMarketingLeadsStatusFilter()
    });   

    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MarketingLeadsStatus-init").click(function() { 
        $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}",
                  errorTarget: ".site-errors",
                  loading: "#tab-site-dashboard-x-settings-loading",                         
                  target: "#actions"}); 
    }); 
    
    $('.MarketingLeadsStatus-order').click(function() {
        $(".MarketingLeadsStatus-order_active").attr('class','MarketingLeadsStatus-order');
        $(this).attr('class','MarketingLeadsStatus-order_active');
        return updateSiteMarketingLeadsStatusFilter();
    });
           
    $(".MarketingLeadsStatus-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMarketingLeadsStatusFilter();
    });

    $("#MarketingLeadsStatus-filter").click(function() { return updateSiteMarketingLeadsStatusFilter(); }); 

    $("[name=MarketingLeadsStatus-nbitemsbypage]").change(function() { return updateSiteMarketingLeadsStatusFilter(); }); 

    // $("[name=MarketingLeadsStatus-name]").change(function() { return updateSiteMarketingLeadsStatusFilter(); }); 

    $(".MarketingLeadsStatus-pager").click(function () {        
        return $.ajax2({ data: getSiteMarketingLeadsStatusFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    {* =====================  A C T I O N S =============================== *}  
      
    $("#MarketingLeadsStatus-New").click( function () {     
        return $.ajax2({
            data : { lang : { lang: $("img.MarketingLeadsStatus[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
            url: "{url_to('marketing_leads_ajax',['action'=>'NewStatusI18n'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions"
        });
    });                
         
    $(".MarketingLeadsStatus-View").click( function () {  
        return $.ajax2({ data : { MarketingLeadsStatusI18n : { 
                                    status_id: $(this).attr('id'),
                                    lang: $("img.MarketingLeadsStatus[name=lang]").attr('id')                                              
                            } },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('marketing_leads_ajax',['action'=>'ViewStatusI18n'])}",
                        errorTarget: ".site-errors",
                        target: "#actions"});
    });
            
    $(".MarketingLeadsStatus-Delete").click( function () { 
        if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ MarketingLeadsStatusI18n: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'DeleteStatusI18n'])}",
                        errorTarget: ".site-errors",     
                        loading: "#tab-site-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='deleteStatusI18n')
                            {    
                                $("tr#MarketingLeadsStatus-"+resp.id).remove();  
                                if ($('.MarketingLeadsStatus').length==0)
                                    return $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}",
                                                     errorTarget: ".site-errors",
                                                     target: "#tab-dashboard-x-settings"});
                                updateSitePager(1);
                            }       
                        }
                });                                        
    });
    
    $("#MarketingLeadsStatus-all").click(function () {                
        $(".MarketingLeadsStatus-selection").prop("checked",$(this).prop("checked"));             
        $(".MarketingLeadsStatus-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
    });
    
    $(".MarketingLeadsStatus-selection").click(function (){               
        $(".MarketingLeadsStatus-actions_items").css('opacity',($(".MarketingLeadsStatus-selection:checked").length?'1':'0.5'));
    });
          
    $("#MarketingLeadsStatus-Delete").click( function () { 
        var params={ selection : {  } };
        text="";
        $(".MarketingLeadsStatus-selection:checked").each(function (id) { 
            params.selection[id]=this.id;
            text+=this.name+",\n";
        });
        if ($.isEmptyObject(params.selection))
           return ;
        if (!confirm('{__('Status \u000A\u000A"#0#"\u000A\u000A will be deleted. Confirm ?')}'.format(text.substring(0,text.lastIndexOf(","))))) 
            return false; 
        return $.ajax2({ 
                data: params,                     
                url: "{url_to('marketing_leads_ajax',['action'=>'DeletesStatus'])}",
                errorTarget: ".site-errors",     
                loading: "#tab-site-x-settings-loading",
                success: function(resp) {
                       if (resp.action=='deletesStatus')
                       {   
                           if ($(".MarketingLeadsStatus").length-resp.parameters.length==0)
                           {    
                             return $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}",
                                              errorTarget: ".dashboard-site-errors",     
                                              loading: "#tab-site-x-settings-loading",                    
                                              target: "#actions" });
                           }    
                           $.each(resp.parameters, function () {  $("tr[name=MarketingLeadsStatus-"+this+"]").remove(); });
                           updateSitePager(resp.parameters.length); 
                           $("input#MarketingLeadsStatus-all").attr("checked",false);                                    
                       }       
                    }
        });
    });
	   
    $("#MarketingLeadsStatus-Import").click( function () { 
        return $.ajax2({
            url: "{url_to('marketing_leads_ajax',['action'=>'ImportStatus'])}",
            errorTarget: ".site-errors",
            target: "#actions"
        });
    });  
</script>    