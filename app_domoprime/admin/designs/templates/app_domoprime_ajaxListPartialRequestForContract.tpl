{messages class="site-errors"}
<h3>{__('Calculation')}</h3>    
{if $contract->isLoaded()}
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeCalculationForContract"}
<button id="DomoprimeCalculationForContract-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeCalculationForContract-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>     
      <th  class="footable-first-column" data-toggle="true">
            <span>{__('Region')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Zone')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Sector')}</span>               
        </th>
            <th  class="footable-first-column" data-toggle="true">
            <span>{__('Energy')}</span>               
        </th>
          </th>
            <th  class="footable-first-column" data-toggle="true">
            <span>{__('Class')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Revenue')}</span>               
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Number of people')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Qmarc')}</span>  

        </th> 
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Qmarc value')}</span>  

        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('By')}</span>  

        </th> 
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Validated By')}</span>  
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
       <td>{* id *}</td>
         <td>{* id *}</td>
          <td>{* id *}</td>
       <td>{* name *}</td>
       <td>{* color *}</td>
        <td>{* color *}</td>
        <td>{* color *}</td>
       <td>{* icon *}</td>  
       <td>{* icon *}</td>  
       <td>{* icon *}</td>  
       <td>{* icon *}</td>  
       <td>{* actions *}</td>
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeCalculationForContract list" id="DomoprimeCalculationForContract-{$item->get('id')}"> 
        <td class="DomoprimeCalculationForContract-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
              {$item->getRegion()->get('name')}
            </td>
            <td>                
              {$item->getZone()->get('code')}
            </td>
             <td>                    
              {$item->getSector()->get('name')}
            </td>
             <td>                    
              {$item->getEnergy()->getI18n()}
            </td>
              <td>                    
              {$item->getClass()->getI18n()}
            </td>
             <td>                
              {$item->get('revenue')}
            </td>
            <td> 
              {$item->get('number_of_people')}
            </td>
            <td>
              {$item->get('qmac')}
            </td>  
                <td>
                 {$item->get('qmac_value')}
            </td> 
                 <td>
                 {$item->getUser()|upper}
            </td> 
                 <td>
                     {if $item->hasAcceptedBy()}
                        {$item->getAcceptedBy()|upper}
                     {else}
                         {__('No validator')}
                     {/if}    
            </td> 
            <td>
                {$item->get('created_at')}
            </td>
            <td>               
               {* <a href="#" title="{__('Edit')}" class="DomoprimeCalculationForContract-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>  *}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No sector')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeCalculationForContract-all" /> 
          <a style="opacity:0.5" class="DomoprimeCalculationForContract-actions_items" href="#" title="{__('Delete')}" id="DomoprimeCalculationForContract-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeCalculationForContract"}
<script type="text/javascript">
 
        function getSiteDomoprimeCalculationForContractFilterParameters()
        {
            var params={   Contract: '{$contract->get('id')}' ,
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeCalculationForContract-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeCalculationForContract-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeCalculationForContract-order_active").attr("name")] =$(".DomoprimeCalculationForContract-order_active").attr("id");   
            $(".DomoprimeCalculationForContract-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeCalculationForContractFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeCalculationForContractFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRequestForContract'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-site-x-settings-loading",
                            target: "#tab-customer-meetings-requests-{$contract->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeCalculationForContract-pager .DomoprimeCalculationForContract-active").html()?parseInt($(".DomoprimeCalculationForContract-pager .DomoprimeCalculationForContract-active").html()):1;
           records_by_page=$("[name=DomoprimeCalculationForContract-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeCalculationForContract-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeCalculationForContract-nb_results").html())-n;
           $("#DomoprimeCalculationForContract-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeCalculationForContract-end_result").html($(".DomoprimeCalculationForContract-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeCalculationForContract-init").click(function() {                  
               $.ajax2({ data : { Contract: '{$contract->get('id')}' },
                         url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRequestForContract'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-site-x-settings-loading",                         
                         target: "#tab-customer-contracts-requests-{$contract->get('id')}"}); 
           }); 
    
          $('.DomoprimeCalculationForContract-order').click(function() {
                $(".DomoprimeCalculationForContract-order_active").attr('class','DomoprimeCalculationForContract-order');
                $(this).attr('class','DomoprimeCalculationForContract-order_active');
                return updateSiteDomoprimeCalculationForContractFilter();
           });
           
            $(".DomoprimeCalculationForContract-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeCalculationForContractFilter();
            });
            
          $("#DomoprimeCalculationForContract-filter").click(function() { return updateSiteDomoprimeCalculationForContractFilter(); }); 
          
          $("[name=DomoprimeCalculationForContract-nbitemsbypage]").change(function() { return updateSiteDomoprimeCalculationForContractFilter(); }); 
          
         // $("[name=DomoprimeCalculationForContract-name]").change(function() { return updateSiteDomoprimeCalculationForContractFilter(); }); 
           
           $(".DomoprimeCalculationForContract-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeCalculationForContractFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRequestForContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 target: "#tab-customer-contracts-requests-{$contract->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
             
     
         
	  $('.footable').footable();
	
</script>    

{else}
    {__('Meeting is invalid')}
{/if}    
