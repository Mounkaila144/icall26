{messages class="site-errors"}
<h3>{__('Partner layers')}</h3>    
<div>
  <a href="#" class="btn" id="PartnerLayerCompany-New" title="{__('New Layer')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New layer')}</a>    
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="PartnerLayerCompany"}
<button id="PartnerLayerCompany-filter" class="btn-table" style="width:auto">{__("Filter")}</button>   
<button id="PartnerLayerCompany-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>      
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>
            <div>
                <a href="#" class="PartnerLayerCompany-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="PartnerLayerCompany-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Post code')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('City')}</span>  

        </th>  
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Phone')}</span>               
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Default?')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Active')}</span>  

        </th>  
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
       <td>{* name *}
           <input type="text" class="PartnerLayerCompany-search" style="height: 15px;" name="name"  value="{$formFilter.search.name}">
       </td>
       <td>{* post code *}
            <input type="text" class="PartnerLayerCompany-search" style="height: 15px;" name="postcode"  value="{$formFilter.search.postcode}">
       </td>
       <td>{* city *}
           <input type="text" class="PartnerLayerCompany-search" style="height: 15px;" name="city" value="{$formFilter.search.city}">
       </td>  
       <td>{* phone *}
           <input type="text" class="PartnerLayerCompany-search" style="height: 15px;" name="phone"  value="{$formFilter.search.phone}">
       </td>
       <td>{* state *}
       </td> 
        <td>{* state *}
       </td> 
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="PartnerLayerCompany list" id="PartnerLayerCompany-{$item->get('id')}"> 
        <td class="PartnerLayerCompany-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                     
            <td>                
               {$item->get('name')}    
            </td>
            <td> 
               {if $item->get('postcode')}
                {$item->get('postcode')}
                {else}
                        {__('---')}
                {/if}
            </td>
            <td>
               {if $item->get('city')}
                {$item->get('city')}  
                {else}
                        {__('---')}
                {/if}
            </td> 
            <td>
                {if $item->get('phone')}
                    {$item->get('phone')} 
                {else}
                    {__('---')}
                {/if}
            </td> 
            <td>
                  {__($item->get('is_default'))} 
            </td>    
            <td>
                {__($item->get('is_active'))} 
            </td> 
            <td>               
                <a href="#" title="{__('Edit')}" class="PartnerLayerCompany-View" id="{$item->get('id')}">
                     <i class="fa fa-edit" style="font-size: 16px;"></i></a>   
                       <a href="#" title="{__('Contacts')}" class="PartnerLayerCompany-Contacts" id="{$item->get('id')}">
                      <i class="fa fa-users" style="font-size: 16px;"></i></a>   
                <a href="#" title="{__('Delete')}" class="PartnerLayerCompany-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                   <i class="fa fa-remove" style="font-size: 16px;"></i>
                </a>              
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No partner layer')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="PartnerLayerCompany-all" /> 
          <a style="opacity:0.5" class="PartnerLayerCompany-actions_items" href="#" title="{__('Delete')}" id="DomomprimeZone-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="PartnerLayerCompany"}
<script type="text/javascript">
 
        function getSitePartnerLayerCompanyFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=PartnerLayerCompany-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".PartnerLayerCompany-order_active").attr("name"))
                 params.filter.order[$(".PartnerLayerCompany-order_active").attr("name")] =$(".PartnerLayerCompany-order_active").attr("id");   
            $(".PartnerLayerCompany-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSitePartnerLayerCompanyFilter()
        {           
           return $.ajax2({ data: getSitePartnerLayerCompanyFilterParameters(), 
                            url:"{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".PartnerLayerCompany-pager .PartnerLayerCompany-active").html()?parseInt($(".PartnerLayerCompany-pager .PartnerLayerCompany-active").html()):1;
           records_by_page=$("[name=PartnerLayerCompany-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".PartnerLayerCompany-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#PartnerLayerCompany-nb_results").html())-n;
           $("#PartnerLayerCompany-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#PartnerLayerCompany-end_result").html($(".PartnerLayerCompany-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#PartnerLayerCompany-init").click(function() {                  
               $.ajax2({ url:"{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"}); 
           }); 
    
          $('.PartnerLayerCompany-order').click(function() {
                $(".PartnerLayerCompany-order_active").attr('class','PartnerLayerCompany-order');
                $(this).attr('class','PartnerLayerCompany-order_active');
                return updateSitePartnerLayerCompanyFilter();
           });
           
            $(".PartnerLayerCompany-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSitePartnerLayerCompanyFilter();
            });
            
          $("#PartnerLayerCompany-filter").click(function() { return updateSitePartnerLayerCompanyFilter(); }); 
          
          $("[name=PartnerLayerCompany-nbitemsbypage]").change(function() { return updateSitePartnerLayerCompanyFilter(); }); 
          
         // $("[name=PartnerLayerCompany-name]").change(function() { return updateSitePartnerLayerCompanyFilter(); }); 
           
           $(".PartnerLayerCompany-pager").click(function () {                    
                return $.ajax2({ data: getSitePartnerLayerCompanyFilterParameters(), 
                                url:"{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#PartnerLayerCompany-New").click( function () {             
            return $.ajax2({              
                url: "{url_to('partners_layer_ajax',['action'=>'NewLayer'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".PartnerLayerCompany-View").click( function () {                       
                return $.ajax2({ data : { PartnerLayer : $(this).attr('id')  },
                                url :"{url_to('partners_layer_ajax',['action'=>'ViewLayerCompany'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         });
                    
         
          $(".PartnerLayerCompany-Delete").click( function () { 
                if (!confirm('{__("Partner Layer \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ PartnerLayer: $(this).attr('id') },
                                url :"{url_to('partners_layer_ajax',['action'=>'DeleteLayer'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteLayer')
                                       {    
                                          $("tr#PartnerLayerCompany-"+resp.id).remove();  
                                          if ($('.PartnerLayerCompany').length==0)
                                            return $.ajax2({ url:"{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}",
                                            errorTarget: ".site-servers-errors",
                                            loading: "#tab-site-dashboard-x-settings-loading"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
      $(".PartnerLayerCompany-Contacts").click( function () {              
                return $.ajax2({ data : { PartnerLayer : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('partners_layer_ajax',['action'=>'ListPartnerContact'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                
</script>    

