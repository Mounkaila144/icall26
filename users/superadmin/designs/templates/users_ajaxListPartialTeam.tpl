{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Teams')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-UserTeam-New" title="{__('new team')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New team')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-UserTeam"}
<button id="{$site->getSiteID()}-UserTeam-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-UserTeam-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-UserTeam-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserTeam-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>            
        </th>
           <th>
            <span>{__('name')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-UserTeam-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserTeam-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>        
       <td>{* name *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-UserTeam" id="{$site->getSiteID()}-UserTeam-{$item->get('id')}"> 
        <td class="{$site->getSiteID()}-UserTeam-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="{$site->getSiteID()}-UserTeam-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                       
                </td>
            {/if}
            <td><span>{$item->get('id')}</span></td>               
            <td>               
                     {$item->get('name')}      
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-UserTeam-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('users')}" class="{$site->getSiteID()}-UserTeam-ViewUsers" id="{$item->get('id')}">
                     <img height="16px" width="16px" src="{url('/icons/team32x32.png','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-UserTeam-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>                
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No team')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-UserTeam-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-UserTeam-actions_items" href="#" title="{__('delete')}" id="UserTeam-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-UserTeam"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}TeamFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                       
                                nbitemsbypage: $("[name={$site->getSiteID()}-UserTeam-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-UserTeam-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-UserTeam-order_active").attr("name")] =$(".{$site->getSiteID()}-UserTeam-order_active").attr("id");   
            $(".{$site->getSiteID()}-UserTeam-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}TeamFilter()
        {        
           return $.ajax2({ data: getSite{$site->getSiteKey()}TeamFilterParameters(), 
                            url:"{url_to('users_site_ajax',['action'=>'ListPartialTeam'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-UserTeam-pager .UserTeam-active").html()?parseInt($(".{$site->getSiteID()}-UserTeam-pager .UserTeam-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-UserTeam-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-UserTeam-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-UserTeam-nb_results").html())-n;
           $("#{$site->getSiteID()}-UserTeam-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-UserTeam-end_result").html($(".{$site->getSiteID()}-Team-count:last").html());
        }                    
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-UserTeam-init").click(function() {                
               $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartialTeam'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-UserTeam-order').click(function() {
                $(".{$site->getSiteID()}-UserTeam-order_active").attr('class','{$site->getSiteID()}-UserTeam-order');
                $(this).attr('class','{$site->getSiteID()}-UserTeam-order_active');
                return updateSite{$site->getSiteKey()}TeamFilter();
           });
           
            $(".{$site->getSiteID()}-UserTeam-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}TeamFilter();
            });
            
          $("#{$site->getSiteID()}-UserTeam-filter").click(function() { return updateSite{$site->getSiteKey()}TeamFilter(); }); 
          
          $("[name={$site->getSiteID()}-UserTeam-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}TeamFilter(); }); 
          
           
           $(".{$site->getSiteID()}-UserTeam-pager").click(function () {                     
                return $.ajax2({ data: getSite{$site->getSiteKey()}TeamFilterParameters(), 
                                 url:"{url_to('users_site_ajax',['action'=>'ListPartialTeam'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-UserTeam-New").click( function () {            
            return $.ajax2({                
                url: "{url_to('users_site_ajax',['action'=>'NewTeam'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-UserTeam-View").click( function () {                
                return $.ajax2({ data : { UserTeam : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('users_site_ajax',['action'=>'ViewTeam'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
         
         $(".{$site->getSiteID()}-UserTeam-ViewUsers").click( function () {                
                return $.ajax2({ data : { UserTeam : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('users_site_ajax',['action'=>'ViewTeamUsers'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-UserTeam-Delete").click( function () { 
                if (!confirm('{__("Team \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserTeam: $(this).attr('id') },
                                 url :"{url_to('users_site_ajax',['action'=>'DeleteTeam'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteUserTeam')
                                       {    
                                          $("tr#{$site->getSiteID()}-UserTeam-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-UserTeam').length==0)
                                              return $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartialTeam'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>       