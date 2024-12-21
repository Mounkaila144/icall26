{messages class="site-errors"}
<h3>{__('Sectors')}</h3>    
<div>
  <a href="#" class="btn" id="DomomprimeZone-New" title="{__('New sector')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New sector')}</a>    
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomomprimeZone"}
<button id="DomomprimeZone-filter" class="btn-table" >{__("filter")|capitalize}</button>   <button id="DomomprimeZone-init" class="btn-table">{__("init")|capitalize}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>
       <th>&nbsp;</th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="DomomprimeZone-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomomprimeZone-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Code')}</span>               
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Department')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Zone')}</span>  

        </th>               
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
       <td></td>
       <td>{* id *}</td>
       <td>{* name *}</td>
       <td>{* color *}</td>
       <td>{* icon *}</td>  
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomomprimeZone list" id="DomomprimeZone-{$item->get('id')}"> 
        <td class="DomomprimeZone-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>           
                <td>                           
                    <input class="DomomprimeZone-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('dept')}"/>                       
                </td>            
            <td><span>{$item->get('id')|escape|truncate}</span></td>
            <td>                
               {$item->get('code')}    
            </td>
            <td> 
               {$item->get('dept')}
            </td>
            <td>
               {$item->getSector()->get('name')}   
            </td>                      
            <td>               
                <a href="#" title="{__('edit')}" class="DomomprimeZone-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('delete')}" class="DomomprimeZone-Delete" id="{$item->get('id')}"  name="{$item->get('dept')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>              
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No sector')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomomprimeZone-all" /> 
          <a style="opacity:0.5" class="DomomprimeZone-actions_items" href="#" title="{__('Delete')}" id="DomomprimeZone-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomomprimeZone"}
<script type="text/javascript">
 
        function getSiteDomomprimeZoneFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomomprimeZone-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomomprimeZone-order_active").attr("name"))
                 params.filter.order[$(".DomomprimeZone-order_active").attr("name")] =$(".DomomprimeZone-order_active").attr("id");   
            $(".DomomprimeZone-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomomprimeZoneFilter()
        {           
           return $.ajax2({ data: getSiteDomomprimeZoneFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-site-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomomprimeZone-pager .DomomprimeZone-active").html()?parseInt($(".DomomprimeZone-pager .DomomprimeZone-active").html()):1;
           records_by_page=$("[name=DomomprimeZone-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomomprimeZone-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomomprimeZone-nb_results").html())-n;
           $("#DomomprimeZone-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomomprimeZone-end_result").html($(".DomomprimeZone-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomomprimeZone-init").click(function() {                  
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-site-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomomprimeZone-order').click(function() {
                $(".DomomprimeZone-order_active").attr('class','DomomprimeZone-order');
                $(this).attr('class','DomomprimeZone-order_active');
                return updateSiteDomomprimeZoneFilter();
           });
           
            $(".DomomprimeZone-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomomprimeZoneFilter();
            });
            
          $("#DomomprimeZone-filter").click(function() { return updateSiteDomomprimeZoneFilter(); }); 
          
          $("[name=DomomprimeZone-nbitemsbypage]").change(function() { return updateSiteDomomprimeZoneFilter(); }); 
          
         // $("[name=DomomprimeZone-name]").change(function() { return updateSiteDomomprimeZoneFilter(); }); 
           
           $(".DomomprimeZone-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomomprimeZoneFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomomprimeZone-New").click( function () {             
            return $.ajax2({              
                url: "{url_to('app_domoprime_ajax',['action'=>'NewZone'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-site-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".DomomprimeZone-View").click( function () {                       
                return $.ajax2({ data : { DomomprimeZone : $(this).attr('id')  },
                                loading: "#tab-site-dashboard-site-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewZone'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomomprimeZone-Delete").click( function () { 
                if (!confirm('{__("Sector \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomomprimeZoneI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteZone'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteZone')
                                       {    
                                          $("tr#DomomprimeZone-"+resp.id).remove();  
                                          if ($('.DomomprimeZone').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
     
         
	  $('.footable').footable();
	
</script>    
