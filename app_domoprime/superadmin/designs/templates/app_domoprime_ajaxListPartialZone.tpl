{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Sectors')}</h3>    
<div>
  <a href="#" class="btn" id="{$site->getSiteID()}-DomomprimeZone-New" title="{__('New sector')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New sector')}</a>    
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-DomomprimeZone"}
<button id="{$site->getSiteID()}-DomomprimeZone-filter" class="btn-table" >{__("filter")|capitalize}</button>   <button id="{$site->getSiteID()}-DomomprimeZone-init" class="btn-table">{__("init")|capitalize}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>
       <th>&nbsp;</th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-DomomprimeZone-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-DomomprimeZone-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="{$site->getSiteID()}-DomomprimeZone list" id="{$site->getSiteID()}-DomomprimeZone-{$item->get('id')}"> 
        <td class="{$site->getSiteID()}-DomomprimeZone-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>           
                <td>                           
                    <input class="{$site->getSiteID()}-DomomprimeZone-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('dept')}"/>                       
                </td>            
            <td><span>{$item->get('id')|escape|truncate}</span></td>
            <td>                
               {$item->get('code')}    
            </td>
            <td> 
               {$item->get('dept')}
            </td>
            <td>
               {$item->get('sector')}   
            </td>                      
            <td>               
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-DomomprimeZone-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-DomomprimeZone-Delete" id="{$item->get('id')}"  name="{$item->get('dept')}">
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
        <input type="checkbox" id="{$site->getSiteID()}-DomomprimeZone-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-DomomprimeZone-actions_items" href="#" title="{__('Delete')}" id="DomomprimeZone-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-DomomprimeZone"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}DomomprimeZoneFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name={$site->getSiteID()}-DomomprimeZone-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-DomomprimeZone-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-DomomprimeZone-order_active").attr("name")] =$(".{$site->getSiteID()}-DomomprimeZone-order_active").attr("id");   
            $(".{$site->getSiteID()}-DomomprimeZone-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}DomomprimeZoneFilter()
        {           
           return $.ajax2({ data: getSite{$site->getSiteKey()}DomomprimeZoneFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-DomomprimeZone-pager .DomomprimeZone-active").html()?parseInt($(".{$site->getSiteID()}-DomomprimeZone-pager .DomomprimeZone-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-DomomprimeZone-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-DomomprimeZone-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-DomomprimeZone-nb_results").html())-n;
           $("#{$site->getSiteID()}-DomomprimeZone-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-DomomprimeZone-end_result").html($(".{$site->getSiteID()}-DomomprimeZone-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-DomomprimeZone-init").click(function() {                  
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-DomomprimeZone-order').click(function() {
                $(".{$site->getSiteID()}-DomomprimeZone-order_active").attr('class','{$site->getSiteID()}-DomomprimeZone-order');
                $(this).attr('class','{$site->getSiteID()}-DomomprimeZone-order_active');
                return updateSite{$site->getSiteKey()}DomomprimeZoneFilter();
           });
           
            $(".{$site->getSiteID()}-DomomprimeZone-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}DomomprimeZoneFilter();
            });
            
          $("#{$site->getSiteID()}-DomomprimeZone-filter").click(function() { return updateSite{$site->getSiteKey()}DomomprimeZoneFilter(); }); 
          
          $("[name={$site->getSiteID()}-DomomprimeZone-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}DomomprimeZoneFilter(); }); 
          
         // $("[name=DomomprimeZone-name]").change(function() { return updateSite{$site->getSiteKey()}DomomprimeZoneFilter(); }); 
           
           $(".{$site->getSiteID()}-DomomprimeZone-pager").click(function () {                    
                return $.ajax2({ data: getSite{$site->getSiteKey()}DomomprimeZoneFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-DomomprimeZone-New").click( function () {             
            return $.ajax2({              
                url: "{url_to('app_domoprime_ajax',['action'=>'NewZone'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-DomomprimeZone-View").click( function () {                       
                return $.ajax2({ data : { DomomprimeZone : $(this).attr('id')  },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewZone'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-DomomprimeZone-Delete").click( function () { 
                if (!confirm('{__("Sector \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomomprimeZoneI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteZone'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteZone')
                                       {    
                                          $("tr#{$site->getSiteID()}-DomomprimeZone-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-DomomprimeZone').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
     
         
	  $('.footable').footable();
	
</script>    
