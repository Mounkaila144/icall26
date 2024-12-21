{messages class="customers-meeting-app-domoprime-billing-errors"}
<h3>{__('Requests')}</h3> 
<div class="divFilter">
<div>
      
</div>
      <div class="filter">
       {if $pager->getNbItems()>5}&nbsp;{/if}      
                    {* date *}
       <div class="date">
           <span style=" display: inline">                      
            <input placeholder="{__('Start date')}" class="DomoprimeRequest range inputWidth" id="request_created_at_from" type="text" size="6" name="created_at[from]" value="{format_date((string)$formFilter->getDateFilter('from'),'a')}"/>
           </span><br>
            <span>               
                <input placeholder="{__('End date')}"  class="DomoprimeRequest range inputWidth" id="request_created_at_to" type="text" size="6" name="created_at[to]" value="{format_date((string)$formFilter->getDateFilter('to'),'a')}"/>
            </span>         
            <br>         
            <div>
              {*   <div>
                <input type="checkbox" class="DomoprimeRequest date_sort displayInLine" name="date_request"  {if $formFilter.date_request->getValue()}checked="checked"{/if}/>
                <div style="width:100px" class="displayInLine">{__('Use date of request')}</div>  
                 </div>
                 <div>
                <input type="checkbox" class="DomoprimeRequest date_sort displayInLine" name="date_install"  {if $formFilter.date_install->getValue()}checked="checked"{/if}/>
                <div style="width:100px" class="displayInLine">{__('Use date of installation')}</div>                
                 </div> *}
            </div>
       </div><br>
          
       <div class="">{* customer *}           
          <input class="DomoprimeRequest-search inputWidth" type="text"  placeholder="{__('Customer, Contract reference')}" size="10" name="lastname" value="{$formFilter.search.lastname}">            
       </div><br>
       
      {* <div>{* amount *}{*</div>*}
       <div class="">{* phone *}
            <input class="DomoprimeRequest-search inputWidth"  placeholder="Téléphone" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </div><br>
       <div>
            <input class="DomoprimeRequest-search inputWidth" placeholder="{__('Reference')}" type="text" size="8" name="reference" value="{$formFilter.search.reference}"> 
       </div><br>
     {*  <div class="" class="DomoprimeRequest cols postcode">
           <input class="DomoprimeRequest-begin inputWidth"  placeholder="Code postal" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}"> 
       </div><br>       
       <div class="fi" class="DomoprimeRequest cols city">
           <input class="DomoprimeRequest-search inputWidth"  placeholder="Ville" type="text" size="8"   name="city" value="{$formFilter.search.city}"> 
            <img id="field-customer-contracts-city-loading" class="loading" style="display:none;" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
       </div>   *}
        <div class="filter fi">
            
            {* ================== STATE =========================== *}  
  <div class="filter" id="state">    
      <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="state">
    {foreach $formFilter->in.state_id->getOption('choices') as $state}
        <div>           
             <input type="checkbox" class="DomoprimeRequest-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeRequest-in-select" name="state"/>{__('Select/unselect all')}
      </div>
  </div>  
            
            
            
            
            
            
       <button id="DomoprimeRequest-filter" class="btn inputWidth" >{__("Filter")}</button>   
       <button id="DomoprimeRequest-init" class="btn inputWidth">{__("Init")}</button>
        </div>
         <div class="filter">  
                     
    </div>
    </div>
</div>
<div class="reste">        
     
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeRequest"}
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
    <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
        </th>       
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Surface 101')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Surface 102')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Surface 103')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Revenue')}</span>               
        </th>              
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of fiscal people')}</span>               
        </th>  
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Parcel referrence')}</span>               
        </th> 
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Parcel surface')}</span>               
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th>             
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
           <td>{* id *}</td>
           <td>{* id *}</td>  
       <td>{* name *}</td>   
          <td>{* name *}</td>   
          
       
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeRequest list" id="DomoprimeRequest-{$item->get('id')}"> 
        <td class="DomoprimeRequest-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
              {$item->getCustomer()|upper} - {$item->getCustomer()->getFormattedPhone()} 
              {if $item->hasContract()} - ({$item->getContract()->get('reference')}){/if}
            </td>
            <td> 
                {$item->getFormatter()->getSurfaceTop()->getText("#.00")}   
                ({$item->getFormatter()->getInstallSurfaceTop()->getText("#.00")})
            </td>
            <td>
               {$item->getFormatter()->getSurfaceWall()->getText("#.00")}
               ({$item->getFormatter()->getInstallSurfaceWall()->getText("#.00")})
            </td>
            <td>                
                {$item->getFormatter()->getSurfaceFloor()->getText("#.00")}
                ({$item->getFormatter()->getInstallSurfaceFloor()->getText("#.00")})
            </td>
            <td>                
                {$item->getFormatter()->getRevenue()->getText()} 
            </td>            
            <td>
                 {$item->getFormatter()->getNumberOfPeople()->getText("#.0")} 
            </td>  
            <td>
                 {$item->getFormatter()->getNumberOfFiscal()->getText("#.0")} 
            </td>       
            <td>
                 {$item->get("parcel_reference")} 
            </td>
                 <td>
                  {$item->getFormatter()->getParcelSurface()->getText("#.0")} 
            </td>
            <td>
                {$item->getFormatter()->getCreatedAt()->getFormatted(['d','q'])}
            </td>                         
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No request')}</span>
{else}
    {*if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeRequest-all" /> 
          <a style="opacity:0.5" class="DomoprimeRequest-actions_items" href="#" title="{__('Delete')}" id="DomoprimeRequest-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeRequest"}

</div>
<script type="text/javascript">
 
  var dates = $( "#request_created_at_from, #request_created_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "request_created_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );

        function getSiteDomoprimeRequestFilterParameters()
        {
            var params={    filter: {  order : { }, 
                                    search : { },
                                    equal: { }, 
                                    in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },
                                    range: $(".DomoprimeRequest.range").getFilter(),
                                nbitemsbypage: $("[name=DomoprimeRequest-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeRequest-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeRequest-order_active").attr("name")] =$(".DomoprimeRequest-order_active").attr("id");   
            $(".DomoprimeRequest-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            $(".DomoprimeRequest-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   });    
            $(".DomoprimeRequest.date_sort").each(function () { params.filter[$(this).attr('name')] =$(this).prop('checked'); });
            $(".DomoprimeRequest-equal.Select option:selected").each(function(){ params.filter.equal[$(this).parent().attr('name')]=$(this).val() });
            return params;                  
        }
        
        function updateSiteDomoprimeRequestFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeRequestFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialRequest'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-request-errors",    
                               loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-requests-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-requests-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeRequest-pager .DomoprimeRequest-active").html()?parseInt($(".DomoprimeRequest-pager .DomoprimeRequest-active").html()):1;
           records_by_page=$("[name=DomoprimeRequest-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeRequest-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeRequest-nb_results").html())-n;
           $("#DomoprimeRequest-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeRequest-end_result").html($(".DomoprimeRequest-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeRequest-init").click(function() {                  
               return $.ajax2({                                               
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialRequest'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-request-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-requests-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-requests-base" 
                         }); 
           });
    
          $('.DomoprimeRequest-order').click(function() {
                $(".DomoprimeRequest-order_active").attr('class','DomoprimeRequest-order');
                $(this).attr('class','DomoprimeRequest-order_active');
                return updateSiteDomoprimeRequestFilter();
           });
           
            $(".DomoprimeRequest-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeRequestFilter();
            });
            
          $("#DomoprimeRequest-filter").click(function() { return updateSiteDomoprimeRequestFilter(); }); 
          
          $(".DomoprimeRequest-equal.Select,[name=DomoprimeRequest-nbitemsbypage]").change(function() { return updateSiteDomoprimeRequestFilter(); }); 
          
         // $("[name=DomoprimeRequest-name]").change(function() { return updateSiteDomoprimeRequestFilter(); }); 
           
           $(".DomoprimeRequest-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeRequestFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialRequest'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-request-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-requests-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-requests-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
            $(".DomoprimeRequest-Remove").click(function() {   
               if (!confirm('{__("Request \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeRequest: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'RemoveRequest'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-request-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='RemoveRequest')
                                        {    
                                            $(".DomoprimeRequest.list[id=DomoprimeRequest-"+resp.id+"]").remove();
                                            if ($('.DomoprimeRequest.list').length==0)
                                              return $.ajax2({ 
                                                    url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialRequest'])}" , 
                                                    errorTarget: ".customers-meeting-app-domoprime-request-errors",    
                                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-requests-loading",
                                                    target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-requests-base"                 
                                                });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
             $(".DomoprimeRequest-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Request \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeRequest: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'DisableRequest'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-request-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-requests-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableRequest')
                                        {                                               
                                            $(".DomoprimeRequest-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeRequest-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeRequest.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeRequest-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeRequest-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Request \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeRequest: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'EnableRequest'])}" , 
                        errorTarget: ".customers-meeting-app-domoprime-request-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-requests-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableRequest')
                                        {    
                                            $(".DomoprimeRequest-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeRequest-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeRequest.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeRequest-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
           
           
           
           
    $(".filter-btn").click(function() {   
                $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();                     
    });
    
    $('.filter').mouseleave( function() { $('.filter-content').hide();} );
    
    
    $(".DomoprimeRequest-in-select[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
                      
     $(".DomoprimeRequest.date_sort").click(function () { 
        var value=$(this).prop('checked');
        $(".date_sort").prop('checked',false);
        $(this).prop('checked',value);        
    });
</script>


