{messages class="site-errors"}
<h3>{__('Teams')}</h3>    
<div>
  {if $user->hasCredential([['superadmin','admin','settings_user_team_new']])}  
  <a href="#" id="UserTeam-New" title="{__('new team')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New team')}</a>   
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="UserTeam"}
<button id="UserTeam-filter">{__("Filter")}</button>   <button id="UserTeam-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
      {*  <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="UserTeam-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserTeam-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>   *}         
        </th>
           <th>
            <span>{__('name')|capitalize}</span>      
            <div>
                <a href="#" class="UserTeam-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserTeam-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
  {*     <td>{* id *}
  {* </td>        *}
       <td>{* name *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="UserTeam" id="UserTeam-{$item->get('id')}"> 
        <td class="UserTeam-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="UserTeam-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                       
                </td>
            {/if}
          {*  <td><span>{$item->get('id')}</span></td>   *}
            <td>               
                     {$item->get('name')}      
            </td>            
            <td>     
                 {if $user->hasCredential([['superadmin','admin','settings_user_team_view']])}  
                <a href="#" title="{__('edit')}" class="UserTeam-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
               {/if}
                {if $user->hasCredential([['superadmin','admin','settings_user_team_user_list']])}  
                <a href="#" title="{__('users')}" class="UserTeam-ViewUsers" id="{$item->get('id')}">
                     <img height="16px" width="16px" src="{url('/icons/team32x32.png','picture')}" alt='{__("edit")}'/></a> 
                {/if}
                 {if $user->hasCredential([['superadmin','admin','settings_user_team_delete']])}  
                <a href="#" title="{__('delete')}" class="UserTeam-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a> 
                {/if}   
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No team')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="UserTeam-all" /> 
          <a style="opacity:0.5" class="UserTeam-actions_items" href="#" title="{__('delete')}" id="UserTeam-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="UserTeam"}
<script type="text/javascript">
 
        function getSiteTeamFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                       
                                nbitemsbypage: $("[name=UserTeam-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".UserTeam-order_active").attr("name"))
                 params.filter.order[$(".UserTeam-order_active").attr("name")] =$(".UserTeam-order_active").attr("id");   
            $(".UserTeam-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteTeamFilter()
        {        
           return $.ajax2({ data: getSiteTeamFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'ListPartialTeam'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".UserTeam-pager .UserTeam-active").html()?parseInt($(".UserTeam-pager .UserTeam-active").html()):1;
           records_by_page=$("[name=UserTeam-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".UserTeam-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#UserTeam-nb_results").html())-n;
           $("#UserTeam-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#UserTeam-end_result").html($(".Team-count:last").html());
        }                    
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#UserTeam-init").click(function() {                
               $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialTeam'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.UserTeam-order').click(function() {
                $(".UserTeam-order_active").attr('class','UserTeam-order');
                $(this).attr('class','UserTeam-order_active');
                return updateSiteTeamFilter();
           });
           
            $(".UserTeam-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteTeamFilter();
            });
            
          $("#UserTeam-filter").click(function() { return updateSiteTeamFilter(); }); 
          
          $("[name=UserTeam-nbitemsbypage]").change(function() { return updateSiteTeamFilter(); }); 
          
           
           $(".UserTeam-pager").click(function () {                     
                return $.ajax2({ data: getSiteTeamFilterParameters(), 
                                 url:"{url_to('users_ajax',['action'=>'ListPartialTeam'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#UserTeam-New").click( function () {            
            return $.ajax2({                
                url: "{url_to('users_ajax',['action'=>'NewTeam'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".UserTeam-View").click( function () {                
                return $.ajax2({ data : { UserTeam : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewTeam'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
         $(".UserTeam-ViewUsers").click( function () {                
                return $.ajax2({ data : { UserTeam : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewTeamUsers'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".UserTeam-Delete").click( function () { 
                if (!confirm('{__("Team \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserTeam: $(this).attr('id') },
                                 url :"{url_to('users_ajax',['action'=>'DeleteTeam'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteUserTeam')
                                       {    
                                          $("tr#UserTeam-"+resp.id).remove();  
                                          if ($('.UserTeam').length==0)
                                              return $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialTeam'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>       