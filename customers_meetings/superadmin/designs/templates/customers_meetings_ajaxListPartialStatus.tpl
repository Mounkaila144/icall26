{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Customer meeting status')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-CustomerMeetingStatus-New" title="{__('new status')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New status')}</a>     
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-CustomerMeetingStatus"}
<button id="{$site->getSiteID()}-CustomerMeetingStatus-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-CustomerMeetingStatus-init">{__("Init")}</button>
<div>       
    <img class="{$site->getSiteID()}-CustomerMeetingStatus" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="{$site->getSiteID()}-CustomerMeetingStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingStatus-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingStatus-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingStatus-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingStatus-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
         <th>
            <span>{__('color')|capitalize}</span>               
        </th>
        <th>
            <span>{__('icon')|capitalize}</span>  

        </th>
           <th>
            <span>{__('value')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingStatus-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingStatus-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr>
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
    <tr class="{$site->getSiteID()}-CustomerMeetingStatus" {if $item->hasCustomerMeetingStatusI18n()}id="{$site->getSiteID()}-CustomerMeetingStatus-{$item->getCustomerMeetingStatusI18n()->get('id')}"{/if}> 
        <td class="{$site->getSiteID()}-CustomerMeetingStatus-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerMeetingStatusI18n()}
                    <input class="{$site->getSiteID()}-CustomerMeetingStatus-selection" type="checkbox" id="{$item->getCustomerMeetingStatusI18n()->get('id')}" name="{$item->getCustomerMeetingStatusI18n()->get('name')}"/>   
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
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-CustomerMeetingStatus-View" id="{$item->getCustomerMeetingStatus()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasCustomerMeetingStatusI18n()}<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-CustomerMeetingStatus-Delete" id="{$item->getCustomerMeetingStatusI18n()->get('id')}"  name="{$item->getCustomerMeetingStatusI18n()->get('value')}">
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
        <input type="checkbox" id="{$site->getSiteID()}-CustomerMeetingStatus-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-CustomerMeetingStatus-actions_items" href="#" title="{__('delete')}" id="CustomerMeetingStatus-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-CustomerMeetingStatus"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}CustomerMeetingStatusFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-CustomerMeetingStatus-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-CustomerMeetingStatus").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-CustomerMeetingStatus-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-CustomerMeetingStatus-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-CustomerMeetingStatus-order_active").attr("name")] =$(".{$site->getSiteID()}-CustomerMeetingStatus-order_active").attr("id");   
            $(".{$site->getSiteID()}-CustomerMeetingStatus-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerMeetingStatusFilterParameters(), 
                            url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-CustomerMeetingStatus-pager .CustomerMeetingStatus-active").html()?parseInt($(".{$site->getSiteID()}-CustomerMeetingStatus-pager .CustomerMeetingStatus-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-CustomerMeetingStatus-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-CustomerMeetingStatus-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-CustomerMeetingStatus-nb_results").html())-n;
           $("#{$site->getSiteID()}-CustomerMeetingStatus-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-CustomerMeetingStatus-end_result").html($(".{$site->getSiteID()}-CustomerMeetingStatus-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#{$site->getSiteID()}-CustomerMeetingStatus-ChangeLang").click(function() {      
                   $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
            });
            
            $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                
                $(".{$site->getSiteID()}-CustomerMeetingStatus[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#{$site->getSiteID()}-CustomerMeetingStatusChangeLang").show();
               updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-CustomerMeetingStatus-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-CustomerMeetingStatus-order').click(function() {
                $(".{$site->getSiteID()}-CustomerMeetingStatus-order_active").attr('class','{$site->getSiteID()}-CustomerMeetingStatus-order');
                $(this).attr('class','{$site->getSiteID()}-CustomerMeetingStatus-order_active');
                return updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter();
           });
           
            $(".{$site->getSiteID()}-CustomerMeetingStatus-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter();
            });
            
          $("#{$site->getSiteID()}-CustomerMeetingStatus-filter").click(function() { return updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter(); }); 
          
          $("[name={$site->getSiteID()}-CustomerMeetingStatus-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter(); }); 
          
         // $("[name=CustomerMeetingStatus-name]").change(function() { return updateSite{$site->getSiteKey()}CustomerMeetingStatusFilter(); }); 
           
           $(".{$site->getSiteID()}-CustomerMeetingStatus-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerMeetingStatusFilterParameters(), 
                                 url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-CustomerMeetingStatus-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.{$site->getSiteId()}-CustomerMeetingStatus[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('customers_meeting_ajax',['action'=>'NewStatusI18n'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });                
         
         $(".{$site->getSiteID()}-CustomerMeetingStatus-View").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerMeetingStatusI18n : { 
                                                status_id: $(this).attr('id'),
                                                lang: $("img.{$site->getSiteID()}-CustomerMeetingStatus[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('customers_meeting_ajax',['action'=>'ViewStatusI18n'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-CustomerMeetingStatus-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerMeetingStatusI18n: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_ajax',['action'=>'DeleteStatusI18n'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteStatusI18n')
                                       {    
                                          $("tr#{$site->getSiteID()}-CustomerMeetingStatus-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-CustomerMeetingStatus').length==0)
                                              return $.ajax2({ url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    