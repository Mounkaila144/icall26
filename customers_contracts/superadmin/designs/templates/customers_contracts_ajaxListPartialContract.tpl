{messages class="{$site->getSiteID()}-customers-contract-site-errors"}
<h3>{__('Customer contract')}</h3>    
<div>
 {* <a href="#" class="btn" id="{$site->getSiteID()}-CustomerContracts-New" title="{__('new')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New contract')}</a>    *}
  <a href="#" class="btn" id="{$site->getSiteID()}-CustomerContracts-Export" title="{__('export')}" ><img  src="{url('/icons/export.gif','picture')}" alt="{__('new')}"/>{__('Export')}</a>   
</div>
<div class="filter" id="columns">
    <span class="filter-btn name-filter btn-table" id="columns">{__('Columns')} <i id="columns" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
    <div class="filter-content" id="columns">
    {foreach $formFilter->cols->getOption('choices') as $name}
        <div>
            <input type="checkbox" class="CustomerContracts cols" name="cols" id="{$name}" {if in_array($name,(array)$formFilter.cols->getValue())}checked="checked"{/if}/>{__($name)}
         </div>  
    {/foreach} 
    <input type="checkbox" class="CustomerContracts select" name="cols" {if $formFilter.cols->getValue()}checked=""{/if}/>{__('Select/unselect all')}
    </div> 
</div>
<div style="clear: both"></div>    
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerContracts"}
<button id="CustomerContracts-filter" class="btn-table">{__("Filter")}</button>   
<button class="btn-table" id="CustomerContracts-init">{__("Init")}</button>
<table id="CustomerContracts-List" class="tabl-list" cellpadding="0" cellspacing="0">   
  <tr class="list-header">
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}       
        <th class="CustomerContracts cols id"  {if !$formFilter->hasColumn('id')}style="display:none;"{/if}>
            <span>{__('id')|capitalize}</span>
            <div>               
                <a href="#" class="CustomerContracts-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>              
            </div> 
        </th>                   
        <th class="CustomerContracts cols date resize" width="{$formFilter.sizes.date}" name="date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>
            <span>{__('date')|capitalize}</span>  
            <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.in_at->getValueExist('asc','_active')}" id="asc" name="in_at"><img  src='{url("/icons/sort_asc`$formFilter.order.in_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.in_at->getValueExist('desc','_active')}" id="desc" name="in_at"><img  src='{url("/icons/sort_desc`$formFilter.order.in_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
         <th class="CustomerContracts cols customer resize" width="{$formFilter.sizes.customer}" name="customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>
            <span>{__('customer')|capitalize}</span> 
              <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
        <th class="CustomerContracts cols phone resize" width="{$formFilter.sizes.phone}" name="phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>
            <span>{__('phone')|capitalize}</span>  
        </th>            
        <th class="CustomerContracts cols postcode resize" width="{$formFilter.sizes.postcode}" name="postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>
            <span>{__('postcode')|capitalize}</span>   
              <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>                
        <th class="CustomerContracts cols city resize" width="{$formFilter.sizes.city}" name="city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>
            <span>{__('city')|capitalize}</span>   
              <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.city->getValueExist('asc','_active')}" id="asc" name="city"><img  src='{url("/icons/sort_asc`$formFilter.order.city->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.city->getValueExist('desc','_active')}" id="desc" name="city"><img  src='{url("/icons/sort_desc`$formFilter.order.city->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="input-list">
       <td>{* # *}</td>
       <td>{* id *}</td>
       <td>{* date *}</td>
       <td>{* customer *}</td>
       <td>{* phone *}</td>
       <td>{* postcode *}</td>
       <td>{* city *}</td>
       <td>{* commercial *}</td>
       <td>{* telepro *}</td>
       <td>{* status *}</td>
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="CustomerContracts list" id="CustomerContracts-{$item->get('id')}" name="{$item->getCustomer()}"> 
         <td class="CustomerContracts-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerContractStatusI18n()}
                    <input class="{$site->getSiteID()}-CustomerContractsStatus-selection" type="checkbox" id="{$item->getCustomerContractStatusI18n()->get('id')}" name="{$item->getCustomerContractStatusI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if} 
         </td>   
         <td class="CustomerContracts cols id" {if !$formFilter->hasColumn('id')}style="display:none;"{/if}>{* id *}
                <span>{$item->get('id')}</span>
         </td>
         <td class="CustomerContracts cols date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>{* date *}                
               {* {format_date($item->get('in_at'),'a')} {__('at')} {format_date($item->get('in_at'),'t')} *}
               <div>
               {__('Booked in')}&nbsp;{format_date($item->get('created_at'),'p')}
               </div>
          </td> 
          <td class="CustomerContracts cols customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>{* customer *} 
               {$item->getCustomer()->getLastname()} {$item->getCustomer()->getFirstname()}
          </td>  
           <td class="CustomerContracts cols phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>{* phone *}
                {$item->getCustomer()->getPhone()}  
            </td>           
            <td class="CustomerContracts cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
                 {$item->getCustomer()->getAddress()->get('postcode')}  
            </td>           
            <td class="CustomerContracts cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
                 {$item->getCustomer()->getAddress()->get('city')}   
            </td>  
            <td>
              {*  {$item->getTelepro()} *}
            </td>
            <td>
            </td>
             <td>{* status *}
                {if $item->getStatus()->get('icon')} 
                   <img src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/> 
                {elseif $item->getStatus()->get('color')}
                <div style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                {/if}               
                {$item->getStatus()->getCustomerContractStatusI18n()->get('value')}
            </td>
            <td>               
                <a href="#" title="{__('edit')}" class="CustomerContracts-View" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
              {*  <a href="#" title="{__('edit')}" class="CustomerContracts-Product" id="{$item->get('id')}">
                     <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a> *}
              {*  <a href="#" title="{__('contributor')}" class="CustomerContracts-Contributor" id="{$item->get('id')}">
                     <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a>  *}
                 <a href="#" title="{__('Send SMS')}" class="CustomerContracts-Sms" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                <a href="#" title="{__('Send Email')}" class="CustomerContracts-Email" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a> 
                <a href="#" title="{__('delete')}" class="CustomerContracts-Delete" id="{$item->get('id')}"  name="{$item->getCustomer()} ({format_date($item->get('created_at'),'p')})">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>               
            </td>
    </tr>
    {/foreach}
</table>



<script type="text/javascript">
    
    {* =====================  P A G E R S =============================== *}  
    
      function getContractsFilterParameters()
        {
           var params={ filter: {  order : { }, 
                                    // range: $(".range").getFilter(),                                     
                                     equal : {  
                                        // sales_id : $("[name=sales_id] option:selected").val(), 
                                       //  telepro_id : $("[name=telepro_id] option:selected").val(), 
                                         state_id : $("[name=state_id] option:selected").val(), 
                                     },
                                     search: {  },  
                                //     in : {  telepro_id: [],sales_id: [] },
                                     cols: [],
                                     sizes: { },
                                     nbitemsbypage: $("[name=CustomerContracts-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            if ($(".CustomerContracts-order_active").attr("name"))
                    params.filter.order[$(".CustomerContracts-order_active").attr("name")] =$(".CustomerContracts-order_active").attr("id");
            $(".CustomerContracts-search").each(function() { params.filter.search[this.name] =this.value; });              
        //    $(".CustomerContracts-in[name=telepro_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); }); 
        //    $(".CustomerContracts-in[name=sales_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); }); 
            $(".CustomerContracts[name=cols]:checked").each(function() { params.filter.cols.push($(this).attr('id')); }); 
            $(".CustomerContracts.resize").each(function() {  params.filter.sizes[$(this).attr('name')] =$(this).width(); });
          //  alert("params="+params.toSource())
            return params;                  
        }
        
        function updateContractsFilter()
        {
           return $.ajax2({ data: getContractsFilterParameters(), 
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}" , 
                            errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",
                            target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-base" });
        }
        
        $('.CustomerContracts-order').click(function() {
            $(".CustomerContracts-order_active").attr('class','CustomerContracts-order');
            $(this).attr('class','CustomerContracts-order_active');
            return updateContractsFilter();
        });

        $(".CustomerContracts-search").keypress(function(event) {
            if (event.keyCode==13)
                return updateContractsFilter();
        });
        
        $(".CustomerContracts-equal,[name=CustomerContracts-nbitemsbypage]").change(function() { return updateContractsFilter(); }); 
         
        $("#CustomerContracts-filter").click(function() { return updateContractsFilter(); }); 

        $(".CustomerContracts-in[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
        
        $(".CustomerContracts.cols").click(function() {           
            if ($(this).prop("checked"))
                $(".CustomerContracts.cols."+$(this).attr('id')).show();
            else
                $(".CustomerContracts.cols."+$(this).attr('id')).hide();
        });
        
        $(".CustomerContracts.select").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
        
        $("#CustomerContracts-init").click(function() { $.ajax2({ 
                url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",                
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-base"}); 
        }); 

        $(".CustomerContracts-pager").click(function () {             
                return $.ajax2({ data: getContractsFilterParameters(), 
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",
                                 target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-base"
                });
        });
   
    {* =====================  A C T I O N S =============================== *}  
    
     $(".CustomerContracts-View").click( function () {         
            addSiteTabField("{$site->getSiteID()}","customers-contract",$(this).attr('id'),$(this).attr('name'));           
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContract'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                         
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-"+$(this).attr('id')
           });
    });
    
    
      $(".CustomerContracts.list").dblclick( function () {         
            addSiteTabField("{$site->getSiteID()}","customers-contract",$(this).attr('id').replace('CustomerContracts-',''),$(this).attr('name'));           
            return $.ajax2({     
                data : { Contract: $(this).attr('id').replace('CustomerContracts-','') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContract'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                         
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-"+$(this).attr('id').replace('CustomerContracts-','')
           });
    });
    
    
     $(".CustomerContracts-Product").click( function () {                        
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'GenerateProduct'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                                         
           });
    });
    
      $(".CustomerContracts-Contributor").click( function () {                        
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'CreateContributor'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading"
           });
    });
    
     $(".CustomerContracts-Sms").click( function () {         
            addSiteTabField("{$site->getSiteID()}","customers-contract","sms-"+$(this).attr('id'),$(this).attr('name')+" - {__('New SMS')}");           
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'SmsContract'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",  
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-sms-"+$(this).attr('id')
              //  target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-sms-"+$(this).attr('id')
           });
     });
    
     $(".CustomerContracts-Email").click( function () {         
            addSiteTabField("{$site->getSiteID()}","customers-contract","email-"+$(this).attr('id'),$(this).attr('name')+" - {__('New email')}");                      
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'EmailContract'])}",                                             
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",  
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-email-"+$(this).attr('id')
           });           
    });
    
      $(".CustomerContracts-Delete").click( function () {    
            if (!confirm('{__("Contract \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'DeleteContract'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",
                success: function (resp)
                         {
                             if (resp.action=='DeleteContract')
                             {
                                 $("#CustomerContracts-"+resp.id).remove();    
                                 if ($(".CustomerContracts.list").length==0)
                                 {
                                      $("#CustomerContracts-List").after("{__("No Contract")}")
                                 }    
                             }    
                         }
           });
       });
    {* ================= OTHERS ====================================================== *}
            
    $(".filter-btn").click(function() {   
            $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();            
            $('.iconfont[id='+$(this).attr('id')+"]").toggleClass('fa fa-sort-desc fa fa-sort-asc');
    });
    
    $('.filter-content').mouseleave( function() { $('.filter-content').hide();} );
</script>    
