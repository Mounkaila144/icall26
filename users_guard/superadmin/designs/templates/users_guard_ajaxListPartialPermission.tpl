{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Permissions')}</h3> 
<div>
    <a id="{$site->getSiteID()}-NewPermission" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('new permission')|capitalize}</a>
    
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-Permissions"}
<button id="{$site->getSiteID()}-Permissions-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-Permissions-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
     <tr>
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>{__('id')}
             <div>
                 <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                 <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('name')}
               <div>
              <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>      
          <th>{__('date creation')}
                <div>
                  <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.created_at->getValueExist('asc','_active')}" id="asc" name="created_at"><img  src='{url("/icons/sort_asc`$formFilter.order.created_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.created_at->getValueExist('desc','_active')}" id="desc" name="created_at"><img  src='{url("/icons/sort_desc`$formFilter.order.created_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th>{__('date update')}
                <div>
                  <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.updated_at->getValueExist('asc','_active')}" id="asc" name="updated_at"><img  src='{url("/icons/sort_asc`$formFilter.order.updated_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="{$site->getSiteID()}-Permissions-order{$formFilter.order.updated_at->getValueExist('desc','_active')}" id="desc" name="updated_at"><img  src='{url("/icons/sort_desc`$formFilter.order.updated_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th>{__('actions')}</th>
     </tr>
     <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="{$site->getSiteID()}-Permissions-search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
            <td><input class="{$site->getSiteID()}-Permissions-search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td>                        
             <td></td>
            <td></td>
            <td></td>
        </tr>       
        {foreach $pager as $permission}
        <tr class="{$site->getSiteID()}-Permissions" id="{$site->getSiteID()}-Permission-{$permission->get('id')}">
            <td class="{$site->getSiteID()}-Permission-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$permission@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="{$site->getSiteID()}-Permissions-selection" type="checkbox" name="{$permission->getId()}" id="{$permission->get('name')}"/></td>{/if}
            <td>
                {$permission->get('id')}
            </td>
            <td>
                {$permission->get('name')|escape}
            </td>           
            <td>
                {$permission->get('created_at')}
            </td>
            <td>
                {$permission->get('updated_at')}
            </td>
            <td>
               <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-ViewPermission" id="{$permission->get('id')}" name="{$permission->get('name')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
               <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-DeletePermission" id="{$permission->get('id')}" name="{$permission->get('name')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()}  
     {__("no result")}
{else}
   {if $pager->getNbItems()>5}
       <input type="checkbox" id="{$site->getSiteID()}-Permissions-all" />  
       <a href="#" title="{__('delete')}" id="{$site->getSiteID()}-DeletePermissions" style="opacity:0.5" class="{$site->getSiteID()}-Permissions-actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
  {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-Permissions"}
<script type="text/javascript">
                 
        
        function getSite{$site->getSiteKey()}PermissionsFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                     search: { 
                                            is_active : $("[name={$site->getSiteID()}-Permissions-is_active]").val() ,
                                            application : $(".{$site->getSiteID()}-Permissions[name=application] option:selected").val()
                                     }, 
                                     nbitemsbypage: $("[name={$site->getSiteID()}-Permissions-nbitemsbypage]").val(),
                                     
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".{$site->getSiteID()}-Permissions-order_active").attr("name")] =$(".{$site->getSiteID()}-Permissions-order_active").attr("id");
            $(".{$site->getSiteID()}-Permissions-search").each(function() { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}PermissionsFilter()
        {
           return $.ajax2({ data: getSite{$site->getSiteKey()}PermissionsFilterParameters(), 
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            url:"{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            target: "#{$site->getSiteID()}-actions" });
        }
        
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-Permissions-pager .active").html()?parseInt($(".{$site->getSiteID()}-Permissions-pager .{$site->getSiteID()}-Permissions-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-Permissions-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-Permissions-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#{$site->getSiteID()}-Permissions-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-Permissions-end_result").html($(".{$site->getSiteID()}-Permissions-count:last").html());
        }
        
 
        
         // {* PAGER - begin *}
         $('.{$site->getSiteID()}-Permissions-order').click(function() {
             $(".{$site->getSiteID()}-Permissions-order_active").attr('class','{$site->getSiteID()}-Permissions-order');
             $(this).attr('class','{$site->getSiteID()}-Permissions-order_active');
             return updateSite{$site->getSiteKey()}PermissionsFilter();
         });
         
          $("[name={$site->getSiteID()}-Permissions-nbitemsbypage],[name={$site->getSiteID()}-Permissions-is_active]").change(function() { return updateSite{$site->getSiteKey()}PermissionsFilter(); }); 
                      
          $(".{$site->getSiteID()}-Permissions-search").keypress(function(event) {
                        if (event.keyCode==13)
                            return updateSite{$site->getSiteKey()}PermissionsFilter();
          });
                   
          $("#{$site->getSiteID()}-Permissions-filter").click(function() { return updateSite{$site->getSiteKey()}PermissionsFilter(); }); 
          
          $("#{$site->getSiteID()}-Permissions-init").click(function() { $.ajax2({ 
                                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading", 
                                        url:"{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",
                                        errorTarget: ".{$site->getSiteID()}-site-errors",
                                        target: "#{$site->getSiteID()}-actions"}); }); 

          $(".{$site->getSiteID()}-Permissions-pager").click(function () {
                  return $.ajax2({ data: getSite{$site->getSiteKey()}PermissionsFilterParameters(), 
                                   loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                   url: "{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                   errorTarget: ".{$site->getSiteID()}-site-errors",
                                   target: "#{$site->getSiteID()}-actions"});
          });
                   
          // {* PAGER - end *}         
           
          // {* ACTIONS - begin *}
          
          $("#{$site->getSiteID()}-DeletePermissions").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".{$site->getSiteID()}-Permissions-selection:checked").each(function (id) { 
                params.selection[id]=this.name;
                text+=this.id+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm("{__('Permissions :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ data: params,
                       url: "{url_to('users_guard_ajax',['action'=>'DeletesPermission'])}",
                       loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                       errorTarget: ".{$site->getSiteID()}-site-errors",    
                       success: function(resp) {
                                if (resp.action=='deletePermissions')
                                {                                    
                                    if ($(".Permissions").length-resp.parameters.length==0)
                                       return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",target : "#actions"});
                                    $.each(resp.parameters, function () {  $("tr#{$site->getSiteID()}-Permission-"+this).remove(); });
                                    updateSite{$site->getSiteKey()}Pager(resp.parameters.length);       
                                    $("input#{$site->getSiteID()}-Permissions-all").attr("checked",false);                                    
                                }   
                       }
             });    
          });
          
          
          
          $(".{$site->getSiteID()}-DeletePermission").click( function () { 
                if (!confirm('{__("Permission \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({ data: { permission: this.id },
                          loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                          url: "{url_to('users_guard_ajax',['action'=>'DeletePermission'])}",
                          errorTarget: ".{$site->getSiteID()}-site-errors",    
                          success: function(resp) {
                            if (resp.action=='deletePermission')
                            {    
                                if ($(".{$site->getSiteID()}-Permissions").length-1==0)
                                   return $.ajax2({ loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                                    url:"{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",
                                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                                    target: "#{$site->getSiteID()}-actions"});
                                $("tr#{$site->getSiteID()}-Permission-"+resp.id).remove();  
                                updateSite{$site->getSiteKey()}Pager(1);
                            }
                          }
                        }); 
          });
          
          $(".{$site->getSiteID()}-ViewPermission").click( function () { 
                $.ajax2({ data : { id: this.id },
                                   loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                   url: "{url_to('users_guard_ajax',['action'=>'ViewPermission'])}",
                                   errorTarget: ".{$site->getSiteID()}-site-errors",
                                   target: "#{$site->getSiteID()}-actions"});
          });
          
          $("#{$site->getSiteID()}-NewPermission").click( function () { 
                $.ajax2({   loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            url: "{url_to('users_guard_ajax',['action'=>'NewPermission'])}",
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            target: "#{$site->getSiteID()}-actions"});
          });
          
          $(".{$site->getSiteID()}-Permissions-selection").click(function (){               
                $(".{$site->getSiteID()}-Permissions-actions_items").css('opacity',($(".{$site->getSiteID()}-Permissions-selection:checked").length?'1':'0.5'));
          });

           $("#{$site->getSiteID()}-Permissions-all").click(function () {                               
               $(".{$site->getSiteID()}-Permissions-selection").attr("checked","checked"); 
               $(".{$site->getSiteID()}-Permissions-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
           });
</script>