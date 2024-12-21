{messages class="customers-meeting-app-domoprime-errors"}
<h3>{__('Cumac results')}</h3>    
{*if $user->hasCredential([['superadmin','admin','meeting_export']])} 
    <a href="{url_to('customers_meeting',['action'=>'ExportCsvMeetings'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range','date_rdv','date_treated','date_creation','date_confirmed'])}" target="_blank" class="btn widthAFilter" id="CustomerMeetings-Export" title="{__('export')}" >
      <i class="fa fa-caret-square-o-down"></i>{__('Export')}</a>   
{/if*}
{*if $user->hasCredential([['superadmin','admin','meeting_export']])} 
    <a href="#" class="btn" id="CustomerMeetings-Generate" title="{__('Generate')}" >
      <i class="fa fa-cogs"></i>{__('Generate')}</a>   
{/if*}
<br>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeCalculation"}
<button id="DomoprimeCalculation-filter" style="width:auto;" class="btn-table" >{__("Filter")}</button>   
<button id="DomoprimeCalculation-init" class="btn-table">{__("Init")}</button>
 {* ================== POLLUTER =========================== *}
 {if $formFilter->in->hasValidator('polluter_id')} 
  <div class="filter" id="polluter">    
      <span class="filter-btn name-filter btn-table" id="polluter">{__('Polluters')}<i id="polluter" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="polluter">
    {foreach $formFilter->in.polluter_id->getOption('choices') as $polluter}
        <div>           
             <input type="checkbox" class="DomoprimeCalculation-in polluter" name="polluter_id" id="{$polluter->get('id')}" {if in_array($polluter->get('id'),(array)$formFilter.in.polluter_id->getValue())}checked="checked"{/if}/>{if $polluter->isLoaded()}{$polluter->get('name')}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeCalculation-in-select" name="polluter"/>{__('Select/unselect all')}
      </div>
  </div>    
   {/if}  
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Phone')}</span>               
        </th>
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
            <span>{__('Number of parts')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Qmarc')}</span>  

        </th> 
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Qmarc value')}</span>  

        </th> 
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Margin')}</span>  
        </th> 
        {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','app_domoprime_view_list_polluter']])} 
         <th>{* partner *}       
            <span>{__('Polluter')}</span>    
        </th>
        {/if}   
          <th>
            <span>{__('Causes')}</span>  
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('By')}</span>  

        </th> 
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Validated By')}</span>  
        </th> 
         </th> 
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Status')}</span>  
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
        <input class="DomoprimeCalculation-search" type="text" size="8" name="lastname" placeholder="{__('Customer')}" value="{$formFilter.search.lastname}">
        </td>
        <td>
          <input class="DomoprimeCalculation-search" type="text" size="8" name="phone" placeholder="{__('Phone,Mobile')}" value="{$formFilter.search.phone}">
            
        </td>
       <td>{* id *}</td>
         <td>{* id *}</td>
          <td>{* id *}</td>
       <td>{* name *}</td>
       <td>{* color *}</td>
        <td>{* color *}</td>
       <td>{* color *}</td>
        <td>{* color *}</td>
        <td>{* color *}</td>
       <td>{* icon *}</td>  
       <td>{* icon *}</td>  
       <td>{* icon *}</td> 
       {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])} 
         <td>{* partner *}       
            {if count($formFilter->equal.polluter_id->getOption('choices')) >1}
                {html_options class="CustomerContracts-equal widthSelect " name="polluter_id" options=$formFilter->equal.polluter_id->getOption('choices') selected=(string)$formFilter.equal.polluter_id}
            {else}
               {__('---')}
           {/if}   
        </td>
        {/if}   
       <td>{* icon *}</td>  
       <td>{* actions *}</td>
         <td>{* actions *}</td>
          <td>{* actions *}</td>
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeCalculation list" id="DomoprimeCalculation-{$item->get('id')}"> 
        <td class="DomoprimeCalculation-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
              {$item->getCustomer()|upper}
            </td>
            <td>                
              {$item->getCustomer()->getFormattedPhone()}
            </td>
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
              {$item->get('number_of_parts')}
            </td>
            <td>
              {$item->get('qmac')}
            </td>  
                <td>
                 {$item->get('qmac_value')}
            </td> 
                <td>
                 {$item->get('margin_price')}
            </td> 
              {if $meeting_settings->hasPolluter()}
                  <td>                      
                      {if $item->hasPolluter()}
                          {$item->getPolluter()->get('name')|upper}
                      {else}
                          {__('---')}
                      {/if}    
                  </td>
        {/if}  
        <td>
            {$item->getCauses()}
        </td>
                 <td>
                 {$item->getUser()|upper}
            </td> 
                 <td class="Domoprime-AcceptedBy" id="{$item->get('id')}">
                     {if $item->hasAcceptedBy()}
                        {$item->getAcceptedBy()|upper}
                     {else}
                         {__('No validator')}
                     {/if}    
            </td> 
            <td class="Domoprime-Confirm-text" id="{$item->get('id')}">
               {$item->getStatusI18n()}
            </td>
            <td>
                {$item->get('created_at')}
            </td>
            <td>               
                 {if $item->isAccepted()}
                         <a href="#" title="{__('Click to cancel validation')}" class="Domoprime-Confirm" id="{$item->get('id')}" name="Refuse">
                         <img class="Domoprime-Confirm-img" id="{$item->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Validated")}'/></a> 
                    {else}
                        <a href="#" title="{__('Click to validate')}" class="Domoprime-Confirm" id="{$item->get('id')}" name="Valid">
                        <img class="Domoprime-Confirm-img" id="{$item->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/></a>  
                    {/if}
                <a href="#" title="{__('Edit')}" class="DomoprimeCalculation-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                        
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No calculation')}</span>
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
            var params={   
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
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialCalculation'])}" , 
                              errorTarget: ".customers-meeting-app-domoprime-errors",    
                                 loading: "#tab-site-dashboard-customers-meeting-app-domoprime-00-loading",
                                 target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-00-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeCalculation-pager .DomoprimeCalculation-active").html()?parseInt($(".DomoprimeCalculation-pager .DomoprimeCalculation-active").html()):1;
           records_by_page=$("[name=DomoprimeCalculation-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeCalculation-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeCalculation-nb_results").html())-n;
           $("#DomoprimeCalculation-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeCalculation-end_result").html($(".DomoprimeCalculation-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeCalculation-init").click(function() {                  
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialCalculation'])}",
                           errorTarget: ".customers-meeting-app-domoprime-errors",    
                                 loading: "#tab-site-dashboard-customers-meeting-app-domoprime-00-loading",
                                 target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-00-base"}); 
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
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialCalculation'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".customers-meeting-app-domoprime-errors",    
                                 loading: "#tab-site-dashboard-customers-meeting-app-domoprime-00-loading",
                                 target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-00-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $(".Domoprime-Confirm").click( function () {   
            if ($(this).attr('name')=='Valid')
            {
               return $.ajax2({     
                    data : { DomoprimeRequest: $(this).attr('id') },
                    url: "{url_to('app_domoprime_ajax',['action'=>'ValidRequest'])}",
                    errorTarget: ".customers-meeting-app-domoprime-errors",    
                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-00-loading",                                 
                    success: function (resp)
                             {
                                if (resp.action=='ValidRequest')
                                {                                        
                                      $(".Domoprime-Confirm[id="+resp.id+"]").attr({ name:"Cancel", title: "{__('Click to cancel validation')}" });
                                      $(".Domoprime-Confirm-img[id="+resp.id+"]").attr({ 
                                              src: "{url('/icons/approved16x16.png','picture')}",
                                              alt: "{__('Validated')}"
                                      });     
                                      $(".Domoprime-Confirm-text[id="+resp.id+"]").html(resp.status);
                                      $(".Domoprime-AcceptedBy[id="+resp.id+"]").html(resp.accepted_by);
                                }
                             }
                 });
            }    
            else
            {
                return $.ajax2({     
                    data : { DomoprimeRequest: $(this).attr('id') },
                    url: "{url_to('app_domoprime_ajax',['action'=>'RefuseRequest'])}",
                    errorTarget: ".customers-meeting-app-domoprime-errors",    
                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-00-loading",                                 
                    success: function (resp)
                             {
                                if (resp.action=='RefuseRequest')
                                {                                        
                                      $(".Domoprime-Confirm[id="+resp.id+"]").attr({ name: "Confirm", title: "{__('Click to validate')}" });                                     
                                      $(".Domoprime-Confirm-img[id="+resp.id+"]").attr({ 
                                              src: "{url('/icons/refused16x16.png','picture')}",
                                              alt: "{__('Refused')}"
                                      });     
                                      $(".Domoprime-Confirm-text[id="+resp.id+"]").html(resp.status);
                                      $(".Domoprime-AcceptedBy[id="+resp.id+"]").html(resp.accepted_by);
                                }
                             }
                 });
            }    
         return false;           
     });    
     
         
	  $('.footable').footable();
	
</script>    

  
