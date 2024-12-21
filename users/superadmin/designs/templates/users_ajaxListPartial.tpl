{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Users')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-New" title="{__('new product')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New user')}</a>   

</div>
  
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class=$site->getSiteID()}
<button id="{$site->getSiteID()}-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
     <tr>
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>{__('id')}
             <div>
                 <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                 <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('username')}
               <div>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.username->getValueExist('asc','_active')}" id="asc" name="username"><img  src='{url("/icons/sort_asc`$formFilter.order.username->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.username->getValueExist('desc','_active')}" id="desc" name="username"><img  src='{url("/icons/sort_desc`$formFilter.order.username->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         
         <th>{__('firstname')}
               <div>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.firstname->getValueExist('asc','_active')}" id="asc" name="firstname"><img  src='{url("/icons/sort_asc`$formFilter.order.firstname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.firstname->getValueExist('desc','_active')}" id="desc" name="firstname"><img  src='{url("/icons/sort_desc`$formFilter.order.firstname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('lastname')}
              <div>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
          <th>{__('email')}
               <div>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.email->getValueExist('asc','_active')}" id="asc" name="email"><img  src='{url("/icons/sort_asc`$formFilter.order.email->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.email->getValueExist('desc','_active')}" id="desc" name="email"><img  src='{url("/icons/sort_desc`$formFilter.order.email->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
          </th>
          <th>{__('state')}</th>
          <th>{__('date creation')}
                <div>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.created_at->getValueExist('asc','_active')}" id="asc" name="created_at"><img  src='{url("/icons/sort_asc`$formFilter.order.created_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.created_at->getValueExist('desc','_active')}" id="desc" name="created_at"><img  src='{url("/icons/sort_desc`$formFilter.order.created_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th>{__('last login')}
                <div>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.lastlogin->getValueExist('asc','_active')}" id="asc" name="lastlogin"><img  src='{url("/icons/sort_asc`$formFilter.order.lastlogin->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.lastlogin->getValueExist('desc','_active')}" id="desc" name="lastlogin"><img  src='{url("/icons/sort_desc`$formFilter.order.lastlogin->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th>{__('last password generation')}
                <div>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.last_password_gen->getValueExist('asc','_active')}" id="asc" name="last_password_gen"><img  src='{url("/icons/sort_asc`$formFilter.order.last_password_gen->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a> 
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.last_password_gen->getValueExist('desc','_active')}" id="desc" name="last_password_gen"><img  src='{url("/icons/sort_desc`$formFilter.order.last_password_gen->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
                </div>
          </th>
          <th>{__('actions')}</th>
     </tr>
     <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="username" value="{$formFilter.search.username}"></td>
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="firstname" value="{$formFilter.search.firstname}"></td>
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="lastname" value="{$formFilter.search.lastname}"></td>
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="email" value="{$formFilter.search.email}"></td>
            <td>{html_options_format format="__" name="{$site->getSiteID()}-is_active" options=$formFilter->search.is_active->getOption('choices') selected=(string)$formFilter.search.is_active}</td>
            <td></td>
            <td></td>   
            <td></td>  
            <td></td>
            <td></td>
        </tr>       
        {foreach $pager as $user}
        <tr class="{$site->getSiteID()}-users" id="{$site->getSiteID()}-user-{$user->get('id')}">
            <td class="{$site->getSiteID()}-users-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$user@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="{$site->getSiteID()}-selection" type="checkbox" name="{$user->getId()}" id="{$user->get('firstname')} {$user->get('lastname')} ({$user->get('username')})" /></td>{/if}
            <td>
                {$user->getId()}
            </td>
            <td>
                {$user->get('username')|escape}
            </td>
            <td>
                {$user->get('firstname')|escape}
            </td>
             <td>
                {$user->get('lastname')|escape}
            </td>
            <td>
                {$user->get('email')|escape}
            </td>
            <td>
               {* {$user->get('is_active')} *}
               <a href="#" title="{__('change')}" class="{$site->getSiteID()}-Change" id="{$user->get('id')}" name="{$user->get('is_active')}"><img  src="{url('/icons/','picture')}{$user->get('is_active')}.gif" alt='{__("user_`$user->get("is_active")`")}'/></a>
            </td>
            <td>
                {$user->get('created_at')}
            </td>
            <td>
                {$user->get('lastlogin')}
            </td>
            <td id="{$site->getSiteID()}-lastpasswordgen-{$user->get('id')}">
                {$user->get('last_password_gen')|escape}
            </td>
            <td>
               <a href="#" title="{__('regenerate password')}" class="{$site->getSiteID()}-RegeneratePassword" id="{$user->get('id')}" name="{$user->get('firstname')} {$user->get('lastname')}"><img  src="{url('/icons/password.png','picture')}" alt='{__("regenerate password")}'/></a>
               <a href="#" title="{__('groups')}" class="{$site->getSiteID()}-ViewGroup" id="{$user->get('id')}" name="{$user->get('firstname')} {$user->get('lastname')}"><img  src="{url('/icons/group.png','picture')}" alt='{__("group")}'/></a>
               <a href="#" title="{__('permissions')}" class="{$site->getSiteID()}-ViewPermissions" id="{$user->get('id')}" name="{$user->get('firstname')} {$user->get('lastname')}"><img  src="{url('/icons/permission.png','picture')}" alt='{__("permissions")}'/></a>
               <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-View" id="{$user->get('id')}" name="{$user->get('firstname')} {$user->get('lastname')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
               <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-Delete" id="{$user->get('id')}" name="{$user->get('firstname')} {$user->get('lastname')} ({$user->get('username')})"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()} 
     {__("no result")}
{else}
   {if $pager->getNbItems()>5}
       <input type="checkbox" id="{$site->getSiteID()}-all" />  
       <a href="#" title="{__('enable')}" id="{$site->getSiteID()}-EnabledUsers" style="opacity:0.5" class="{$site->getSiteID()}-actions_items"><img  src="{url('/icons/YES.gif','picture')}" alt='{__("yes")}'/>
       <a href="#" title="{__('disable')}" id="{$site->getSiteID()}-DisabledUsers" style="opacity:0.5" class="{$site->getSiteID()}-actions_items"><img  src="{url('/icons/NO.gif','picture')}" alt='{__("no")}'/></a>
       <a href="#" title="{__('delete')}" id="{$site->getSiteID()}-DeleteUsers" style="opacity:0.5" class="{$site->getSiteID()}-actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
    {* <button id="delete">delete</button> *}
  {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class=$site->getSiteID()}  
  
  
 <script type="text/javascript">
    
          function changeSite{$site->getSiteKey()}UserState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.{$site->getSiteID()}-Change#"+this;
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
        
        function getSite{$site->getSiteKey()}UserFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { 
                                         is_active : $("[name={$site->getSiteID()}-is_active]").val() 
                                    },
                                    equal: {   },                                                                                                                                   
                                nbitemsbypage: $("[name={$site->getSiteID()}-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-order_active").attr("name")] =$(".{$site->getSiteID()}-order_active").attr("id");   
            $(".{$site->getSiteID()}-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}UserFilter()
        {          
           return $.ajax2({ data: getSite{$site->getSiteKey()}UserFilterParameters(), 
                            url:"{url_to('users_site_ajax',['action'=>'ListPartial'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-pager .active").html()?parseInt($(".{$site->getSiteID()}-pager .active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-nb_results").html())-n;
           $("#{$site->getSiteID()}-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-end_result").html($(".{$site->getSiteID()}-User-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-init").click(function() {                 
               $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartial'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
          }); 
    
          $('.{$site->getSiteID()}-order').click(function() {
                $(".{$site->getSiteID()}-order_active").attr('class','{$site->getSiteID()}-order');
                $(this).attr('class','{$site->getSiteID()}-order_active');
                return updateSite{$site->getSiteKey()}UserFilter();
          });
           
          $(".{$site->getSiteID()}-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}UserFilter();
          });
            
          $("#{$site->getSiteID()}-filter").click(function() { return updateSite{$site->getSiteKey()}UserFilter(); }); 
          
          $("[name={$site->getSiteID()}-nbitemsbypage],[name={$site->getSiteID()}-is_active]").change(function() { return updateSite{$site->getSiteKey()}UserFilter(); }); 
                           
           
          $(".{$site->getSiteID()}-pager").click(function () {                     
                return $.ajax2({ data: getSite{$site->getSiteKey()}UserFilterParameters(), 
                                 url:"{url_to('products_ajax',['action'=>'ListPartial'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
          });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-New").click( function () {             
            return $.ajax2({                    
                url: "{url_to('users_site_ajax',['action'=>'NewUser'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-View").click( function () {                    
                return $.ajax2({ data : { User : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('users_site_ajax',['action'=>'ViewUser'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                     
         
          $(".{$site->getSiteID()}-Delete").click( function () { 
                if (!confirm('{__("User \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ User: $(this).attr('id') },
                                 url :"{url_to('users_site_ajax',['action'=>'DeleteUser'])}",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",    
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteUser')
                                       {    
                                          $("tr#{$site->getSiteID()}-user-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-users').length==0)
                                              return $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartial'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
        $(".{$site->getSiteID()}-RegeneratePassword").click( function () { 
                    return $.ajax2({ data : { id: this.id },
                                   loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                   url :"{url_to('users_site_ajax',['action'=>'RegeneratePassword'])}",
                                   errorTarget: ".{$site->getSiteID()}-site-errors",
                                   success: function(resp) { 
                                               if (resp.action=='RegeneratePasswordUser'&&resp.params.id && resp.params.date)
                                                     $("#{$site->getSiteID()}-lastpasswordgen-"+resp.params.id).html(resp.params.date);
                                   }
                         });
          });
          
          $(".{$site->getSiteID()}-ViewPermissions").click( function () {           
              return $.ajax2({  data : { User: this.id },                             
                                url: "{url_to('users_site_ajax',['action'=>'PermissionsList'])}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                            
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions" });
          });
 
         $(".{$site->getSiteID()}-ViewGroup").click( function () { 
              return $.ajax2({  data : { User: this.id },                               
                                url: "{url_to('users_site_ajax',['action'=>'GroupsList'])}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                        
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions" });
          });   
          
         $(".{$site->getSiteID()}-Change").click(function() { 
                        return $.ajax2({ 
                            data : { id: this.id , value:this.name },
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",    
                            url: "{url_to('users_site_ajax',['action'=>'ChangeUser'])}",
                            errorTarget: ".{$site->getSiteID()}-site-errors", 
                            success: function(resp) { 
                                        if (resp.action=='ChangeUser')
                                            changeSite{$site->getSiteKey()}UserState(resp);
                                     }
                    });
         });
         
         
 </script>    