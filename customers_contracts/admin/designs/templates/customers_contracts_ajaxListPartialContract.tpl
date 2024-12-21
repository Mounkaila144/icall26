{messages class="customers-contract-errors"}
<h3>{__('Customer contract')}</h3> 

{if $user->hasCredential([['superadmin','admin','contract_turnover']])}    
<h4>{__('Turnover')}:{format_currency($pager->getTurnover(),$settings_contracts->get('default_currency'))}</h4>
{/if}
<div>
  {if $user->hasCredential([['superadmin','admin','contract_new']])} 
  {* not implemented  <a href="#" class="btn" id="CustomerContracts-New" title="{__('new')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New contract')}</a>    *}
  {/if}   
  {if $user->hasCredential([['superadmin','admin','contract_export']])} 
  <a href="#" class="btn" id="CustomerContracts-Export" title="{__('export')}" ><img  src="{url('/icons/export.gif','picture')}" alt="{__('new')}"/>{__('Export')}</a>   
  {/if}
  {if $user->hasCredential([['superadmin','admin','contract_import']])}    
  <a class="btn" id="CustomerContracts-Import" href="#">
        <img src="{url('/icons/import.gif','picture')}" alt="{__('import')}"/>{__('import')|capitalize}
  </a> 
  {/if}    
  {if $user->hasCredential([['superadmin','admin','contract_exportKml']])}   
 {* <a href="{url_to('customers_contracts',['action'=>'ExportKMLContracts'])}" class="btn" id="CustomerContracts-ExportKML" title="{__('export kml')}" ><img class="icon"  src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/>{__('Export KML')}</a>    *}
  <a href="{url_to('customers_contracts',['action'=>'ExportKMLFilterContracts'])}?{$formFilter->getParametersForUrl()}" class="btn" id="CustomerContracts-ExportFilterKML" title="{__('export kml')}" ><img class="icon"  src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/>{__('Export KML')}</a>   
  {/if}
  {if $user->hasCredential(['superadmin'])}
  <a href="#" class="btn" id="CustomerContracts-GenerateCoordinates" title="{__('Generate coordinates')}" ><img class="icon"  src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/>{__('Generate coordinates')}</a>   
  {/if}
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
{if $pager->hasItems()}
    {* ================== SALE 1 =========================== *}
    {if $formFilter->in->hasValidator('sale_1_id')} 
    <div class="filter" id="sale1">    
      <span class="filter-btn name-filter btn-table" id="sale1">{__('Sale1')}<i id="sale1" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="sale1">
    {foreach $formFilter->in.sale_1_id->getOption('choices') as $sale}
        <div>
             <input type="checkbox" class="CustomerContracts-in sale1" name="sale_1_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_1_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="sale1"/>{__('Select/unselect all')}
      </div>
   </div>
   {/if}   
      {* ================== SALE 2 =========================== *}
      {if $formFilter->in->hasValidator('sale_2_id')} 
  <div class="filter" id="sale2">    
      <span class="filter-btn name-filter btn-table" id="sale2">{__('Sale2')}<i id="sale2" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="sale2">
    {foreach $formFilter->in.sale_2_id->getOption('choices') as $sale}
        <div>
             <input type="checkbox" class="CustomerContracts-in sale2" name="sale_2_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_2_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="sale2"/>{__('Select/unselect all')}
      </div>
  </div>    
      {/if}
  {* ================== TELEPRO =========================== *}
  {if $formFilter->in->hasValidator('telepro_id')} 
  <div class="filter" id="telepro">    
      <span class="filter-btn name-filter btn-table" id="telepro">{__('Telepro')}<i id="telepro" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="telepro">
    {foreach $formFilter->in.telepro_id->getOption('choices') as $sale}
        <div>
             <input type="checkbox" class="CustomerContracts-in telepro" name="telepro_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="telepro"/>{__('Select/unselect all')}
      </div>
  </div>
  {/if}
  
 {* ================== TEAM =========================== *}
 {if $formFilter->in->hasValidator('team')} 
  <div class="filter" id="team">    
      <span class="filter-btn name-filter btn-table" id="team">{__('Team')}<i id="team" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="team">
    {foreach $formFilter->in.team_id->getOption('choices') as $team}
        <div>
             <input type="checkbox" class="CustomerContracts-in team" name="team_id" id="{$team->get('id')}" {if in_array($team->get('id'),(array)$formFilter.in.team_id->getValue())}checked="checked"{/if}/>{if $team->isLoaded()}{$team->get('name')}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="team"/>{__('Select/unselect all')}
      </div>
  </div>     
  {/if}
  {* ================== STATE =========================== *}  
  <div class="filter" id="state">    
      <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="state">
    {foreach $formFilter->in.state_id->getOption('choices') as $state}
        <div>           
             <input type="checkbox" class="CustomerContracts-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="state"/>{__('Select/unselect all')}
      </div>
  </div>  
  {* ================== PRODUCT =========================== *}
  <div class="filter" id="product">    
      <span class="filter-btn name-filter btn-table" id="product">{__('Products')}<i id="product" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="product">
    {foreach $formFilter->in.product_id->getOption('choices') as $product}
        <div>           
             <input type="checkbox" class="CustomerContracts-in product" name="product_id" id="{$product->get('id')}" {if in_array($product->get('id'),(array)$formFilter.in.product_id->getValue())}checked="checked"{/if}/>{if $product->isLoaded()}{$product->get('meta_title')}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="product"/>{__('Select/unselect all')}
      </div>
  </div>
    {* ================== PARTNER =========================== *}
  <div class="filter" id="partner">    
      <span class="filter-btn name-filter btn-table" id="partner">{__('Partners')}<i id="partner" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="partner">
    {foreach $formFilter->in.financial_partner_id->getOption('choices') as $partner}
        <div>           
             <input type="checkbox" class="CustomerContracts-in partner" name="financial_partner_id" id="{$partner->get('id')}" {if in_array($partner->get('id'),(array)$formFilter.in.financial_partner_id->getValue())}checked="checked"{/if}/>{if $partner->isLoaded()}{$partner->get('name')}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in" name="partner"/>{__('Select/unselect all')}
      </div>
  </div>
{/if}    

<div style="clear: both"></div>    
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerContracts"}
<button id="CustomerContracts-filter" class="btn-table">{__("Filter")}</button>   
<button class="btn-table" id="CustomerContracts-init">{__("Init")}</button>
<table id="CustomerContracts-List" class="tabl-list" cellpadding="0" cellspacing="0">   
  <tr class="list-header">
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}                                
        <th class="CustomerContracts cols date resize" width="{$formFilter.sizes.date}" name="date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>
            <span>{__('date')|capitalize}</span>  
            <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.opened_at->getValueExist('asc','_active')}" id="asc" name="opened_at"><img  src='{url("/icons/sort_asc`$formFilter.order.opened_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.opened_at->getValueExist('desc','_active')}" id="desc" name="opened_at"><img  src='{url("/icons/sort_desc`$formFilter.order.opened_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>              
         <th class="CustomerContracts cols customer resize" width="{$formFilter.sizes.customer}" name="customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>
            <span>{__('customer')|capitalize}</span> 
              <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>  
        <th>
             <span>{__('products')|capitalize}</span> 
        </th>
        <th class="CustomerContracts cols amount resize" width="{$formFilter.sizes.customer}" name="amount" {if !$formFilter->hasColumn('amount')}style="display:none;"{/if}>
             <span>{__('amount')|capitalize}</span> 
              <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.total_price_with_taxe->getValueExist('asc','_active')}" id="asc" name="total_price_with_taxe"><img  src='{url("/icons/sort_asc`$formFilter.order.total_price_with_taxe->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.total_price_with_taxe->getValueExist('desc','_active')}" id="desc" name="total_price_with_taxe"><img  src='{url("/icons/sort_desc`$formFilter.order.total_price_with_taxe->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
        <th class="CustomerContracts cols phone resize" width="{$formFilter.sizes.phone}" name="phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>
            <span>{__('phone')|capitalize}</span>  
              <div>
                <a href="#" class="CustomerContracts-order{$formFilter.order.phone->getValueExist('asc','_active')}" id="asc" name="phone"><img  src='{url("/icons/sort_asc`$formFilter.order.phone->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.phone->getValueExist('desc','_active')}" id="desc" name="phone"><img  src='{url("/icons/sort_desc`$formFilter.order.phone->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
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
        <th>{* commercial1 *}       
            <span>{__('commercial 1')|capitalize}</span>    
        </th>
        <th>{* commercial2 *}       
            <span>{__('commercial 2')|capitalize}</span>    
        </th>
        {if $formFilter->equal->hasValidator('telepro_id')} 
        <th>{* telepro *}
           <span>{__('telepro')|capitalize}</span>        
        </th>
        {/if}
        <th>{* status *}
            <span>{__('State')}</span>         
        </th>
        {if $formFilter->equal->hasValidator('status')} 
        <th>
            <span>{__('Status')}</span>          
        </th>
        {/if}
        <th>{__('actions')|capitalize}</th>
    </tr>  
    <tr class="input-list">
       <td>{* # *}</td>
         {if $pager->getNbItems()>5}<td>&nbsp;</tdh>{/if}       
       <td>{* date *}
       <div>
               {__('from')}
                <input class="CustomerContracts range" id="opened_at_from" type="text" size="10" name="opened_at[from]" value="{format_date((string)$formFilter.range.opened_at.from,'a')}"/>
            </div>
            <div>
               {__('to')}
                <input  class="CustomerContracts range" id="opened_at_to" type="text" size="10" name="opened_at[to]" value="{format_date((string)$formFilter.range.opened_at.to,'a')}"/>
            </div>           
       
       </td>
       <td>{* customer *}
            <input class="CustomerContracts-search" type="text" size="10" name="lastname" value="{$formFilter.search.lastname}"> 
       </td>
       <td>{* products *}
            {html_options class="CustomerContracts-equal" style="width: 100px" name="product_id" options=$formFilter->equal.product_id->getOption('choices') selected=(string)$formFilter.equal.product_id}
       </td>
       <td>{* amount *}</td>
       <td>{* phone *}
            <input class="CustomerContracts-search" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </td>
       <td class="CustomerContracts cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
           <input class="CustomerContracts-begin" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}"> 
       </td>
       <td class="CustomerContracts cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
           <input class="CustomerContracts-search" type="text" size="8"   name="city" value="{$formFilter.search.city}"> 
       </td>
       <td>{* commercial1 *}
            {html_options class="CustomerContracts-equal" style="width: 100px" name="sale_1_id" options=$formFilter->equal.sale_1_id->getOption('choices') selected=(string)$formFilter.equal.sale_1_id}
       </td>
       <td>{* commercial2 *}
            {html_options class="CustomerContracts-equal" style="width: 100px" name="sale_2_id" options=$formFilter->equal.sale_2_id->getOption('choices') selected=(string)$formFilter.equal.sale_2_id}
       </td>
       {if $formFilter->equal->hasValidator('telepro_id')} 
       <td>{* telepro *}
           {if count($formFilter->equal.telepro_id->getOption('choices')) > 1}
           {html_options class="CustomerContracts-equal" style="width: 100px" name="telepro_id" options=$formFilter->equal.telepro_id->getOption('choices') selected=(string)$formFilter.equal.telepro_id}
           {else}
               ---
           {/if}
       </td>
       {/if}
       <td>{* status *}
            {html_options class="CustomerContracts-equal" style="width: 100px"  name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
       </td>
       {if $formFilter->equal->hasValidator('status')} 
       <td>
          {html_options_format format="__" class="CustomerContracts-equal" style="width: 100px"  name="status" options=$formFilter->equal.status->getOption('choices') selected=(string)$formFilter.equal.status} 
       </td>
       {/if}
       <td>{* actions *}</td>
    </tr>
    <tr class="input-list">
       <td>{* # *}</td>
        {if $pager->getNbItems()>5}<td>&nbsp;</tdh>{/if}     
       <td>{* date *}</td>
       <td>{* customer *}           
       </td>
       <td>{* products *}           
       </td>
       <td>{* amount *}          
       </td>
       <td>{* phone *}         
       </td>
       <td class="CustomerContracts cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}          
       </td>
       <td class="CustomerContracts cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}

       </td>
       <td>{* commercial1 *}
          
       </td>
       <td>{* commercial2 *}
          
       </td>
       <td>{* telepro *}
          
       </td>
       <td>{* status *}         
       </td>
       {if $formFilter->equal->hasValidator('status')} 
       <td>          
       </td>
       {/if}
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="CustomerContracts list" id="CustomerContracts-{$item->get('id')}" name="{$item->getCustomer()}"> 
         <td class="CustomerContracts-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerContractStatusI18n()}
                    <input class="CustomerContractsStatus-selection" type="checkbox" id="{$item->getCustomerContractStatusI18n()->get('id')}" name="{$item->getCustomerContractStatusI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if} 
         </td>           
         <td class="CustomerContracts cols date" {if !$formFilter->hasColumn('date')}style="display:none;"{/if}>{* date *}                             
               <div>
               {format_date($item->get('opened_at'),'p')}
               </div>
          </td> 
          <td class="CustomerContracts cols customer" {if !$formFilter->hasColumn('customer')}style="display:none;"{/if}>{* customer *} 
               {$item->getCustomer()->getLastname()} {$item->getCustomer()->getFirstname()}
          </td> 
          <td>
              {if $item->hasProducts()}
                {foreach $item->getProducts() as $product}
                    {$product->get('meta_title')}
                {/foreach}
              {/if}
          </td>
           <td class="CustomerContracts cols amount" {if !$formFilter->hasColumn('amount')}style="display:none;"{/if}>{* amount *} 
               <div>{format_currency($item->get('total_price_with_taxe'),$settings_contracts->get('default_currency'))}</div>
                 <div>{if $item->hasPartner()}{$item->getPartner()->get('name')}{/if}</div>
          </td> 
           <td class="CustomerContracts cols phone" {if !$formFilter->hasColumn('phone')}style="display:none;"{/if}>{* phone *}
                <div>{$item->getCustomer()->getPhone()}</div>
                <div>{$item->getCustomer()->getMobile()}</div>
            </td>           
            <td class="CustomerContracts cols postcode" {if !$formFilter->hasColumn('postcode')}style="display:none;"{/if}>{* postcode *}
                 {$item->getCustomer()->getAddress()->get('postcode')}  
            </td>           
            <td class="CustomerContracts cols city" {if !$formFilter->hasColumn('city')}style="display:none;"{/if}>{* city *}
                 {$item->getCustomer()->getAddress()->get('city')}   
            </td>             
            <td>{* commercial1 *}
                {if $item->hasSale1()}
                 {$item->getSale1()->getName(false)} 
                    <div>
                     {if $user->hasCredential([['superadmin','admin','contract_sale_sms_send']])} 
                        <a href="#" title="{__('Send SMS')}" class="CustomerContracts-SmsForSale1" id="{$item->get('id')}" name="{$item->getSale1()}">
                        <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                     {/if}
                      {if $user->hasCredential([['superadmin','admin','contract_sale_email_send']])} 
                        <a href="#" title="{__('Send Email')}" class="CustomerContracts-EmailForSale1" id="{$item->get('id')}" name="{$item->getSale1()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a>                       
                     {/if}
                      </div>
                 {/if}
            </td>
            <td>{* commercial2 *}
                {if $item->hasSale2()}
                {$item->getSale2()->getName(false)} 
                <div>
                    {if $user->hasCredential([['superadmin','admin','contract_sale_sms_send']])} 
                     <a href="#" title="{__('Send SMS')}" class="CustomerContracts-SmsForSale2" id="{$item->get('id')}" name="{$item->getSale2()}">
                    <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                    {/if}
                    {if $user->hasCredential([['superadmin','admin','contract_sale_email_send']])} 
                    <a href="#" title="{__('Send Email')}" class="CustomerContracts-EmailForSale2" id="{$item->get('id')}" name="{$item->getSale2()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a>  
                    {/if}
                </div>
                {/if}
            </td>
             {if $formFilter->equal->hasValidator('telepro_id')} 
             <td>{if $item->hasTelepro()}
                     {$item->getTelepro()->getName(false)}
                {/if}
            </td>
            {/if}
             <td>{* status *}               
                {if $item->hasStatus()}
                    {if $item->getStatus()->get('icon')} 
                       <img src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/> 
                    {elseif $item->getStatus()->get('color')}
                    <div class="color" style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                    {/if}&nbsp;               
                    {$item->getStatus()->getCustomerContractStatusI18n()->get('value')}
                {else}
                    {__('---')}
                {/if}
            </td>
            {if $formFilter->equal->hasValidator('status')} 
            <td> 
                {__($item->get('status'))}
            </td>
            {/if}
            <td>       
                {if $user->hasCredential([['superadmin','admin','contract_modify','contract_view']])} 
                <a href="#" title="{__('edit')}" class="CustomerContracts-View" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
                {/if}     
              {*  <a href="#" title="{__('edit')}" class="CustomerContracts-Product" id="{$item->get('id')}">
                     <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a> *}
              {*  <a href="#" title="{__('contributor')}" class="CustomerContracts-Contributor" id="{$item->get('id')}">
                     <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a>  *}
                {if $user->hasCredential([['superadmin','admin','contract_customer_sms_send']])} 
                 <a href="#" title="{__('Send SMS')}" class="CustomerContracts-Sms" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/></a> 
                {/if}     
                {if $user->hasCredential([['superadmin','admin','contract_customer_email_send']])} 
                <a href="#" title="{__('Send Email')}" class="CustomerContracts-Email" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/></a> 
                {/if}     
                {if $user->hasCredential([['superadmin','admin','contract_documents_list']])} 
                <a href="#" title="{__('Documents')}" class="CustomerContracts-Documents" id="{$item->get('id')}" name="{$item->getCustomer()}">
                     <img  src="{url('/icons/doc16x16.png','picture')}" alt='{__("Documents")}'/></a>   
                {/if}
                {if $user->hasCredential([['superadmin','admin','contract_one_exportKml']])} 
                <a href="{url_to('customers_contracts',['action'=>'ExportKMLContract'])}?contract={$item->get('id')}" title="{__('Export Kml')}">
                     <img  src="{url('/icons/files/kml.gif','picture')}" alt='{__("Export Kml")}'/></a> 
                {/if} 
                {if $user->hasCredential([['superadmin','admin','contract_delete']])} 
                <a href="#" title="{__('delete')}" class="CustomerContracts-Delete" id="{$item->get('id')}"  name="{$item->getCustomer()} ({format_date($item->get('created_at'),'p')})">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>               
                {/if}
            </td>
    </tr>
    {/foreach}
</table>
{if !$pager->getNbItems()}
     <span>{__('No contract')}</span>
{else}
    {if $pager->getNbItems()>5}
      {*  <input type="checkbox" id="CustomerContracts-all" /> 
          <a style="opacity:0.5" class="CustomerContracts-actions_items" href="#" title="{__('delete')}" id="CustomerContracts-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>          *}
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerContracts"}
<script type="text/javascript">
    
    {JqueryScriptsReady}
    {/JqueryScriptsReady}
        
    var dates = $( ".CustomerContracts#opened_at_from, .CustomerContracts#opened_at_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "opened_at_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );
    {* =====================  P A G E R S =============================== *}  
    
      function getContractsFilterParameters()
        {
           var params={ filter: {  order : { }, 
                                     range: $(".CustomerContracts.range").getFilter(),                                    
                                     equal : { },
                                     begin : { },
                                     search: {  },                                  
                                     cols: [],
                                     in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },
                                     sizes: { },
                                     nbitemsbypage: $("[name=CustomerContracts-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            {* ================ ORDER ============================= *}
            if ($(".CustomerContracts-order_active").attr("name"))
                    params.filter.order[$(".CustomerContracts-order_active").attr("name")] =$(".CustomerContracts-order_active").attr("id");
            {* ================ SEARCH ============================= *}
            $(".CustomerContracts-search").each(function() { params.filter.search[this.name] =this.value; });   
            {* ================ BEGIN ============================= *}
            $(".CustomerContracts-begin").each(function() { params.filter.begin[this.name] =this.value; });   
            {* ================ RESIZE/COLS ============================= *}
            $(".CustomerContracts[name=cols]:checked").each(function() { params.filter.cols.push($(this).attr('id')); }); 
            $(".CustomerContracts.resize").each(function() {  params.filter.sizes[$(this).attr('name')] =$(this).width(); });
            {* ================ EQUAL ============================= *}
            $(".CustomerContracts-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); }); 
            {* ================ IN ============================= *}
            $(".CustomerContracts-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   });    
          //  alert("params="+params.toSource()) */
            return params;                  
        }
        
        function updateContractsFilter()
        {
           return $.ajax2({ data: getContractsFilterParameters(), 
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}" , 
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-site-panel-dashboard-customers-contract-base" });
        }
        
         function updateSitePager(n)
        {
           page_active=$(".CustomerContracts-pager .CustomerContracts-active").html()?parseInt($(".CustomerContracts-pager .CustomerContracts-active").html()):1;
           records_by_page=$("[name=CustomerContracts-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerContracts-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerContracts-nb_results").html())-n;
           $("#CustomerContracts-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerContracts-end_result").html($(".CustomerContracts-count:last").html());
        }
        
        $('.CustomerContracts-order').click(function() {
            $(".CustomerContracts-order_active").attr('class','CustomerContracts-order');
            $(this).attr('class','CustomerContracts-order_active');
            return updateContractsFilter();
        });

        $(".CustomerContracts-search,.CustomerContracts-begin").keypress(function(event) {
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
                errorTarget: ".customers-contract-errors",                
                loading: "#tab-site-dashboard-customers-contract-loading",
                target: "#tab-site-panel-dashboard-customers-contract-base"}); 
        }); 

        $(".CustomerContracts-pager").click(function () {             
                return $.ajax2({ data: getContractsFilterParameters(), 
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".customers-contract-errors",
                                 loading: "#tab-site-dashboard-customers-contract-loading",
                                 target: "#tab-site-panel-dashboard-customers-contract-base"
                });
        });
   
    {* =====================  A C T I O N S =============================== *}  
    
     $(".CustomerContracts-View").click( function () {         
            addTabField("customers-contract",$(this).attr('id'),$(this).attr('name'));           
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                         
                target: "#tab-site-panel-dashboard-customers-contract-"+$(this).attr('id')
           });
    });
    
    
      $(".CustomerContracts.list").dblclick( function () {         
           addTabField("customers-contract",$(this).attr('id').replace('CustomerContracts-',''),$(this).attr('name'));       
            return $.ajax2({     
                data : { Contract: $(this).attr('id').replace('CustomerContracts-','') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                         
                target: "#tab-site-panel-dashboard-customers-contract-"+$(this).attr('id').replace('CustomerContracts-','')
           });
    });
    
    
     $(".CustomerContracts-Product").click( function () {                        
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'GenerateProduct'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                                         
           });
    });
    
      $(".CustomerContracts-Contributor").click( function () {                        
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'CreateContributor'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading"
           });
    });
    
     $(".CustomerContracts-Sms").click( function () {         
            addTabField("customers-contract","sms-"+$(this).attr('id'),$(this).attr('name')+" - {__('New SMS')}");           
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'SmsContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                target: "#tab-site-panel-dashboard-customers-contract-sms-"+$(this).attr('id')
              //  target: "#tab-site-panel-dashboard-site-customers-meeting-sms-"+$(this).attr('id')
           });
     });
    
     $(".CustomerContracts-Email").click( function () {         
            addTabField("customers-contract","email-"+$(this).attr('id'),$(this).attr('name')+" - {__('New email')}");                      
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'EmailContract'])}",                                             
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                target: "#tab-site-panel-dashboard-customers-contract-email-"+$(this).attr('id')
           });           
    });
    
     $(".CustomerContracts-SmsForSale1,.CustomerContracts-SmsForSale2").click( function () {         
            addTabField("customers-contract","sms-"+$(this).attr('id'),"{__('New SMS for ')}"+$(this).attr('name'));                       
            return $.ajax2({     
                data : {    Contract: $(this).attr('id'),
                            ContractSaleSMS: { 
                                          sale: $(this).attr('class').replace('CustomerContracts-SmsFor',''),
                                          token : "{mfForm::getToken('ContractSaleForm')}" } },
                url: "{url_to('customers_contracts_ajax',['action'=>'SmsContractForSale'])}",
                errorTarget: ".customers-contract-site-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                          
                target: "#tab-site-panel-dashboard-customers-contract-sms-"+$(this).attr('id')
           });
     });
     
     $(".CustomerContracts-EmailForSale1,.CustomerContracts-EmailForSale2").click( function () {         
            addTabField("customers-contract","email-"+$(this).attr('id'),"{__('New email for ')}"+$(this).attr('name'));                      
            return $.ajax2({     
                data : { Contract: $(this).attr('id'),
                         ContractEmailSale: { 
                                          sale: $(this).attr('class').replace('CustomerContracts-EmailFor',''),
                                          token : "{mfForm::getToken('ContractSaleForm')}" } },
                url: "{url_to('customers_contracts_ajax',['action'=>'EmailContractForSale'])}",
                errorTarget: ".customers-contract-site-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                             
                target: "#tab-site-panel-dashboard-customers-contract-email-"+$(this).attr('id')              
           });           
    }); 
    
    
      $(".CustomerContracts-Delete").click( function () {    
            if (!confirm('{__("Contract \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'DeleteContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
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
       
      $(".CustomerContracts-Documents").click( function () {    
            addTabField("customers-contract","document-"+$(this).attr('id'),$(this).attr('name')+" - {__('Product Documents')}");                      
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_documents_ajax',['action'=>'ListContractDocument'])}",                                             
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                target: "#tab-site-panel-dashboard-customers-contract-document-"+$(this).attr('id')
           });           
    });
    {* ================= OTHERS ====================================================== *}
            
    $(".filter-btn").click(function() {   
            $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();            
            $('.iconfont[id='+$(this).attr('id')+"]").toggleClass('fa fa-sort-desc fa fa-sort-asc');
    });
    
    $('.filter-content').mouseleave( function() { $('.filter-content').hide();} );
    
    $("#CustomerContracts-Import").click( function () { 
                return $.ajax2({
                    url:"{url_to('customers_contracts_ajax',['action'=>'ImportContract'])}",
                    errorTarget: ".customers-contract-errors",                
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    target: "#tab-site-panel-dashboard-customers-contract-base"
               });
          });  
          
           $("#CustomerContracts-GenerateCoordinates").click( function () {                
            return $.ajax2({                    
                url: "{url_to('customers_ajax',['action'=>'GenerateCoordinates'])}",
                errorTarget: ".customers-contract-errors",        
                loading: "#tab-site-dashboard-customers-contract-loading",              
                success: function (resp)
                         {
                               
                         }
           });
    });   
</script>    

{* 
   tab-site-panel-dashboard-site-customers-contract-base --> #tab-site-panel-dashboard-customers-contract-base
   tab-site-dashboard-customers-contract-loading   ---> tab-site-dashboard-site-customers-contract-loading
*}