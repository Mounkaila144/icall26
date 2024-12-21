{messages class="site-errors"}
<h3>{__('Users')}</h3>    
<div>
  {if $user->hasCredential([['superadmin','admin','settings_user_new']])}  
  <a href="#" class="btn" id="New" title="{__('new product')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New user')}</a>   
  {/if}
</div>
  
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="User"}
<button id="filter" class="btn-table">{__("Filter")}</button>   <button id="init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">
    <thead> 
     <tr class="list-header">
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th data-hide="phone" style="display: table-cell;">{__('id')}
             <div>
                 <a href="#" class="order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                 <a href="#" class="order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('username')}
               <div>
              <a href="#" class="order{$formFilter.order.username->getValueExist('asc','_active')}" id="asc" name="username"><img  src='{url("/icons/sort_asc`$formFilter.order.username->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.username->getValueExist('desc','_active')}" id="desc" name="username"><img  src='{url("/icons/sort_desc`$formFilter.order.username->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         
         <th>{__('firstname')}
               <div>
              <a href="#" class="order{$formFilter.order.firstname->getValueExist('asc','_active')}" id="asc" name="firstname"><img  src='{url("/icons/sort_asc`$formFilter.order.firstname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.firstname->getValueExist('desc','_active')}" id="desc" name="firstname"><img  src='{url("/icons/sort_desc`$formFilter.order.firstname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('lastname')}
              <div>
              <a href="#" class="order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
          <th data-hide="phone" style="display: table-cell;">{__('email')}
               <div>
              <a href="#" class="order{$formFilter.order.email->getValueExist('asc','_active')}" id="asc" name="email"><img  src='{url("/icons/sort_asc`$formFilter.order.email->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.email->getValueExist('desc','_active')}" id="desc" name="email"><img  src='{url("/icons/sort_desc`$formFilter.order.email->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
          </th>
          <th data-hide="phone" style="display: table-cell;">{__('state')}</th>
          <th data-hide="phone,tablet" style="display: table-cell;">{__('date creation')}
                <div>
              <a href="#" class="order{$formFilter.order.created_at->getValueExist('asc','_active')}" id="asc" name="created_at"><img  src='{url("/icons/sort_asc`$formFilter.order.created_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.created_at->getValueExist('desc','_active')}" id="desc" name="created_at"><img  src='{url("/icons/sort_desc`$formFilter.order.created_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th data-hide="phone,tablet" style="display: table-cell;">{__('last login')}
                <div>
                  <a href="#" class="order{$formFilter.order.lastlogin->getValueExist('asc','_active')}" id="asc" name="lastlogin"><img  src='{url("/icons/sort_asc`$formFilter.order.lastlogin->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="order{$formFilter.order.lastlogin->getValueExist('desc','_active')}" id="desc" name="lastlogin"><img  src='{url("/icons/sort_desc`$formFilter.order.lastlogin->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th data-hide="phone,tablet" style="display: table-cell;">{__('last password generation')}
                <div>
                  <a href="#" class="order{$formFilter.order.last_password_gen->getValueExist('asc','_active')}" id="asc" name="last_password_gen"><img  src='{url("/icons/sort_asc`$formFilter.order.last_password_gen->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a> 
                  <a href="#" class="order{$formFilter.order.last_password_gen->getValueExist('desc','_active')}" id="desc" name="last_password_gen"><img  src='{url("/icons/sort_desc`$formFilter.order.last_password_gen->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
                </div>
          </th>
          <th data-hide="phone" style="display: table-cell;">{__('actions')}</th>
     </tr>
</thead>
     <tr class="input-list">
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
            <td><input class="search" type="text" size="5" name="username" value="{$formFilter.search.username}"></td>
            <td><input class="search" type="text" size="5" name="firstname" value="{$formFilter.search.firstname}"></td>
            <td><input class="search" type="text" size="5" name="lastname" value="{$formFilter.search.lastname}"></td>
            <td><input class="search" type="text" size="5" name="email" value="{$formFilter.search.email}"></td>
            <td>{html_options_format format="__" name="is_active" options=$formFilter->search.is_active->getOption('choices') selected=(string)$formFilter.search.is_active}</td>
            <td></td>
            <td></td>   
            <td></td>  
            <td></td>
            <td></td>
        </tr>       
        {foreach $pager as $item}
        <tr class="users list" id="user-{$item->get('id')}">
            <td class="users-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="selection" type="checkbox" name="{$item->getId()}" id="{$item->get('firstname')} {$item->get('lastname')} ({$item->get('username')})" /></td>{/if}
            <td>
                {$item->getId()}
            </td>
            <td>
                {$item->get('username')|escape}
            </td>
            <td>
                {$item->get('firstname')|escape}
            </td>
             <td>
                {$item->get('lastname')|escape}
            </td>
            <td>
                {$item->get('email')|escape}
            </td>
            <td>
               {* {$user->get('is_active')} *}
               <a href="#" title="{__('change')}" class="Change" id="{$item->get('id')}" name="{$item->get('is_active')}"><img  src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__("user_`$item->get("is_active")`")}'/></a>
            </td>
            <td>
                {$item->get('created_at')}
            </td>
            <td>
                {$item->get('lastlogin')}
            </td>
            <td id="lastpasswordgen-{$item->get('id')}">
                {$item->get('last_password_gen')|escape}
            </td>
            <td>                 
               {if $user->hasCredential([['superadmin','admin','settings_user_password_creation']])}  
               <a href="#" title="{__('create password')}" class="CreatePassword" id="{$item->get('id')}" name="{$item->get('firstname')} {$item->get('lastname')}"><img  src="{url('/icons/arrow_rotate_anticlockwise.png','picture')}" alt='{__("create password")}'/></a>
               {/if}
               {if $user->hasCredential([['superadmin','admin','settings_user_password_generation']])}  
               <a href="#" title="{__('regenerate password')}" class="RegeneratePassword" id="{$item->get('id')}" name="{$item->get('firstname')} {$item->get('lastname')}"><img  src="{url('/icons/password.png','picture')}" alt='{__("regenerate password")}'/></a>
               {/if}
               {if $user->hasCredential([['superadmin','admin','settings_user_function_user_list']])}  
               <a href="#" title="{__('position')}" class="ViewPosition" id="{$item->get('id')}"><img  src="{url('/icons/position16x16.png','picture')}" alt='{__("position")}'/></a>
               {/if}
               {if $user->hasCredential([['superadmin','admin','settings_user_group_user_list']])}  
               <a href="#" title="{__('groups')}" class="ViewGroup" id="{$item->get('id')}" name="{$item->get('firstname')} {$item->get('lastname')}"><img  src="{url('/icons/group.png','picture')}" alt='{__("group")}'/></a>
               {/if}
               {if $user->hasCredential([['superadmin','admin','settings_user_permissions_user_list']])}  
               <a href="#" title="{__('permissions')}" class="ViewPermissions" id="{$item->get('id')}" name="{$item->get('firstname')} {$item->get('lastname')}"><img  src="{url('/icons/permission.png','picture')}" alt='{__("permissions")}'/></a>
               {/if}
               {if $user->hasCredential([['superadmin','admin','settings_user_view']])}  
               <a href="#" title="{__('edit')}" class="View" id="{$item->get('id')}" name="{$item->get('firstname')} {$item->get('lastname')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
               {/if}
               {if $user->hasCredential([['superadmin','admin','settings_user_delete']])}  
               <a href="#" title="{__('delete')}" class="Delete" id="{$item->get('id')}" name="{$item->get('firstname')} {$item->get('lastname')} ({$item->get('username')})"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
               {/if}
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()} 
     {__("no result")}
{else}
   {if $pager->getNbItems()>5}
       <input type="checkbox" id="all" />  
       <a href="#" title="{__('enable')}" id="EnabledUsers" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/YES.gif','picture')}" alt='{__("yes")}'/>
       <a href="#" title="{__('disable')}" id="DisabledUsers" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/NO.gif','picture')}" alt='{__("no")}'/></a>
       <a href="#" title="{__('delete')}" id="DeleteUsers" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
    {* <button id="delete">delete</button> *}
  {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="User"}  {* probleme a trouvé *}    
 <script type="text/javascript">
    
          function changeSiteUserState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.Change#"+this;
                if (resp.state=='YES'||resp.state=='NO') 
                {    
                    $(sel+" img").attr({
                        src :"{url('/icons/','picture')}"+resp.state+".gif",
                        alt : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}'),
                        title : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}')
                    });
                    $(sel).attr("name",resp.state);
                }
            });  
        }
        
        function getSiteUserFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { 
                                         is_active : $("[name=is_active]").val() 
                                    },
                                    equal: {   },                                                                                                                                   
                                nbitemsbypage: $("[name=User-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".order_active").attr("name"))
                 params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");   
            $(".search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteUserFilter()
        {          
           return $.ajax2({ data: getSiteUserFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'ListPartial'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".User-pager .active").html()?parseInt($(".User-pager .active").html()):1;
           records_by_page=$("[name=User-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#User-nb_results").html())-n;
           $("#User-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#User-end_result").html($(".User-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#init").click(function() {                 
               $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartial'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
          }); 
    
          $('.order').click(function() {
                $(".order_active").attr('class','order');
                $(this).attr('class','order_active');
                return updateSiteUserFilter();
          });
           
          $(".search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteUserFilter();
          });
            
          $("#filter").click(function() { return updateSiteUserFilter(); }); 
          
          $("[name=User-nbitemsbypage],[name=is_active]").change(function() { return updateSiteUserFilter(); }); 
                           
           
          $(".User-pager").click(function () {                     
                return $.ajax2({ data: getSiteUserFilterParameters(), 
                                 url:"{url_to('users_ajax',['action'=>'ListPartial'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
          });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#New").click( function () {             
            return $.ajax2({                    
                url: "{url_to('users_ajax',['action'=>'NewUser'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".View").click( function () {                    
                return $.ajax2({ data : { User : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewUser'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
          $(".ViewPosition").click( function () {                    
                return $.ajax2({ data : { User : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewUserFunction'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                     
         
          $(".Delete").click( function () { 
                if (!confirm('{__("User \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ User: $(this).attr('id') },
                                 url :"{url_to('users_ajax',['action'=>'DeleteUser'])}",
                                 errorTarget: ".site-errors",    
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteUser')
                                       {    
                                          $("tr#user-"+resp.id).remove();  
                                          if ($('.users').length==0)
                                              return $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartial'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
        $(".RegeneratePassword").click( function () { 
                    return $.ajax2({ data : { id: this.id },
                                   loading: "#tab-site-dashboard-x-settings-loading",
                                   url :"{url_to('users_ajax',['action'=>'RegeneratePassword'])}",
                                   errorTarget: ".site-errors",
                                   success: function(resp) { 
                                               if (resp.action=='RegeneratePasswordUser'&&resp.params.id && resp.params.date)
                                                     $("#lastpasswordgen-"+resp.params.id).html(resp.params.date);
                                   }
                         });
          });
          
          $(".ViewPermissions").click( function () {           
              return $.ajax2({  data : { User: this.id },                             
                                url: "{url_to('users_ajax',['action'=>'PermissionsList'])}",
                                loading: "#tab-site-dashboard-x-settings-loading",                            
                                errorTarget: ".site-errors",
                                target: "#actions" });
          });
 
         $(".ViewGroup").click( function () { 
              return $.ajax2({  data : { User: this.id },                               
                                url: "{url_to('users_ajax',['action'=>'GroupsList'])}",
                                loading: "#tab-site-dashboard-x-settings-loading",                        
                                errorTarget: ".site-errors",
                                target: "#actions" });
          });   
          
         $(".Change").click(function() { 
                        return $.ajax2({ 
                            data : { id: this.id , value:this.name },
                            loading: "#tab-site-dashboard-x-settings-loading",    
                            url: "{url_to('users_ajax',['action'=>'ChangeUser'])}",
                            errorTarget: ".site-errors", 
                            success: function(resp) { 
                                        if (resp.action=='ChangeUser')
                                            changeSiteUserState(resp);
                                     }
                    });
         });
        
          $(".selection").click(function (){               
                $(".actions_items").css('opacity',($(".selection:checked").length?'1':'0.5'));
          });
            
          $("#all").click(function () {                
               $(".selection").prop("checked",$(this).prop("checked"));             
               $(".actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
          });
           // {* PAGER - end *}         
           
           // {* ACTIONS - begin *}
          $("#EnabledUsers,#DisabledUsers").click( function () { 
                var params={ users : { selection : {  } , value :(this.id=='DisabledUsers'?'NO':'YES'),token: "{mfForm::getToken('changeUsersForm')}" } };
                idx=0;
                $(".selection:checked").each(function (id) { 
                    if ($(".ChangeUser#"+this.name).attr('name')!=params.users.value)
                       params.users.selection[idx++]= this.name;
                });
                if ($.isEmptyObject(params.users.selection))
                   return ;
              return $.ajax2({
                   data: params,                  
                   url: "{url_to('users_ajax',['action'=>'ChangeUsers'])}",
                   loading: "#tab-site-dashboard-x-settings-loading", 
                   errorTarget: ".site-errors",
                   success: function(resp) { 
                               if (resp.action=='ChangeUsers')
                                   changeSiteUserState(resp);
                            }
              });
          });
          
          $("#DeleteUsers").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".selection:checked").each(function (id) { 
                params.selection[id]=this.name;
                text+=this.id+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm("{__('Users :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ 
                     data: params,                     
                     url: "{url_to('users_ajax',['action'=>'DeleteUsers'])}",
                     loading: "#tab-site-dashboard-x-settings-loading", 
                     errorTarget: ".site-errors",
                     success: function(resp) {
                            if (resp.action=='deleteUsers')
                            {   
                                if ($(".users").length-resp.parameters.length==0)
                                {    
                                  return $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartial'])}",
                                                    errorTarget: ".site-errors",
                                                    loading: "#tab-site-dashboard-x-settings-loading",                         
                                                    target: "#actions" });
                                }    
                                $.each(resp.parameters, function (id) {  $("tr#user-"+this).remove(); });
                                updateSitePager(resp.parameters.length); 
                                $("input#all").attr("checked",false);                                    
                            }       
                         }
             });
          });
          	
	 $(".CreatePassword").click( function () {           
              return $.ajax2({  data : { User: this.id },                             
                                url: "{url_to('users_ajax',['action'=>'CreatePasswordUser'])}",
                                loading: "#tab-site-dashboard-x-settings-loading",                            
                                errorTarget: ".site-errors",
                                target: "#actions" });
          });
          
        
 </script>    