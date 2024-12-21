{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('User function')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-UserFunction-New" title="{__('new function')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New function')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-UserFunction"}
<button id="{$site->getSiteID()}-UserFunction-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-UserFunction-init">{__("Init")}</button>
<div>       
    <img class="{$site->getSiteID()}-UserFunction" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="{$site->getSiteID()}-UserFunction-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-UserFunction-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserFunction-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th> 
        </th>
           <th>
            <span>{__('name')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-UserFunction-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserFunction-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        </th>
           <th>
            <span>{__('function')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-UserFunction-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserFunction-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="{$site->getSiteID()}-UserFunction" {if $item->hasUserFunctionI18n()}id="{$site->getSiteID()}-UserFunction-{$item->getUserFunctionI18n()->get('id')}"{/if}> 
        <td class="{$site->getSiteID()}-UserFunction-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasUserFunctionI18n()}
                    <input class="{$site->getSiteID()}-UserFunction-selection" type="checkbox" id="{$item->getUserFunctionI18n()->get('id')}" name="{$item->getUserFunctionI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getUserFunction()->get('id')}</span></td>         
            <td>                
                     {$item->getUserFunction()->get('name')}                
            </td>  
            <td>
                {if $item->hasUserFunctionI18n()}
                     {$item->getUserFunctionI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-UserFunction-View" id="{$item->getUserFunction()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasUserFunctionI18n()}<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-UserFunction-Delete" id="{$item->getUserFunctionI18n()->get('id')}"  name="{$item->getUserFunctionI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No function')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-UserFunction-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-UserFunction-actions_items" href="#" title="{__('delete')}" id="UserFunction-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-UserFunction"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}UserFunctionFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-UserFunction-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-UserFunction").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-UserFunction-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-UserFunction-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-UserFunction-order_active").attr("name")] =$(".{$site->getSiteID()}-UserFunction-order_active").attr("id");   
            $(".{$site->getSiteID()}-UserFunction-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}UserFunctionFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}UserFunctionFilterParameters(), 
                            url:"{url_to('users_site_ajax',['action'=>'ListPartialFunction'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-UserFunction-pager .UserFunction-active").html()?parseInt($(".{$site->getSiteID()}-UserFunction-pager .UserFunction-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-UserFunction-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-UserFunction-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-UserFunction-nb_results").html())-n;
           $("#{$site->getSiteID()}-UserFunction-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-UserFunction-end_result").html($(".{$site->getSiteID()}-UserFunction-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#{$site->getSiteID()}-UserFunction-ChangeLang").click(function() {      
                   $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
            });
            
            $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                
                $(".{$site->getSiteID()}-UserFunction[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#{$site->getSiteID()}-UserFunctionChangeLang").show();
               updateSite{$site->getSiteKey()}UserFunctionFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-UserFunction-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartialFunction'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-UserFunction-order').click(function() {
                $(".{$site->getSiteID()}-UserFunction-order_active").attr('class','{$site->getSiteID()}-UserFunction-order');
                $(this).attr('class','{$site->getSiteID()}-UserFunction-order_active');
                return updateSite{$site->getSiteKey()}UserFunctionFilter();
           });
           
            $(".{$site->getSiteID()}-UserFunction-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}UserFunctionFilter();
            });
            
          $("#{$site->getSiteID()}-UserFunction-filter").click(function() { return updateSite{$site->getSiteKey()}UserFunctionFilter(); }); 
          
          $("[name={$site->getSiteID()}-UserFunction-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}UserFunctionFilter(); }); 
          
         // $("[name=UserFunction-name]").change(function() { return updateSite{$site->getSiteKey()}UserFunctionFilter(); }); 
           
           $(".{$site->getSiteID()}-UserFunction-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}UserFunctionFilterParameters(), 
                                 url:"{url_to('users_site_ajax',['action'=>'ListPartialFunction'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-UserFunction-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.{$site->getSiteId()}-UserFunction[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('users_site_ajax',['action'=>'NewFunctionI18n'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-UserFunction-View").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { UserFunctionI18n : { 
                                                function_id: $(this).attr('id'),
                                                lang: $("img.{$site->getSiteID()}-UserFunction[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('users_site_ajax',['action'=>'ViewFunctionI18n'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-UserFunction-Delete").click( function () { 
                if (!confirm('{__("Function \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserFunctionI18n: $(this).attr('id') },
                                 url :"{url_to('users_site_ajax',['action'=>'DeleteFunctionI18n'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteFunctionI18n')
                                       {    
                                          $("tr#{$site->getSiteID()}-UserFunction-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-UserFunction').length==0)
                                              return $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartialFunction'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    