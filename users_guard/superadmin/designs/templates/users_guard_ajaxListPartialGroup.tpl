{messages class="{$site->getSiteID()}-site-errors"}
<div>
    <a id="{$site->getSiteID()}-New" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('new groups')|capitalize}</a>
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
         <th>{__('name')}
               <div>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('state')}</th>
          <th>{__('date creation')}
                <div>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.created_at->getValueExist('asc','_active')}" id="asc" name="created_at"><img  src='{url("/icons/sort_asc`$formFilter.order.created_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.created_at->getValueExist('desc','_active')}" id="desc" name="created_at"><img  src='{url("/icons/sort_desc`$formFilter.order.created_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th>{__('date update')}
                <div>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.updated_at->getValueExist('asc','_active')}" id="asc" name="updated_at"><img  src='{url("/icons/sort_asc`$formFilter.order.updated_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="{$site->getSiteID()}-order{$formFilter.order.updated_at->getValueExist('desc','_active')}" id="desc" name="updated_at"><img  src='{url("/icons/sort_desc`$formFilter.order.updated_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>  
       
          <th>{__('actions')}</th>
     </tr>
     <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
            <td><input class="{$site->getSiteID()}-search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td>
            <td>{html_options_format format="__" name="{$site->getSiteID()}-is_active" options=$formFilter->search.is_active->getOption('choices') selected=(string)$formFilter.search.is_active}</td> 
            <td></td>
            <td></td>            
            <td></td>
        </tr>       
        {foreach $pager as $group}
        <tr class="{$site->getSiteID()}-Groups" id="{$site->getSiteID()}-group-{$group->get('id')}">
            <td class="{$site->getSiteID()}-groups-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$group@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="{$site->getSiteID()}-selection" type="checkbox" name="{$group->getId()}" id="{$group->get('name')}"/></td>{/if}
            <td>
                {$group->get('id')}
            </td>
            <td>
                {$group->get('name')|escape}
            </td>
            <td>             
               <a href="#" title="{__('change')}" class="{$site->getSiteID()}-ChangeGroup" id="{$group->get('id')}" name="{$group->get('is_active')}"><img  src="{url('/icons/','picture')}{$group->get('is_active')}.gif" alt='{__("group_`$group->get("is_active")`")}'/></a>
            </td>
            <td>
                {$group->get('created_at')}
            </td>
            <td>
                {$group->get('updated_at')}
            </td>          
            <td>
               <a href="#" title="{__('permissions')}" class="{$site->getSiteID()}-ViewPermissions" id="{$group->get('id')}" name="{$group->get('name')}"><img  src="{url('/icons/permission.png','picture')}" alt='{__("permissions")}'/></a>
               <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-View" id="{$group->get('id')}" name="{$group->get('name')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
               <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-Delete" id="{$group->get('id')}" name="{$group->get('name')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()}  
     {__("no result")}
{else}
   {if $pager->getNbItems()>5}
       <input type="checkbox" id="{$site->getSiteID()}-all" />  
       <a href="#" title="{__('enable')}" id="{$site->getSiteID()}-Enabled" style="opacity:0.5" class="{$site->getSiteID()}-actions_items"><img  src="{url('/icons/YES.gif','picture')}" alt='{__("yes")}'/>
       <a href="#" title="{__('disable')}" id="{$site->getSiteID()}-Disabled" style="opacity:0.5" class="{$site->getSiteID()}-actions_items"><img  src="{url('/icons/NO.gif','picture')}" alt='{__("no")}'/></a>
      <a href="#" title="{__('delete')}" id="{$site->getSiteID()}-Delete" style="opacity:0.5" class="{$site->getSiteID()}-actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
  {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class=$site->getSiteID()}
<script type="text/javascript">
        
        function changeSite{$site->getSiteKey()}GroupState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.{$site->getSiteID()}-ChangeGroup#"+this;
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
        
        function getSite{$site->getSiteKey()}GroupsFilterParameters()
        {
            params={ filter: {  order : { }, 
                                     search: { 
                                               is_active : $("[name={$site->getSiteID()}-is_active]").val(),
                                               application: $("[name={$site->getSiteID()}-application] option:selected").val()
                                             }, 
                                     nbitemsbypage: $("[name={$site->getSiteID()}-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".{$site->getSiteID()}-order_active").attr("name")] =$(".{$site->getSiteID()}-order_active").attr("id");
            $(".{$site->getSiteID()}-search").each(function() { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}GroupsFilter()
        {
           return $.ajax2({ data: getSite{$site->getSiteKey()}GroupsFilterParameters(),                          
                            url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            target: "#{$site->getSiteID()}-actions" });
        }
        
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-pager .{$site->getSiteID()}-active").html()?parseInt($(".{$site->getSiteID()}-pager .{$site->getSiteID()}-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-groups-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-nb_results").html())-n;
           $("#{$site->getSiteID()}-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-end_result").html($(".{$site->getSiteID()}-groups-count:last").html());
        }
        
       
         // {* PAGER - begin *}
         $('.{$site->getSiteID()}-order').click(function() {
             $(".{$site->getSiteID()}-order_active").attr('class','{$site->getSiteID()}-order');
             $(this).attr('class','{$site->getSiteID()}-order_active');
             return updateSite{$site->getSiteKey()}GroupsFilter();
         });
         
         //{$site->getSiteID()}-search
          $("[name={$site->getSiteID()}-nbitemsbypage],[name={$site->getSiteID()}-is_active]").change(function() {
              return updateSite{$site->getSiteKey()}GroupsFilter();
          });              
          
          $(".{$site->getSiteID()}-search").keypress(function(event) {
                        if (event.keyCode==13)
                                return updateSite{$site->getSiteKey()}GroupsFilter();  
          });
                   
          $("#{$site->getSiteID()}-filter").click(function() {  return updateSite{$site->getSiteKey()}GroupsFilter(); }); 
          
          $("#{$site->getSiteID()}-init").click(function() { $.ajax2({   
                                                    url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                                    target: "#{$site->getSiteID()}-actions"}); }); 

          $(".{$site->getSiteID()}-pager").click(function () {              
                    return $.ajax2({ data:getSite{$site->getSiteKey()}GroupsFilterParameters(),
                                    url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                    target: "#{$site->getSiteID()}-actions"});
          });
                    
          // {* PAGER - end *}         
           
          // {* ACTIONS - begin *}
          
          $("#{$site->getSiteID()}-Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".{$site->getSiteID()}-selection:checked").each(function (id) { 
                params.selection[id]=this.name;
                text+=this.id+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm("{__('Groups :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ data: params,
                               url:"{url_to('users_guard_ajax',['action'=>'DeletesGroup'])}" , 
                               success :function(resp) {
                                        if (resp.action=='deleteGroups')
                                        {                                    
                                            if ($(".{$site->getSiteID()}-groups").length-resp.parameters.length==0)
                                               return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                                                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                                                target: "#{$site->getSiteID()}-actions"});
                                            $.each(resp.parameters, function () {  $("tr#group_"+this).remove(); });
                                            updateSite{$site->getSiteKey()}Pager(resp.parameters.length); 
                                            $("input#{$site->getSiteID()}-all").attr("checked",false);                                    
                                        }       
                               }
             });    
          });
          
          
          
          $(".{$site->getSiteID()}-Delete").click( function () { 
                if (!confirm('{__("Group \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({ data :{ Group: this.id },
                          url:"{url_to('users_guard_ajax',['action'=>'DeleteGroup'])}" , 
                          loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                          errorTarget: ".{$site->getSiteID()}-site-errors",
                          success: function(resp) {
                            if (resp.action=='deleteGroup')
                            {    
                                if ($(".{$site->getSiteID()}-groups").length-1==0)
                                   return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                                    target: "#{$site->getSiteID()}-actions"});
                                $("tr#{$site->getSiteID()}-group-"+resp.id).remove(); 
                                updateSite{$site->getSiteKey()}Pager(1);
                            }
                          }
                        }); 
          });
          
          $(".{$site->getSiteID()}-View").click( function () { 
             return $.ajax2({   data :{ id: this.id },
                                url:"{url_to('users_guard_ajax',['action'=>'ViewGroup'])}" , 
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
          });
          
          $("#{$site->getSiteID()}-New").click( function () { 
             return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'NewGroup'])}" , 
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              target: "#{$site->getSiteID()}-actions"});
          });
          
          $(".{$site->getSiteID()}-ChangeGroup").click( function () { 
                return $.ajax2({ data : { id: this.id , value:this.name },
                          url:"{url_to('users_guard_ajax',['action'=>'ChangeGroup'])}" , 
                          loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                          errorTarget: ".{$site->getSiteID()}-site-errors",    
                          success: function(resp) { 
                                         if (resp.action=='ChangeGroup')
                                            changeSite{$site->getSiteKey()}GroupState(resp);
                                      }
                         });
          });
          
          $(".{$site->getSiteID()}-ViewPermissions").click( function () { 
                 return $.ajax2({ data : { group: this.id },
                                           url:"{url_to('users_guard_ajax',['action'=>'ListPermissionsGroup'])}" , 
                                           loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                            errorTarget: ".{$site->getSiteID()}-site-errors",
                                            target: "#{$site->getSiteID()}-actions"});
          });
          
          $("#EnabledGroups,#DisabledGroups").click( function () { 
                var params={ groups : { selection : {  } , value :(this.id=='DisabledGroups'?'NO':'YES'),token: "{mfForm::getToken('changeGroupsForm')}" } };
                idx=0;
                $(".{$site->getSiteID()}-selection:checked").each(function (id) { 
                    if ($(".{$site->getSiteID()}-ChangeGroup#"+this.name).attr('name')!=params.groups.value)
                       params.groups.selection[idx++]= this.name;
                });
                if ($.isEmptyObject(params.groups.selection))
                   return ;
                return $.ajax2({ data: params ,
                                 url:"{url_to('users_guard_ajax',['action'=>'ChangesGroup'])}" , 
                                 success :function(resp) { 
                                                 if (resp.action=='ChangeGroups')
                                                   changeSite{$site->getSiteKey()}GroupState(resp);
                                             }
                });
          });
          
          $(".{$site->getSiteID()}-selection,#{$site->getSiteID()}-all").click(function (){               
                $(".{$site->getSiteID()}-actions_items").css('opacity',($(".{$site->getSiteID()}-selection:checked").length?'1':'0.5'));
         });
         
          $("#{$site->getSiteID()}-all").click(function () {  $(".{$site->getSiteID()}-selection").attr("checked",($(this).attr("checked")=="checked"));  });
         

</script>