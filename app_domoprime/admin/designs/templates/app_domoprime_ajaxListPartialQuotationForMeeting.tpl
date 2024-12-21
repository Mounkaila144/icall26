{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>
     {if !$meeting->getQuotations() && $meeting->isUnhold() || $user->hasCredential([['superadmin','admin','app_domoprime_meeting_list_quotation_new']])}         
  <a href="#" class="btn" id="DomoprimeQuotationForMeeting-New" title="{__('New quotation')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New quotation')}</a>     
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotationForMeeting"}
<button id="DomoprimeQuotationForMeeting-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeQuotationForMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
       {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_date']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        {/if}        
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ht']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sales HT')}</span>               
        </th>
         {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_taxe']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total Tax')}</span>               
        </th>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ttc']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sale TTC')}</span>               
        </th>   
        {/if}
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created by')}</span>  
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_status']])}
            <th data-hide="phone" style="display: table-cell;">
            <span>{__('Status')}</span>  
        </th> 
        {/if}
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
        <td>{* id *}        
        </td>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_date']])}
           <td>{* id *}</td>
           {/if}
       <td>{* id *}</td>
       {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ht']])}
         <td>{* id *}</td>
        {/if}        
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_taxe']])}  
          <td>{* id *}</td>
           {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ttc']])}  
       <td>{* name *}</td>     
       {/if}
        <td>{* name *}</td>   
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_status']])}
         <td>{* name *}</td> 
         {/if}
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeQuotationForMeeting list" id="DomoprimeQuotationForMeeting-{$item->get('id')}"> 
        <td class="DomoprimeQuotationForMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>        
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_date']])}
            <td>           
                {if $item->hasDatedAt()}
                    {$item->getFormatter()->getDatedAt()->getText()}
                {else}
                    {__('---')}
                {/if}
            </td>
            {/if}
            <td>                
              {$item->get('reference')}
            </td>
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ht']])}
             <td>                
               {$item->getFormattedTotalSaleWithoutTax()}
            </td>
             {/if}
                {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_taxe']])}
            <td>                
               {$item->getFormattedTotalSaleTax()}
            </td>            
            {/if}   
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ttc']])}   
            <td>
               {$item->getFormattedTotalSaleWithTax()}  
            </td>
            {/if}
            <td>
                 {if $item->hasCreator()}
                    {$item->getCreator()|upper}
                 {else}
                     {__('---')}
                 {/if}    
            </td>
            <td>
               {$item->getFormatter()->getCreatedAt()->getFormatted(['d','q'])}
            </td>
              {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_status']])} 
            <td class="DomoprimeQuotationForMeeting Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            {/if}
            <td>               
                {if $meeting->isUnhold()} 
                <a href="#" title="{__('Edit')}" class="DomoprimeQuotationForMeeting-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a> 
                {/if}     
                 <a href="#" title="{__('Display')}" class="DomoprimeQuotationForMeeting-Display" id="{$item->get('id')}">
                     <i class="fa fa-search"></i></a>                      
                <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForMeeting-ExportPdf">
                     <i class="fa fa-file-pdf-o"></i></a> 
                 {if  $user->hasCredential([['superadmin','admin','app_domoprime_meeting_view_quotation_delete']])}
                      
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotationForMeeting-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotationForMeeting-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if}                  
                  {/if}
                  {if  $user->hasCredential([['superadmin']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotationForMeeting-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-remove"></i></a> 
                  {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No quotation')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeQuotationForMeeting-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotationForMeeting-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotationForMeeting-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotationForMeeting"}
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationForMeetingFilterParameters()
        {
            var params={    Meeting: '{$meeting->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeQuotationForMeeting-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotationForMeeting-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotationForMeeting-order_active").attr("name")] =$(".DomoprimeQuotationForMeeting-order_active").attr("id");   
            $(".DomoprimeQuotationForMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationForMeetingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationForMeetingFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-quotations-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotationForMeeting-pager .DomoprimeQuotationForMeeting-active").html()?parseInt($(".DomoprimeQuotationForMeeting-pager .DomoprimeQuotationForMeeting-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotationForMeeting-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotationForMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotationForMeeting-nb_results").html())-n;
           $("#DomoprimeQuotationForMeeting-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotationForMeeting-end_result").html($(".DomoprimeQuotationForMeeting-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForMeeting-init").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-quotations-{$meeting->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeQuotationForMeeting-order').click(function() {
                $(".DomoprimeQuotationForMeeting-order_active").attr('class','DomoprimeQuotationForMeeting-order');
                $(this).attr('class','DomoprimeQuotationForMeeting-order_active');
                return updateSiteDomoprimeQuotationForMeetingFilter();
           });
           
            $(".DomoprimeQuotationForMeeting-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationForMeetingFilter();
            });
            
          $("#DomoprimeQuotationForMeeting-filter").click(function() { return updateSiteDomoprimeQuotationForMeetingFilter(); }); 
          
          $("[name=DomoprimeQuotationForMeeting-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationForMeetingFilter(); }); 
          
         // $("[name=DomoprimeQuotationForMeeting-name]").change(function() { return updateSiteDomoprimeQuotationForMeetingFilter(); }); 
           
           $(".DomoprimeQuotationForMeeting-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationForMeetingFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-loading",
                                target: "#tab-customer-meetings-quotations-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeQuotationForMeeting-New").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'NewQuotationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-quotations-{$meeting->get('id')}" 
                         }); 
           });
           
           
           $(".DomoprimeQuotationForMeeting-View").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ViewQuotationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-quotations-{$meeting->get('id')}" 
                         }); 
           });
           
           
            $(".DomoprimeQuotationForMeeting-Display").click(function() {                  
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisplayQuotationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-quotations-{$meeting->get('id')}" 
                         }); 
           });
           
           
           
             $(".DomoprimeQuotationForMeeting-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                              errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotationForMeeting-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotationForMeeting-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotationForMeeting.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotationForMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotationForMeeting-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotationForMeeting-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotationForMeeting-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotationForMeeting.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotationForMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
</script>    
{else}
    {__('Meeting is invalid.')}
{/if}    
  
