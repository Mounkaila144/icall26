{messages class="customers-meeting-app-domoprime-billing-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>
 {* <a href="#" class="btn" id="DomoprimeBillingForMeeting-New" title="{__('New billing')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New billing')}</a>       *}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeBillingForMeeting"}
<button id="DomoprimeBillingForMeeting-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeBillingForMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sales HT')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total Tax')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sale TTC')}</span>               
        </th>     
          <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>         
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>          
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>            
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
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
        <td>{* id *}        
        </td>
           <td>{* id *}</td>
       <td>{* id *}</td>
         <td>{* id *}</td>
          <td>{* id *}</td>
           <td>{* id *}</td>
            <td>{* id *}</td>
             <td>{* id *}</td>
              <td>{* id *}</td>
          <td>{* id *}</td>
       <td>{* name *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeBillingForMeeting list" id="DomoprimeBillingForMeeting-{$item->get('id')}"> 
        <td class="DomoprimeBillingForMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
             {$item->get('month')}{$item->get('year')}
            </td>
            <td>                
              {$item->get('reference')}
            </td>
             <td>                
             {$item->getFormattedTotalSaleWithoutTax()}
            </td>
            <td>    
                   {$item->getFormattedTotalSaleTax()}
            </td>                           
            </td> 
            <td>
              {$item->getFormattedTotalSaleWithTax()}   
            </td>
             <td>
              {$item->getFormattedPrime()}      
        </td>          
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>          
         <td>
             {$item->getFormattedQmac()}              
        </td>          
         <td>
              {$item->getNumberOfPeople()}                  
        </td>          
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
            <td>
              {$item->get('created_at')}
            </td>
            <td>               
                 
                <a href="#" title="{__('Edit')}" class="DomoprimeBillingForMeeting-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                        
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No billing')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeBillingForMeeting-all" /> 
          <a style="opacity:0.5" class="DomoprimeBillingForMeeting-actions_items" href="#" title="{__('Delete')}" id="DomoprimeBillingForMeeting-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeBillingForMeeting"}
<script type="text/javascript">
 
        function getSiteDomoprimeBillingForMeetingFilterParameters()
        {
            var params={    Meeting: '{$meeting->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeBillingForMeeting-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeBillingForMeeting-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeBillingForMeeting-order_active").attr("name")] =$(".DomoprimeBillingForMeeting-order_active").attr("id");   
            $(".DomoprimeBillingForMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeBillingForMeetingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeBillingForMeetingFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialBillingFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-billings-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeBillingForMeeting-pager .DomoprimeBillingForMeeting-active").html()?parseInt($(".DomoprimeBillingForMeeting-pager .DomoprimeBillingForMeeting-active").html()):1;
           records_by_page=$("[name=DomoprimeBillingForMeeting-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeBillingForMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeBillingForMeeting-nb_results").html())-n;
           $("#DomoprimeBillingForMeeting-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeBillingForMeeting-end_result").html($(".DomoprimeBillingForMeeting-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeBillingForMeeting-init").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialBillingFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-billings-{$meeting->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeBillingForMeeting-order').click(function() {
                $(".DomoprimeBillingForMeeting-order_active").attr('class','DomoprimeBillingForMeeting-order');
                $(this).attr('class','DomoprimeBillingForMeeting-order_active');
                return updateSiteDomoprimeBillingForMeetingFilter();
           });
           
            $(".DomoprimeBillingForMeeting-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeBillingForMeetingFilter();
            });
            
          $("#DomoprimeBillingForMeeting-filter").click(function() { return updateSiteDomoprimeBillingForMeetingFilter(); }); 
          
          $("[name=DomoprimeBillingForMeeting-nbitemsbypage]").change(function() { return updateSiteDomoprimeBillingForMeetingFilter(); }); 
          
         // $("[name=DomoprimeBillingForMeeting-name]").change(function() { return updateSiteDomoprimeBillingForMeetingFilter(); }); 
           
           $(".DomoprimeBillingForMeeting-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeBillingForMeetingFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialBillingFromRequestForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-loading",
                                target: "#tab-customer-meetings-iso-billings-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
         $("#DomoprimeBillingForMeeting-New").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'NewBillingFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-billings-{$meeting->get('id')}" 
                         }); 
           });  
</script>    
{else}
    {__('Meeting is invalid.')}
{/if}    
 

