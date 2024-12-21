<!-- Theme -->
<style>
   /* .ui-resizable-helper { border: 1px dotted #FFFFFF; } */
    .ui-resizable-e { cursor: col-resize; }
</style>
{messages class="customers-meeting-site-errors"}
<h3>{__('Customer meeting')}</h3>   
<div>
 {if $user->hasCredential([['superadmin','admin','meeting_new']])} 
  <a href="#" class="btn" id="CustomerMeetings-New" title="{__('new meeting')}" ><i class="fa fa-plus"></i>
{*<img  src="{url('/icons/new.png','picture')}" alt="{__('new')}"/>*}{__('New meeting')}</a>
  {/if}
  {if $user->hasCredential([['superadmin','admin','meeting_export']])} 
  <a href="{url_to('customers_meeting',['action'=>'ExportMeeting'])}" target="_blank" class="btn" id="CustomerMeetings-Export" title="{__('export')}" ><i class="fa fa-caret-square-o-down"></i>
{*<img  src="{url('/icons/export.gif','picture')}" alt="{__('new')}"/>*}{__('Export')}</a>   
 {/if}
 {if $user->hasCredential([['superadmin','admin','meeting_exportKML']])} 
<a href="{url_to('customers_meeting',['action'=>'ExportKMLMeetings'])}" class="btn" id="CustomerMeetings-ExportKML" title="{__('export kml')}" ><img class="icon"  src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/>{__('Export KML')}</a>   
{/if}
 {if $user->hasCredential([['superadmin','admin','meeting_coordinates']])} 
  <a href="#" class="btn" id="CustomerMeetings-GenerateCoordinates" title="{__('Generate coordinates')}" ><img class="icon"  src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/>{__('Generate coordinates')}</a>   
  {/if}
</div>

<div class="filter" id="columns">
    <span class="filter-btn name-filter btn-table" id="columns">{__('Columns')} <i id="columns" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
    <div class="filter-content" id="columns">
    {foreach $formFilter->cols->getOption('choices') as $name}
        <div>
            <input type="checkbox" class="CustomerMeetings cols" name="cols" id="{$name}" {if in_array($name,(array)$formFilter.cols->getValue())}checked="checked"{/if}/>{__($name)}
         </div>  
    {/foreach} 
    <input type="checkbox" class="CustomerMeetings select" name="cols" {if $formFilter.cols->getValue()}checked=""{/if}/>{__('Select/unselect all')}
    </div> 
</div>
{if $pager->hasItems()}
    {* ========================= TELEPRO ======================== *}
     {if $formFilter->in->hasValidator('telepro_id')}  
        <div class="filter" id="telepro">   
            <span class="filter-btn name-filter btn-table" id="telepro">{__('Telepro')}<i id="telepro" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="telepro">
            {foreach $formFilter->in.telepro_id->getOption('choices') as $telepro}
                <div>
                    <input type="checkbox" class="CustomerMeetings-in telepro" name="telepro_id" id="{$telepro->get('id')}" {if in_array($telepro->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>{$telepro}
                </div>    
            {/foreach}    
            <input type="checkbox" class="CustomerMeetings-in" name="telepro"/>{__('Select/unselect all')}
            </div>
        </div>
     {/if}
     {* ========================= SALE 1 ======================== *}
     {if $formFilter->in->hasValidator('sales_id')}  
        <div class="filter" id="sales">    
            <span class="filter-btn name-filter btn-table" id="sales">{__('Sales')}<i id="sales" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="sales">
        {foreach $formFilter->in.sales_id->getOption('choices') as $sale}
            <div>
                 <input type="checkbox" class="CustomerMeetings-in sales" name="sales_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sales_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
            </div>    
        {/foreach}  
          <input type="checkbox" class="CustomerMeetings-in" name="sales"/>{__('Select/unselect all')}
          </div>
        </div>
    {/if}
{/if} 
<div style="clear: both"></div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetings"}
<button id="CustomerMeetings-filter" class="btn-table">{__("Filter")}</button>   
<button class="btn-table" id="CustomerMeetings-init">{__("Init")}</button>
<table id="CustomerMeetings-List" class="tabl-list footable table" cellpadding="0" cellspacing="0">   
    <thead>
    <tr class="list-header">
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}                                
        <th class="CustomerMeetings cols date resize footable-first-column" data-toggle="true" width="{$formFilter.sizes.date}" name="date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>
            <span>{__('date')|capitalize}</span>  
            <div class="order-rows">
                <a href="#" class="CustomerMeetings-order{$formFilter.order.in_at->getValueExist('asc','_active')}" id="asc" name="in_at"><img  src='{url("/icons/sort_asc`$formFilter.order.in_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.in_at->getValueExist('desc','_active')}" id="desc" name="in_at"><img  src='{url("/icons/sort_desc`$formFilter.order.in_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
         <th class="CustomerMeetings cols customer resize" data-hide="phone" style="display: table-cell;" width="{$formFilter.sizes.customer}" name="customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>
            <span>{__('customer')|capitalize}</span> 
              <div class="order-rows">
                <a href="#" class="CustomerMeetings-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
        <th class="CustomerMeetings cols phone resize" data-hide="phone,tablet" style="display: table-cell;" width="{$formFilter.sizes.phone}" name="phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>
            <span>{__('phone')|capitalize}</span>  
        </th>             
        <th class="CustomerMeetings cols postcode resize" data-hide="phone" style="display: table-cell;" width="{$formFilter.sizes.postcode}" name="postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>
            <span>{__('postcode')|capitalize}</span>   
              <div>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>                
        <th class="CustomerMeetings cols city resize" data-hide="phone,tablet" style="display: table-cell;" width="{$formFilter.sizes.city}" name="city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>
            <span>{__('city')|capitalize}</span>   
        <div class="order-rows">
                <a href="#" class="CustomerMeetings-order{$formFilter.order.city->getValueExist('asc','_active')}" id="asc" name="city"><img  src='{url("/icons/sort_asc`$formFilter.order.city->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetings-order{$formFilter.order.city->getValueExist('desc','_active')}" id="desc" name="city"><img  src='{url("/icons/sort_desc`$formFilter.order.city->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th data-hide="phone" style="display: table-cell;">{* commercial *}       
            <span>{__('commercial')|capitalize}</span>    
        </th>
          <th data-hide="phone" style="display: table-cell;">{* commercial *}       
            <span>{__('commercial2')|capitalize}</span>    
        </th>
        {if $formFilter->equal->hasValidator('telepro_id')}  
        <th data-hide="phone,tablet" style="display: table-cell;">{* telepro *}
           <span>{__('telepro')|capitalize}</span>        
        </th>
        {/if}
        <th data-hide="phone" style="display: table-cell;">{* status *}
            <span>{__('status')|capitalize}</span>         
        </th>
        <th class="CustomerMeetings cols is_confirmed" data-hide="phone" style="display: table-cell;" {if !$formFilter->hasColumn('is_confirmed')}style="display:none;"{/if}>{* is_confirmed *}
            <span>{__('Confirmed')|capitalize}</span>  
        </th>
        <th class="footable-last-column" data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr>
</thead>
<tbody>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}                
       <td class="CustomerMeetings cols date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>{* date *}   
            <div>
               {__('from')}
                <input class="CustomerMeetings range" id="in_at_from" type="text" size="10" name="in_at[from]" value="{if $formFilter.date_rdv->getValue()}{format_date((string)$formFilter.range.created_at.from,'a')}{else}{format_date((string)$formFilter.range.in_at.from,'a')}{/if}"/>
            </div>
            <div>
               {__('to')}
                <input  class="CustomerMeetings range" id="in_at_to" type="text" size="10" name="in_at[to]" value="{if $formFilter.date_rdv->getValue()}{format_date((string)$formFilter.range.created_at.to,'a')}{else}{format_date((string)$formFilter.range.in_at.to,'a')}{/if}"/>
            </div>
            <input type="checkbox" class="CustomerMeetings" name="date_rdv" {if $formFilter.date_rdv->getValue()}checked="checked"{/if}/>{__('Meeting date')}
       </td> 
       
       <td class="CustomerMeetings cols customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>{* customer *}
           <input class="CustomerMeetings-search" type="text" size="8" name="lastname" value="{$formFilter.search.lastname}">
       </td>           
       <td class="CustomerMeetings cols phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>{* phone *}
            <input class="CustomerMeetings-search" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </td>       
       <td class="CustomerMeetings cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
            <input class="CustomerMeetings-search" type="text" size="5" name="postcode" value="{$formFilter.search.postcode}"> 
       </td>               
       <td class="CustomerMeetings cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
            <input class="CustomerMeetings-search" type="text" size="8" name="city" value="{$formFilter.search.city}"> 
       </td>       
       <td>{* commercial *}
           {if count($formFilter->equal.sales_id->getOption('choices')) >1}
                {html_options style="width:88" class="CustomerMeetings-equal" name="sales_id" options=$formFilter->equal.sales_id->getOption('choices') selected=(string)$formFilter.equal.sales_id}
           {else}
               {__('---')}
           {/if}    
       </td>
         <td>{* commercial2 *}
           {if count($formFilter->equal.sale2_id->getOption('choices')) >1}
           {html_options style="width:88" class="CustomerMeetings-equal" name="sale2_id" options=$formFilter->equal.sale2_id->getOption('choices') selected=(string)$formFilter.equal.sale2_id}
           {else}---
           {/if}
       </td>
       {if $formFilter->equal->hasValidator('telepro_id')} 
       <td>{* telepro *}
            {if count($formFilter->equal.telepro_id->getOption('choices')) >1}
                {html_options style="width:88" class="CustomerMeetings-equal" name="telepro_id" options=$formFilter->equal.telepro_id->getOption('choices') selected=(string)$formFilter.equal.telepro_id}
            {else}
               {__('---')}
           {/if} 
       </td>
       {/if}
       <td>{* status *}
         {html_options style="width:74" class="CustomerMeetings-equal"  name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
       </td>
       <td class="CustomerMeetings cols is_confirmed" {if !$formFilter->hasColumn('is_confirmed')}style="display:none;"{/if}>{* is_confirmed *}
         {html_options_format format="__" class="CustomerMeetings-equal" name="is_confirmed" options=$formFilter->equal.is_confirmed->getOption('choices') selected=(string)$formFilter.equal.is_confirmed}
       </td>
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="CustomerMeetings list" id="CustomerMeetings-{$item->get('id')}" name="{$item->getCustomer()}"> 
        <td class="CustomerMeetings-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="CustomerMeetings-selection" type="checkbox" id="{$item->get('id')}" name=""/>                       
                </td>
            {/if}          
                           
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
                <div>{$item->getCustomer()->getPhone()}</div>
                <div>{$item->getCustomer()->getMobile()}</div>                
            </td>             
            <td class="CustomerMeetings cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
                 {$item->getCustomer()->getAddress()->get('postcode')}  
            </td>           
            <td class="CustomerMeetings cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
                 {$item->getCustomer()->getAddress()->get('city')}   
            </td>           
              <td>{* commercial1 *}
                {if $item->hasSale()}
                    {$item->getSale()->getName(false)}
                    <div>
                    {if $user->hasCredential([['superadmin','admin','meeting_sale_sms_send']])} 
                    <a href="#" title="{__('Send SMS')}" class="CustomerMeetings-SmsForSale1" id="{$item->get('id')}" name="{$item->getSale()}">
                    <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                    {/if}
                     {if $user->hasCredential([['superadmin','admin','meeting_sale_email_send']])} 
                    <a href="#" title="{__('Send Email')}" class="CustomerMeetings-EmailForSale1" id="{$item->get('id')}" name="{$item->getSale()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a> 
                     {/if}
                     </div>
                {/if}
            </td>
              <td>{* commercial2 *}              
                {if $item->hasSale2()}
                    {$item->getSale2()->getName(false)}
                    <div>
                      {if $user->hasCredential([['superadmin','admin','meeting_sale_sms_send']])} 
                     <a href="#" title="{__('Send SMS')}" class="CustomerMeetings-SmsForSale2" id="{$item->get('id')}" name="{$item->getSale2()}">
                    <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                    {/if}
                     {if $user->hasCredential([['superadmin','admin','meeting_sale_email_send']])} 
                    <a href="#" title="{__('Send Email')}" class="CustomerMeetings-EmailForSale2" id="{$item->get('id')}" name="{$item->getSale2()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a> 
                     {/if}
                     </div>                     
                {/if}
            </td>
            {if $formFilter->equal->hasValidator('telepro_id')} 
             <td>{* telepro *}
                 {$item->getTelepro()->getName(false)}   
            </td>
            {/if}
             <td>{* status *}
                {if $item->hasStatus()}
                {if $item->getStatus()->get('icon')} 
                    <img class="icon" src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/> 
                {elseif $item->getStatus()->get('color')}
                    <div class="color" style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                {/if}               
                {$item->getStatus()->getCustomerMeetingStatusI18n()->get('value')}
                {else}
                    ---
                {/if}    
            </td>
            <td class="CustomerMeetings cols is_confirmed" {if !$formFilter->hasColumn('is_confirmed')}style="display:none;"{/if}>{* is_confirmed *}
                {if $item->isConfirmed()}{__('Confirmed')}{else}{__('Not confirmed')}{/if}
            </td>
            <td> 
                {if $user->hasCredential([['superadmin','admin','meeting_confirmation']])} 
                    {if $item->isConfirmed()}
                         <a href="#" title="{__('Click to cancel confirmation')}" class="CustomerMeetings-Confirm" id="{$item->get('id')}" name="Cancel">
                         <img class="CustomerMeetings-Confirm-img" id="{$item->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Confirmed")}'/></a> 
                    {else}
                        <a href="#" title="{__('Click to confirm')}" class="CustomerMeetings-Confirm" id="{$item->get('id')}" name="Confirm">
                        <img class="CustomerMeetings-Confirm-img" id="{$item->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/></a>  
                    {/if}
                {/if}
                {if $user->hasCredential([['superadmin','admin','meeting_view']])} 
                <a href="#" title="{__('Edit')}" class="CustomerMeetings-View" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> 
                {/if}     
                {if $user->hasCredential([['superadmin','admin','meeting_customer_sms_send']])} 
                <a href="#" title="{__('Send SMS')}" class="CustomerMeetings-Sms" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                {/if}
                 {if $user->hasCredential([['superadmin','admin','meeting_customer_email_send']])} 
                <a href="#" title="{__('Send Email')}" class="CustomerMeetings-Email" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a> 
                {/if}
                 {if $user->hasCredential([['superadmin','admin','meeting_exportKML']])} 
                <a href="{url_to('customers_meeting',['action'=>'ExportKMLMeeting'])}?meeting={$item->get('id')}" title="{__('Export Kml')}">
                     <img  src="{url('/icons/files/kml.gif','picture')}" alt='{__("Export Kml")}'/></a> 
                {/if}
                 {if $user->hasCredential([['superadmin','admin','meeting_delete']])} 
                <a href="#" title="{__('Delete')}" class="CustomerMeetings-Delete" id="{$item->get('id')}"  name="{$item->getCustomer()} {__('at')} {format_date($item->get('in_at',"d"))}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/></a>      
                {/if}
             {*   <a href="#" title="{__('Test')}" class="CustomerMeetings-Test" id="{$item->get('id')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>  *}     
            </td>
    </tr>    
    {/foreach}  
</tbody>
</table>    
{if !$pager->hasItems()}
     <span>{__('No meeting')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="CustomerMeetings-all" /> 
        {if $user->hasCredential([['superadmin','admin','meeting_delete_multiple']])} 
          <a style="opacity:0.5" class="CustomerMeetings-actions_items" href="#" title="{__('delete')}" id="CustomerMeetings-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
        {/if}   
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetings"}


<script type="text/javascript">
    

    function openCustomerMeetingsTab(tab,meeting_id)
    {
        
    }
    
     var dates = $( ".CustomerMeetings#in_at_from, .CustomerMeetings#in_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "in_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );
    
      function getMeetingsFilterParameters()
        {
           var params={ filter: {  order : { }, 
                                     range: $(".CustomerMeetings.range").getFilter(),                                        
                                     equal : {  
                                         sales_id : $("[name=sales_id] option:selected").val(), 
                                         telepro_id : $("[name=telepro_id] option:selected").val(), 
                                         state_id : $("[name=state_id] option:selected").val(), 
                                         is_confirmed : $("[name=is_confirmed] option:selected").val() 
                                     },
                                     search: {  },  
                                     in : {  telepro_id: [],sales_id: [] },
                                     cols: [],
                                     sizes: { },
                                     date_rdv : $(".CustomerMeetings[name=date_rdv]").prop('checked'),
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
                            errorTarget: ".customers-meeting-site-errors",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-base" });
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
        
        $(".CustomerMeetings-equal,[name=CustomerMeetings-nbitemsbypage]").change(function() { return updateMeetingsFilter(); }); 
         
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
                errorTarget: ".customers-meeting-errors",                
                loading: "#tab-site-dashboard-customers-meeting-loading",
                target: "#tab-site-panel-dashboard-customers-meeting-base"}); 
        }); 

        $(".CustomerMeetings-pager").click(function () {             
                return $.ajax2({ data: getMeetingsFilterParameters(), 
                                 url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".customers-meeting-site-errors",
                                 loading: "#tab-site-dashboard-customers-meeting-loading",
                                 target: "#tab-site-panel-dashboard-customers-meeting-base"
                });
        });

   {* =====================  A C T I O N S =============================== *}  
    
    $("#CustomerMeetings-New").click( function () {         
            if (addTabField("customers-meeting","New","{__('New')}"))
                return false;                         
            return $.ajax2({                
                url: "{url_to('customers_meeting_ajax',['action'=>'NewMeeting'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                             
                target: "#tab-site-panel-dashboard-customers-meeting-New"
           });
    });
    
      $(".CustomerMeetings-View").click( function () {    
            id=$(this).attr('id');           
            addTabField("customers-meeting",id,$(this).attr('name'));           
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'ViewMeeting'])}",
                error: function () { closeTabField("customers-meeting",id); },
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                target: "#tab-site-panel-dashboard-customers-meeting-"+$(this).attr('id')
           });
    });
    
     $(".CustomerMeetings.list").dblclick( function () {         
            addTabField("customers-meeting",$(this).attr('id').replace('CustomerMeetings-',''),$(this).attr('name'));           
            return $.ajax2({     
                data : { Meeting: $(this).attr('id').replace('CustomerMeetings-','') },
                url: "{url_to('customers_meeting_ajax',['action'=>'ViewMeeting'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",                           
                target: "#tab-site-panel-dashboard-customers-meeting-"+$(this).attr('id').replace('CustomerMeetings-','')
           });
    });
    
     $(".CustomerMeetings-Confirm").click( function () {   
            if ($(this).attr('name')=='Confirm')
            {
               return $.ajax2({     
                    data : { Meeting: $(this).attr('id') },
                    url: "{url_to('customers_meeting_ajax',['action'=>'ConfirmMeeting'])}",
                    errorTarget: ".customers-meeting-site-errors",
                    loading: "#tab-site-dashboard-customers-meeting-loading",
                    success: function (resp)
                             {
                                if (resp.action=='ConfirmMeeting')
                                {                                        
                                      $(".CustomerMeetings-Confirm[id="+resp.id+"]").attr({ name:"Cancel", title: "{__('Click to cancel confirmation')}" });
                                      $(".CustomerMeetings-Confirm-img[id="+resp.id+"]").attr({ 
                                              src: "{url('/icons/approved16x16.png','picture')}",
                                              alt: "{__('cancel')}"
                                      });  
                                }
                             }
                 });
            }    
            else
            {
                return $.ajax2({     
                    data : { Meeting: $(this).attr('id') },
                    url: "{url_to('customers_meeting_ajax',['action'=>'CancelMeeting'])}",
                    errorTarget: ".customers-meeting-site-errors",
                    loading: "#tab-site-dashboard-customers-meeting-loading",
                    success: function (resp)
                             {
                                if (resp.action=='CancelMeeting')
                                {                                        
                                      $(".CustomerMeetings-Confirm[id="+resp.id+"]").attr({ name: "Confirm", title: "{__('Click to confirm')}" });                                     
                                      $(".CustomerMeetings-Confirm-img[id="+resp.id+"]").attr({ 
                                              src: "{url('/icons/refused16x16.png','picture')}",
                                              alt: "{__('confirm')}"
                                      });  
                                }
                             }
                 });
            }    
         return false;           
     });
     
      $(".CustomerMeetings-Sms").click( function () {         
            addTabField("customers-meeting","sms-"+$(this).attr('id'),$(this).attr('name')+" - {__('New SMS')}");           
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'SmsMeeting'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                target: "#tab-site-panel-dashboard-customers-meeting-sms-"+$(this).attr('id')
           });
     });
     
      $(".CustomerMeetings-Email").click( function () {         
            addTabField("customers-meeting","email-"+$(this).attr('id'),$(this).attr('name')+" - {__('New email')}");                      
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'EmailMeeting'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                             
                target: "#tab-site-panel-dashboard-customers-meeting-email-"+$(this).attr('id')              
           });           
    });
    
    $(".CustomerMeetings-SmsForSale1,.CustomerMeetings-SmsForSale2").click( function () {         
            addTabField("customers-meeting","sms-"+$(this).attr('id'),"{__('New SMS for ')}"+$(this).attr('name'));                       
            return $.ajax2({     
                data : {    Meeting: $(this).attr('id'),
                            MeetingSaleSMS: { 
                                          sale: $(this).attr('class').replace('CustomerMeetings-SmsFor',''),
                                          token : "{mfForm::getToken('MeetingSaleForm')}" } },
                url: "{url_to('customers_meeting_ajax',['action'=>'SmsMeetingForSale'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                target: "#tab-site-panel-dashboard-customers-meeting-sms-"+$(this).attr('id')
           });
     });
     
     $(".CustomerMeetings-EmailForSale1,.CustomerMeetings-EmailForSale2").click( function () {         
            addTabField("customers-meeting","email-"+$(this).attr('id'),"{__('New email for ')}"+$(this).attr('name'));                      
            return $.ajax2({     
                data : { Meeting: $(this).attr('id'),
                         MeetingEmailSale: { 
                                          sale: $(this).attr('class').replace('CustomerMeetings-EmailFor',''),
                                          token : "{mfForm::getToken('MeetingSaleForm')}" } },
                url: "{url_to('customers_meeting_ajax',['action'=>'EmailMeetingForSale'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                             
                target: "#tab-site-panel-dashboard-customers-meeting-email-"+$(this).attr('id')              
           });           
    }); 
    
    $(".CustomerMeetings-Delete").click( function () {    
            if (!confirm('{__("Meeting \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'DeleteMeeting'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",
                success: function (resp)
                         {
                             if (resp.action=='DeleteMeeting')
                             {
                                 $("#CustomerMeetings-"+resp.id).remove();    
                                 if ($(".CustomerMeetings").length==0)
                                 {
                                      $("#CustomerMeetings-List").after("{__("No meeting")}")
                                 }    
                             }    
                         }
           });
       });
       
         $(".filter-btn").click(function() {   
            $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();            
           /* $('.iconfont[id='+$(this).attr('id')+"]").toggleClass('fa fa-sort-desc fa fa-sort-asc');*/
    });
    
    $('.filter-content').mouseleave( function() { $('.filter-content').hide();} );
</script>         


