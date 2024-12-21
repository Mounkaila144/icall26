<!-- Theme -->
<style>
   /* .ui-resizable-helper { border: 1px dotted #FFFFFF; } */
    .ui-resizable-e { cursor: col-resize; }
</style>
{messages class="{$site->getSiteID()}-customers-meeting-site-errors"}
<h3>{__('Customer meeting')}</h3>    
<div>
  <a href="#" class="btn" id="{$site->getSiteID()}-CustomerMeetings-New" title="{__('new')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New meeting')}</a>   
  <a href="#" class="btn" id="{$site->getSiteID()}-CustomerMeetings-Export" title="{__('export')}" ><img  src="{url('/icons/export.gif','picture')}" alt="{__('new')}"/>{__('Export')}</a>   
</div>
<div>
    <div>{__('Columns')}</div>
    {foreach $formFilter->cols->getOption('choices') as $name}
        <div>
            <input type="checkbox" class="CustomerMeetings cols" name="cols" id="{$name}" {if in_array($name,(array)$formFilter.cols->getValue())}checked="checked"{/if}/>{__($name)}
        </div>    
    {/foreach} 
    <input type="checkbox" class="CustomerMeetings select" name="cols" {if $formFilter.cols->getValue()}checked=""{/if}/>{__('Select/unselect all')}
</div>
{if $pager->hasItems()}
<div>
    <div>{__('Telepro')}</div>
    {foreach $formFilter->in.telepro_id->getOption('choices') as $telepro}
        <div>
            <input type="checkbox" class="CustomerMeetings-in telepro" name="telepro_id" id="{$telepro->get('id')}" {if in_array($telepro->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>{$telepro}
        </div>    
    {/foreach}    
    <input type="checkbox" class="CustomerMeetings-in" name="telepro"/>{__('Select/unselect all')}
</div>
<div>
     <div>{__('Sales')}</div>
{foreach $formFilter->in.sales_id->getOption('choices') as $sale}
    <div>
        <input type="checkbox" class="CustomerMeetings-in sales" name="sales_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sales_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
    </div>    
{/foreach}  
  <input type="checkbox" class="CustomerMeetings-in" name="sales"/>{__('Select/unselect all')}
</div>
{/if}
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetings"}
<button id="CustomerMeetings-filter" class="btn-table">{__("Filter")}</button>   <button class="btn-table" id="CustomerMeetings-init">{__("Init")}</button>
<table id="CustomerMeetings-List" class="tabl-list" cellpadding="0" cellspacing="0">   
    <tr class="list-header">
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}       
        <th class="CustomerMeetings cols id"  {if !$formFilter->hasColumn('id')}style="display:none;"{/if}>
            <span>{__('id')|capitalize}</span>
            <div>               
                <a href="#" class="CustomerMeetings-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>              
            </div> 
        </th>                   
        <th class="CustomerMeetings cols date resize" width="{$formFilter.sizes.date}" name="date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>
            <span>{__('date')|capitalize}</span>  
            <div>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.in_at->getValueExist('asc','_active')}" id="asc" name="in_at"><img  src='{url("/icons/sort_asc`$formFilter.order.in_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.in_at->getValueExist('desc','_active')}" id="desc" name="in_at"><img  src='{url("/icons/sort_desc`$formFilter.order.in_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
         <th class="CustomerMeetings cols customer resize" width="{$formFilter.sizes.customer}" name="customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>
            <span>{__('customer')|capitalize}</span> 
              <div>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
        <th class="CustomerMeetings cols phone resize" width="{$formFilter.sizes.phone}" name="phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>
            <span>{__('phone')|capitalize}</span>  
        </th>            
        <th class="CustomerMeetings cols postcode resize" width="{$formFilter.sizes.postcode}" name="postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>
            <span>{__('postcode')|capitalize}</span>   
              <div>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>                
        <th class="CustomerMeetings cols city resize" width="{$formFilter.sizes.city}" name="city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>
            <span>{__('city')|capitalize}</span>   
              <div>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.city->getValueExist('asc','_active')}" id="asc" name="city"><img  src='{url("/icons/sort_asc`$formFilter.order.city->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.city->getValueExist('desc','_active')}" id="desc" name="city"><img  src='{url("/icons/sort_desc`$formFilter.order.city->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>{* commercial *}       
            <span>{__('commercial')|capitalize}</span>    
        </th>
        <th>{* telepro *}
           <span>{__('telepro')|capitalize}</span>        
        </th>
        <th>{* status *}
            <span>{__('status')|capitalize}</span>         
        </th>
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}      
       <td class="CustomerMeetings cols id" {if !$formFilter->hasColumn('id')}style="display:none;"{/if}>{* id *}
          <input class="search" type="text" size="5" name="id" value="{$formFilter.search.id}">
       </td>      
       <td class="CustomerMeetings cols date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>{* date *}
          <table cellpadding="0" cellspacing="0">
            <tr>
                <td><span>{__('from')}</span></td>
                <td><input class="range" id="in_at_from" type="text" size="7" name="in_at[from]" value="{format_date((string)$formFilter.range.in_at.from,'a')}"/> </td>
            </tr>
            <tr>
                <td><span>{__('to')}</span></td>
                <td><input  class="range" id="in_at_to" type="text" size="7" name="in_at[to]" value="{format_date((string)$formFilter.range.in_at.to,'a')}"/></td>
            <tr>
         </table> 
       </td>          
       <td class="CustomerMeetings cols customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>{* customer *}
           <input class="CustomerMeetings-search" type="text" size="5" name="lastname" value="{$formFilter.search.lastname}">
       </td>           
       <td class="CustomerMeetings cols phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>{* phone *}
            <input class="CustomerMeetings-search" type="text" size="5" name="phone" value="{$formFilter.search.phone}"> 
       </td>      
       <td class="CustomerMeetings cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
            <input class="CustomerMeetings-search" type="text" size="5" name="postcode" value="{$formFilter.search.postcode}"> 
       </td>               
       <td class="CustomerMeetings cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
            <input class="CustomerMeetings-search" type="text" size="5" name="city" value="{$formFilter.search.city}"> 
       </td>       
       <td>{* commercial *}
           {html_options class="CustomerMeetings-equal" name="sales_id" options=$formFilter->equal.sales_id->getOption('choices') selected=(string)$formFilter.equal.sales_id}
       </td>
       <td>{* telepro *}
            {html_options class="CustomerMeetings-equal" name="telepro_id" options=$formFilter->equal.telepro_id->getOption('choices') selected=(string)$formFilter.equal.telepro_id}
       </td>
       <td>{* status *}
         {html_options class="CustomerMeetings-equal" name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
       </td>
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="CustomerMeetings list" id="CustomerMeetings-{$item->get('id')}"> 
        <td class="CustomerMeetings-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerMeetingStatusI18n()}
                    <input class="{$site->getSiteID()}-CustomerMeetingsStatus-selection" type="checkbox" id="{$item->getCustomerMeetingStatusI18n()->get('id')}" name="{$item->getCustomerMeetingStatusI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}          
            <td class="CustomerMeetings cols id" {if !$formFilter->hasColumn('id')}style="display:none;"{/if}>{* id *}
                <span>{$item->get('id')}</span>
            </td>                     
            <td class="CustomerMeetings cols date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>{* date *}                
               {format_date($item->get('in_at'),'a')} {__('at')} {format_date($item->get('in_at'),'t')}
               <div>
               {__('Booked in')}&nbsp;{format_date($item->get('created_at'),'p')}
               </div>
            </td>                     
            <td class="CustomerMeetings cols customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>{* customer *} 
               {$item->getCustomer()->getLastname()} {$item->getCustomer()->getFirstname()}
            </td>                     
            <td class="CustomerMeetings cols phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>{* phone *}
                {$item->getCustomer()->getPhone()}  
            </td>           
            <td class="CustomerMeetings cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
                 {$item->getCustomer()->getAddress()->get('postcode')}  
            </td>           
            <td class="CustomerMeetings cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
                 {$item->getCustomer()->getAddress()->get('city')}   
            </td>           
              <td>{* commercial *}
                {$item->getSale()}   
            </td>
             <td>{* telepro *}
                 {$item->getTelepro()}   
            </td>
             <td>{* status *}
                {if $item->getStatus()->get('icon')} 
                   <img src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/> 
                {elseif $item->getStatus()->get('color')}
                <div style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                {/if}               
                {$item->getStatus()->getCustomerMeetingStatusI18n()->get('value')}
            </td>
            <td>               
                <a href="#" title="{__('edit')}" class="CustomerMeetings-View" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('delete')}" class="CustomerMeetings-Delete" id="{$item->get('id')}"  name="{$item->getCustomer()}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>               
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->hasItems()}
     <span>{__('No meeting')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="CustomerMeetings-all" /> 
          <a style="opacity:0.5" class="CustomerMeetings-actions_items" href="#" title="{__('delete')}" id="CustomerMeetings-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetings"}


<script type="text/javascript">
    
      function getMeetingsFilterParameters()
        {
           var params={ filter: {  order : { }, 
                                    // range: $(".range").getFilter(),                                     
                                     equal : {  
                                         sales_id : $("[name=sales_id] option:selected").val(), 
                                         telepro_id : $("[name=telepro_id] option:selected").val(), 
                                     },
                                     search: {  },  
                                     in : {  telepro_id: [],sales_id: [] },
                                     cols: [],
                                     sizes: { },
                                     nbitemsbypage: $("[name=CustomerMeetings-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            if ($(".CustomerMeetings-order_active").attr("name"))
                    params.filter.order[$(".CustomerMeetings-order_active").attr("name")] =$(".CustomerMeetings-order_active").attr("id");
            $(".CustomerMeetings-search").each(function() { params.filter.search[this.name] =this.value; });              
            $(".CustomerMeetings-in[name=telepro_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); }); 
            $(".CustomerMeetings-in[name=sales_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); }); 
            $(".CustomerMeetings[name=cols]:checked").each(function() { params.filter.cols.push($(this).attr('id')); }); 
            $(".CustomerMeetings.resize").each(function() {  params.filter.sizes[$(this).attr('name')] =$(this).width(); });
          //  alert("params="+params.toSource())
            return params;                  
        }
        
        function updateMeetingsFilter()
        {
           return $.ajax2({ data: getMeetingsFilterParameters(), 
                            url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeeting'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",
                            target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-base" });
        }
        
        $('.CustomerMeetings-order').click(function() {
            $(".CustomerMeetings-order_active").attr('class','CustomerMeetings-order');
            $(this).attr('class','CustomerMeetings-order_active');
            return updateMeetingsFilter();
        });

        $(".CustomerMeetings-search").keypress(function(event) {
            if (event.keyCode==13)
                return updateMeetingsFilter();
        });
        
        $(".CustomerMeetings-equal").change(function() { return updateMeetingsFilter(); }); 
         
        $("#CustomerMeetings-filter").click(function() { return updateMeetingsFilter(); }); 

        $(".CustomerMeetings-in[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
        
        $(".CustomerMeetings.cols").click(function() {           
            if ($(this).prop("checked"))
                $(".CustomerMeetings.cols."+$(this).attr('id')).show();
            else
                $(".CustomerMeetings.cols."+$(this).attr('id')).hide();
        });
        
        $(".CustomerMeetings.select").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
        
        $("#CustomerMeetings-init").click(function() { $.ajax2({ 
                url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeeting'])}",
                errorTarget: ".{$site->getSiteID()}-customers-meeting-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-base"}); 
        }); 


        $(".CustomerMeetings-pager").click(function () {             
                return $.ajax2({ data: getMeetingsFilterParameters(), 
                                 url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-customers-meeting-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",
                                 target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-base"
                });
        });
   {* =====================  A C T I O N S =============================== *}  
    
  
     
    $("#{$site->getSiteID()}-CustomerMeetings-New").click( function () {         
            if (addSiteTabField("{$site->getSiteID()}","customers-meeting","New","{__('New')}"))
                return false;             
            // tab-site-panel-www-ecosol-net-dashboard-site-customers-meeting-New
            return $.ajax2({                
                url: "{url_to('customers_meeting_ajax',['action'=>'NewMeeting'])}",
                errorTarget: ".{$site->getSiteID()}-customers-meeting-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",                             
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-New"
           });
    });
    
    $(".CustomerMeetings-View").click( function () {         
            addSiteTabField("{$site->getSiteID()}","customers-meeting",$(this).attr('id'),$(this).attr('name'));           
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'ViewMeeting'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",
               // target: "#site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-static-content",                
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-"+$(this).attr('id')
           });
    });
         
    $(".CustomerMeetings-Delete").click( function () { 
                if (!confirm('{__("Meeting \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerMeeting: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_ajax',['action'=>'DeleteMeeting'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteMeeting')
                                       {    
                                          $("tr#{$site->getSiteID()}-CustomerMeeting-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-CustomerMeeting').length==0)
                                              return $.ajax2({ url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeeting'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateMeetingsFilter(1);
                                        }       
                                 }
                     });                                        
      });
            
            
     $("#CustomerMeetings-List th").resizable({
			 handles: 'e' // ,
                            //     ghost:true, 
                           //      helper : "ui-resizable-helper"                 
     });

	


    
</script>         


