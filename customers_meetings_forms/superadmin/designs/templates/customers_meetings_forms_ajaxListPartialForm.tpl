{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Forms')}</h3>   
<div>
  <a href="#" class="btn" id="{$site->getSiteID()}-CustomerMeetingForms-New" title="{__('New form')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New form')}</a> 
  <a href="#" class="btn" id="{$site->getSiteID()}-CustomerMeetingForms-Position" title="{__('Positions')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('Positions')}</a> 
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-CustomerMeetingForms"}
<button id="{$site->getSiteID()}-CustomerMeetingForms-filter" class="btn-table">{__("Filter")}</button>   <button id="{$site->getSiteID()}-CustomerMeetingForms-init" class="btn-table">{__("Init")}</button>
<div>       
    <img class="{$site->getSiteID()}-CustomerMeetingForms" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="{$site->getSiteID()}-CustomerMeetingForms-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingForms-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingForms-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingForms-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingForms-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>        
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingForms-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerMeetingForms-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* name *}</td>      
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-CustomerMeetingForms list" {if $item->hasCustomerMeetingFormI18n()}id="{$site->getSiteID()}-CustomerMeetingForms-{$item->getCustomerMeetingFormI18n()->get('id')}"{/if}> 
        <td class="{$site->getSiteID()}-CustomerMeetingForms-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerMeetingFormI18n()}
                    <input class="{$site->getSiteID()}-CustomerMeetingForms-selection" type="checkbox" id="{$item->getCustomerMeetingFormI18n()->get('id')}" name="{$item->getCustomerMeetingForm()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getCustomerMeetingForm()->get('id')}</span></td>
            <td>                
                    {$item->getCustomerMeetingForm()->get('name')}
            </td>            
            <td>
                {if $item->hasCustomerMeetingFormI18n()}
                     {$item->getCustomerMeetingFormI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-CustomerMeetingForms-View" id="{$item->getCustomerMeetingForm()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasCustomerMeetingFormI18n()}
                <a href="#" title="{__('fields')}" class="{$site->getSiteID()}-CustomerMeetingForms-Fields" id="{$item->getCustomerMeetingFormI18n()->get('id')}">
                    <img  src="{url('/icons/form16x16.png','picture')}" alt='{__("Fields")}'/></a> 
                <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-CustomerMeetingForms-Delete" id="{$item->getCustomerMeetingFormI18n()->get('id')}"  name="{$item->getCustomerMeetingFormI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No form')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-CustomerMeetingForms-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-CustomerMeetingForms-actions_items" href="#" title="{__('delete')}" id="CustomerMeetingForms-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-CustomerMeetingForms"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}CustomerMeetingFormsFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-CustomerMeetingForms-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-CustomerMeetingForms").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-CustomerMeetingForms-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-CustomerMeetingForms-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-CustomerMeetingForms-order_active").attr("name")] =$(".{$site->getSiteID()}-CustomerMeetingForms-order_active").attr("id");   
            $(".{$site->getSiteID()}-CustomerMeetingForms-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerMeetingFormsFilterParameters(), 
                            url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-CustomerMeetingForms-pager .CustomerMeetingForms-active").html()?parseInt($(".{$site->getSiteID()}-CustomerMeetingForms-pager .CustomerMeetingForms-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-CustomerMeetingForms-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-CustomerMeetingForms-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-CustomerMeetingForms-nb_results").html())-n;
           $("#{$site->getSiteID()}-CustomerMeetingForms-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-CustomerMeetingForms-end_result").html($(".{$site->getSiteID()}-CustomerMeetingForms-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#{$site->getSiteID()}-CustomerMeetingForms-ChangeLang").click(function() {      
                   $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
            });
            
            $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                
                $(".{$site->getSiteID()}-CustomerMeetingForms[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#{$site->getSiteID()}-CustomerMeetingFormsChangeLang").show();
               updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter();
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-CustomerMeetingForms-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-CustomerMeetingForms-order').click(function() {
                $(".{$site->getSiteID()}-CustomerMeetingForms-order_active").attr('class','{$site->getSiteID()}-CustomerMeetingForms-order');
                $(this).attr('class','{$site->getSiteID()}-CustomerMeetingForms-order_active');
                return updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter();
           });
           
            $(".{$site->getSiteID()}-CustomerMeetingForms-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter();
            });
            
          $("#{$site->getSiteID()}-CustomerMeetingForms-filter").click(function() { return updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter(); }); 
          
          $("[name={$site->getSiteID()}-CustomerMeetingForms-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter(); }); 
          
         // $("[name=CustomerMeetingForms-name]").change(function() { return updateSite{$site->getSiteKey()}CustomerMeetingFormsFilter(); }); 
           
           $(".{$site->getSiteID()}-CustomerMeetingForms-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerMeetingFormsFilterParameters(), 
                                 url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-CustomerMeetingForms-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.{$site->getSiteId()}-CustomerMeetingForms[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('customers_meeting_forms_ajax',['action'=>'NewFormI18n'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });                
         
         $(".{$site->getSiteID()}-CustomerMeetingForms-View").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerMeetingFormI18n : { 
                                                form_id: $(this).attr('id'),
                                                lang: $("img.{$site->getSiteID()}-CustomerMeetingForms[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('customers_meeting_forms_ajax',['action'=>'ViewFormI18n'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-CustomerMeetingForms-Delete").click( function () { 
                if (!confirm('{__("Form \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerMeetingFormI18n: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_forms_ajax',['action'=>'DeleteFormI18n'])}",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteFormI18n')
                                       {    
                                          $("tr#{$site->getSiteID()}-CustomerMeetingForms-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-CustomerMeetingForms').length==0)
                                              return $.ajax2({ url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForms'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
       
       $(".{$site->getSiteID()}-CustomerMeetingForms-Fields").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerMeetingFormI18n : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('customers_meeting_forms_ajax',['action'=>'FormFields'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
     $('.footable').footable();	        
</script>    