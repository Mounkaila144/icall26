{messages class="customers-meeting-app-domoprime-billing-errors"}
<h3>{__('Quotations')}</h3> 
<div class="divFilter">
<div>
      
</div>
      <div class="filter">
       {if $pager->getNbItems()>5}&nbsp;{/if}      
                    {* date *}
       <div class="date">
           <span style=" display: inline">                      
            <input placeholder="{__('Start date')}" class="DomoprimeQuotation range inputWidth" id="quotation_dated_at_from" type="text" size="6" name="dated_at[from]" value="{format_date((string)$formFilter->getDateFilter('from'),'a')}"/>
           </span><br>
            <span>               
                <input placeholder="{__('End date')}"  class="DomoprimeQuotation range inputWidth" id="quotation_dated_at_to" type="text" size="6" name="dated_at[to]" value="{format_date((string)$formFilter->getDateFilter('to'),'a')}"/>
            </span>         
            <br>         
            <div>
                 <div>
                <input type="checkbox" class="DomoprimeQuotation date_sort displayInLine" name="date_quotation"  {if $formFilter.date_quotation->getValue()}checked="checked"{/if}/>
                <div style="width:100px" class="displayInLine">{__('Use date of quotation')}</div>  
                 </div>
                 <div>
                <input type="checkbox" class="DomoprimeQuotation date_sort displayInLine" name="date_install"  {if $formFilter.date_install->getValue()}checked="checked"{/if}/>
                <div style="width:100px" class="displayInLine">{__('Use date of installation')}</div>                
                 </div>
            </div>
       </div><br>
          
       <div class="">{* customer *}           
          <input class="DomoprimeQuotation-search inputWidth" type="text"  placeholder="{__('Customer, Contract reference')}" size="10" name="lastname" value="{$formFilter.search.lastname}">            
       </div><br>
       
      {* <div>{* amount *}{*</div>*}
       <div class="">{* phone *}
            <input class="DomoprimeQuotation-search inputWidth"  placeholder="Téléphone" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </div><br>
       <div>
            <input class="DomoprimeQuotation-search inputWidth" placeholder="{__('Reference')}" type="text" size="8" name="reference" value="{$formFilter.search.reference}"> 
       </div><br>
     {*  <div class="" class="DomoprimeQuotation cols postcode">
           <input class="DomoprimeQuotation-begin inputWidth"  placeholder="Code postal" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}"> 
       </div><br>       
       <div class="fi" class="DomoprimeQuotation cols city">
           <input class="DomoprimeQuotation-search inputWidth"  placeholder="Ville" type="text" size="8"   name="city" value="{$formFilter.search.city}"> 
            <img id="field-customer-contracts-city-loading" class="loading" style="display:none;" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
       </div>   *}
        <div class="filter fi">
            
            {* ================== STATE =========================== *}  
  <div class="filter" id="state">    
      <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="state">
    {foreach $formFilter->in.state_id->getOption('choices') as $state}
        <div>           
             <input type="checkbox" class="DomoprimeQuotation-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeQuotation-in-select" name="state"/>{__('Select/unselect all')}
      </div>
  </div>  
            
            
            
            
            
            
       <button id="DomoprimeQuotation-filter" class="btn inputWidth" >{__("Filter")}</button>   
       <button id="DomoprimeQuotation-init" class="btn inputWidth">{__("Init")}</button>
        </div>
         <div class="filter">  
             
             
           {component name="/app_domoprime_yousign/linkForQuotation"}
           
            {component name="/app_domoprime_yousign_evidence/linkForQuotation"}
     {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_export']])} 
            <a class="btn widthAFilter" target="_blank" href="{url_to('app_domoprime',['action'=>'ExportCsvQuotations'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range'])}" class="btn widthAFilter" title="{__('Export')}" >
            <i class="fa fa-caret-square-o-down" style="margin-right:5px"></i>{__('Export')}</a>   
     {/if}
    </div>
    </div>
</div>
<div class="reste">        
    <h3>   
    {component name="/app_domoprime/NumberOfContractsForQuotations" filter=$formFilter}
    &nbsp;&nbsp;&nbsp;&nbsp;    
    {component name="/app_domoprime/NumberOfSurfacesForQuotations" filter=$formFilter}
    &nbsp;&nbsp;&nbsp;&nbsp;
    {component name="/app_domoprime/NumberOfOperationsForQuotations" filter=$formFilter}
</h3>   
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotation"}
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
    <th  class="footable-first-column" data-toggle="true">
            <span>{__('ID Contract')}</span>               
        </th>
    <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date Quotation')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Polluter')}</span>               
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
{*          {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_fixed_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Fixed prime')}</span>               
        </th>  
        {/if}*}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
{*            {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}*}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_rest_in_charge_after_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge after credit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_available']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit available')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_prime']])}
           <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th> 
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_ana_prime']])}
           <th  class="footable-first-column" data-toggle="true">
            <span>{__('ANAH prime')}</span>               
        </th> 
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_parts']])}
           <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of parts')}</span>               
        </th> 
        {/if}
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Signed')}</span>  
        </th>         
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Signed at')}</span>          
        </th>
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Status')}</span>  
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
       <td>{* id *}               
       </td>      
        <td>{* id *}        
        </td>
        <td>         
        </td>
       <td>{* id *}</td>
         <td>{* id *}</td>
           <td>{* id *}</td>
           {* 
           {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_fixed_prime']])}
            <td>

           </td>  
           {/if}*}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_prime']])}
         <td>
                 
        </td>  
        {/if}
{*             {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit']])}
         <td>
           
        </td>  
        {/if}*}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_qmac']])}
         <td>
               
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_people']])}
         <td>
                
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_children']])}
         <td>               
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_used']])}
         <td>
           
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_rest_in_charge']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_credit_limit']])}
             <td></td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_rest_in_charge_after_credit']])}
             <td></td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_available']])}
             <td></td>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_prime']])}
             <td></td>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_ana_prime']])}
             <td></td>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_parts']])}
             <td></td>
        {/if}
          <td>{* id *}
           {html_options class="DomoprimeQuotation-equal widthSelect Select" name="is_signed" options=$formFilter->equal.is_signed->getOption('choices') selected=(string)$formFilter.equal.is_signed} 
          </td>
            <td>{* id *}</td>
       <td>{* name *}</td>   
          <td>{* name *}</td> 
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeQuotation list" id="DomoprimeQuotation-{$item->get('id')}"> 
        <td class="DomoprimeQuotation-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
              {$item->getMeeting()->get('id')}
            </td>
            <td>                
              {$item->getCustomer()|upper} - {$item->getCustomer()->getFormattedPhone()} 
              {if $item->hasMeeting()} - ({$item->getMeeting()->get('reference')}){/if}
            </td>
            <td> 
                  {$item->getFormatter()->getDatedAt()->getText()}
            </td>
            <td> 
                  {*$item->getMeeting()->getFormatter()->getQuotedAt()->getText()*}
            </td>
            <td> 
                  {if $item->getMeeting()->hasPolluter() }{$item->getMeeting()->getPolluter()->get('name')}{else}{__('---')}{/if}
            </td>
             <td id="Reference-{$item->get('id')}">
                {$item->get('reference')} 
            </td>
            <td>                
               {$item->getFormattedTotalSaleWithoutTax()}
            </td>
            <td>                
               {$item->getFormattedTotalSaleTax()}
            </td>                           
            <td>
               {$item->getFormattedTotalSaleWithTax()}  
            </td>  
{*        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_fixed_prime']])}
         <td>
              {$item->getFormattedFixedPrime()}      
        </td>  
        {/if}*}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_prime']])}
         <td>
              {$item->getFormattedITEPrime()}      
        </td>  
        {/if}
{*        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}*}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_people']])}
         <td>
              {$item->getFormattedNumberOfPeople()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_children']])}
          <td>
              {$item->getFormattedNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_rest_in_charge']])}
         <td>
             {$item->getFormattedRestToPayWithTax()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_available']])}
               <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_prime']])}
             <td>{$item->getFormattedPrime()}</td>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_ana_prime']])}
             <td>{$item->getFormattedAnaPrime()}</td>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_number_of_parts']])}
             <td>{$item->getFormattedNumberOfParts()}</td>
        {/if}
            <td>
                {__($item->get('is_signed'))}
            </td> 
            <td>
             {if $item->isSigned()}
                        {if $item->hasSignedAt()}
                            {format_date($item->get('signed_at'),['d','q'])}       
                        {else}
                            {__('---')}
                        {/if}    
                {/if}
            </td>
            <td>
                {$item->getFormatter()->getCreatedAt()->getFormatted(['d','q'])}
            </td>  
             <td class="DomoprimeQuotation Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            <td>               
                 
{*                <a href="#" title="{__('Edit')}" class="DomoprimeQuotation-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a>   *} 
                 <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForMeeting-ExportPdf">
                     <i class="fa fa-file-pdf-o"></i></a> 
                  
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotation-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotation-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if} 
                 {if  $user->hasCredential([['superadmin','admin','domoprime_quotation_list_remove']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotation-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-remove"></i></a> 
                  {/if}
                  {if $user->hasCredential([['superadmin','admin','domoprime_quotation_list_refresh_reference']])} 
                     <a href="javascript:void(0);" class="DomoprimeQuotation-RefreshReference" title="{__('Refresh')}" id="{$item->get('id')}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No quotation')}</span>
{else}
    {*if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeQuotation-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotation-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotation-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotation"}

</div>
<script type="text/javascript">
 
  var dates = $( "#quotation_dated_at_from, #quotation_dated_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "quotation_dated_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );

        function getSiteDomoprimeQuotationFilterParameters()
        {
            var params={    filter: {  order : { }, 
                                    search : { },
                                    equal: { }, 
                                    in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },
                                    range: $(".DomoprimeQuotation.range").getFilter(),
                                nbitemsbypage: $("[name=DomoprimeQuotation-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotation-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotation-order_active").attr("name")] =$(".DomoprimeQuotation-order_active").attr("id");   
            $(".DomoprimeQuotation-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            $(".DomoprimeQuotation-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   });    
            $(".DomoprimeQuotation.date_sort").each(function () { params.filter[$(this).attr('name')] =$(this).prop('checked'); });
            $(".DomoprimeQuotation-equal.Select option:selected").each(function(){ params.filter.equal[$(this).parent().attr('name')]=$(this).val() });
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialMeetingQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                               loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotation-pager .DomoprimeQuotation-active").html()?parseInt($(".DomoprimeQuotation-pager .DomoprimeQuotation-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotation-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotation-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotation-nb_results").html())-n;
           $("#DomoprimeQuotation-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotation-end_result").html($(".DomoprimeQuotation-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotation-init").click(function() {                  
               return $.ajax2({                                               
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialMeetingQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base" 
                         }); 
           });
    
          $('.DomoprimeQuotation-order').click(function() {
                $(".DomoprimeQuotation-order_active").attr('class','DomoprimeQuotation-order');
                $(this).attr('class','DomoprimeQuotation-order_active');
                return updateSiteDomoprimeQuotationFilter();
           });
           
            $(".DomoprimeQuotation-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationFilter();
            });
            
          $("#DomoprimeQuotation-filter").click(function() { return updateSiteDomoprimeQuotationFilter(); }); 
          
          $(".DomoprimeQuotation-equal.Select,[name=DomoprimeQuotation-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationFilter(); }); 
          
         // $("[name=DomoprimeQuotation-name]").change(function() { return updateSiteDomoprimeQuotationFilter(); }); 
           
           $(".DomoprimeQuotation-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialMeetingQuotation'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
            $(".DomoprimeQuotation-Remove").click(function() {   
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'RemoveQuotation'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='RemoveQuotation')
                                        {    
                                            $(".DomoprimeQuotation.list[id=DomoprimeQuotation-"+resp.id+"]").remove();
                                            if ($('.DomoprimeQuotation.list').length==0)
                                              return $.ajax2({ 
                                                    url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialMeetingQuotation'])}" , 
                                                    errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                                                    target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"                 
                                                });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
             $(".DomoprimeQuotation-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotation.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotation-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                        errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotation.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
           
           
           
           
    $(".filter-btn").click(function() {   
                $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();                     
    });
    
    $('.filter').mouseleave( function() { $('.filter-content').hide();} );
    
    
    $(".DomoprimeQuotation-in-select[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
                      
     $(".DomoprimeQuotation.date_sort").click(function () { 
        var value=$(this).prop('checked');
        $(".date_sort").prop('checked',false);
        $(this).prop('checked',value);        
    });
    
    
     $('.DomoprimeQuotation-RefreshReference').click(function (){
            return $.ajax2({ 
                data : { DomoprimeQuotation: $(this).attr('id')},
                url:"{url_to('app_domoprime_ajax',['action'=>'RefreshQuotation'])}" , 
                errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                //target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"     
                success: function (resp)
                {
                    if (resp.action=='RefreshQuotation')
                    {    
                        $("#Reference-"+resp.id).text(resp.reference);                                 
                    }
                }
        }); 
          
    });
</script>
