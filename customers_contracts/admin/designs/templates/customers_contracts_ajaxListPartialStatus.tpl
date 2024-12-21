{messages class="site-errors"}
<h3>{__('customer contract status')}</h3>    
<div>
  <a href="#" class="btn" id="CustomerContractStatus-New" title="{__('new status')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New status')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerContractStatus"}
<button id="CustomerContractStatus-filter" class="btn-table" >{__("Filter")}</button>   <button id="CustomerContractStatus-init" class="btn-table">{__("Init")}</button>
<div>       
    <img class="CustomerContractStatus" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="CustomerContractStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="CustomerContractStatus-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContractStatus-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="CustomerContractStatus-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContractStatus-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('color')|capitalize}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('icon')|capitalize}</span>  

        </th>
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('value')|capitalize}</span>      
            <div>
                <a href="#" class="CustomerContractStatus-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContractStatus-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* name *}</td>
       <td>{* color *}</td>
       <td>{* icon *}</td>
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="CustomerContractStatus list" {if $item->hasCustomerContractStatusI18n()}id="CustomerContractStatus-{$item->getCustomerContractStatusI18n()->get('id')}"{/if}> 
        <td class="CustomerContractStatus-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerContractStatusI18n()}
                    <input class="CustomerContractStatus-selection" type="checkbox" id="{$item->getCustomerContractStatusI18n()->get('id')}" name="{$item->getCustomerContractStatusI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getCustomerContractStatus()->get('id')|escape|truncate}</span></td>
            <td>                
                    {$item->getCustomerContractStatus()->get('name')}
            </td>
            <td> 
                {if $item->getCustomerContractStatus()->get('color')}
                <div style="background:{$item->getCustomerContractStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>
                {/if}
            </td>
            <td>{* icon *}
               {if $item->getCustomerContractStatus()->get('icon')} 
                   <img src="{$item->getCustomerContractStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
               {/if}    
            </td>
            <td>
                {if $item->hasCustomerContractStatusI18n()}
                     {$item->getCustomerContractStatusI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="CustomerContractStatus-View" id="{$item->getCustomerContractStatus()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasCustomerContractStatusI18n()}<a href="#" title="{__('delete')}" class="CustomerContractStatus-Delete" id="{$item->getCustomerContractStatusI18n()->get('id')}"  name="{$item->getCustomerContractStatusI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No status')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="CustomerContractStatus-all" /> 
          <a style="opacity:0.5" class="CustomerContractStatus-actions_items" href="#" title="{__('delete')}" id="CustomerContractStatus-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerContractStatus"}
<script type="text/javascript">
 
        function getSiteCustomerContractStatusFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=CustomerContractStatus-name] option:selected").val()  
                                    },
                                lang: $("img.CustomerContractStatus").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=CustomerContractStatus-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerContractStatus-order_active").attr("name"))
                 params.filter.order[$(".CustomerContractStatus-order_active").attr("name")] =$(".CustomerContractStatus-order_active").attr("id");   
            $(".CustomerContractStatus-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerContractStatusFilter()
        {
           $(".dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteCustomerContractStatusFilterParameters(), 
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerContractStatus-pager .CustomerContractStatus-active").html()?parseInt($(".CustomerContractStatus-pager .CustomerContractStatus-active").html()):1;
           records_by_page=$("[name=CustomerContractStatus-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerContractStatus-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerContractStatus-nb_results").html())-n;
           $("#CustomerContractStatus-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerContractStatus-end_result").html($(".CustomerContractStatus-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#CustomerContractStatus-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".CustomerContractStatus[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#CustomerContractStatusChangeLang").show();
               updateSiteCustomerContractStatusFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#CustomerContractStatus-init").click(function() {   
               $(".dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.CustomerContractStatus-order').click(function() {
                $(".CustomerContractStatus-order_active").attr('class','CustomerContractStatus-order');
                $(this).attr('class','CustomerContractStatus-order_active');
                return updateSiteCustomerContractStatusFilter();
           });
           
            $(".CustomerContractStatus-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteCustomerContractStatusFilter();
            });
            
          $("#CustomerContractStatus-filter").click(function() { return updateSiteCustomerContractStatusFilter(); }); 
          
          $("[name=CustomerContractStatus-nbitemsbypage]").change(function() { return updateSiteCustomerContractStatusFilter(); }); 
          
         // $("[name=CustomerContractStatus-name]").change(function() { return updateSiteCustomerContractStatusFilter(); }); 
           
           $(".CustomerContractStatus-pager").click(function () {      
                $(".dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSiteCustomerContractStatusFilterParameters(), 
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#CustomerContractStatus-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.CustomerContractStatus[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('customers_contracts_ajax',['action'=>'NewStatusI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".CustomerContractStatus-View").click( function () { 
                $(".dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerContractStatusI18n : { 
                                                status_id: $(this).attr('id'),
                                                lang: $("img.CustomerContractStatus[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('customers_contracts_ajax',['action'=>'ViewStatusI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".CustomerContractStatus-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerContractStatusI18n: $(this).attr('id') },
                                 url :"{url_to('customers_contracts_ajax',['action'=>'DeleteStatusI18n'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteStatusI18n')
                                       {    
                                          $("tr#CustomerContractStatus-"+resp.id).remove();  
                                          if ($('.CustomerContractStatus').length==0)
                                              return $.ajax2({ url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            

         
  // $('.footable').footable();
	
</script>    