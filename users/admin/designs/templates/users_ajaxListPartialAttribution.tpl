{messages class="site-errors"}
<h3>{__('User attribution')}</h3>    
<div>
 {if $user->hasCredential([['superadmin','admin','settings_user_attribution_new']])}      
  <a href="#" id="UserAttribution-New" title="{__('new attribution')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New attribution')}</a>   
 {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="UserAttribution"}
<button id="UserAttribution-filter">{__("Filter")}</button>   <button id="UserAttribution-init">{__("Init")}</button>
<div>       
    <img class="UserAttribution" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="UserAttribution-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
      {*  <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="UserAttribution-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserAttribution-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th> *}
        </th>
           <th>
            <span>{__('name')|capitalize}</span>      
            <div>
                <a href="#" class="UserAttribution-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserAttribution-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        </th>
           <th>
            <span>{__('function')|capitalize}</span>      
            <div>
                <a href="#" class="UserAttribution-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserAttribution-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
    {*   <td>{* id *} {* </td>    *} 
       <td>{* name *}</td>      
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="UserAttribution" {if $item->hasUserAttributionI18n()}id="UserAttribution-{$item->getUserAttributionI18n()->get('id')}"{/if}> 
        <td class="UserAttribution-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasUserAttributionI18n()}
                    <input class="UserAttribution-selection" type="checkbox" id="{$item->getUserAttributionI18n()->get('id')}" name="{$item->getUserAttributionI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
        {*   <td><span>{$item->getUserAttribution()->get('id')}</span></td>         *}
            <td>                
                     {$item->getUserAttribution()->get('name')}                
            </td>  
            <td>
                {if $item->hasUserAttributionI18n()}
                     {$item->getUserAttributionI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>     
                 {if $user->hasCredential([['superadmin','admin','settings_user_attribution_view']])}     
                <a href="#" title="{__('edit')}" class="UserAttribution-View" id="{$item->getUserAttribution()->get('id')}">                    
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {/if}     
                {if $user->hasCredential([['superadmin','admin','settings_user_attribution_delete']])}     
                    {if $item->hasUserAttributionI18n()}<a href="#" title="{__('delete')}" class="UserAttribution-Delete" id="{$item->getUserAttributionI18n()->get('id')}"  name="{$item->getUserAttributionI18n()->get('value')}">
                       <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                    </a>
                    {/if}
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No attribution')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="UserAttribution-all" /> 
          <a style="opacity:0.5" class="UserAttribution-actions_items" href="#" title="{__('delete')}" id="UserAttribution-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="UserAttribution"}
<script type="text/javascript">
 
        function getUserAttributionFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=UserAttribution-name] option:selected").val()  
                                    },
                                lang: $("img.UserAttribution").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=UserAttribution-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".UserAttribution-order_active").attr("name"))
                 params.filter.order[$(".UserAttribution-order_active").attr("name")] =$(".UserAttribution-order_active").attr("id");   
            $(".UserAttribution-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateUserAttributionFilter()
        {
           $(".dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getUserAttributionFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'ListPartialAttribution'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading", 
                            target: "#actions"
                             });
        }
    
        function updatePager(n)
        {
           page_active=$(".UserAttribution-pager .UserAttribution-active").html()?parseInt($(".UserAttribution-pager .UserAttribution-active").html()):1;
           records_by_page=$("[name=UserAttribution-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".UserAttribution-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#UserAttribution-nb_results").html())-n;
           $("#UserAttribution-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#UserAttribution-end_result").html($(".UserAttribution-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#UserAttribution-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".UserAttribution[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#UserAttributionChangeLang").show();
               updateUserAttributionFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#UserAttribution-init").click(function() {   
               $(".-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialAttribution'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.UserAttribution-order').click(function() {
                $(".UserAttribution-order_active").attr('class','UserAttribution-order');
                $(this).attr('class','UserAttribution-order_active');
                return updateUserAttributionFilter();
           });
           
            $(".UserAttribution-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateUserAttributionFilter();
            });
            
          $("#UserAttribution-filter").click(function() { return updateUserAttributionFilter(); }); 
          
          $("[name=UserAttribution-nbitemsbypage]").change(function() { return updateUserAttributionFilter(); }); 
          
         // $("[name=UserAttribution-name]").change(function() { return updateUserAttributionFilter(); }); 
           
           $(".UserAttribution-pager").click(function () {      
                $(".-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getUserAttributionFilterParameters(), 
                                 url:"{url_to('users_ajax',['action'=>'ListPartialAttribution'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#UserAttribution-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.UserAttribution[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('users_ajax',['action'=>'NewAttributionI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".UserAttribution-View").click( function () { 
                $(".-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { UserAttributionI18n : { 
                                                attribution_id: $(this).attr('id'),
                                                lang: $("img.UserAttribution[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewAttributionI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".UserAttribution-Delete").click( function () { 
                if (!confirm('{__("Attribution \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserAttributionI18n: $(this).attr('id') },
                                 url :"{url_to('users_ajax',['action'=>'DeleteAttributionI18n'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteAttributionI18n')
                                       {    
                                          $("tr#UserAttribution-"+resp.id).remove();  
                                          if ($('.UserAttribution').length==0)
                                              return $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialAttribution'])}",
                                                               loading: "#tab-site-dashboard-x-settings-loading",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updatePager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    