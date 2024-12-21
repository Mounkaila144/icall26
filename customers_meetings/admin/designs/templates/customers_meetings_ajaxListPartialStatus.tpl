{messages class="site-errors"}
<h3>{__('Customer meeting status')}</h3>    
<div>
  <a href="#" class="btn" id="CustomerMeetingStatus-New" title="{__('new status')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New status')}</a>     
  <a href="#" class="btn" id="CustomerMeetingStatus-Export" title="{__('export')}" ><i class="fa fa-caret-square-o-down" style="margin-right:10px;"></i>
      {*<img  src="{url('/icons/export.gif','picture')}" alt="{__('new')}"/>*}{__('Export')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetingStatus"}
<button id="CustomerMeetingStatus-filter" class="btn-table">{__("Filter")}</button>   <button id="CustomerMeetingStatus-init" class="btn-table">{__("Init")}</button>
<div>       
    <img class="CustomerMeetingStatus" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="CustomerMeetingStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="CustomerMeetingStatus-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetingStatus-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th class="footable-first-column" data-toggle="true">
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="CustomerMeetingStatus-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetingStatus-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
                <a href="#" class="CustomerMeetingStatus-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetingStatus-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="CustomerMeetingStatus list" {if $item->hasCustomerMeetingStatusI18n()}id="CustomerMeetingStatus-{$item->getCustomerMeetingStatusI18n()->get('id')}"{/if}> 
        <td class="CustomerMeetingStatus-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerMeetingStatusI18n()}
                    <input class="CustomerMeetingStatus-selection" type="checkbox" id="{$item->getCustomerMeetingStatusI18n()->get('id')}" name="{$item->getCustomerMeetingStatusI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getCustomerMeetingStatus()->get('id')|escape|truncate}</span></td>
            <td>                
                    {$item->getCustomerMeetingStatus()->get('name')}
            </td>
            <td> 
                {if $item->getCustomerMeetingStatus()->get('color')}
                <div style="background:{$item->getCustomerMeetingStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>
                {/if}
            </td>
            <td>{* icon *}
               {if $item->getCustomerMeetingStatus()->get('icon')} 
                   <img src="{$item->getCustomerMeetingStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
               {/if}    
            </td>
            <td>
                {if $item->hasCustomerMeetingStatusI18n()}
                     {$item->getCustomerMeetingStatusI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="CustomerMeetingStatus-View" id="{$item->getCustomerMeetingStatus()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasCustomerMeetingStatusI18n()}<a href="#" title="{__('delete')}" class="CustomerMeetingStatus-Delete" id="{$item->getCustomerMeetingStatusI18n()->get('id')}"  name="{$item->getCustomerMeetingStatusI18n()->get('value')}">
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
        <input type="checkbox" id="CustomerMeetingStatus-all" /> 
          <a style="opacity:0.5" class="CustomerMeetingStatus-actions_items" href="#" title="{__('delete')}" id="CustomerMeetingStatus-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetingStatus"}
<script type="text/javascript">
 
        function getSiteCustomerMeetingStatusFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=CustomerMeetingStatus-name] option:selected").val()  
                                    },
                                lang: $("img.CustomerMeetingStatus").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=CustomerMeetingStatus-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerMeetingStatus-order_active").attr("name"))
                 params.filter.order[$(".CustomerMeetingStatus-order_active").attr("name")] =$(".CustomerMeetingStatus-order_active").attr("id");   
            $(".CustomerMeetingStatus-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerMeetingStatusFilter()
        {
           $(".dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteCustomerMeetingStatusFilterParameters(), 
                            url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerMeetingStatus-pager .CustomerMeetingStatus-active").html()?parseInt($(".CustomerMeetingStatus-pager .CustomerMeetingStatus-active").html()):1;
           records_by_page=$("[name=CustomerMeetingStatus-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerMeetingStatus-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerMeetingStatus-nb_results").html())-n;
           $("#CustomerMeetingStatus-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerMeetingStatus-end_result").html($(".CustomerMeetingStatus-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#CustomerMeetingStatus-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".CustomerMeetingStatus[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#CustomerMeetingStatusChangeLang").show();
               updateSiteCustomerMeetingStatusFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#CustomerMeetingStatus-init").click(function() {   
               $(".dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.CustomerMeetingStatus-order').click(function() {
                $(".CustomerMeetingStatus-order_active").attr('class','CustomerMeetingStatus-order');
                $(this).attr('class','CustomerMeetingStatus-order_active');
                return updateSiteCustomerMeetingStatusFilter();
           });
           
            $(".CustomerMeetingStatus-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteCustomerMeetingStatusFilter();
            });
            
          $("#CustomerMeetingStatus-filter").click(function() { return updateSiteCustomerMeetingStatusFilter(); }); 
          
          $("[name=CustomerMeetingStatus-nbitemsbypage]").change(function() { return updateSiteCustomerMeetingStatusFilter(); }); 
          
         // $("[name=CustomerMeetingStatus-name]").change(function() { return updateSiteCustomerMeetingStatusFilter(); }); 
           
           $(".CustomerMeetingStatus-pager").click(function () {      
                $(".dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSiteCustomerMeetingStatusFilterParameters(), 
                                 url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#CustomerMeetingStatus-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.CustomerMeetingStatus[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('customers_meeting_ajax',['action'=>'NewStatusI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });                
         
         $(".CustomerMeetingStatus-View").click( function () { 
                $(".dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerMeetingStatusI18n : { 
                                                status_id: $(this).attr('id'),
                                                lang: $("img.CustomerMeetingStatus[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('customers_meeting_ajax',['action'=>'ViewStatusI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".CustomerMeetingStatus-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerMeetingStatusI18n: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_ajax',['action'=>'DeleteStatusI18n'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteStatusI18n')
                                       {    
                                          $("tr#CustomerMeetingStatus-"+resp.id).remove();  
                                          if ($('.CustomerMeetingStatus').length==0)
                                              return $.ajax2({ url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
       
     $('.footable').footable();
	   
      $("#CustomerMeetingStatus-Import").click( function () { 
                return $.ajax2({
                    url: "{url_to('customers_meeting_ajax',['action'=>'ImportStatus'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"
               });
          });  
</script>    