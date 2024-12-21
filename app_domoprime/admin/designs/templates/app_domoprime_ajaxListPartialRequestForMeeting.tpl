{messages class="site-errors"}
<h3>{__('Calculation')}</h3>    
{if $meeting->isLoaded()}
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeCalculation"}
<button id="DomoprimeCalculation-filter" class="btn-table" >{__("filter")|capitalize}</button>   <button id="DomoprimeCalculation-init" class="btn-table">{__("init")|capitalize}</button>
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
    <tr class="DomoprimeCalculation list" id="DomoprimeCalculation-{$item->get('id')}"> 
        <td class="DomoprimeCalculation-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
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
                <a href="#" title="{__('Edit')}" class="DomoprimeCalculation-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                        
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No sector')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeCalculation-all" /> 
          <a style="opacity:0.5" class="DomoprimeCalculation-actions_items" href="#" title="{__('Delete')}" id="DomoprimeCalculation-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeCalculation"}
<script type="text/javascript">
 
        function getSiteDomoprimeCalculationFilterParameters()
        {
            var params={   Meeting: '{$meeting->get('id')}' ,
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeCalculation-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeCalculation-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeCalculation-order_active").attr("name")] =$(".DomoprimeCalculation-order_active").attr("id");   
            $(".DomoprimeCalculation-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeCalculationFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeCalculationFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRequestForMeeting'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-site-x-settings-loading",
                            target: "#tab-customer-meetings-requests-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeCalculation-pager .DomoprimeCalculation-active").html()?parseInt($(".DomoprimeCalculation-pager .DomoprimeCalculation-active").html()):1;
           records_by_page=$("[name=DomoprimeCalculation-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeCalculation-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeCalculation-nb_results").html())-n;
           $("#DomoprimeCalculation-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeCalculation-end_result").html($(".DomoprimeCalculation-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeCalculation-init").click(function() {                  
               $.ajax2({ data : { Meeting: '{$meeting->get('id')}' },
                         url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRequestForMeeting'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-site-x-settings-loading",                         
                         target: "#tab-customer-meetings-requests-{$meeting->get('id')}"}); 
           }); 
    
          $('.DomoprimeCalculation-order').click(function() {
                $(".DomoprimeCalculation-order_active").attr('class','DomoprimeCalculation-order');
                $(this).attr('class','DomoprimeCalculation-order_active');
                return updateSiteDomoprimeCalculationFilter();
           });
           
            $(".DomoprimeCalculation-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeCalculationFilter();
            });
            
          $("#DomoprimeCalculation-filter").click(function() { return updateSiteDomoprimeCalculationFilter(); }); 
          
          $("[name=DomoprimeCalculation-nbitemsbypage]").change(function() { return updateSiteDomoprimeCalculationFilter(); }); 
          
         // $("[name=DomoprimeCalculation-name]").change(function() { return updateSiteDomoprimeCalculationFilter(); }); 
           
           $(".DomoprimeCalculation-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeCalculationFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRequestForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 target: "#tab-customer-meetings-requests-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
             
     
         
	  $('.footable').footable();
	
</script>    

{else}
    {__('Meeting is invalid')}
{/if}    