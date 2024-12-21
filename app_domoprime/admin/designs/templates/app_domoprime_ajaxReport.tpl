<!--begin--><div class="divFilter">
   <div style="text-align: center" class="li1"><span class="buttonSlide">
    <i class="fa fa-bars fa-2x" style="color: black;"></i> </span></div>

     {* input data filter *}
      <div class="filter">
         {if $pager->getNbItems()>5}&nbsp;{/if}       
       <div class="" class="date">{* date *}
           <span style=" display: inline">
            {*{__('from')}*}
            De:<br>
            <input placeholder="Date début" class="DomoprimeCalculationReport range inputWidth" id="opc_at_from" type="text" size="6" name="opc_at[from]" value="{format_date((string)$formFilter.range.opc_at.from,'a')}"/>
           </span><br>
            <span>
                A:<br> {*{__('to')}*}
                <input placeholder="Date fin"  class="DomoprimeCalculationReport range inputWidth" id="opc_at_to" type="text" size="6" name="opc_at[to]" value="{format_date((string)$formFilter.range.opc_at.to,'a')}"/>
            </span>  <br>         
            
       </div><br>
       <div class="">{* customer *}
           
                <input class="DomoprimeCalculationReport-search inputWidth" type="text" placeholder="{__('Customer')}" size="10" name="lastname" value="{$formFilter.search.lastname}">           
       </div><br>             
       <div class="">{* phone *}
            <input class="DomoprimeCalculationReport-search inputWidth" placeholder="Téléphone" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </div><br>                
       <div>{* actions *}</div>
    </div>
       
{if $pager->hasItems()}
  <div class="fi filter"> 
       {* ================== STATE =========================== *}  
  {* <div class="filter" id="state">    
      <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="state">
    {foreach $formFilter->in.state_id->getOption('choices') as $state}
        <div>           
             <input type="checkbox" class="DomoprimeCalculation-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeCalculation-in-select" name="state"/>{__('Select/unselect all')}
      </div>
  </div>  *}
  </div>
{/if}  
    <div class="filter fi">
          <button id="DomoprimeCalculationReport-filter" class="btn inputWidth">{__("Filter")}</button>   <br>
          <button class="btn inputWidth" id="DomoprimeCalculationReport-init">{__("Init")}</button>
    </div>
    {* button export *}
    <div class="filter">        
  
    </div>
      
</div>



<div class="reste">
    <h4>{__('Total surfaces')}:{$formFilter->getTotalSurfaces()->getText()} m²</h4>
    <h4>{__('Total Cumac value')}:{$formFilter->getTotalCumacValues()->getAmount()}</h4>
    <h4>{__('Total Cumac')}:{$formFilter->getTotalCumacs()->getText()}</h4>
{messages class="customers-meeting-app-domoprime-report-errors"}
<table class="tabl-list" cellpadding="0" cellspacing="0" style="margin-bottom: 11px;">
    <tr class="list-header">
        <th>{__('Installer')}</th>
        <th>{__('State')}</th>
        <th>{__('Mode')}</th>
        <th>{__('Class')}</th>
        <th>{__('Energy')}</th>
        <th>{__('Sector')}</th>
        <th>{__('Dept')}</th>
    </tr>
    <tr class="list">
        <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport-equal" name="financial_partner_id" options=$formFilter->equal.financial_partner_id->getOption('choices') selected=(string)$formFilter.equal.financial_partner_id}
     </td> 
     <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport-equal" name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
     </td>  
     <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport" name="mode" options=$formFilter->mode->getOption('choices') selected=(string)$formFilter.mode}
     </td>
      <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport-equal" name="class_id" options=$formFilter->equal.class_id->getOption('choices') selected=(string)$formFilter.equal.class_id}
     </td>
       <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport-equal" name="energy_id" options=$formFilter->equal.energy_id->getOption('choices') selected=(string)$formFilter.equal.energy_id}
     </td>
      <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport-equal" name="sector_id" options=$formFilter->equal.sector_id->getOption('choices') selected=(string)$formFilter.equal.sector_id}
     </td>
      <td>{* status *}
            {html_options class="widthSelect DomoprimeCalculationReport-equal" name="zone_id" options=$formFilter->equal.zone_id->getOption('choices') selected=(string)$formFilter.equal.zone_id}
     </td>
    </tr>
</table>
         
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeCalculationReport" style="margin-top: 15px;"}
<table class="tabl-list" cellpadding="0" cellspacing="0">
    <tr class="list-header">
        <th>
            
        </th>
        <th>
            {__('Date')}
        </th>
        <th>
            {__('Customer')}
        </th>
        {foreach $pager->getProducts() as $product}
            <th colspan="2">
            {$product->get('reference')}
            </th>
            {*<th>
                
            </th>*}
        {/foreach} 
        <th>
            {__('Total')}
        </th>
    </tr>    
    {foreach $pager as $item}
        <tr class="list">
            <td class="CustomerContracts-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            <td>
                 <i>{$item->getContract()->getFormatter()->getOpcAt()->getText()}</i>
                 <div class="battery">
                    <div class="battery-percentage percent-{$item->getFormatter()->getSurfaceBargraph()->getPourcentage()}"></div>
                 </div>
            </td>
            <td>              
                <strong>{$item->getCustomer()->get('firstname')|upper} {$item->getCustomer()->get('lastname')|upper}</strong>
                <div>
                    {$item->getCustomer()->getAddress()->get('postcode')} {$item->getCustomer()->getAddress()->get('city')}                
                </div>
            </td>            
            {foreach $item->getProductCalculationCollection() as $calculation}
                <td>
                      {if $formFilter->getMode()=='cumac' || $formFilter->getMode()=='mixed'}
                          <div><strong>{$calculation->getFormatter()->getCumac()}</strong></div>
                   {/if}  
                   {if $formFilter->getMode()=='cumac_value' || $formFilter->getMode()=='mixed'}
                       <div>{$calculation->getFormatter()->getCumacValue()}</div>
                   {/if}                   
                </td>
                <td>                                     
                       <div>{$calculation->getFormatter()->getSurface()} m²</div>                                    
                </td>                   
             {/foreach}
             <td>
                 {$item->getFormatter()->getTotalCumacValue()}
             </td>
        </tr>
        
    {/foreach}    
    
</table>
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeCalculationReport"}

</div>



<script type="text/javascript">
    
            $('.buttonSlide').click(function(){
            $('#body').toggleClass('close-slide');
        });
    var dates = $( ".DomoprimeCalculationReport#opc_at_from, .DomoprimeCalculationReport#opc_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "opc_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );

     $(".filter-btn").click(function() {   
            $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();            
          {*  $('.iconfont[id='+$(this).attr('id')+"]").toggleClass('fa fa-sort-desc fa fa-sort-asc');*}
    });
    
    $('.filter').mouseleave( function() { $('.filter-content').hide();} );
    
    
     function getReportFilterParameters()
        {
           var params={ filter: {  order : { }, 
                                    range: $(".DomoprimeCalculationReport.range").getFilter(),                                    
                                     equal : { },                                  
                                     search: {  },                                                                      
                                     in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} }, 
                                     mode : $(".DomoprimeCalculationReport[name=mode]").val(),
                                     nbitemsbypage: $("[name=DomoprimeCalculationReport-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            {* ================ ORDER ============================= *}
            if ($(".DomoprimeCalculationReport-order_active").attr("name"))
                    params.filter.order[$(".DomoprimeCalculationReport-order_active").attr("name")] =$(".DomoprimeCalculationReport-order_active").attr("id");
            {* ================ SEARCH ============================= *}
            $(".DomoprimeCalculationReport-search").each(function() { params.filter.search[this.name] =this.value; });                       
            {* ================ EQUAL ============================= *}
            $(".DomoprimeCalculationReport-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); }); 
            {* ================ IN ============================= *}
          
            return params;                  
        }
        
        
    function updateReportFilter()
        {
           return $.ajax2({ data: getReportFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'Report'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-report-errors",
                            loading: "#tab-site-dashboard-customers-meeting-app-domoprime-25-report-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-25-report-base" });
        }  
        
        
           $("#DomoprimeCalculationReport-init").click(function() { 
                    return $.ajax2({ 
                            url:"{url_to('app_domoprime_ajax',['action'=>'Report'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-report-errors",
                            loading: "#tab-site-dashboard-customers-meeting-app-domoprime-25-report-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-25-report-base" });
        }); 
        
        
        $(".DomoprimeCalculationReport,.DomoprimeCalculationReport-equal,[name=DomoprimeCalculationReport-nbitemsbypage]").change(function() { return updateReportFilter(); }); 
        
        $(".DomoprimeCalculationReport-pager").click(function () {             
                return $.ajax2({ data: getReportFilterParameters(), 
                              url:"{url_to('app_domoprime_ajax',['action'=>'Report'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),                                  
                              errorTarget: ".customers-meeting-app-domoprime-report-errors",
                             loading: "#tab-site-dashboard-customers-meeting-app-domoprime-25-report-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-25-report-base" });              
        });
        
        $("#DomoprimeCalculationReport-filter").click(function() { return updateReportFilter(); }); 
        
         $(".DomoprimeCalculationReport-search").keypress(function(event) {
            if (event.keyCode==13)
                return updateReportFilter();
        });
</script>    