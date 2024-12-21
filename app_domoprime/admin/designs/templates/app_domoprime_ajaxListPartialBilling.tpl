{messages class="customers-meeting-app-domoprime-billing-errors"}
<h3>{__('Billings')}</h3> 
<div class="divFilter">
<div>
      
</div>
      <div class="filter">
       {if $pager->getNbItems()>5}&nbsp;{/if}      
                    {* date *}
       <div class="date">
           <span style=" display: inline">         
            <input placeholder="{__('Start date')}" class="DomoprimeBilling range inputWidth" id="dated_at_from" type="text" size="6" name="dated_at[from]" value="{format_date((string)$formFilter.range.dated_at.from,'a')}"/>
           </span><br>
            <span>               
                <input placeholder="{__('End date')}"  class="DomoprimeBilling range inputWidth" id="dated_at_to" type="text" size="6" name="dated_at[to]" value="{format_date((string)$formFilter.range.dated_at.to,'a')}"/>
            </span>  <br>         
            
       </div><br>
          
       <div class="">{* customer *}           
          <input class="DomoprimeBilling-search inputWidth" type="text"  placeholder="{__('Customer, Contract reference')}" size="10" name="lastname" value="{$formFilter.search.lastname}">            
       </div><br>
       
      {* <div>{* amount *}{*</div>*}
       <div class="">{* phone *}
            <input class="DomoprimeBilling-search inputWidth"  placeholder="Téléphone" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </div><br>
       <div>
            <input class="DomoprimeBilling-search inputWidth" placeholder="{__('Reference')}" type="text" size="8" name="reference" value="{$formFilter.search.reference}"> 
       </div><br>
     {*  <div class="" class="DomoprimeBilling cols postcode">
           <input class="DomoprimeBilling-begin inputWidth"  placeholder="Code postal" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}"> 
       </div><br>       
       <div class="fi" class="DomoprimeBilling cols city">
           <input class="DomoprimeBilling-search inputWidth"  placeholder="Ville" type="text" size="8"   name="city" value="{$formFilter.search.city}"> 
            <img id="field-customer-contracts-city-loading" class="loading" style="display:none;" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
       </div>   *}
        <div class="filter fi">
       <button id="DomoprimeBilling-filter" class="btn inputWidth" >{__("Filter")}</button>   
       <button id="DomoprimeBilling-init" class="btn inputWidth">{__("Init")}</button>
        </div>
         <div class="filter">           
           {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_export']])} 
            <a target="_blank" href="{url_to('app_domoprime',['action'=>'ExportCsvBillings'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range'])}" class="btn widthAFilter" title="{__('Export')}" >
            <i class="fa fa-caret-square-o-down" style="margin-right:5px"></i>{__('Export')}</a>   
     {/if}   
             
    </div>
    </div>
</div>

<div class="reste">    
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeBilling"}
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
     <th  class="footable-first-column" data-toggle="true">
            <span>{__('ID')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
        </th>
            <th  class="footable-first-column" data-toggle="true">
            <span>{__('Phone')}</span>               
        </th>
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
          {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_in_charge_after_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge after credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_tax_credit_available']])}
             <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit available')}</span>               
        </th> 
        {/if}
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
        <td>
        </td>
       <td>{* id *}</td>
       <td>{* id *}</td>
          <td>{* id *}</td>
        <td>{* id *}              
        </td>        
       <td>{* id *}</td>
         <td>{* id *}</td>
          <td>{* id *}</td>
           {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_prime']])}
         <td>
                 
        </td>  
        {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_tax_credit']])}
         <td>
           
        </td>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_qmac']])}
         <td>
               
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_number_of_people']])}
         <td>
                
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_number_of_children']])}
         <td>               
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_tax_credit_used']])}
         <td>
           
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_in_charge']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_credit_limit']])}
             <td></td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_in_charge_after_credit']])}
             <td></td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_tax_credit_available']])}
             <td></td>
        {/if}
       <td>{* name *}</td>     
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeBilling list" id="DomoprimeBilling-{$item->get('id')}"> 
        <td class="DomoprimeBilling-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
             {$item->get('id')}
            </td>
             <td>                
             {$item->getCustomer()|upper} ({$item->getContract()->get('reference')})
            </td>
             <td>                
                 <div>{$item->getCustomer()->getFormattedPhone()}</div>
                 <div>{$item->getCustomer()->getFormattedMobile()}</div>
            </td>
            <td>
                 {$item->getFormatter()->getDatedAt()->getFormatted()}
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
                {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_prime']])}
         <td>
              {$item->getFormattedPrime()}      
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_number_of_people']])}
         <td>
              {$item->getNumberOfPeople()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_number_of_children']])}
          <td>
              {$item->getNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_in_charge']])}
         <td>
             {$item->getFormattedRestInCharge()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_rest_tax_credit_available']])}
             <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
            <td>
              {$item->get('created_at')}
            </td>     
            <td>       
                {if $user->hasCredential([['superadmin','admin','app_domoprime_billing_list_send_email']])}
               <a href="javascript:void(0);"  title="{__('Send by email to customer')}" id="{$item->get('id')}" class="DomoprimeBilling-SendEmail">
                      <i class="fa fa-envelope"></i></a> 
               {/if}       
              <a href="{url_to('app_domoprime',['action'=>'ExportBillingPdf'])}?{__('Billing')}={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeBillingForContract-ExportPdf">
                      <i class="fa fa-file-pdf-o"></i></a>                
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No billing')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeBilling-all" /> 
          <a style="opacity:0.5" class="DomoprimeBilling-actions_items" href="#" title="{__('Delete')}" id="DomoprimeBilling-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeBilling"}
</div>
<script type="text/javascript">
 
 var dates = $( "#dated_at_from, #dated_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "dated_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );

        function getSiteDomoprimeBillingFilterParameters()
        {
            var params={    filter: {  order : { }, 
                                    search : { },
                                    equal: { },       
                                    range: $(".DomoprimeBilling.range").getFilter(),
                                nbitemsbypage: $("[name=DomoprimeBilling-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeBilling-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeBilling-order_active").attr("name")] =$(".DomoprimeBilling-order_active").attr("id");   
            $(".DomoprimeBilling-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeBillingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeBillingFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBilling'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-errors",    
                               loading: "#tab-site-dashboard-customers-meeting-app-domoprime-20-billings-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-20-billings-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeBilling-pager .DomoprimeBilling-active").html()?parseInt($(".DomoprimeBilling-pager .DomoprimeBilling-active").html()):1;
           records_by_page=$("[name=DomoprimeBilling-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeBilling-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeBilling-nb_results").html())-n;
           $("#DomoprimeBilling-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeBilling-end_result").html($(".DomoprimeBilling-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeBilling-init").click(function() {                  
               return $.ajax2({                                               
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBilling'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-20-billings-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-20-billings-base" 
                         }); 
           });
    
          $('.DomoprimeBilling-order').click(function() {
                $(".DomoprimeBilling-order_active").attr('class','DomoprimeBilling-order');
                $(this).attr('class','DomoprimeBilling-order_active');
                return updateSiteDomoprimeBillingFilter();
           });
           
            $(".DomoprimeBilling-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeBillingFilter();
            });
            
          $("#DomoprimeBilling-filter").click(function() { return updateSiteDomoprimeBillingFilter(); }); 
          
          $("[name=DomoprimeBilling-nbitemsbypage]").change(function() { return updateSiteDomoprimeBillingFilter(); }); 
          
         // $("[name=DomoprimeBilling-name]").change(function() { return updateSiteDomoprimeBillingFilter(); }); 
           
           $(".DomoprimeBilling-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeBillingFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBilling'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-billing-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-20-billings-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-20-billings-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
       $(".DomoprimeBilling-SendEmail").click(function () { 
           return $.ajax2({ data : { Billing: $(this).attr('id') },                                              
                            url:"{url_to('app_domoprime_ajax',['action'=>'SendEmailBilling'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-app-domoprime-20-billings-loading",
                            success : function (resp)
                                    {
                                    }
                         }); 
       });
</script>

