{messages class="site-errors"}
<h3>{__('Subvention types')}</h3>    
<div>
  <a href="#" class="btn" id="DomomprimeType-New" title="{__('New type')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New type')}</a>    
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomomprimeType"}
<button id="DomomprimeType-filter" class="btn-table" >{__("filter")|capitalize}</button>   <button id="DomomprimeType-init" class="btn-table">{__("init")|capitalize}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>      
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('id')}</span>
            <div>
                <a href="#" class="DomomprimeType-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomomprimeType-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>               
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Commercial')}</span>               
        </th>                   
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>           
       <td>{* color *}</td>
       <td>{* icon *}</td>  
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomomprimeType list" id="DomomprimeType-{$item->get('id')}"> 
        <td class="DomomprimeType-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                     
            <td><span>{$item->get('id')|escape}</span></td>
            <td>                
               {$item->get('name')}    
            </td>
            <td> 
               {$item->get('commercial')}   
            </td>                      
            <td>               
                <a href="#" title="{__('Edit')}" class="DomomprimeType-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('Delete')}" class="DomomprimeType-Delete" id="{$item->get('id')}"  name="{$item->get('dept')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>              
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No type')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomomprimeType-all" /> 
          <a style="opacity:0.5" class="DomomprimeType-actions_items" href="#" title="{__('Delete')}" id="DomomprimeType-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomomprimeType"}
<script type="text/javascript">
 
        function getSiteDomomprimeTypeFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomomprimeType-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomomprimeType-order_active").attr("name"))
                 params.filter.order[$(".DomomprimeType-order_active").attr("name")] =$(".DomomprimeType-order_active").attr("id");   
            $(".DomomprimeType-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomomprimeTypeFilter()
        {           
           return $.ajax2({ data: getSiteDomomprimeTypeFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialType'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-site-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomomprimeType-pager .DomomprimeType-active").html()?parseInt($(".DomomprimeType-pager .DomomprimeType-active").html()):1;
           records_by_page=$("[name=DomomprimeType-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomomprimeType-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomomprimeType-nb_results").html())-n;
           $("#DomomprimeType-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomomprimeType-end_result").html($(".DomomprimeType-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomomprimeType-init").click(function() {                  
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialType'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-site-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomomprimeType-order').click(function() {
                $(".DomomprimeType-order_active").attr('class','DomomprimeType-order');
                $(this).attr('class','DomomprimeType-order_active');
                return updateSiteDomomprimeTypeFilter();
           });
           
            $(".DomomprimeType-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomomprimeTypeFilter();
            });
            
          $("#DomomprimeType-filter").click(function() { return updateSiteDomomprimeTypeFilter(); }); 
          
          $("[name=DomomprimeType-nbitemsbypage]").change(function() { return updateSiteDomomprimeTypeFilter(); }); 
          
         // $("[name=DomomprimeType-name]").change(function() { return updateSiteDomomprimeTypeFilter(); }); 
           
           $(".DomomprimeType-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomomprimeTypeFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialType'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomomprimeType-New").click( function () {             
            return $.ajax2({              
                url: "{url_to('app_domoprime_ajax',['action'=>'NewType'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-site-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".DomomprimeType-View").click( function () {                       
                return $.ajax2({ data : { DomoprimeSubventionType : $(this).attr('id')  },
                                loading: "#tab-site-dashboard-site-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewType'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomomprimeType-Delete").click( function () { 
                if (!confirm('{__("Sector \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeSubventionType: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteType'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteType')
                                       {    
                                          $("tr#DomomprimeType-"+resp.id).remove();  
                                          if ($('.DomomprimeType').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialType'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
     
         
	  $('.footable').footable();
	
</script>    
