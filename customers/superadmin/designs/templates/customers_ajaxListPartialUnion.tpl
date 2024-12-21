{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Customer union')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-CustomerUnion-New" title="{__('new union')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New union')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-CustomerUnion"}
<button id="{$site->getSiteID()}-CustomerUnion-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-CustomerUnion-init">{__("Init")}</button>
<div>       
    <img class="{$site->getSiteID()}-CustomerUnion" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="{$site->getSiteID()}-CustomerUnion-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerUnion-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerUnion-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerUnion-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerUnion-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
           <th>
            <span>{__('value')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-CustomerUnion-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-CustomerUnion-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-CustomerUnion" {if $item->hasCustomerUnionI18n()}id="{$site->getSiteID()}-CustomerUnion-{$item->getCustomerUnionI18n()->get('id')}"{/if}> 
        <td class="{$site->getSiteID()}-CustomerUnion-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerUnionI18n()}
                    <input class="{$site->getSiteID()}-CustomerUnion-selection" type="checkbox" id="{$item->getCustomerUnionI18n()->get('id')}" name="{$item->getCustomerUnionI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getCustomerUnion()->get('id')|escape|truncate}</span></td>
            <td>                
                    {$item->getCustomerUnion()->get('name')}
            </td>           
            <td>
                {if $item->hasCustomerUnionI18n()}
                     {$item->getCustomerUnionI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-CustomerUnion-View" id="{$item->getCustomerUnion()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasCustomerUnionI18n()}<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-CustomerUnion-Delete" id="{$item->getCustomerUnionI18n()->get('id')}"  name="{$item->getCustomerUnionI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No union')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-CustomerUnion-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-CustomerUnion-actions_items" href="#" title="{__('delete')}" id="CustomerUnion-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-CustomerUnion"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}CustomerUnionFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-CustomerUnion-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-CustomerUnion").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-CustomerUnion-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-CustomerUnion-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-CustomerUnion-order_active").attr("name")] =$(".{$site->getSiteID()}-CustomerUnion-order_active").attr("id");   
            $(".{$site->getSiteID()}-CustomerUnion-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}CustomerUnionFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerUnionFilterParameters(), 
                            url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-CustomerUnion-pager .CustomerUnion-active").html()?parseInt($(".{$site->getSiteID()}-CustomerUnion-pager .CustomerUnion-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-CustomerUnion-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-CustomerUnion-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-CustomerUnion-nb_results").html())-n;
           $("#{$site->getSiteID()}-CustomerUnion-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-CustomerUnion-end_result").html($(".{$site->getSiteID()}-CustomerUnion-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#{$site->getSiteID()}-CustomerUnion-ChangeLang").click(function() {      
                   $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
            });
            
            $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                
                $(".{$site->getSiteID()}-CustomerUnion[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#{$site->getSiteID()}-CustomerUnionChangeLang").show();
               updateSite{$site->getSiteKey()}CustomerUnionFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-CustomerUnion-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-CustomerUnion-order').click(function() {
                $(".{$site->getSiteID()}-CustomerUnion-order_active").attr('class','{$site->getSiteID()}-CustomerUnion-order');
                $(this).attr('class','{$site->getSiteID()}-CustomerUnion-order_active');
                return updateSite{$site->getSiteKey()}CustomerUnionFilter();
           });
           
            $(".{$site->getSiteID()}-CustomerUnion-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}CustomerUnionFilter();
            });
            
          $("#{$site->getSiteID()}-CustomerUnion-filter").click(function() { return updateSite{$site->getSiteKey()}CustomerUnionFilter(); }); 
          
          $("[name={$site->getSiteID()}-CustomerUnion-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}CustomerUnionFilter(); }); 
          
         // $("[name=CustomerUnion-name]").change(function() { return updateSite{$site->getSiteKey()}CustomerUnionFilter(); }); 
           
           $(".{$site->getSiteID()}-CustomerUnion-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerUnionFilterParameters(), 
                                 url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-CustomerUnion-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.{$site->getSiteId()}-CustomerUnion[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('customers_ajax',['action'=>'NewUnionI18n'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-CustomerUnion-View").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerUnionI18n : { 
                                                union_id: $(this).attr('id'),
                                                lang: $("img.{$site->getSiteID()}-CustomerUnion[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('customers_ajax',['action'=>'ViewUnionI18n'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-CustomerUnion-Delete").click( function () { 
                if (!confirm('{__("Union \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerUnionI18n: $(this).attr('id') },
                                 url :"{url_to('customers_ajax',['action'=>'DeleteUnionI18n'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteUnionI18n')
                                       {    
                                          $("tr#{$site->getSiteID()}-CustomerUnion-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-CustomerUnion').length==0)
                                              return $.ajax2({ url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    