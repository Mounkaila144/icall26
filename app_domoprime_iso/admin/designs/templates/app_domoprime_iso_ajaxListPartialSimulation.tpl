{messages class="customers-meeting-app-domoprime-billing-errors"}
<h3>{__('Simulations')}</h3> 
<div class="divFilter">
<div>
      
</div>
      <div class="filter">
       {if $pager->getNbItems()>5}&nbsp;{/if}      
                    {* date *}
       <div class="date">
           <span style=" display: inline">                      
            <input placeholder="{__('Start date')}" class="DomoprimeSimulation range inputWidth" id="simulation_dated_at_from" type="text" size="6" name="dated_at[from]" value="{format_date((string)$formFilter->getDateFilter('from'),'a')}"/>
           </span><br>
            <span>               
                <input placeholder="{__('End date')}"  class="DomoprimeSimulation range inputWidth" id="simulation_dated_at_to" type="text" size="6" name="dated_at[to]" value="{format_date((string)$formFilter->getDateFilter('to'),'a')}"/>
            </span>         
            <br>         
            <div>
                 <div>
                <input type="checkbox" class="DomoprimeSimulation date_sort displayInLine" name="date_simulation"  {if $formFilter.date_simulation->getValue()}checked="checked"{/if}/>
                <div style="width:100px" class="displayInLine">{__('Use date of simulation')}</div>  
                 </div>
                 <div>
                <input type="checkbox" class="DomoprimeSimulation date_sort displayInLine" name="date_install"  {if $formFilter.date_install->getValue()}checked="checked"{/if}/>
                <div style="width:100px" class="displayInLine">{__('Use date of installation')}</div>                
                 </div>
            </div>
       </div><br>
          
       <div class="">{* customer *}           
          <input class="DomoprimeSimulation-search inputWidth" type="text"  placeholder="{__('Customer, Contract reference')}" size="10" name="lastname" value="{$formFilter.search.lastname}">            
       </div><br>
       
      {* <div>{* amount *}{*</div>*}
       <div class="">{* phone *}
            <input class="DomoprimeSimulation-search inputWidth"  placeholder="Téléphone" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </div><br>
       <div>
            <input class="DomoprimeSimulation-search inputWidth" placeholder="{__('Reference')}" type="text" size="8" name="reference" value="{$formFilter.search.reference}"> 
       </div><br>
     {*  <div class="" class="DomoprimeSimulation cols postcode">
           <input class="DomoprimeSimulation-begin inputWidth"  placeholder="Code postal" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}"> 
       </div><br>       
       <div class="fi" class="DomoprimeSimulation cols city">
           <input class="DomoprimeSimulation-search inputWidth"  placeholder="Ville" type="text" size="8"   name="city" value="{$formFilter.search.city}"> 
            <img id="field-customer-contracts-city-loading" class="loading" style="display:none;" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
       </div>   *}
        <div class="filter fi">
            
            {* ================== STATE =========================== *}  
  <div class="filter" id="state">    
      <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="state">
    {foreach $formFilter->in.state_id->getOption('choices') as $state}
        <div>           
             <input type="checkbox" class="DomoprimeSimulation-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeSimulation-in-select" name="state"/>{__('Select/unselect all')}
      </div>
  </div>  
            
            
            
            
            
            
       <button id="DomoprimeSimulation-filter" class="btn inputWidth" >{__("Filter")}</button>   
       <button id="DomoprimeSimulation-init" class="btn inputWidth">{__("Init")}</button>
        </div>
         <div class="filter">  
                     
    </div>
    </div>
</div>
<div class="reste">        
     
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeSimulation"}
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
    <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
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
           {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_rest_in_charge_after_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge after credit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit_available']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit available')}</span>               
        </th>  
        {/if}
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
       <td>{* id *}               
       </td>      
        <td>{* id *}        
        </td>
        <td>         
        </td>
       <td>{* id *}</td>
         <td>{* id *}</td>
           <td>{* id *}</td>  
            {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_prime']])}
         <td>
                 
        </td>  
        {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit']])}
         <td>
           
        </td>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_qmac']])}
         <td>
               
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_number_of_people']])}
         <td>
                
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_number_of_children']])}
         <td>               
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit_used']])}
         <td>
           
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_rest_in_charge']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_credit_limit']])}
             <td></td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_rest_in_charge_after_credit']])}
             <td></td>
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit_available']])}
             <td></td>
        {/if}
       <td>{* name *}</td>   
          <td>{* name *}</td> 
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeSimulation list" id="DomoprimeSimulation-{$item->get('id')}"> 
        <td class="DomoprimeSimulation-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
              {$item->getCustomer()|upper} - {$item->getCustomer()->getFormattedPhone()} 
              {if $item->hasContract()} - ({$item->getContract()->get('reference')}){/if}
            </td>
            <td> 
                  {$item->getFormatter()->getDatedAt()->getText()}
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
             {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_prime']])}
         <td>
              {$item->getFormattedPrime()}      
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_number_of_people']])}
         <td>
              {$item->getNumberOfPeople()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_number_of_children']])}
          <td>
              {$item->getNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_rest_in_charge']])}
         <td>
             {$item->getFormattedRestInCharge()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_simulation_tax_credit_available']])}
               <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
            <td>
                {$item->getFormatter()->getCreatedAt()->getFormatted(['d','q'])}
            </td>  
             <td class="DomoprimeSimulation Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            <td>               
                 
                <a href="#" title="{__('Edit')}" class="DomoprimeSimulation-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a>    
                {* <a href="{url_to('app_domoprime_iso',['action'=>'ExportSimulationPdf'])}?Simulation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeSimulationForMeeting-ExportPdf">
                     <i class="fa fa-file-pdf-o"></i></a> *}
                  
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeSimulation-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeSimulation-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if} 
                 {if  $user->hasCredential([['superadmin','admin','domoprime_simulation_list_remove']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeSimulation-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-remove"></i></a> 
                  {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No simulation')}</span>
{else}
    {*if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeSimulation-all" /> 
          <a style="opacity:0.5" class="DomoprimeSimulation-actions_items" href="#" title="{__('Delete')}" id="DomoprimeSimulation-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeSimulation"}

</div>
<script type="text/javascript">
 
  var dates = $( "#simulation_dated_at_from, #simulation_dated_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "simulation_dated_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );

        function getSiteDomoprimeSimulationFilterParameters()
        {
            var params={    filter: {  order : { }, 
                                    search : { },
                                    equal: { }, 
                                    in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },
                                    range: $(".DomoprimeSimulation.range").getFilter(),
                                nbitemsbypage: $("[name=DomoprimeSimulation-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeSimulation-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeSimulation-order_active").attr("name")] =$(".DomoprimeSimulation-order_active").attr("id");   
            $(".DomoprimeSimulation-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            $(".DomoprimeSimulation-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   });    
            $(".DomoprimeSimulation.date_sort").each(function () { params.filter[$(this).attr('name')] =$(this).prop('checked'); });
            $(".DomoprimeSimulation-equal.Select option:selected").each(function(){ params.filter.equal[$(this).parent().attr('name')]=$(this).val() });
            return params;                  
        }
        
        function updateSiteDomoprimeSimulationFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeSimulationFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-errors",    
                               loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-simulations-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-simulations-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeSimulation-pager .DomoprimeSimulation-active").html()?parseInt($(".DomoprimeSimulation-pager .DomoprimeSimulation-active").html()):1;
           records_by_page=$("[name=DomoprimeSimulation-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeSimulation-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeSimulation-nb_results").html())-n;
           $("#DomoprimeSimulation-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeSimulation-end_result").html($(".DomoprimeSimulation-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeSimulation-init").click(function() {                  
               return $.ajax2({                                               
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-simulations-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-simulations-base" 
                         }); 
           });
    
          $('.DomoprimeSimulation-order').click(function() {
                $(".DomoprimeSimulation-order_active").attr('class','DomoprimeSimulation-order');
                $(this).attr('class','DomoprimeSimulation-order_active');
                return updateSiteDomoprimeSimulationFilter();
           });
           
            $(".DomoprimeSimulation-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeSimulationFilter();
            });
            
          $("#DomoprimeSimulation-filter").click(function() { return updateSiteDomoprimeSimulationFilter(); }); 
          
          $(".DomoprimeSimulation-equal.Select,[name=DomoprimeSimulation-nbitemsbypage]").change(function() { return updateSiteDomoprimeSimulationFilter(); }); 
          
         // $("[name=DomoprimeSimulation-name]").change(function() { return updateSiteDomoprimeSimulationFilter(); }); 
           
           $(".DomoprimeSimulation-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeSimulationFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulation'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-simulation-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-simulations-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-simulations-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
            $(".DomoprimeSimulation-Remove").click(function() {   
               if (!confirm('{__("Simulation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'RemoveSimulation'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-simulation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='RemoveSimulation')
                                        {    
                                            $(".DomoprimeSimulation.list[id=DomoprimeSimulation-"+resp.id+"]").remove();
                                            if ($('.DomoprimeSimulation.list').length==0)
                                              return $.ajax2({ 
                                                    url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulation'])}" , 
                                                    errorTarget: ".customers-meeting-app-domoprime-simulation-errors",    
                                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-simulations-loading",
                                                    target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-simulations-base"                 
                                                });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
             $(".DomoprimeSimulation-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Simulation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'DisableSimulation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-simulations-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableSimulation')
                                        {                                               
                                            $(".DomoprimeSimulation-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeSimulation-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeSimulation.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeSimulation-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeSimulation-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Simulation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'EnableSimulation'])}" , 
                        errorTarget: ".customers-meeting-app-domoprime-simulation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-simulations-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableSimulation')
                                        {    
                                            $(".DomoprimeSimulation-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeSimulation-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeSimulation.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeSimulation-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
           
           
           
           
    $(".filter-btn").click(function() {   
                $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();                     
    });
    
    $('.filter').mouseleave( function() { $('.filter-content').hide();} );
    
    
    $(".DomoprimeSimulation-in-select[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
                      
     $(".DomoprimeSimulation.date_sort").click(function () { 
        var value=$(this).prop('checked');
        $(".date_sort").prop('checked',false);
        $(this).prop('checked',value);        
    });
</script>

