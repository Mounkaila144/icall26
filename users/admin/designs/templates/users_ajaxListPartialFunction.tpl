{messages class="site-errors"}
<h3>{__('User function')}</h3>    
<div>
  {if $user->hasCredential([['superadmin','admin','settings_user_function_new']])}    
  <a href="#" id="UserFunction-New" title="{__('new function')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New function')}</a>   
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="UserFunction"}
<button id="UserFunction-filter">{__("Filter")}</button>   <button id="UserFunction-init">{__("Init")}</button>
<div>       
    <img class="UserFunction" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="UserFunction-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
      {*  <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="UserFunction-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserFunction-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th> *}
        </th>
           <th>
            <span>{__('name')|capitalize}</span>      
            <div>
                <a href="#" class="UserFunction-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserFunction-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        </th>
           <th>
            <span>{__('function')|capitalize}</span>      
            <div>
                <a href="#" class="UserFunction-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserFunction-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
     {*  <td>{* id *} {* </td>     *}
       <td>{* name *}</td>      
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="UserFunction" {if $item->hasUserFunctionI18n()}id="UserFunction-{$item->getUserFunctionI18n()->get('id')}"{/if}> 
        <td class="UserFunction-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasUserFunctionI18n()}
                    <input class="UserFunction-selection" type="checkbox" id="{$item->getUserFunctionI18n()->get('id')}" name="{$item->getUserFunctionI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
        {*    <td><span>{$item->getUserFunction()->get('id')}</span></td>          *}
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
                 {if $user->hasCredential([['superadmin','admin','settings_user_function_view']])}  
                <a href="#" title="{__('edit')}" class="UserFunction-View" id="{$item->getUserFunction()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {/if}
                {if $user->hasCredential([['superadmin','admin','settings_user_function_delete']])}  
                       {if $item->hasUserFunctionI18n()}<a href="#" title="{__('delete')}" class="UserFunction-Delete" id="{$item->getUserFunctionI18n()->get('id')}"  name="{$item->getUserFunctionI18n()->get('value')}">
                          <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                       </a>
                   {/if}
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No function')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="UserFunction-all" /> 
          <a style="opacity:0.5" class="UserFunction-actions_items" href="#" title="{__('delete')}" id="UserFunction-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="UserFunction"}
<script type="text/javascript">
 
        function getSiteUserFunctionFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=UserFunction-name] option:selected").val()  
                                    },
                                lang: $("img.UserFunction").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=UserFunction-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".UserFunction-order_active").attr("name"))
                 params.filter.order[$(".UserFunction-order_active").attr("name")] =$(".UserFunction-order_active").attr("id");   
            $(".UserFunction-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteUserFunctionFilter()
        {
           $(".dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteUserFunctionFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'ListPartialFunction'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".UserFunction-pager .UserFunction-active").html()?parseInt($(".UserFunction-pager .UserFunction-active").html()):1;
           records_by_page=$("[name=UserFunction-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".UserFunction-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#UserFunction-nb_results").html())-n;
           $("#UserFunction-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#UserFunction-end_result").html($(".UserFunction-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#UserFunction-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".UserFunction[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#UserFunctionChangeLang").show();
               updateSiteUserFunctionFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#UserFunction-init").click(function() {   
               $(".dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialFunction'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.UserFunction-order').click(function() {
                $(".UserFunction-order_active").attr('class','UserFunction-order');
                $(this).attr('class','UserFunction-order_active');
                return updateSiteUserFunctionFilter();
           });
           
            $(".UserFunction-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteUserFunctionFilter();
            });
            
          $("#UserFunction-filter").click(function() { return updateSiteUserFunctionFilter(); }); 
          
          $("[name=UserFunction-nbitemsbypage]").change(function() { return updateSiteUserFunctionFilter(); }); 
          
         // $("[name=UserFunction-name]").change(function() { return updateSiteUserFunctionFilter(); }); 
           
           $(".UserFunction-pager").click(function () {      
                $(".dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSiteUserFunctionFilterParameters(), 
                                 url:"{url_to('users_ajax',['action'=>'ListPartialFunction'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#UserFunction-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.UserFunction[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('users_ajax',['action'=>'NewFunctionI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".UserFunction-View").click( function () { 
                $(".dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { UserFunctionI18n : { 
                                                function_id: $(this).attr('id'),
                                                lang: $("img.UserFunction[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewFunctionI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".UserFunction-Delete").click( function () { 
                if (!confirm('{__("Function \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserFunctionI18n: $(this).attr('id') },
                                 url :"{url_to('users_ajax',['action'=>'DeleteFunctionI18n'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteFunctionI18n')
                                       {    
                                          $("tr#UserFunction-"+resp.id).remove();  
                                          if ($('.UserFunction').length==0)
                                              return $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialFunction'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    