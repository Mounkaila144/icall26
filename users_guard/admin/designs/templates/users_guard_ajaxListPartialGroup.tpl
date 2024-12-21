{messages class="site-errors"}
<div>
    <a id="New" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('New groups')}</a>
</div>
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
         <th>{__('state')}</th>
          <th>{__('date creation')}
                <div>
                  <a href="#" class="order{$formFilter.order.created_at->getValueExist('asc','_active')}" id="asc" name="created_at"><img  src='{url("/icons/sort_asc`$formFilter.order.created_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="order{$formFilter.order.created_at->getValueExist('desc','_active')}" id="desc" name="created_at"><img  src='{url("/icons/sort_desc`$formFilter.order.created_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
          <th>{__('date update')}
                <div>
                  <a href="#" class="order{$formFilter.order.updated_at->getValueExist('asc','_active')}" id="asc" name="updated_at"><img  src='{url("/icons/sort_asc`$formFilter.order.updated_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                  <a href="#" class="order{$formFilter.order.updated_at->getValueExist('desc','_active')}" id="desc" name="updated_at"><img  src='{url("/icons/sort_desc`$formFilter.order.updated_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>  
       
          <th>{__('actions')}</th>
     </tr>
     <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>
            <td><input class="search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td>
            <td>{html_options_format format="__" name="is_active" options=$formFilter->search.is_active->getOption('choices') selected=(string)$formFilter.search.is_active}</td> 
            <td></td>
            <td></td>            
            <td></td>
        </tr>       
        {foreach $pager as $group}
        <tr class="Groups" id="group-{$group->get('id')}">
            <td class="groups-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$group@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="selection" type="checkbox" name="{$group->getId()}" id="{$group->get('name')}"/></td>{/if}
            <td>
                {$group->get('id')}
            </td>
            <td>
                {$group->get('name')|escape}
            </td>
            <td>             
               <a href="#" title="{__('change')}" class="ChangeGroup" id="{$group->get('id')}" name="{$group->get('is_active')}"><img  src="{url('/icons/','picture')}{$group->get('is_active')}.gif" alt='{__("group_`$group->get("is_active")`")}'/></a>
            </td>
            <td>
                {$group->get('created_at')}
            </td>
            <td>
                {$group->get('updated_at')}
            </td>          
            <td>
               <a href="#" title="{__('permissions')}" class="ViewPermissions" id="{$group->get('id')}" name="{$group->get('name')}"><img  src="{url('/icons/permission.png','picture')}" alt='{__("permissions")}'/></a>
               <a href="#" title="{__('edit')}" class="View" id="{$group->get('id')}" name="{$group->get('name')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
               <a href="#" title="{__('delete')}" class="Delete" id="{$group->get('id')}" name="{$group->get('name')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()}  
     {__("no result")}
{else}
   {if $pager->getNbItems()>5}
       <input type="checkbox" id="all" />  
       <a href="#" title="{__('enable')}" id="Enabled" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/YES.gif','picture')}" alt='{__("yes")}'/>
       <a href="#" title="{__('disable')}" id="Disabled" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/NO.gif','picture')}" alt='{__("no")}'/></a>
      <a href="#" title="{__('delete')}" id="Delete" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
  {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager}
<script type="text/javascript">
        
        function changeSiteGroupState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.ChangeGroup#"+this;
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
        
        function getSiteGroupsFilterParameters()
        {
            params={ filter: {  order : { }, 
                                     search: { 
                                               is_active : $("[name=is_active]").val(),
                                               application: $("[name=application] option:selected").val()
                                             }, 
                                     nbitemsbypage: $("[name=nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");
            $(".search").each(function() { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateSiteGroupsFilter()
        {
           return $.ajax2({ data: getSiteGroupsFilterParameters(),                          
                            url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                            loading: "#tab-site-dashboard-x-settings-loading",
                            errorTarget: ".site-errors",
                            target: "#actions" });
        }
        
        function updateSitePager(n)
        {
           page_active=$(".pager . active").html()?parseInt($(".pager . active").html()):1;
           records_by_page=$("[name=nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".groups-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("# nb_results").html())-n;
           $("#nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#end_result").html($(".groups-count:last").html());
        }
        
       
         // {* PAGER - begin *}
         $('.order').click(function() {
             $(".order_active").attr('class',' order');
             $(this).attr('class','order_active');
             return updateSiteGroupsFilter();
         });
         
         // search
          $("[name=nbitemsbypage],[name=is_active]").change(function() {
              return updateSiteGroupsFilter();
          });              
          
          $(".search").keypress(function(event) {
                        if (event.keyCode==13)
                                return updateSiteGroupsFilter();  
          });
                   
          $("#filter").click(function() {  return updateSiteGroupsFilter(); }); 
          
          $("#init").click(function() { $.ajax2({   
                                                    url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                                                    loading: "#tab-site-dashboard-x-settings-loading",
                                                    errorTarget: ".site-errors",
                                                    target: "#actions"}); }); 

          $(".pager").click(function () {              
                    return $.ajax2({ data:getSiteGroupsFilterParameters(),
                                    url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                    errorTarget: ".site-errors",
                                    target: "#actions"});
          });
                    
          // {* PAGER - end *}         
           
          // {* ACTIONS - begin *}
          
          $("#Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".selection:checked").each(function (id) { 
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
                                            if ($(".groups").length-resp.parameters.length==0)
                                               return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                                                                loading: "#tab-site-dashboard-x-settings-loading",
                                                                errorTarget: ".site-errors",
                                                                target: "#actions"});
                                            $.each(resp.parameters, function () {  $("tr#group_"+this).remove(); });
                                            updateSitePager(resp.parameters.length); 
                                            $("input# all").attr("checked",false);                                    
                                        }       
                               }
             });    
          });
          
          
          
          $(".Delete").click( function () { 
                if (!confirm('{__("Group \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({ data :{ Group: this.id },
                          url:"{url_to('users_guard_ajax',['action'=>'DeleteGroup'])}" , 
                          loading: "#tab-site-dashboard-x-settings-loading",
                          errorTarget: ".site-errors",
                          success: function(resp) {
                            if (resp.action=='deleteGroup')
                            {    
                                if ($(".groups").length-1==0)
                                   return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                                                    loading: "#tab-site-dashboard-x-settings-loading",
                                                    errorTarget: ".site-errors",
                                                    target: "#actions"});
                                $("tr#group-"+resp.id).remove(); 
                                updateSitePager(1);
                            }
                          }
                        }); 
          });
          
          $(".View").click( function () { 
             return $.ajax2({   data :{ id: this.id },
                                url:"{url_to('users_guard_ajax',['action'=>'ViewGroup'])}" , 
                                loading: "#tab-site-dashboard-x-settings-loading",
                                errorTarget: ".site-errors",
                                target: "#actions"});
          });
          
          $("#New").click( function () { 
             return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'NewGroup'])}" , 
                              loading: "#tab-site-dashboard-x-settings-loading",
                              errorTarget: ".site-errors",
                              target: "#actions"});
          });
          
          $(".ChangeGroup").click( function () { 
                return $.ajax2({ data : { id: this.id , value:this.name },
                          url:"{url_to('users_guard_ajax',['action'=>'ChangeGroup'])}" , 
                          loading: "#tab-site-dashboard-x-settings-loading",
                          errorTarget: ".site-errors",    
                          success: function(resp) { 
                                         if (resp.action=='ChangeGroup')
                                            changeSiteGroupState(resp);
                                      }
                         });
          });
          
          $(".ViewPermissions").click( function () { 
                 return $.ajax2({ data : { group: this.id },
                                           url:"{url_to('users_guard_ajax',['action'=>'ListPermissionsGroup'])}" , 
                                           loading: "#tab-site-dashboard-x-settings-loading",
                                            errorTarget: ".site-errors",
                                            target: "#actions"});
          });
          
          $("#EnabledGroups,#DisabledGroups").click( function () { 
                var params={ groups : { selection : {  } , value :(this.id=='DisabledGroups'?'NO':'YES'),token: "{mfForm::getToken('changeGroupsForm')}" } };
                idx=0;
                $(".selection:checked").each(function (id) { 
                    if ($(".ChangeGroup#"+this.name).attr('name')!=params.groups.value)
                       params.groups.selection[idx++]= this.name;
                });
                if ($.isEmptyObject(params.groups.selection))
                   return ;
                return $.ajax2({ data: params ,
                                 url:"{url_to('users_guard_ajax',['action'=>'ChangesGroup'])}" , 
                                 success :function(resp) { 
                                                 if (resp.action=='ChangeGroups')
                                                   changeSiteGroupState(resp);
                                             }
                });
          });
          
          $(".selection,#all").click(function (){               
                $(".actions_items").css('opacity',($(".selection:checked").length?'1':'0.5'));
         });
         
          $("#all").click(function () {  $(".selection").attr("checked",($(this).attr("checked")=="checked"));  });
         

</script>