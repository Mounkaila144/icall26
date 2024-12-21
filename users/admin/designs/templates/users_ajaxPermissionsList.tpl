{messages class="site-errors"}
{if  $item->isLoaded()}
    <h3>{__('user')|capitalize} : {$item->get('username')} [{$item}] - {__('permissions')|capitalize}</h3>    
    <div>
        {if $user->hasCredential([['superadmin','admin','settings_user_permission_user_new']])}
        <a id="UserPermission-AddPermission" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('add permission')|capitalize}</a>
        {/if}
        <a href="#" id="UserPermission-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>
    {if  $pager->getNbItems()}
        {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="UserPermission"}
        <button id="UserPermission-filter">{__("Filter")}</button>   <button id="UserPermission-init">{__("Init")}</button>
        <table cellpadding="0" cellspacing="0">
             <tr>
                <th>#</th>
                {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}               
                 <th>{__('name')}
                       <div>
                      <a href="#" class="UserPermission-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                      <a href="#" class="UserPermission-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                     </div> 
                 </th>         
                 <th>{__('actions')}</th>
             </tr>
             <tr>
                    <td></td>
                    {if $pager->getNbItems()>5}<td></td>{/if}                   
                    <td></td> 
                    <td></td>
                </tr>       
                {foreach $pager as $permission}
                <tr class="permissions" id="permission_{$permission->get('id')}">
                    <td class="permissions_count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$permission@iteration}</td>
                    {if $pager->getNbItems()>5}<td><input class="selection" type="checkbox" name="{$permission->get('id')}" id="{$permission->get('name')}"/></td>{/if}                   
                    <td>
                        {__($permission->get('name'),'','permissions')}
                    </td>
                    <td>
                       {if $user->hasCredential([['superadmin','admin','settings_user_permission_user_delete']])}
                       <a href="#" title="{__('delete')}" class="UserPermission-DeletePermission" id="{$permission->get('id')}" name="{$permission->get('name')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
                       {/if}
                    </td>
                </tr>
                {/foreach}
        </table>
        {if $pager->getNbItems()>5}
               <input type="checkbox" id="all" />  
               <a href="#" title="{__('delete')}" id="UserPermission-DeletePermissions"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
        {/if}
        {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="UserPermission"}
    {else}
            {__("no result")}
    {/if}
{else}
    {__("user doesn't exist")}
{/if}    
<script type="text/javascript">
    
        function getPermissionsFilterParameters()
        {
            var params={ User : "{$item->get('id')}",
                     filter: {  order : { }, 
                                     search: { 
                                               is_active : $("[name=is_active]").val(),
                                             }, 
                                     nbitemsbypage: $("[name=UserPermission-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".UserPermission-order_active").attr("name")] =$(".UserPermission-order_active").attr("id");
            $(".UserPermission-search").each(function() { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updatePermissionsFilter()
        {
           return $.ajax2({ data: getPermissionsFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'PermissionsList'])}" , 
                            errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions" });
        }
        
        function updatePager(n)
        {
           page_active=$(".UserPermission-pager .active").html()?parseInt($(".pager .active").html()):1;
           records_by_page=$("[name=UserPermission-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".permissions_count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#UserPermission-nb_results").html())-n;
           $("#UserPermission-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#UserPermission-end_result").html($(".permissions_count:last").html());
        }
         // {* PAGER - begin *}
         $('.UserPermission-order').click(function() {
            $(".UserPermission-order_active").attr('class','UserPermission-order');
            $(this).attr('class','UserPermission-order_active');
            return updatePermissionsFilter();
         });
         
          $("[name=UserPermission-nbitemsbypage],[name=UserPermission-is_active]").change(function() { return updatePermissionsFilter(); }); 
          
          $(".UserPermission-search").keypress(function(event) {
                        if (event.keyCode==13)
                             return updatePermissionsFilter();
          });
                   
          $("#UserPermission-filter").click(function() { return updatePermissionsFilter(); }); 
          
          $("#UserPermission-init").click(function() { $.ajax2({ data : { User : "{$item->get('id')}" }, 
                                                           url :"{url_to('users_ajax',['action'=>'PermissionsList'])}",
                                                           errorTarget: ".site-errors",
                                                             loading: "#tab-site-dashboard-x-settings-loading",
                                                           target: "#actions" });
          }); 
                             
          $(".pager").click(function () {
             return $.ajax2({ data: getPermissionsFilterParameters(), 
                              url:"{url_to('users_ajax',['action'=>'PermissionsList'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length) , 
                              errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                              target: "#actions" });
          });
          
          $("#all").click(function () {  $(".selection").attr("checked",($(this).attr("checked")=="checked"));  });
          // {* PAGER - end *}         
           
          // {* ACTIONS - begin *}
          
          $("#UserPermission-DeletePermissions").click( function () { 
             var params={ selection : {  }, User : "{$item->get('id')}" };
             text="";              
             $(".selection:checked").each(function (id) { 
                params.selection[id]=this.name;
                text+=this.id+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm("{__('Permissions :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ data:params,
                       url: "{url_to('users_ajax',['action'=>'DeleteUserPermissions'])}",
                       errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",
                       success: function(resp) {
                                    if (resp.action=='deleteUserPermissions')
                                    {                                    
                                        if ($(".permissions").length-resp.parameters.length==0)
                                             return $.ajax2({ data : { User : "{$item->get('id')}" },
                                                                       url:"{url_to('users_ajax',['action'=>'PermissionsList'])}",
                                                                       errorTarget: ".site-errors",
                                                                         loading: "#tab-site-dashboard-x-settings-loading",
                                                                       target: "#actions" });
                                        $.each(resp.parameters, function (id) {  $("tr#permission_"+this).remove(); });
                                        // Update Number of results
                                         updatePager(resp.parameters.length); 
                                        $("input#all").attr("checked",false);                                    
                                    }       
                               }
             });    
             return false;
          });
          
          $(".UserPermission-DeletePermission").click( function () { 
                if (!confirm('{__("Permission \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({ data: { userPermission: this.id },
                                 url : "{url_to('users_ajax',['action'=>'DeleteUserPermission'])}",
                                 errorTarget: ".site-errors",
                                   loading: "#tab-site-dashboard-x-settings-loading",
                                 success :function(resp) {
                                                if (resp.action=='deleteUserPermission')
                                                {    
                                                    if ($(".permissions").length-1==0)
                                                       return $.ajax2({ data : { User : "{$item->get('id')}" },
                                                                                 url:"{url_to('users_ajax',['action'=>'PermissionsList'])}", 
                                                                                 errorTarget: ".site-errors",
                                                                                   loading: "#tab-site-dashboard-x-settings-loading",
                                                                                 target: "#actions" });
                                                    $("tr#permission_"+resp.id).remove();  
                                                    updatePager(1); 
                                                }
                                         }
                        }); 
          });
          
          $("#UserPermission-AddPermission").click( function () { 
                $.ajax2({ data: { User : "{$item->get('id')}" }, 
                                  url: "{url_to('users_ajax',['action'=>'AddPermissions'])}",
                                  errorTarget: ".site-errors",
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                      target: "#actions"});
          });
                    
          $('#UserPermission-Cancel').click(function(){ $.ajax2({ url: "{url_to('users_ajax',['action'=>'ListPartial'])}", 
                                                   errorTarget: ".site-errors",
                                                     loading: "#tab-site-dashboard-x-settings-loading",
                                                   target: "#actions"
                                        }); 
          });
          
</script>