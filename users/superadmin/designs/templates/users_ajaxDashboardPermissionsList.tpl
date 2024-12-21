{messages class="errors"}
{if  $user->isLoaded()}
    <h3>{__('user')|capitalize} : {$user->get('username')} [{$user}] - {__('permissions')|capitalize}</h3>    
    <div>
        <a id="New" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('add permission')|capitalize}</a>
        <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>
    {if  $pager->getNbItems()}
        {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter}
        <button id="filter">{__("Filter")}</button>   <button id="init">{__("Init")}</button>
        <table cellpadding="0" cellspacing="0">
             <tr>
                <th>#</th>
                {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
                <th>{__('id')}
                     <div>
                         <a href="#" class="order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                         <a href="#" class="order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                     </div> 
                 </th>
                 <th>{__('name')}
                       <div>
                      <a href="#" class="order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                      <a href="#" class="order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                     </div> 
                 </th>         
                 <th>{__('actions')}</th>
             </tr>
             <tr>
                    <td></td>
                    {if $pager->getNbItems()>5}<td></td>{/if}
                    <td><input class="search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
                    <td><input class="search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td> 
                    <td></td>
                </tr>       
                {foreach $pager as $permission}
                <tr class="permissions" id="permission_{$permission->get('id')}">
                    <td class="permissions_count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$permission@iteration}</td>
                    {if $pager->getNbItems()>5}<td><input class="selection" type="checkbox" name="{$permission->get('id')}" id="{$permission->get('name')}"/></td>{/if}
                    <td>
                        {$permission->get('id')}
                    </td>
                    <td>
                        {$permission->get('name')}
                    </td>
                    <td>
                       <a href="#" title="{__('delete')}" class="DeleteUserPermission" id="{$permission->get('id')}" name="{$permission->get('name')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
                    </td>
                </tr>
                {/foreach}
        </table>
        {if $pager->getNbItems()>5}
               <input type="checkbox" id="all" />  
               <a href="#" title="{__('delete')}" id="DeleteUserPermissions"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
        {/if}
        {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager}
    {else}
            {__("no result")}
    {/if}
{else}
    {__("user doesn't exist")}
{/if}    
<script type="text/javascript">
    
        function getPermissionsFilterParameters()
        {
            params={ user : "{$user->get('id')}",
                     filter: {  order : { }, 
                                     search: { 
                                               is_active : $("[name=is_active]").val(),
                                             }, 
                                     nbitemsbypage: $("[name=nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");
            $(".search").each(function(id) { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updatePermissionsFilter()
        {
           return $.ajax2({ data: getPermissionsFilterParameters(), 
                            url:"{url_to('users_guard_ajax',['action'=>'PermissionsList'])}" , 
                            loading: "#tab-dashboard-superadmin-loading",
                            target: "#actions" });
        }
        
        function updatePager(n)
        {
           page_active=$(".pager .active").html()?parseInt($(".pager .active").html()):1;
           records_by_page=$("[name=nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".permissions_count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#end_result").html($(".permissions_count:last").html());
        }
         // {* PAGER - begin *}
         $('.order').click(function() {
            $(".order_active").attr('class','order');
            $(this).attr('class','order_active');
            return updatePermissionsFilter();
         });
         
          $("[name=nbitemsbypage],[name=is_active]").change(function() { return updatePermissionsFilter(); }); 
          
          $(".search").keypress(function(event) {
                        if (event.keyCode==13)
                             return updatePermissionsFilter();
          });
                   
          $("#filter").click(function() { return updatePermissionsFilter(); }); 
          
          $("#init").click(function() { $.ajax2({ data : { user : "{$user->get('id')}" }, 
                                                url :"{url_to('users_guard_ajax',['action'=>'PermissionsList'])}",
                                                loading: "#tab-dashboard-superadmin-loading",
                                                target: "#actions" }); }); 
                             
          $(".pager").click(function () {
             return $.ajax2({ data: getPermissionsFilterParameters(), 
                            url:"{url_to('users_guard_ajax',['action'=>'PermissionsList'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length) , 
                            loading: "#tab-dashboard-superadmin-loading",
                            target: "#actions" });
          });
          
          $("#all").click(function () {  $(".selection").attr("checked",($(this).attr("checked")=="checked"));  });
          // {* PAGER - end *}         
           
          // {* ACTIONS - begin *}
          
          $("#DeleteUserPermissions").click( function () { 
             var params={ selection : {  }, user : "{$user->get('id')}" };
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
                       url: "{url_to('users_guard_ajax',['action'=>'DeleteUserPermissions'])}",
                       loading: "#tab-dashboard-superadmin-loading",
                       success: function(resp) {
                                    if (resp.action=='deleteUserPermissions')
                                    {                                    
                                        if ($(".permissions").length-resp.parameters.length==0)
                                             return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'PermissionsList'])}",                                         
                                                              loading: "#tab-dashboard-superadmin-loading",
                                                              target: "#actions"});
                                        $.each(resp.parameters, function (id) {  $("tr#permission_"+this).remove(); });
                                        // Update Number of results
                                         updatePager(resp.parameters.length); 
                                        $("input#all").attr("checked",false);                                    
                                    }       
                               }
             });    
             return false;
          });
          
          $(".DeleteUserPermission").click( function () { 
                if (!confirm('{__("Permission \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({ data: { userPermission: this.id },
                                 url : "{url('/module/dashboard/users/DeleteUserPermission')}",
                                 success :function(resp) {
                                                if (resp.action=='deleteUserPermission')
                                                {    
                                                    if ($(".permissions").length-1==0)
                                                       return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'PermissionsList'])}", 
                                                                        loading: "#tab-dashboard-superadmin-loading",
                                                                        target: "#actions" });
                                                    $("tr#permission_"+resp.id).remove();  
                                                    updatePager(1); 
                                                }
                                         }
                        }); 
          });
          
          $("#New").click( function () { 
                $.ajax2({ data: { user : "{$user->get('id')}" }, 
                          url: "{url_to('users_guard_ajax',['action'=>'AddPermissions'])}",
                          loading: "#tab-dashboard-superadmin-loading",
                          target: "#actions"});
          });
                    
          $('#Cancel').click(function(){ return $.ajax2({ 
                    loading: "#tab-dashboard-superadmin-loading",
                    url: "{url_to('users_dashboard_ajax',['action'=>'DashboardListPartial'])}",
                    target: "#actions" }); });
</script>