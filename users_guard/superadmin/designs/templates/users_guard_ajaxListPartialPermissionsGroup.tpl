{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('group permissions')}</h3>    
<div>
    <a id="AddPermissionsGroup" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('Add permission group')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('Cancel')}</a>
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="PermissionsGroup"}
<button id="PermissionsGroup-filter">{__("Filter")}</button>   
<button id="PermissionsGroup-init">{__("Init")}</button>
<div>       
    <img class="{$site->getSiteID()}-PermissionsGroup" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="{$site->getSiteID()}-PermissionsGroup-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table cellpadding="0" cellspacing="0">
     <tr>
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>{__('id')}
             <div>
                 <a href="#" class="PermissionsGroup-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                 <a href="#" class="PermissionsGroup-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('name')}
               <div>
              <a href="#" class="PermissionsGroup-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="PermissionsGroup-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>  
         <th>{__('value')}
               <div>
              <a href="#" class="PermissionsGroup-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="PermissionsGroup-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>  
         <th>{__('actions')}</th>
     </tr>
     <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="PermissionsGroup-search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
            <td><input class="PermissionsGroup-search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td> 
            <td></td>
            <td></td>
        </tr>       
        {foreach $pager as $permission}
        <tr class="PermissionsGroup" id="PermissionsGroup-{$permission->getPermissionGroup()->get('id')}">
            <td class="PermissionsGroup-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$permission@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="PermissionsGroup-selection" type="checkbox" name="{$permission->getPermissionGroup()->get('id')}" id="{$permission->getPermissionGroupI18n()->get('value')}"/></td>{/if}
            <td>
                {$permission->getPermissionGroup()->get('id')}
            </td>
            <td>
                {$permission->getPermissionGroup()->get('name')}
            </td>
             <td>
                 {if $permission->hasPermissionGroupI18n()}
                        {$permission->getPermissionGroupI18n()->get('value')}
                 {else}
                     {__('---')}
                 {/if}    
            </td>
            <td>
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-PermissionsGroup-View" id="{$permission->getPermissionGroup()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
               {if $permission->hasPermissionGroupI18n()}
               <a href="#" title="{__('delete')}" class="PermissionsGroups-Delete" id="{$permission->getPermissionGroupI18n()->get('id')}" name="{$permission->getPermissionGroupI18n()->get('value')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
               {/if}
            </td>
        </tr>
        {/foreach}              
</table>    
{if !$pager->getNbItems()}  
     <span>{__("no result")}</span>
{elseif $pager->getNbItems()>5}
       <input type="checkbox" id="PermissionsGroup-all" />  
       <a href="#" title="{__('delete')}" id="PermissionsGroup-Delete"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="PermissionsGroup"}
<script type="text/javascript">
          
         function getPermissionsFilterParameters()
        {
            var params={ 
                     filter: {  order : { }, 
                                     search: { is_active : $(".PermissionsGroup-search[name=is_active]").val() }, 
                                     nbitemsbypage: $("[name=PermissionsGroup-nbitemsbypage]").val(),
                                     lang: $("img.{$site->getSiteID()}-PermissionsGroup").attr('id'), 
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".PermissionsGroup-order_active").attr("name")] =$(".PermissionsGroup-order_active").attr("id");
            $(".PermissionsGroup-search").each(function() { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updatePermissionsFilter()
        {            
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getPermissionsFilterParameters(), 
                            url :"{url_to('users_guard_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              target: "#{$site->getSiteId()}-actions"
                          });
        }
        
        function updatePager(n)
        {
           page_active=$(".PermissionsGroup-pager .PermissionsGroup-active").html()?parseInt($(".PermissionsGroup-pager .PermissionsGroup-active").html()):1;
           records_by_page=$("[name=PermissionsGroup-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".PermissionsGroup-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#PermissionsGroup-nb_results").html())-n;
           $("#PermissionsGroup-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#PermissionsGroup-end_result").html($(".PermissionsGroup-count:last").html());
        }
        
         // {* PAGER - begin *}
         $('.PermissionsGroup-order').click(function() {
             $(".PermissionsGroup-order_active").attr('class','PermissionsGroup-order');
             $(this).attr('class','PermissionsGroup-order_active');
             return updatePermissionsFilter();

         });
         
          $("[name=PermissionsGroup-nbitemsbypage],.PermissionsGroup[name=is_active]").change(function() {
              return updatePermissionsFilter();
          }); 
          
          $(".PermissionsGroup-search").keypress(function(event) {
                        if (event.keyCode==13)
                            return updatePermissionsFilter();                            
          });
                   
           $("#PermissionsGroup-filter").click(function() {
              return updatePermissionsFilter();
          }); 
          
          $("#PermissionsGroup-init").click(function() { 
                    $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                    $.ajax2({           
                              url :"{url_to('users_guard_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              target: "#{$site->getSiteId()}-actions"
          }); 
          }); 
                             
          $(".PermissionsGroup-pager").click(function () {     
                    $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                    return $.ajax2({ data: getPermissionsFilterParameters(),
                                    url:"{url_to('users_guard_ajax',['action'=>'ListPartialPermissionsGroup'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),                                    
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 target: "#{$site->getSiteId()}-actions"
                        });
          });
                   
          // {* PAGER - end *}         
          
     {* ===================== L A N G U A G E =============================== *}
         
            $("#{$site->getSiteID()}-PermissionsGroup-ChangeLang").click(function() {      
                   $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
            });
            
            $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                
                $(".{$site->getSiteID()}-PermissionsGroup[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#{$site->getSiteID()}-PermissionsGroupChangeLang").show();
               updatePermissionsFilter();
            });   
            
          // {* ACTIONS - begin *}
          
          $("#PermissionsGroup-Delete").click( function () { 
             var params={ selection : {  } };
             text="";              
             $(".PermissionsGroup-selection:checked").each(function (id) { 
                params.selection[id]=this.name;
                text+=this.id+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm("{__('Groups :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                 return false;            
             return $.ajax2({ data:params,
                              url :"{url_to('users_guard_ajax',['action'=>'DeletesPermissionsGroups'])}",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              success:function(resp) {
                                    if (resp.action=='deletePermissiongroup')
                                    {                                    
                                        if ($(".PermissionsGroup").length-resp.parameters.length==0)
                                           return $.ajax2({ 
                                                        url: "{url_to('users_guard_site_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                                                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                                        errorTarget: ".{$site->getSiteID()}-site-errors",
                                                        target: "#{$site->getSiteId()}-actions"
                                                        });
                                        $.each(resp.parameters, function (id) {  $("tr#PermissionsGroup-"+this).remove(); });
                                        updatePager(resp.parameters.length);      
                                        $("input#PermissionsGroup-all").attr("checked",false);                                    
                                    }  
                              }
             });    
          });
          
          
          
          $(".PermissionsGroups-Delete").click( function () { 
                if (!confirm('{__("Group \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false;              
                return $.ajax2({ data: { PermissionGroupI18n: this.id },                                 
                                 url :"{url_to('users_guard_ajax',['action'=>'DeletePermissionGroupI18n'])}",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 success: function(resp) {
                                                    if (resp.action=='deletePermissionGroupI18n')
                                                    {    
                                                        if ($(".PermissionsGroup").length-1==0)
                                                           return $.ajax2({                                                                         
                                                                        url: "{url_to('users_guard_site_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                                                                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                                                        errorTarget: ".{$site->getSiteID()}-site-errors",
                                                                        target: "#{$site->getSiteID()}-actions"});
                                                        $("tr#PermissionsGroup-"+resp.id).remove();  
                                                        updatePager(1);      
                                                    }
                                          }
                        }); 
          });
          
          $("#AddPermissionsGroup").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ 
                        data : { lang : { lang: $("img.{$site->getSiteID()}-PermissionsGroup[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                        url: "{url_to('users_guard_site_ajax',['action'=>'NewPermissionGroupI18n'])}",
                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                        errorTarget: ".{$site->getSiteID()}-site-errors",
                        target: "#{$site->getSiteId()}-actions"});
          });
                    
          $('#Cancel').click(function(){ 
             $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
             return $.ajax2({ 
                        url: "{url_to('users_guard_site_ajax',['action'=>'ListPartialPermission'])}",
                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                        errorTarget: ".{$site->getSiteID()}-site-errors",
                        target: "#{$site->getSiteId()}-actions"}); });
          
     $(".{$site->getSiteID()}-PermissionsGroup-View").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { PermissionGroupI18n : { 
                                                group_id: $(this).attr('id'),
                                                lang: $("img.{$site->getSiteID()}-PermissionsGroup[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('users_guard_site_ajax',['action'=>'ViewPermissionGroupI18n'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
</script>