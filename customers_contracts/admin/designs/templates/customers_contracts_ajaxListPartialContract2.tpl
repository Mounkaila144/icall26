
{component name="/site_text/loadTexts" module="customers_contracts"}
<div id="contract-view-dialog" style="display:none" class="dialogs" title="test"></div>
<!--begin-->
<div id="list-top-contract">
    {messages class="customers-contract-errors"}
<!--<h3>{__('Customer contract')}</h3> -->
<h3 class="p-0">{__('Contracts list')}</h3>

<div>
    {*if $user->hasCredential([['superadmin','contract_turnover']])}
        <table class="TurnoverInfo">
            <tr>
                <td>{__('Turnover')}:</td>
                <td>???????{*format_currency($pager->getTurnover(),$settings_contracts->get('default_currency'))*}{*</td>
            </tr>
        </table>
        <h4>{__('Turnover without tax')}:????????????????{*format_currency($pager->getTurnoverWithoutTaxFromPager(),$settings_contracts->get('default_currency'))*}{*</h4>
        <h4>{__('Turnover tax amount')}:?????????????????{*format_currency($pager->getTaxAmountFromPager(),$settings_contracts->get('default_currency'))*}{*</h4> 
    {/if*}
    {component name="/app_domoprime_multi/StatisticsByPollutersForContracts" filter=$formFilter tpl="contract_statistics"}      
    {*<table class="TotalTurnoverInfo TurnoverInfo">
        <tr>
            <th>&ensp;</th>
            <th>101</th>
            <th>102</th>
            <th>103</th>
        </tr>

        {component name="/app_domoprime_multi/NumberOfOperationsForContracts" filter=$formFilter}  
        {component name="/app_domoprime_multi/NumberOfSurfacesForContracts" filter=$formFilter}        
        {component name="/app_domoprime_multi/NumberOfCumacsForContracts" filter=$formFilter}            
    </table>  *}
    {*component name="/app_domoprime_iso3/StatisticsByClassForContracts" filter=$formFilter}

    {component name="/app_domoprime/NumberOfCumacForContracts" filter=$formFilter}
    *}    
</div>
{component name="/system_debug/Display"}
<div style="clear: both"></div>
<div style="display: inline-block;">
    {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerContracts"}
</div>
<div class="listArrows">    
    <a href="javascript:void(0);" class="leftArrowContract"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <a href="javascript:void(0);" class="rightArrowContract"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>


<div style="display: inline;"><span>{__('line_by_work')}</span><input type="checkbox" id="OnlyContract"></div>
    <div class="filter" id="columns">    
      <span class="filter-btn name-filter columns-btn " id="columns">{__('Columns')}<i id="product" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
        <div style="width:25%" class="filter-content filter-content-contracts" id="columns">
             <div class="row"> 
                {foreach $formFilter->getColumns()->asort() as $key=>$col}

                    {if $col@first}
                         <div class="col-md-6">
                       {elseif $col@index % 6 == 0}
                           </div>
                            <div class="col-md-6">
                       {/if}
                        <div class="filter-content-input">
                            <input type="checkbox" class="CustomerContracts columns cols ColsCheck " name="{$key}" id="check-{$key}" data-id="{$key}" {if $formFilter->hasColumn($key)}checked="checked"{/if}/>
                        </div>
                         <label for="check-{$key}" class="filter-content-txt">{if $col==__($col)}{__("columns_base_`$col`")}{else}{__($col)}{/if}</label>           
                        </br>
                        {if $col@last}
                          </div>
                    {/if}   
                {/foreach}
              </div>
            <div class="filter-content-input">
                <input type="checkbox" class="CustomerContracts-columns-all ColsCheck " id="check-all-columns"/>
            </div>
            <label for="check-all-columns" class="filter-content-txt">{__('Select/unselect all')}</label>
            <button id="CustomerContracts-columns-filter" class="btn inputWidth">{__("Filter")}</button>
        </div>
    </div>
   <i style="color:red;cursor:pointer;display:inline-block" class="filter-list-toggle fa fa-filter"></i>    
</div>
<div class="divFilter">
    <div style="position:relative;">
    {*<div style="text-align: center" class="li1"><span class="buttonSlide">{*<img width="16px" height="16px" src="{url('/icons/info-btn.jpg','picture')}" title="tab">*}
    {*<i class="fa fa-bars fa-2x" style="color: black;"></i> </span></div>*}

     {* input data filter *}
      <div class="filter fi">             
       <div class="" class="date">{* date *}
           <span style=" display: flex">
            {*{__('from')}*}
            <span style="margin-top: 10px;"> De:{component name="/utils/DateFdatesromAndToFromMonths" class="CustomerContracts" from="opened_at_from" to="opened_at_to"}</span>                            
             <input placeholder="{__('Started At')}" class="CustomerContracts range form-control" id="opened_at_from" type="text" size="6" name="opened_at[from]" value="{format_date((string)$formFilter->getDateFilter('from'),'a')}"/>          
             <a style="margin-top: 10px;"href="#" class="CustomerContractsEraser" id="opened_at_from"><i class="fa fa-eraser"/></a>
            </span><br>
            <span style=" display: flex">
                <span style="margin-top: 10px;">A&nbsp;&nbsp;: {*{__('to')}*}</span>
                <input placeholder="{__('Ended At')}"  class="CustomerContracts range form-control" id="opened_at_to" type="text" size="5" name="opened_at[to]" value="{format_date((string)$formFilter->getDateFilter('to'),'a')}"/>
                <a style="margin-top: 10px;" href="#" class="CustomerContractsEraser" id="opened_at_to"><i class="fa fa-eraser"/></a>
            </span>  <br>        
            <div>
                {if $formFilter->hasValidator('date_null')}
                    <div class="form-check">                        
                        <label class="displayInLdocument_is_signedine form-check-label">
                            <input type="checkbox" class="DateFilter CustomerContracts form-check-input" name="date_null"  {if $formFilter.date_null->getValue()}checked="checked"{/if}/>{__('Empty')}
                        </label>
                    </div>
                {/if}
                {if $formFilter->hasValidator('date_created')}
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="DateFilter CustomerContracts  form-check-input" name="date_created"  {if $formFilter.date_created->getValue()}checked="checked"{/if}/>
                            {__('Use date of creation')}
                        </label>                
                    </div>
                {/if}
                {if $formFilter->hasValidator('date_install')}
                   
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="DateFilter CustomerContracts  form-check-input" name="date_install"  {if $formFilter.date_install->getValue()}checked="checked"{/if}/>
                            {if $formFilter->equal->hasValidator('polluter_id')}
                                {if $formFilter.equal.polluter_id->getValue()}
                                        {if $formFilter->getEqualPolluter()->get('type')=='BOILER' || $formFilter->getEqualPolluter()->get('type')=='PAC'}
                                            <span class="opcLabel"> {__('Installation date boiler pac')}</span>
                                        {else}
                                            <span class="opcLabel">{__('date_install')}</span>
                                        {/if}
                                                {else}<span class="opcLabel">
                                                            {__('date_install')}</span>
                                {/if}

                            {else}<span class="opcLabel">
                                                {__('date_install')}</span>
                             {/if}
                        </label>
                    </div>            
                {/if}
                {if $formFilter->hasValidator('date_sav')}
                    <div class="form-check">
                        <label class="form-check-label">
                    <input type="checkbox" class="DateFilter CustomerContracts  form-check-input" name="date_sav"  {if $formFilter.date_sav->getValue()}checked="checked"{/if}/>
                         {*if $formFilter->equal->hasValidator('polluter_id')}
                                {if $formFilter.equal.polluter_id->getValue()}
                                        {if $formFilter->getEqualPolluter()->get('type')=='BOILER' ||$formFilter->getEqualPolluter()->get('type')=='PAC'}
                                            <span class="savLabel">{__('date_acceptance')} {__('pac')} {__('boiler')}</span>
                                        {else}
                                            {if $formFilter->getEqualPolluter()->get('type')=='ITE' ||$formFilter->getEqualPolluter()->get('type')=='ISO'}
                                                <span class="savLabel">{__('date_acceptance')} {__('ite iso')}</span>
                                            {else}
                                                <span class="savLabel">{__('date_acceptance')}</span>
                                            {/if}
                                        {/if}
                                    {else}
                                     <span class="savLabel">{__('date_acceptance')}</span>
                                  
                                {/if}
                         {else*}
                                <span class="savLabel">{__('date_acceptance')}</span>
                          {*/if*}                        
                        </label>
                    </div>                
                {/if}
                <div class="">{* customer *}
                    {*if $user->hasCredential([['superadmin','contract_list_company']])}
                         <input class="CustomerContracts-search inputWidth form-control" type="text" placeholder="{__('Customer, Reference')}" size="10" name="lastname" value="{$formFilter.search.lastname}">
                    {else*}
                         <input class="CustomerContracts-search inputWidth form-control" type="text" placeholder="{__('Customer, Reference')}" size="10" name="lastname" value="{$formFilter.search.lastname}">
                    {*/if*}
                </div>
                <div class="">{* reference *}
                    {if $user->hasCredential([['superadmin','contract_list_filter_reference']])}
                        {html_options class=" widthSelect  CustomerContracts-equal form-control" name="reference" options=$formFilter->getReferences() selected=(string)$formFilter.equal.reference}
                    {/if}
                </div>
                <br>
               {* <div>{* amount *}{*</div>*}
                <div class="">{* phone *}
                     <input class="CustomerContracts-search inputWidth form-control" placeholder="{__('phone')}" type="text" size="8" name="phone" value="{$formFilter.search.phone}">
                </div> 
                <div class="" class="CustomerContracts cols postcode">{* postcode *}
                    <input class="CustomerContracts-begin inputWidth form-control" placeholder="Code postal" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}">
                </div>     
                <div class="fi" class="CustomerContracts cols city">{* city *}
                    <input class="CustomerContracts-search inputWidth form-control" placeholder="Ville" type="text" size="8"   name="city" value="{$formFilter.search.city}">
                     <img id="field-customer-contracts-city-loading" class="loading" style="display:none;" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
                </div>
                <button id="CustomerContracts-filter" class="btn inputWidth btn-secondary">{__("Filter")}</button>   <br>
                <button class="btn inputWidth btn-secondary" id="CustomerContracts-init">{__("Init")}</button>
                <div>
                    {if $user->hasCredential([['superadmin','admin','contract_new']])}
                    <a href="#" class="btn btn btn-secondary widthAFilter" id="CustomerContracts-New" title="{__('new')}" >
                        <i class="fa fa-plus" style="margin-right: 10px"></i>{__('New')}
                    </a>  
                    {/if}    
                </div>
                 {if $user->hasCredential([['superadmin','admin','contract_export']])}
                <a arget="_blank" href="{url_to('customers_contracts',['action'=>'ExportCsvContracts'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range','rangeOr','date_install','date_sav'])}" class="btn widthAFilter" title="{__('Export')}" >
                    <i class="fa fa-caret-square-o-down" style="margin-right: 10px"></i>{__('Export CSV')}</a>  
                 {/if} 
                {component name="/customers_contracts_exports/exportLink"}
                {if $formFilter->equal->hasValidator('energy_id') && $user->hasCredential([['app_domoprime_iso_contract_list_filter_energy']])}
                    <div class="form-group">
                        <label>{__('Energy')}</label>  
                       {html_options class="widthSelect  CustomerContracts-equal" name="energy_id" options=$formFilter->equal.energy_id->getOption('choices') selected=(string)$formFilter.equal.energy_id}            
                    </div>
                {/if}                
                {if $formFilter->equal->hasValidator('sector_id') && $user->hasCredential([['app_domoprime_iso_contract_list_filter_sector']])}
                    <div class="form-group">
                       <label>{__('Sector')}</label>  
                       {html_options class="widthSelect  CustomerContracts-equal"  name="sector_id" options=$formFilter->equal.sector_id->getOption('choices') selected=(string)$formFilter.equal.sector_id}            
                    </div>
                {/if}
                {if $formFilter->equal->hasValidator('class_id')}
                    <div class="form-group">
                       <label>{__('Class')}</label>  
                       {html_options class="widthSelect  CustomerContracts-equal"  name="class_id" options=$formFilter->equal.class_id->getOption('choices') selected=(string)$formFilter.equal.class_id}            
                    </div>
                {/if}
                {if $formFilter->hasValidator('surface_parcel_check')}
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="DateFilter CustomerContracts form-check-input" name="surface_parcel_check"  {if $formFilter.surface_parcel_check->getValue()}checked="checked"{/if}/>
                           <span>{__('Parcel surface')}</span>  
                        </label>
                    </div>
                {/if}
                {component name="/app_domoprime/quotationFilterContract"}
                {if $formFilter->equal->hasValidator('quotation_is_signed')}
                    <div class="form-group">
                        <label>{__('Quotation signed')}</label>      
                        {html_options class="widthSelect  CustomerContracts-equal" name="quotation_is_signed" options=$formFilter->equal.quotation_is_signed->getOption('choices') selected=(string)$formFilter.equal.quotation_is_signed}                            
                    </div>
                {/if}
                {if $formFilter->equal->hasValidator('document_is_signed')}
                    <div class="form-group">
                    <label>{__('Document signed')}</label>      
                    {html_options class="widthSelect  CustomerContracts-equal" name="document_is_signed" options=$formFilter->equal.document_is_signed->getOption('choices') selected=(string)$formFilter.equal.document_is_signed}                            
                    </div>
                {/if}
                {component name="/app_domoprime_yousign_evidence/FilterForContracts" formFilter=$formFilter}
                {component name="/app_domoprime_iso/FilterForContracts"}                
                {component name="/customers_contracts_documents_check/checkFilterForContracts"}
                
                
                 <br>
                {component name="/customers_contracts/BtnExportKMLForContracts"  formfilter=$formFilter}  
                {component name="/customers_contracts_maps/BtnExport"}
               
            </div>
        </div><br>      
       <div>{* actions *}</div>
    </div>
       
{if $pager->hasItems()}
    <div class="fi filter">
 
    {* ================== OPC DATE RANGE =========================== *}
    {*if $formFilter->in->hasValidator('opc_range_id')}
    <div class="filter" id="opc_range">    
      <span class="filter-btn name-filter btn-table" id="opc_range">{__('Opc range')}<i id="opc_range" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content filter-content-contracts" id="opc_range">
        {foreach $formFilter->in.opc_range_id->getOption('choices') as $range_i18n}
            <div>
                <div class="filter-content-input">
                    <input type="checkbox" class="CustomerContracts-in opc_range" name="opc_range_id" id="{$range_i18n->get('range_id')}" {if in_array($range_i18n->get('range_id'),(array)$formFilter.in.opc_range_id->getValue())}checked="checked"{/if}/>
                </div>
                <div class="filter-content-txt">
                    {if $range_i18n->isLoaded()}{$range_i18n->get('value')|upper}{else}{__('Empty')}{/if}
                </div>                
            </div>    
        {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="opc_range"/>{__('Select/unselect all')}
      </div>
   </div>
   {/if*}  
    {* ================== SAV AT DATE RANGE =========================== *}
    {if $formFilter->in->hasValidator('sav_at_range_id')}
    <div class="filter" id="sav_at_range">    
      <span class="filter-btn name-filter btn-table" id="sav_at_range">{__('Sav at range')}<i id="sav_at_range" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content filter-content-contracts" id="sav_at_range">
    {foreach $formFilter->in.sav_at_range_id->getOption('choices') as $range_i18n}
        <div>
            <div class="filter-content-input">
                <input type="checkbox" class="CustomerContracts-in opc_range" name="sav_at_range_id" id="{$range_i18n->get('range_id')}" {if in_array($range_i18n->get('range_id'),(array)$formFilter.in.sav_at_range_id->getValue())}checked="checked"{/if}/>
            </div>
            <div class="filter-content-txt">
                {if $range_i18n->isLoaded()}{$range_i18n->get('value')|upper}{else}{__('Empty')}{/if}
            </div>            
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="sav_at_range"/>{__('Select/unselect all')}
      </div>
   </div>
   {/if}  
    {* ================== SALE 1 =========================== *}
    {*if $formFilter->in->hasValidator('sale_1_id')  &&  $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
        <div class="filter" id="sale1">    
          <span class="filter-btn name-filter btn-table" id="sale1">{__('Sale1')}<i id="sale1" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
          <div class="filter-content wide-filtre-content filter-content-contracts " id="sale1">
        {foreach $formFilter->in.sale_1_id->getOption('choices') as $sale}
            {if $sale@first}
                <div class="filter-layout">
              {elseif $sale@index % 6 == 0}
                  </div>
                <div class="filter-layout">
              {/if}
                <div>
                    <div class="filter-content-input">
                        <input type="checkbox" class="CustomerContracts-in sale1" name="sale_1_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_1_id->getValue())}checked="checked"{/if}/>
                    </div>
                    <div class="filter-content-txt">
                       {if $sale->isLoaded()}{$sale->get('lastname')|upper} {$sale->get('firstname')|upper}{else}{__('Empty')}{/if}
                    </div>

                </div>  
                {if $sale@last}
                </div>
                {/if}  
        {/foreach}  
          <input type="checkbox" class="CustomerContracts-in-select" name="sale1"/>{__('Select/unselect all')}
          </div>
       </div>
   {/if*}      
      {* ================== SALE 2 =========================== *}
      {*if $formFilter->in->hasValidator('sale_2_id')   &&  $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
  <div class="filter" id="sale2">    
      <span class="filter-btn name-filter btn-table" id="sale2">{__('Sale2')}<i id="sale2" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content wide-filtre-content filter-content-contracts" id="sale2">
        {foreach $formFilter->in.sale_2_id->getOption('choices') as $sale}
                {if $sale@first}
                    <div class="filter-layout">
                {elseif $sale@index % 6 == 0}
                    </div>
                    <div class="filter-layout">
                {/if}
                <div>
                    <div class="filter-content-input">
                        <input type="checkbox" class="CustomerContracts-in sale2" name="sale_2_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_2_id->getValue())}checked="checked"{/if}/>
                    </div>
                    <div class="filter-content-txt">
                       {if $sale->isLoaded()}{$sale->get('lastname')|upper} {$sale->get('firstname')|upper}{else}{__('Empty')}{/if}
                    </div>                
                </div>
                {if $sale@last}
                            </div>
                {/if}    
        {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="sale2"/>{__('Select/unselect all')}
      </div>
  </div>    
      {/if*}
  {* ================== TELEPRO =========================== *}
  {*if $formFilter->in->hasValidator('telepro_id')}
  <div class="filter" id="telepro">    
      <span class="filter-btn name-filter btn-table" id="telepro">{__('Telepro')}<i id="telepro" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content wide-filtre-content filter-content-contracts" id="telepro">
    {foreach $formFilter->in.telepro_id->getOption('choices') as $sale}
          {if $sale@first}
            <div class="filter-layout">
          {elseif $sale@index % 6 == 0}
              </div>
            <div class="filter-layout">
          {/if}
        <div>
            <div class="filter-content-input">
                <input type="checkbox" class="CustomerContracts-in telepro" name="telepro_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>
            </div>
            <div class="filter-content-txt">
               {if $sale->isLoaded()}{$sale->get('lastname')|upper} {$sale->get('firstname')|upper}{else}{__('Empty')}{/if}
            </div>            
        </div>
         {if $sale@last}
                        </div>
          {/if}
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="telepro"/>{__('Select/unselect all')}
      </div>
  </div>
  {/if*}
   {*if $formFilter->in->hasValidator('assistant_id') && $user->hasCredential([['superadmin','admin','contract_view_list_assistant']])}
     {* ========================= ASSISTANT ======================== }
     <div class="filter" id="assistant">    
      <span class="filter-btn name-filter btn-table" id="assistant">{__('Assistant')}<i id="assistant" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content wide-filtre-content filter-content-contracts" id="assistant">
        {foreach $formFilter->in.assistant_id->getOption('choices') as $assistant}
            {if $assistant@first}
                <div class="filter-layout">
            {elseif $assistant@index % 6 == 0}
                </div>
                <div class="filter-layout">
            {/if}
            <div>
                <div class="filter-content-input">
                    <input type="checkbox" class="CustomerContracts-in assistant" name="assistant_id" id="{$assistant->get('id')}" {if in_array($assistant->get('id'),(array)$formFilter.in.assistant_id->getValue())}checked="checked"{/if}/>
                </div>
                <div class="filter-content-txt">
                   {if $assistant->isLoaded()}{$assistant->get('lastname')|upper} {$assistant->get('firstname')|upper}{else}{__('Empty')}{/if}
                </div>                
            </div>
            {if $assistant@last}
                        </div>
            {/if}    
        {/foreach}  
          <input type="checkbox" class="CustomerContracts-in-select" name="assistant"/>{__('Select/unselect all')}
          </div>
        </div>
    {/if*}
 {* ================== TEAM =========================== *}
 {*if $formFilter->in->hasValidator('team_id') && $user->hasCredential([['superadmin','admin','contract_view_list_team']])}
    <div class="filter" id="team">    
        <span class="filter-btn name-filter btn-table" id="team">{__('Team')}<i id="team" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
        <div class="filter-content wide-filtre-content filter-content-contracts" id="team">
      {foreach $formFilter->in.team_id->getOption('choices') as $team}
              {if $team@first}
                  <div class="filter-layout">
              {elseif $team@index % 6 == 0}
                  </div>
                  <div class="filter-layout">
              {/if}
              <div>
                  <div class="filter-content-input">
                      <input type="checkbox" class="CustomerContracts-in team" name="team_id" id="{$team->get('id')}" {if in_array($team->get('id'),(array)$formFilter.in.team_id->getValue())}checked="checked"{/if}/>
                  </div>
                  <div class="filter-content-txt">
                      {if $team->isLoaded()}{$team->get('name')}{else}{__('Empty')}{/if}
                  </div>                
              </div>
              {if $team@last}
                          </div>
              {/if}    
      {/foreach}  
        <input type="checkbox" class="CustomerContracts-in-select" name="team"/>{__('Select/unselect all')}
        </div>
    </div>        
  {/if*}  
  {* ================== STATE =========================== *}  
  {*<div class="filter" id="state">    
      <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content filter-content-contracts" id="state">
    {foreach $formFilter->in.state_id->getOption('choices') as $state}
        <div>        
            <div class="filter-content-input">
                <input type="checkbox" class="CustomerContracts-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>
            </div>
            <div class="filter-content-txt">
                {if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
            </div>            
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="state"/>{__('Select/unselect all')}
      </div>
  </div>  *}
    {* ================== OPC STATUS =========================== *}  
    {*if $formFilter->in->hasValidator('opc_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_opc_status']])}
     <div class="filter" id="opc_status">    
         <span class="filter-btn name-filter btn-table" id="opc_status">{__('Attribution')}<i id="opc_status" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
         <div class="filter-content filter-content-contracts" id="opc_status">
       {foreach $formFilter->in.opc_status_id->getOption('choices') as $state}
           <div>  
               <div class="filter-content-input">
                   <input type="checkbox" class="CustomerContracts-in opc_status" name="opc_status_id" id="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}" {if $state->isLoaded() && in_array($state->get('status_id'),(array)$formFilter.in.opc_status_id->getValue()) || ($state->isNotLoaded() && in_array('NULL',(array)$formFilter.in.opc_status_id->getValue()))}checked="checked"{/if}/>
               </div>
               <div class="filter-content-txt">
                   {if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
               </div>            
           </div>    
       {/foreach}  
         <input type="checkbox" class="CustomerContracts-in-select" name="opc_status"/>{__('Select/unselect all')}
         </div>
     </div>  
   {/if*}
    {* ================== TIME STATUS =========================== *}  
    {*if $formFilter->in->hasValidator('time_state_id') && $user->hasCredential([['superadmin','contract_view_list_time_state']])}
    <div class="filter" id="time_state">    
        <span class="filter-btn name-filter btn-table" id="time_state">{__('Time status')}<i id="time_state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
        <div class="filter-content filter-content-contracts" id="time_state">
      {foreach $formFilter->in.time_state_id->getOption('choices') as $state}
          <div>    
              <div class="filter-content-input">
                   <input type="checkbox" class="CustomerContracts-in time_state" name="time_state_id" id="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}" {if $state->isLoaded() && in_array($state->get('status_id'),(array)$formFilter.in.time_state_id->getValue()) || ($state->isNotLoaded() && in_array('NULL',(array)$formFilter.in.time_state_id->getValue()))}checked="checked"{/if}/>
              </div>
              <div class="filter-content-txt">
                  {if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
              </div>            
          </div>    
      {/foreach}  
        <input type="checkbox" class="CustomerContracts-in-select" name="time_state"/>{__('Select/unselect all')}
        </div>
    </div>  
   {/if*}
   {* ================== ADMIN STATUS =========================== *}  
   {*if $formFilter->in->hasValidator('admin_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_admin_status']])}
        <div class="filter" id="admin_status">    
            <span class="filter-btn name-filter btn-table" id="admin_status">{__('Admin status')}<i id="time_state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content filter-content-contracts" id="admin_status">
          {foreach $formFilter->in.admin_status_id->getOption('choices') as $state}
              <div>    
                  <div class="filter-content-input">
                      <input type="checkbox" class="CustomerContracts-in admin_status" name="admin_status_id" id="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}" {if $state->isLoaded() && in_array($state->get('status_id'),(array)$formFilter.in.admin_status_id->getValue()) || ($state->isNotLoaded() && in_array('NULL',(array)$formFilter.in.admin_status_id->getValue()))}checked="checked"{/if}/>
                  </div>
                  <div class="filter-content-txt">
                      {if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}
                  </div>            
              </div>    
          {/foreach}  
            <input type="checkbox" class="CustomerContracts-in-select" name="admin_status"/>{__('Select/unselect all')}
            </div>
        </div>  
   {/if*}
  {* ================== PRODUCT =========================== *}
  <div class="filter" id="product">    
      <span class="filter-btn name-filter btn-table" id="product">{__('Products')}<i id="product" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content filter-content-contracts" id="product">
    {foreach $formFilter->in.product_id->getOption('choices') as $product}
        <div>    
            <div class="filter-content-input">
                <input type="checkbox" class="CustomerContracts-in product" name="product_id" id="{$product->get('id')}" {if in_array($product->get('id'),(array)$formFilter.in.product_id->getValue())}checked="checked"{/if}/>
            </div>
            <div class="filter-content-txt">
                {if $product->isLoaded()}{$product->get('meta_title')}{else}{__('Empty')}{/if}
            </div>            
        </div>    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="product"/>{__('Select/unselect all')}
      </div>
  </div>
    {* ================== PARTNER =========================== *}
   {* <div class="filter" id="partner">    
        <span class="filter-btn name-filter btn-table" id="partner">{__('Installers')}<i id="partner" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
        <div class="filter-content wide-filtre-content filter-content-contracts" id="partner">
      {foreach $formFilter->in.financial_partner_id->getOption('choices') as $partner}
              {if $partner@first}
                  <div class="filter-layout">
              {elseif $partner@index % 6 == 0}
                  </div>
                  <div class="filter-layout">
              {/if}
              <div>  
                  <div class="filter-content-input">
                      <input type="checkbox" class="CustomerContracts-in partner" name="financial_partner_id" id="{$partner->get('id')}" {if in_array($partner->get('id'),(array)$formFilter.in.financial_partner_id->getValue())}checked="checked"{/if}/>
                  </div>
                  <div class="filter-content-txt">
                       {if $partner->isLoaded()}{$partner->get('name')}{else}{__('Empty')}{/if}
                  </div>                
              </div>
              {if $partner@last}
                          </div>
              {/if}        
      {/foreach}  
        <input type="checkbox" class="CustomerContracts-in-select" name="partner"/>{__('Select/unselect all')}
        </div>
    </div>*}
    {* ================== POLLUTER =========================== *}
 {*if $formFilter->in->hasValidator('polluter_id')}
  <div class="filter" id="polluter">    
      <span class="filter-btn name-filter btn-table" id="polluter">{__('Polluters')}<i id="polluter" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content wide-filtre-content filter-content-contracts" id="polluter">
    {foreach $formFilter->in.polluter_id->getOption('choices') as $polluter}
            {if $polluter@first}
                <div class="filter-layout">
            {elseif $polluter@index % 6 == 0}
                </div>
                <div class="filter-layout">
            {/if}
            <div>  
                <div class="filter-content-input">
                    <input type="checkbox" class="CustomerContracts-in polluter" name="polluter_id" id="{$polluter->get('id')}" {if in_array($polluter->get('id'),(array)$formFilter.in.polluter_id->getValue())}checked="checked"{/if}/>
                </div>
                <div class="filter-content-txt">
                    {if $polluter->isLoaded()}
                        {if $user->hasCredential([['contract_list_equal_polluter_with_username']])}
                            {$polluter->getNameWithUserName()}
                        {else}
                            {$polluter}
                         {/if}  
                    {else}{__('Empty')}{/if}
                </div>                
            </div>  
            {if $polluter@last}
                        </div>
            {/if}    
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="polluter"/>{__('Select/unselect all')}
      </div>
  </div>    
   {/if*}  
    {* ================== LAYER =========================== *}
        {*if $formFilter->in->hasValidator('partner_layer_id')}
         <div class="filter" id="partner_layer">    
             <span class="filter-btn name-filter btn-table" id="partner_layer">{__('Layers')}<i id="partner_layer" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
             <div class="filter-content wide-filtre-content filter-content-contracts" id="partner_layer">
           {foreach $formFilter->in.partner_layer_id->getOption('choices') as $layer}
                   {if $layer@first}
                       <div class="filter-layout">
                   {elseif $layer@index % 6 == 0}
                       </div>
                       <div class="filter-layout">
                   {/if}
                   <div>      
                       <div class="filter-content-input">
                           <input type="checkbox" class="CustomerContracts-in partner_layer" name="partner_layer_id" id="{$layer->get('id')}" {if in_array($layer->get('id'),(array)$formFilter.in.partner_layer_id->getValue())}checked="checked"{/if}/>
                       </div>
                       <div class="filter-content-txt">
                           {if $layer->isLoaded()}{$layer->get('name')}{else}{__('Empty')}{/if}
                       </div>                
                   </div>
                   {if $layer@last}
                               </div>
                   {/if}    
           {/foreach}  
             <input type="checkbox" class="CustomerContracts-in-select" name="partner_layer"/>{__('Select/unselect all')}
             </div>
         </div>    
             
        {/if*}    
      {* ================== CREATOR =========================== *}
 {*if $formFilter->in->hasValidator('created_by_id')}
  <div class="filter" id="created_by">    
      <span class="filter-btn name-filter btn-table" id="created_by">{__('Creator')}<i id="created_by" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content wide-filtre-content filter-content-contracts" id="created_by">
    {foreach $formFilter->in.created_by_id->getOption('choices') as $creator}
            {if $creator@first}
                <div class="filter-layout">
            {elseif $creator@index % 6 == 0}
                </div>
                <div class="filter-layout">
            {/if}
            <div>
                <div class="filter-content-input">
                    <input type="checkbox" class="CustomerContracts-in created_by" name="created_by_id" id="{$creator->get('id')}" {if in_array($creator->get('id'),(array)$formFilter.in.created_by_id->getValue())}checked="checked"{/if}/>
                </div>
                <div class="filter-content-txt">
                    {if $creator->isLoaded()}{$creator}{else}{__('Empty')}{/if}
                </div>                
            </div>
            {if $creator@last}
                        </div>
            {/if}      
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="created_by"/>{__('Select/unselect all')}
      </div>
  </div>    
   {/if*}
 
   {if $formFilter->in->hasValidator('zone_id')}
   {* ===================== ZONE ======================== *}
  <div class="filter" id="zone">    
      <span class="filter-btn name-filter btn-table" id="zone">{__('Zone')}<i id="zone" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content filter-content-contracts" id="zone">
    {foreach $formFilter->in.zone_id->getChoices()->toArray() as $name=>$zone}
        <div>          
             {if $name}
                 <div class="filter-content-input">
                     <input type="checkbox" class="CustomerContracts-in zone" name="zone_id" id="{$zone->get('id')}" {if in_array($zone->get('id'),(array)$formFilter.in.zone_id->getValue())}checked="checked"{/if}/>
                 </div>
                 <div class="filter-content-txt">
                     {$zone->get('name')}
                 </div>                    
             {else}
                 <div class="filter-content-input">
                     <input type="checkbox" class="CustomerContracts-in zone" name="zone_id" id="" {if in_array($zone,(array)$formFilter.in.zone_id->getValue())}checked="checked"{/if}/>
                 </div>
                 <div class="filter-content-txt">
                     {__('Empty')}
                 </div>                
             {/if}
        </div>  
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="zone"/>{__('Select/unselect all')}
      </div>
  </div>
   {/if}  
   {*if $formFilter->in->hasValidator('company_id')}
   {* ===================== Company ======================== }
    <div class="filter" id="company_id">    
        <span class="filter-btn name-filter btn-table" id="company_id">{__('Company')}<i id="company_id" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
        <div class="filter-content filter-content-contracts" id="company_id">
            {foreach $formFilter->in.company_id->getChoices() as $name=>$company}
                <div>          
                     {if $name}
                         <div class="filter-content-input">
                             <input type="checkbox" class="CustomerContracts-in company" name="company_id" id="{$company->get('id')}" {if in_array($company->get('id'),(array)$formFilter.in.company_id->getValue())}checked="checked"{/if}/>
                         </div>
                         <div class="filter-content-txt">
                             {$company->get('name')}
                         </div>                    
                     {else}
                         <div class="filter-content-input">
                             <input type="checkbox" class="CustomerContracts-in company" name="company_id" id="" {if in_array($company,(array)$formFilter.in.company_id->getValue())}checked="checked"{/if}/>
                         </div>
                         <div class="filter-content-txt">
                             {__('Empty')}
                         </div>                
                     {/if}
                </div>  
            {/foreach}  
        <input type="checkbox" class="CustomerContracts-in-select" name="company"/>{__('Select/unselect all')}
        </div>
    </div>
   {/if*}  
   
  {*
  <div class="filter" id="xxxx">    
      <span class="filter-btn name-filter btn-table" id="xxxx">{__('More filter')}<i id="xxx" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content wide-filtre-content filter-content-contracts" id="xxxy">
    {*foreach $formFilter->in.created_by_id->getOption('choices') as $creator}
        <div>          
             <input type="checkbox" class="CustomerContracts-in created_by" name="created_by_id" id="{$creator->get('id')}" {if in_array($creator->get('id'),(array)$formFilter.in.created_by_id->getValue())}checked="checked"{/if}/>{if $creator->isLoaded()}{$creator}{else}{__('Empty')}{/if}
        </div>    
    {/foreach*}  
 {*     <input type="checkbox" class="CustomerContracts-in-select" name="xxxxxx"/>{__('Select/unselect all')}
      </div>
  </div>  *}  
   
  </div>
{/if}  
    {* button export *}
    <div class="filter">
    
    {if $user->hasCredential(['superadmin'])}
        <a href="#" class="btn" id="CustomerContracts-GenerateCoordinates" title="{__('Generate coordinates')}" ><img class="icon"  src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/><div style="width:100px">{__('Generate all<br>coordinates')}</div></a>  
        <br/>
    {/if}
    {if $user->hasCredential([['superadmin','contract_coordinates2']])}
        <div  class="btn">
            <a  href="#" id="CustomerContracts-GenerateCoordinatesFromFilter" title="{__('Generate coordinates')}" >
                <img  style="float:left" src="{url('/icons/kml2.png','picture')}" alt="{__('new')}"/><div style="width:100px;font-size: 12px;">{__('Generate<br>coordinates')}</div>
            </a>
            <div style="width:100px;font-size: 10px;">
                <div>      
                    <input type="checkbox" id="GenerateCoordinatesFromFilter-Force"/>{__('Force')}
                </div>
            </div>
        </div>
    {/if}
    {component name="/customers_contracts_imports/importLink"}
    {component name="/customers_contracts_exports/exportBtn"}
    {component name="/app_domoprime/exportLink"}
    {component name="/services_impot_verif/ExportLinkForContract"}
    </div>      
</div>
</div>
<!--end-->
<div id="resteViewContract" class="reste resteView" style="display: none;">
    {messages class="customers-contract-view-errors"}
    <div id="resteViewContractContent">
       
    </div>
</div>
<div id="resteContent" class="reste">
    
<div class="table">
<div  class="containerDivResp">            
<table id="CustomerContracts-List" class="tabl-list" cellpadding="0" cellspacing="0">  
  <thead>
  <tr class="list-header">
    <th>#</th>
        <th>&nbsp;</th>
        {if $user->hasCredential([['superadmin','admin','contract_view_list_id']])}
        {if $formFilter->hasColumn('id')}
        <th class="CustomerContracts cols AllText id  resize" title="{__('ID')}" style="min-width:{$formFilter.sizes.id}px!important;"{*width="{$formFilter.sizes.id}px"*} name="id">
            <span>{__('id')}</span>               
            <div class="order-asc-desc">
                <a href="#" class="CustomerContracts-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        {/if}
        {/if}
         <th>
            {__('Works')}
        </th>
        {if $formFilter->hasColumn('date')}
            <th class="CustomerContractsS cols AllText date  resize" title="{__('date')}" style="min-width:{$formFilter.sizes.date}px!important;" {*width="{$formFilter.sizes.date}px"*} name="date">

                    <span>{__('date')|capitalize}</span>  

                <div class="order-asc-desc">
                        <a href="#" class="CustomerContracts-order{$formFilter.order.opened_at->getValueExist('asc','_active')}" id="asc" name="opened_at"><img  src='{url("/icons/sort_asc`$formFilter.order.opened_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                        <a href="#" class="CustomerContracts-order{$formFilter.order.opened_at->getValueExist('desc','_active')}" id="desc" name="opened_at"><img  src='{url("/icons/sort_desc`$formFilter.order.opened_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th>  
        {/if}
        

      
        {if $formFilter->hasColumn('customer')}
        <th class="CustomerContractsS cols AllText customer resize" title="{__('Customer name')}" style="min-width:{$formFilter.sizes.customer}px!important;" {*width="{$formFilter.sizes.customer}"*} name="customer">
         
            <span>{__('Customer name')|capitalize}</span>
          
              <div class="order-asc-desc">
                <a href="#" class="CustomerContracts-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
              </div>            
        </th>  
        {/if}
     
       
       {* <th>
             <span>{__('products')|capitalize}</span>
        </th> *}
         
        {if $formFilter->hasColumn('phone')}
        <th class="CustomerContractsS cols AllText phone resize" title="{__('phone')}"  style="min-width:{$formFilter.sizes.phone}px!important;" {*width="{$formFilter.sizes.phone}"*} name="phone">
                          
            <span>{__('phone')|capitalize}</span>  
          
            <div class="order-asc-desc">
                <a href="#" class="CustomerContracts-order{$formFilter.order.phone->getValueExist('asc','_active')}" id="asc" name="phone"><img  src='{url("/icons/sort_asc`$formFilter.order.phone->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.phone->getValueExist('desc','_active')}" id="desc" name="phone"><img  src='{url("/icons/sort_desc`$formFilter.order.phone->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        {/if}
        {if $formFilter->hasColumn('postcode')}
        <th class="CustomerContractsS cols AllText postcode resize" title="{__('postcode')}" style="min-width:{$formFilter.sizes.postcode}px!important;" {*width="{$formFilter.sizes.postcode}"*} name="postcode">          
            <span>{__('postcode')|capitalize}</span>           
            <div class="order-asc-desc">
                <a href="#" class="CustomerContracts-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>            
        </th>  
        {/if}
        {if $formFilter->hasColumn('city')}
        <th class="CustomerContractsS cols AllText city resize" title="{__('city')}" style="min-width:{$formFilter.sizes.city}px!important;" {*width="{$formFilter.sizes.city}"*} name="city">           
            <span>{__('city')|capitalize}</span>  
            <div class="order-asc-desc">
                <a href="#" class="CustomerContracts-order{$formFilter.order.city->getValueExist('asc','_active')}" id="asc" name="city"><img  src='{url("/icons/sort_asc`$formFilter.order.city->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.city->getValueExist('desc','_active')}" id="desc" name="city"><img  src='{url("/icons/sort_desc`$formFilter.order.city->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>            
        </th>      
        {/if}
         {if $formFilter->hasColumn('class_id')}
      {if $formFilter->equal->hasValidator('class_id') && $user->hasCredential([['superadmin_debugxx','app_domoprime_iso_contract_list_filter_header_class','','app_domoprime_iso_contract_list_filter_class','app_domoprime_iso_contract_list_filter_class_energy_sector']])}
           
          <th title="{__('Class')}">
             <div class="">
             <span>{__('Class')}</span>
             </div>
        </th>  
        {/if}
        {/if}
        
         {if $user->hasCredential([['contract_list_display_team']]) || ($formFilter->equal->hasValidator('team_id') && $user->hasCredential([['superadmin','admin','contract_view_list_team']]))}
            {if $formFilter->hasColumn('team')}
            <th class="CustomerContractsS cols AllText team  resize" title="{__('team1')}" style="min-width:{$formFilter.sizes.team}px!important;" {*width="{$formFilter.sizes.team}px"*} name="team">{* team *}
                
                <span>{__('team_id')}</span>      
                
            </th>
            {/if}
        {/if}
         {if $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
            {if $formFilter->hasColumn('sale1')}
            <th class="CustomerContractsS cols AllText sale1 resize" title="{__('commercial 1')}" style="min-width:{$formFilter.sizes.sale1}px!important;" {*width="{$formFilter.sizes.city}"*} name="sale1">{* commercial1 *}                      
                    <span>{__('commercial_1')|capitalize}</span>  
            </th>
            {/if}
        {/if}
        {if $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
            {if $formFilter->hasColumn('sale2')}
            <th class="CustomerContractsS cols AllText sale2  resize" title="{__('commercial 2')}" style="min-width:{$formFilter.sizes.sale2}px!important;" {*width="{$formFilter.sizes.sale2}px"*} name="sale2">{* commercial2 *}      
                <span>{__('commercial_2')|capitalize}</span>
            </th>      
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('telepro_id')}
            {if $formFilter->hasColumn('telepro_id')}
            <th class="CustomerContractsS cols AllText telepro_id  resize" title="{__('telepro')}" style="min-width:{$formFilter.sizes.telepro_id}px!important;" {*width="{$formFilter.sizes.telepro_id}px"*} name="telepro_id">{* telepro *}
                <span>{__('telepro_id')|capitalize}</span>
            </th>
            {/if}
        {/if}
         {* assistant *}
        {if $user->hasCredential([['contract_list_display_assistant']]) || ($formFilter->equal->hasValidator('assistant_id') && $user->hasCredential([['superadmin','admin','contract_view_list_assistant']]))}  
            {if $formFilter->hasColumn('assistant_id')}
                <th class="CustomerContractsS cols AllText assistant_id  resize" title="{__('Assistant')}" style="min-width:{$formFilter.sizes.assistant_id}px!important;" {*width="{$formFilter.sizes.assistant_id}px"*} name="assistant_id" data-hide="phone,tablet" style="display: table-cell;">{* assistant *}
                    <span>{__('assistant_id')}</span>
                </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])} 
            {if $formFilter->hasColumn('polluter')}
                <th class="CustomerContractsS cols AllText polluter " title="{__('Polluter')}" style="min-width:{*$formFilter.sizes.work_polluter*}px!important;" {*width="{$formFilter.sizes.polluter}px"*} name="polluter_id">{* polluter *}      
                        <span>{__('polluter')}</span>  
                </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('financial_partner_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner']])}
            {if $formFilter->hasColumn('financial_partner_id')}
            <th class="CustomerContractsS cols AllText financial_partner_id  resize" title="{__('Installers')}" style="min-width:{$formFilter.sizes.financial_partner_id}px!important;" {*width="{$formFilter.sizes.financial_partner_id}px"*} name="financial_partner_id">{* financial_partner_id *}      
                <span>{__('install_team')}</span>
            </th>
            {/if}
        {/if}
       
        {if $formFilter->equal->hasValidator('partner_layer_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner_layer']])}            
            {if $formFilter->hasColumn('partner_layer_id')}
            <th class="CustomerContractsS cols AllText partner_layer_id  resize" title="{__('under_layer')}" style="min-width:{$formFilter.sizes.partner_layer_id}px!important;" {*width="{$formFilter.sizes.partner_layer_id}px"*} name="partner_layer_id">{* partner_layer_id *}       
                <span>{__('under_layer')}</span>    
            </th>
            {else}  
               
            {/if}
        {/if}
          {if $formFilter->hasColumn('state')}
        <th class="CustomerContractsS cols AllText state  resize" title="{__('contract_state')}" style="min-width:{$formFilter.sizes.state}px!important;" {*width="{$formFilter.sizes.state}px"*} name="state">{* status *}            
                    <span>{__('contract_state')}</span>         
        </th>
        {/if}
        {if $formFilter->equal->hasValidator('time_state_id') && $user->hasCredential([['superadmin','contract_view_list_time_state']])}
            {if $formFilter->hasColumn('time_state_id')}
            <th class="CustomerContractsS cols AllText time_state_id  resize" title="{__('Time status')}" style="min-width:{$formFilter.sizes.time_state_id}px!important;" {*width="{$formFilter.sizes.time_state_id}px"*} name="time_state_id">      
                    <span>{__('time_status')}</span>    
            </th>
            {/if}
        {/if}    
         {if $user->hasCredential([['superadmin','contract_list_install_state']]) && $formFilter->equal->hasValidator('install_state_id')}
            {if $formFilter->hasColumn('install_state')}
            <th class="CustomerContractsS cols AllText install_state"   title="{__('Install state')}">
                 <span>{__('install_state')}</span>        
            </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('admin_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_admin_status']])}
            {if $formFilter->hasColumn('admin_status_id')}
                <th class="CustomerContractsS cols AllText admin_status_id" title="{__('admin_status')}" style="width:{*$formFilter.sizes.admin_status_id*}px!important;" {*width="{$formFilter.sizes.admin_status}px"*} name="admin_status_id">{* admin_status *}      
                        <span>{__('admin_status')}</span>    
                </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('opc_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_opc_status']])}
            {if $formFilter->hasColumn('opc_status_id')}
                <th class="CustomerContractsS cols AllText opc_status_id  resize" title="{__('Attribution')}" style="min-width:{$formFilter.sizes.opc_status_id}px!important;" {*width="{$formFilter.sizes.opc_status_id}px"*} name="opc_status_id">{* opc_status_id *}      
                        <span>{__('attribution_status')}</span>
                </th>
            {/if}
        {/if}
        {*if $formFilter->hasColumn('work_state_id')}
        <th class="CustomerContractsS cols AllText work_state_id  resize" title="{__('Work State')}"  style="min-width:{$formFilter.sizes.work_state_id}px!important;"  name="work_state_id">     
                    <span>{__('work_state')}</span>             
        </th>
        {/if*}
         {*if $formFilter->hasColumn('work_company_id')}
        <th class="CustomerContractsS cols AllText work_company_id" title="{__('Work company')}" style="min-width:{$formFilter.sizes.work_company_id}px!important;"  name="work_company_id">
            <span>{__('work_company')|capitalize}</span>
              <div>
              </div>
        </th>  
        {/if*}
        {if $formFilter->equal->hasValidator('work_partner_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner']])}
            {if $formFilter->hasColumn('work_partner_id')}
                <th class="CustomerContractsS cols AllText work_partner_id  resize" title="{__('Work installers')}" style="min-width:{$formFilter.sizes.work_partner_id}px!important;" {*width="{$formFilter.sizes.work_partner_id}px"*} name="work_partner_id">{* work_partner_id *}      
 
                        <span>{__('work_installers')}</span>
                    
                </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('work_polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
            {if $formFilter->hasColumn('work_polluter_id')}
                <th class="CustomerContractsS cols AllText work_polluter_id " title="{__('Work Polluter')}" style="width:{*$formFilter.sizes.work_polluter*}px!important;" {*width="{$formFilter.sizes.polluter}px"*} name="work_polluter_id">{* polluter *}      
        
                        <span>{__('work_polluter')}</span>  
                    
                </th>
            {/if}
        {/if}        
        {if $formFilter->equal->hasValidator('work_partner_layer_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner_layer']])}            
            {if $formFilter->hasColumn('work_partner_layer_id')}
                <th class="CustomerContractsS cols AllText work_partner_layer_id  resize" title="{__('Work Layer')}"  style="min-width:{$formFilter.sizes.work_partner_layer_id}px!important;" {*width="{$formFilter.sizes.work_partner_layer_id}px"*} name="work_partner_layer_id">{* work_partner_layer_id *}      

                    <span>{__('work_under_layer')}</span>    

                </th>
               
            {/if}
        {/if}
        {if $formFilter->hasColumn('work_all_quantities')}
            <th class="CustomerContractsS cols AllText work_all_quantities resize" title="{__('Work all quantities')}"  {*width="{$formFilter.sizes.customer}"*} name="work_all_quantities">
                 
                    <span>{__('work_all_quantities')|capitalize}</span>
                
                <div class="order-asc-desc">
                   
                </div>
            </th>  
        {/if}
        {if $formFilter->hasColumn('engine_id')}
        <th class="CustomerContractsS cols AllText engine_id" title="{__('Qumac Engine')}" style="min-width:{$formFilter.sizes.engine_id}px!important;" {*width="{$formFilter.sizes.engine_id}"*} name="engine_id">
             
            <span>{__('Qumac Engine')|capitalize}</span>
              <div>
              </div>
            
        </th>  
        {/if}
        {*if $formFilter->hasColumn('pricing_id')}
            <th class="CustomerContractsS cols AllText pricing_id resize" title="{__('Pricings')}" style="min-width:{$formFilter.sizes.pricing_id}px!important;" name="city">
       
                <span>{__('Pricings')|capitalize}</span>  
             

            </th>      
        {/if*}
       
        {*if $formFilter->hasColumn('work_surface_ite')}
            <th class="CustomerContractsS cols AllTextwork_surface_ite resize"  {*width="{$formFilter.sizes.customer}"*} {*name="work_surface_ite">
             {*   <div class="resizableTH" style="width:{$formFilter.sizes.work_surface_ite}px!important;">
                    <span>{__('Work surface ite')|capitalize}</span>
                </div>
                <div class="order-asc-desc">
                   
                </div>
            </th>  
        {/if}
        {if $formFilter->hasColumn('work_pack_quantity')}
            <th class="CustomerContractsS cols AllTextwork_pack_quantity resize"  {*width="{$formFilter.sizes.customer}"*} {*name="work_pack_quantity">
               {* <div class="resizableTH" style="width:{$formFilter.sizes.work_pack_quantity}px!important;">
                    <span>{__('Work pack quantity')|capitalize}</span>
                </div>
                <div class="order-asc-desc">
                   
                </div>
            </th>  
        {/if}
        {if $formFilter->hasColumn('work_boiler_quantity')}
            <th class="CustomerContractsS cols AllTextwork_boiler_quantity resize"  {*width="{$formFilter.sizes.customer}"*} {*name="work_boiler_quantity">
              {*  <div class="resizableTH" style="width:{$formFilter.sizes.work_boiler_quantity}px!important;">
                    <span>{__('Work boiler quantity')|capitalize}</span>
                </div>
                <div class="order-asc-desc">
                   
                </div>
            </th>  
        {/if*}
        
        {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_list_surface_parcel']])}
            {if $formFilter->hasColumn('surface_parcel_check')}
            <th class="CustomerContractsS cols AllText surface_parcel_check  resize" title="{__('Parcel surface')}" style="min-width:{$formFilter.sizes.surface_parcel_check}px!important;" {*width="{$formFilter.sizes.surface_parcel_check}px"*} name="surface_parcel_check">
                
                {__('Parcel surface')}
               
            </th>
            {/if}
        {/if}
       
        
       
       
        
      
       
       
        
       
         {*if $user->hasCredential([['superadmin','contract_list_advance_payment']])}  
            <th>
              <span>{__('Advance')}</span>              
            </th>  
            {/if*}
        {if $formFilter->equal->hasValidator('is_confirmed') && $user->hasCredential([['superadmin','contract_view_list_confirmed']])}
            {if $formFilter->hasColumn('is_confirmed')}
            <th class="CustomerContractsS cols AllText is_confirmed  resize" title="{__('Confirmed')}" style="min-width:{$formFilter.sizes.is_confirmed}px!important;" {*width="{$formFilter.sizes.is_confirmed}px"*} name="is_confirmed">{* is_confirmed *}
             
                <span>{__('Confirmed')}</span>
           
            </th>        
            {/if}            
        {/if}            
        {if $formFilter->equal->hasValidator('is_hold') && $user->hasCredential([['superadmin','admin','contract_view_list_hold']])}
            {if $formFilter->hasColumn('is_hold')}
                <th class="CustomerContractsS cols AllText is_hold  resize" title="{__('Hold')}" style="min-width:{$formFilter.sizes.is_hold}px!important;" {*width="{$formFilter.sizes.is_hold}px"*} name="is_hold">{* partner *}      
                    <span>{__('Hold')}</span>
                </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_hold_quote') && $user->hasCredential([['superadmin','contract_view_list_hold_quote']])}
            {if $formFilter->hasColumn('is_hold_quote')}
             <th class="CustomerContractsS cols AllText is_hold_quote  resize" title="{__('Quote Hold')}" style="min-width:{*$formFilter.sizes.hold_quote*}px!important;" {*width="{$formFilter.sizes.hold_quote}px"*} name="is_hold_quote">{* hold_quote *}      
 
                     <span>{__('Quote Hold')}</span>  
           
            </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_document')}
            {if $formFilter->hasColumn('is_document')}
            <th class="CustomerContractsS cols AllText is_document  resize" title="{__('Document')}" style="min-width:{$formFilter.sizes.is_document}px!important;" {*width="{$formFilter.sizes.is_document}px"*} name="is_document">    
              
                <span>{__('Document')}</span>  
                
            </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_photo')}
            {if $formFilter->hasColumn('is_photo')}
            <th class="CustomerContractsS cols AllText is_photo  resize" title="{__('Photo')}" style="min-width:{$formFilter.sizes.is_photo}px!important;" {*width="{$formFilter.sizes.is_photo}px"*} name="is_photo">    
 
                <span>{__('photo')}</span>    
             
            </th>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_quality')}
            {if $formFilter->hasColumn('is_quality')}
            <th class="CustomerContractsS cols AllText is_quality  resize" title="{__('Quality')}" style="min-width:{$formFilter.sizes.is_quality}px!important;" {*width="{$formFilter.sizes.is_quality}px"*} name="is_quality">    
 
                <span>{__('quality')}</span>    
 
            </th>
            {/if}
        {/if}
       
        {if $formFilter->equal->hasValidator('created_by_id')}  
            {if $formFilter->hasColumn('creator')}
            <th class="CustomerContractsS cols AllText creator  resize" title="{__('Creator')}" style="min-width:{$formFilter.sizes.creator}px!important;" {*width="{$formFilter.sizes.creator}px"*} name="creator">
              
                    <span>{__('creator')}</span>  
               
            </th>
            {/if}
        {/if}
        {component name="/customers_contracts_master/HeaderContractPager"}  
      
        
         {if $formFilter->hasColumn('company_id')}
        <th class="CustomerContractsS cols AllText company_id resize" title="{__('company')}" style="min-width:{$formFilter.sizes.company_id}px!important;" {*width="{$formFilter.sizes.customer}"*} name="company_id">
            <span>{__('company')|capitalize}</span>
              <div>
              </div>
        </th>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','contract_list_status']]) && $formFilter->equal->hasValidator('status')}  
            {if $formFilter->hasColumn('status')}
                <th class="CustomerContractsS cols AllText status  resize" title="{__('Current Status')}" style="min-width:{$formFilter.sizes.status}px!important;" {*width="{$formFilter.sizes.status}px"*} name="status">
                    <span>{__("Current Status")}</span>
                </th>
            {/if}
        {/if}
        {if $formFilter->hasColumn('actions')}
        <th class="CustomerContractsS cols AllText actions  resize" title="{__('actions')}" style="min-width:{$formFilter.sizes.actions}px!important;" {*width="{$formFilter.sizes.status}px"*} name="actions">
              
                {__('actions')|capitalize}            
             
        </th>
        {/if}
         {if $formFilter->hasColumn('is_billable')}
        <th class="CustomerContractsS cols AllText is_billable resize" title="{__('is billable')}" style="min-width:{$formFilter.sizes.is_billable}px!important;" {*width="{$formFilter.sizes.customer}"*} name="is_billable">
           
            <span>{__('is billable')|capitalize}</span>
            
        </th>  
        {/if}
         {*if $user->hasCredential([['app_domoprime_iso_contract_list_surface_101','app_domoprime_contract_list_surface_from_forms_101','app_domoprime_iso_contract_list_surface_from_form_101']])}          
            {if $formFilter->hasColumn('surface_top')}
                <th class="CustomerContractsS cols AllText surface_top resize" title="{__('101')}" style="min-width:{$formFilter.sizes.surface_top}px!important;"  name="surface_top">
 
                    {__('surface_101')}
 
                {if $formFilter->order->hasValidator('surface_top')}
                    <div class="order-asc-desc">
                    <a href="#" class="CustomerContracts-order{$formFilter.order.surface_top->getValueExist('asc','_active')}" id="asc" name="surface_top"><img  src='{url("/icons/sort_asc`$formFilter.order.surface_top->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="CustomerContracts-order{$formFilter.order.surface_top->getValueExist('desc','_active')}" id="desc" name="surface_top"><img  src='{url("/icons/sort_desc`$formFilter.order.surface_top->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                    </div>
                {/if}                
                </th>
            {/if}
        {/if*}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_102','app_domoprime_contract_list_surface_from_forms_102','app_domoprime_iso_contract_list_surface_from_form_102']])}          
        {*if $formFilter->hasColumn('surface_wall')}            
            <th class="CustomerContractsS cols AllText surface_wall  resize" title="{__('102')}" style="min-width:{$formFilter.sizes.surface_wall}px!important;"  name="surface_wall">
 
                {__('surface_102')}
 
            {if $formFilter->order->hasValidator('surface_wall')}
                <div class="order-asc-desc">
                    <a href="#" class="CustomerContracts-order{$formFilter.order.surface_wall->getValueExist('asc','_active')}" id="asc" name="surface_wall"><img  src='{url("/icons/sort_asc`$formFilter.order.surface_wall->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="CustomerContracts-order{$formFilter.order.surface_wall->getValueExist('desc','_active')}" id="desc" name="surface_wall"><img  src='{url("/icons/sort_desc`$formFilter.order.surface_wall->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            {/if}            
            </th>
        {/if*}
        {/if}
       
        {*if $user->hasCredential([['app_domoprime_iso_contract_list_surface_103','app_domoprime_contract_list_surface_from_forms_103','app_domoprime_iso_contract_list_surface_from_form_103']])}          
            {if $formFilter->hasColumn('surface_floor')}
                <th class="CustomerContractsS cols AllText surface_floor  resize" title="{__('103')}" style="min-width:{$formFilter.sizes.surface_floor}px!important;" name="surface_floor">
 
                        {__('surface_103')}
                
                    {if $formFilter->order->hasValidator('surface_floor')}
                       <div class="order-asc-desc">
                       <a href="#" class="CustomerContracts-order{$formFilter.order.surface_floor->getValueExist('asc','_active')}" id="asc" name="surface_floor"><img  src='{url("/icons/sort_asc`$formFilter.order.surface_floor->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                       <a href="#" class="CustomerContracts-order{$formFilter.order.surface_floor->getValueExist('desc','_active')}" id="desc" name="surface_floor"><img  src='{url("/icons/sort_desc`$formFilter.order.surface_floor->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                       </div>
                    {/if}            
                </th>
            {/if}
        {/if*}
         {if $formFilter->hasColumn('amount')}
        <th class="CustomerContractsS cols AllText amount resize" title="{__('amount')}" style="min-width:{$formFilter.sizes.customer}px!important;" width="{$formFilter.sizes.customer}" name="amount">
 
            <span>{__('amount')|capitalize}</span>
              <div class="order-asc-desc">
                <a href="#" class="CustomerContracts-order{$formFilter.order.total_price_with_taxe->getValueExist('asc','_active')}" id="asc" name="total_price_with_taxe"><img  src='{url("/icons/sort_asc`$formFilter.order.total_price_with_taxe->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerContracts-order{$formFilter.order.total_price_with_taxe->getValueExist('desc','_active')}" id="desc" name="total_price_with_taxe"><img  src='{url("/icons/sort_desc`$formFilter.order.total_price_with_taxe->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
     
        </th>
        {/if}
    </tr>
    <tr class="filter-list">
        <td>{* # *}</td>
        <td>&nbsp;</td>  
       {if $user->hasCredential([['superadmin','admin','contract_view_list_id']])}  
           {if $formFilter->hasColumn('id')}
            <td class="CustomerContracts cols id">
             </td>  
            {/if}    
       {/if}    
        <td></td>
       {if $formFilter->hasColumn('date')}
       <td class="CustomerContracts cols date">{* date *}          
           <div class="filter" id="opc_range">    
            <span class="filter-btn name-filter btn-table btn-sm p-0" id="opc_range">{__('Opc range')}<i id="opc_range" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content filter-content-contracts table-filter" id="opc_range">
              {foreach $formFilter->in.opc_range_id->getOption('choices') as $range_i18n}
                  <div>
                      <div class="filter-content-input">
                          <input type="checkbox" class="CustomerContracts-in opc_range" name="opc_range_id" id="{$range_i18n->get('range_id')}" {if in_array($range_i18n->get('range_id'),(array)$formFilter.in.opc_range_id->getValue())}checked="checked"{/if}/>
                      </div>
                      <div class="filter-content-txt">
                          {if $range_i18n->isLoaded()}{$range_i18n->get('value')|upper}{else}{__('Empty')}{/if}
                      </div>                
                  </div>    
              {/foreach}  
            <input type="checkbox" class="CustomerContracts-in-select" name="opc_range"/>{__('Select/unselect all')}
            </div>
         </div>
       </td>
       {/if}
       {if $formFilter->hasColumn('customer')}
       <td class="CustomerContracts customer">{* customer *}
        
       </td>
       {/if}  
       
      
      
        
       
      {*  <td>
      {*      {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal" name="product_id" options=$formFilter->equal.product_id->getOption('choices') selected=(string)$formFilter.equal.product_id}
       </td> *}
       {* amount *}
      
      {if $formFilter->hasColumn('phone')}
       <td class="CustomerContracts cols phone">{* phone *}
           
       </td>
       {/if}
       {if $formFilter->hasColumn('postcode')}
       <td class="CustomerContracts cols postcode">{* postcode *}  
        
       </td>
       {/if}
       {if $formFilter->hasColumn('city')}
       <td class="CustomerContracts cols city">{* city *}
       </td>
       {/if}
        {if $formFilter->hasColumn('class_id')} 
          <td class="CustomerContracts cols class_id"> 
          </td>
        {/if}
       
       {if $formFilter->equal->hasValidator('team_id') && $user->hasCredential([['superadmin','admin','contract_view_list_team']])}
            {if $formFilter->hasColumn('team')}
               <td class="CustomerContracts cols team"> {* team *}
                    <div class="filter" id="team">    
                    <span class="filter-btn name-filter btn-table btn-sm p-0" id="team">{__('team_id')}<i id="team" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                    <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="team">
                    <input id="team" class="searchFor" type="text">
                   <a id="team" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                  {foreach $formFilter->in.team_id->getOption('choices') as $team}
                          {if $team@first}
                              <div class="filter-layout">
                          {/if}
                          <div>
                              <div class="filter-content-input">
                                  <input type="checkbox" class="CustomerContracts-in team" name="team_id" id="{$team->get('id')}" {if in_array($team->get('id'),(array)$formFilter.in.team_id->getValue())}checked="checked"{/if}/>
                                  <label for="{$team->get('id')}">{if $team->isLoaded()}{$team->get('name')}{else}{__('Empty')}{/if}</label>
                              </div>
                              <div class="filter-content-txt">
                                  
                              </div>                
                          </div>
                          {if $team@last}
                                      </div>
                          {/if}    
                  {/foreach}  
                    <input type="checkbox" class="CustomerContracts-in-select" name="team"/>{__('Select/unselect all')}
                    </div>
                </div>        
                </td>
            {/if}
         {elseif $user->hasCredential([['contract_list_display_team']])}
            {if $formFilter->hasColumn('team')}
                <td class="CustomerContracts cols team"></td>
            {/if}
       {/if}
        {if $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
            {if $formFilter->hasColumn('sale1')}
           <td class="CustomerContracts cols sale1">{* commercial1 *}
             <div class="filter" id="sale1">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="sale1">{__('commercial_1')}<i id="sale1" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="sale1">
                <input id="sale1" class="searchFor" type="text">
                <a id="sale1" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
               {foreach $formFilter->in.sale_1_id->getOption('choices') as $sale}
                  {if $sale@first}
                      <div class="filter-layout">
                    {/if}
                      <div>
                          <div class="filter-content-input">
                              <input type="checkbox" class="CustomerContracts-in sale1" name="sale_1_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_1_id->getValue())}checked="checked"{/if}/>
                              <label for="{$sale->get('id')}">{if $sale->isLoaded()}{$sale->get('lastname')|upper} {$sale->get('firstname')|upper}{else}{__('Empty')}{/if}</label>
                          </div>
                          <div class="filter-content-txt">
                             
                          </div>

                      </div>  
                      {if $sale@last}
                      </div>
                      {/if}  
              {/foreach}  
                <input type="checkbox" class="CustomerContracts-in-select" name="sale1"/>{__('Select/unselect all')}
                </div>
             </div>
           </td>
           {/if}
        {/if}
        {if $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
            {if $formFilter->hasColumn('sale2')}
            <td class="CustomerContracts cols sale2">{* commercial2 *}
                  <div class="filter" id="sale2">    
                    <span class="filter-btn name-filter btn-table btn-sm p-0" id="sale2">{__('commercial_2')}<i id="sale2" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                    <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="sale2">
                     <input id="sale2" class="searchFor" type="text">
                     <a id="sale2" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                      {foreach $formFilter->in.sale_2_id->getOption('choices') as $sale}
                              {if $sale@first}
                                  <div class="filter-layout">
                              {/if}
                              <div>
                                  <div class="filter-content-input">
                                      <input type="checkbox" class="CustomerContracts-in sale2" name="sale_2_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_2_id->getValue())}checked="checked"{/if}/>
                                      <label for="{$sale->get('id')}">{if $sale->isLoaded()}{$sale->get('lastname')|upper} {$sale->get('firstname')|upper}{else}{__('Empty')}{/if}</label>
                                  </div>
                                  <div class="filter-content-txt">
                                     
                                  </div>                
                              </div>
                              {if $sale@last}
                                          </div>
                              {/if}    
                      {/foreach}  
                    <input type="checkbox" class="CustomerContracts-in-select" name="sale2"/>{__('Select/unselect all')}
                    </div>
                </div> 
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('telepro_id')}
           {if $formFilter->hasColumn('telepro_id')}
            <td class="CustomerContracts cols telepro_id">{* telepro *}
                 <div class="filter" id="telepro">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="telepro">{__('telepro_id')}<i id="telepro" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="telepro">
                 <input id="telepro" class="searchFor" type="text">
                <a id="telepro" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                  {foreach $formFilter->in.telepro_id->getOption('choices') as $sale}
                    {if $sale@first}
                      <div class="filter-layout">

                    {/if}
                  <div>
                      <div class="filter-content-input">
                          <input type="checkbox" class="CustomerContracts-in telepro" name="telepro_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>
                          <label for="{$sale->get('id')}">{if $sale->isLoaded()}{$sale->get('lastname')|upper} {$sale->get('firstname')|upper}{else}{__('Empty')}{/if}</label>
                      </div>
                      <div class="filter-content-txt">
                         
                      </div>            
                  </div>
                   {if $sale@last}
                                  </div>
                    {/if}
              {/foreach}  
                <input type="checkbox" class="CustomerContracts-in-select" name="telepro"/>{__('Select/unselect all')}
                </div>
            </div>
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('assistant_id') && $user->hasCredential([['superadmin','admin','contract_view_list_assistant']])}  
         {if $formFilter->hasColumn('assistant_id')}
            <td class="CustomerContracts cols assistant_id">
               <div class="filter" id="assistant">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="assistant">{__('assistant_id')}<i id="assistant" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="assistant">
                <input id="assistant" class="searchFor" type="text">
                <a id="assistant" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                    {foreach $formFilter->in.assistant_id->getOption('choices') as $assistant}
                      {if $assistant@first}
                          <div class="filter-layout">
                      {/if}
                      <div>
                          <div class="filter-content-input">
                              <input type="checkbox" class="CustomerContracts-in assistant" name="assistant_id" id="{$assistant->get('id')}" {if in_array($assistant->get('id'),(array)$formFilter.in.assistant_id->getValue())}checked="checked"{/if}/>
                              <label for="{$assistant->get('id')}">{if $assistant->isLoaded()}{$assistant->get('lastname')|upper} {$assistant->get('firstname')|upper}{else}{__('Empty')}{/if}</label>
                          </div>
                          <div class="filter-content-txt">
                             
                          </div>                
                      </div>
                      {if $assistant@last}
                                  </div>
                      {/if}    
                  {/foreach}  
                    <input type="checkbox" class="CustomerContracts-in-select" name="assistant"/>{__('Select/unselect all')}
                    </div>
                  </div>
            </td>  
       
        {/if}  
        {/if}
         {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
            {if $formFilter->hasColumn('polluter')}
            <td class="CustomerContracts cols polluter">{* polluter *}      
               <div class="filter" id="polluter">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="polluter">{__('polluter')}<i id="polluter" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="polluter">
                <input id="polluter" class="searchFor" type="text">
                <a id="polluter" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>     
              {foreach $formFilter->in.polluter_id->getOption('choices') as $polluter}
                      {if $polluter@first}
                          <div class="filter-layout">
                      {/if}
                      <div>  
                          <div class="filter-content-input">
                              <input type="checkbox" class="CustomerContracts-in polluter" name="polluter_id" id="{$polluter->get('id')}" {if in_array($polluter->get('id'),(array)$formFilter.in.polluter_id->getValue())}checked="checked"{/if}/>
                              <label for="{$polluter->get('id')}">
                                  {if $polluter->isLoaded()}
                                  {if $user->hasCredential([['contract_list_equal_polluter_with_username']])}
                                      {$polluter->get('id')}-{$polluter->get('name')}
                                  {else}
                                      {$polluter}
                                   {/if}  
                              {else}{__('Empty')}{/if}
                              </label>
                          </div>
                          <div class="filter-content-txt">
                              
                          </div>                
                      </div>  
                      {if $polluter@last}
                                  </div>
                      {/if}    
              {/foreach}  
                <input type="checkbox" class="CustomerContracts-in-select" name="polluter"/>{__('Select/unselect all')}
                </div>
            </div>    
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('financial_partner_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner']])}
            {if $formFilter->hasColumn('financial_partner_id')}
            <td class="CustomerContracts cols financial_partner_id">{* financial_partner_id *}      
               <div class="filter" id="partner">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="partner">{__('install_team')}<i id="partner" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="partner">
               <input id="partner" class="searchFor" type="text">
                <a id="partner" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a> 
                {foreach $formFilter->in.financial_partner_id->getOption('choices') as $partner}
                      {if $partner@first}
                          <div class="filter-layout">
                      {/if}
                      <div>  
                          <div class="filter-content-input">
                              <input type="checkbox" class="CustomerContracts-in partner" name="financial_partner_id" id="{$partner->get('id')}" {if in_array($partner->get('id'),(array)$formFilter.in.financial_partner_id->getValue())}checked="checked"{/if}/>
                              <label for="{$partner->get('id')}">{if $partner->isLoaded()}{$partner->get('name')}{else}{__('Empty')}{/if}</label>
                          </div>
                          <div class="filter-content-txt">
                               
                          </div>                
                      </div>
                      {if $partner@last}
                                  </div>
                      {/if}        
              {/foreach}  
                <input type="checkbox" class="CustomerContracts-in-select" name="partner"/>{__('Select/unselect all')}
                </div>
            </div>
             </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('partner_layer_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner_layer']])}
            {if $formFilter->hasColumn('partner_layer_id')}            
               <td class="CustomerContracts cols  partner_layer_id">{* partner *}  
                   {if $formFilter->in->hasValidator('partner_layer_id')}
         <div class="filter" id="partner_layer">    
             <span class="filter-btn name-filter btn-table btn-sm p-0" id="partner_layer">{__('under_layer')}<i id="partner_layer" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
             <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="partner_layer">
             <input id="partner_layer" class="searchFor" type="text">
              <a id="partner_layer" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a> 
            {foreach $formFilter->in.partner_layer_id->getOption('choices') as $layer}
                   {if $layer@first}
                       <div class="filter-layout">
                   {/if}
                   <div>      
                       <div class="filter-content-input">
                           <input type="checkbox" class="CustomerContracts-in partner_layer" name="partner_layer_id" id="{$layer->get('id')}" {if in_array($layer->get('id'),(array)$formFilter.in.partner_layer_id->getValue())}checked="checked"{/if}/>
                           <label for="{$layer->get('id')}">{if $layer->isLoaded()}{$layer->get('name')}{else}{__('Empty')}{/if}</label>
                       </div>
                       <div class="filter-content-txt">
                           
                       </div>                
                   </div>
                   {if $layer@last}
                               </div>
                   {/if}    
           {/foreach}  
             <input type="checkbox" class="CustomerContracts-in-select" name="partner_layer"/>{__('Select/unselect all')}
             </div>
         </div>    
             
        {/if}  
               </td>
           {/if}
        {/if}
          {if $formFilter->hasColumn('state')}
        <td class="CustomerContracts cols state">{* status *}
            <div class="filter" id="state">    
            <span class="filter-btn name-filter btn-table btn-sm p-0" id="state">{__('contract_state')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content filter-content-contracts table-filter" id="state">
           <input id="state" class="searchFor" type="text">
           <a id="state" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a> 
          {foreach $formFilter->in.state_id->getOption('choices') as $state}
              <div>        
                  <div class="filter-content-input">
                      <input type="checkbox" class="CustomerContracts-in state" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>
                      <label for="{$state->get('status_id')}">{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}</label>
                  </div>
                  <div class="filter-content-txt">
                      
                  </div>            
              </div>    
          {/foreach}  
            <input type="checkbox" class="CustomerContracts-in-select" name="state"/>{__('Select/unselect all')}
            </div>
        </div>  
          </td>
        {/if}
        {if $formFilter->equal->hasValidator('time_state_id') && $user->hasCredential([['superadmin','contract_view_list_time_state']])}
            {if $formFilter->hasColumn('time_state_id')}
            <td class="CustomerContracts cols time_state_id">    
               <div class="filter" id="time_state">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="time_state">{__('time_status')}<i id="time_state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content filter-content-contracts table-filter" id="time_state">
                <input id="time_state" class="searchFor" type="text">
              <a id="time_state" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a> 
              {foreach $formFilter->in.time_state_id->getOption('choices') as $state}
                  <div>    
                      <div class="filter-content-input">
                           <input type="checkbox" class="CustomerContracts-in time_state" name="time_state_id" id="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}" {if $state->isLoaded() && in_array($state->get('status_id'),(array)$formFilter.in.time_state_id->getValue()) || ($state->isNotLoaded() && in_array('NULL',(array)$formFilter.in.time_state_id->getValue()))}checked="checked"{/if}/>
                           <label for="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}">{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}</label>
                      </div>
                      <div class="filter-content-txt">
                          
                      </div>            
                  </div>    
              {/foreach}  
                <input type="checkbox" class="CustomerContracts-in-select" name="time_state"/>{__('Select/unselect all')}
                </div>
            </div>  
            </td>
            {/if}
        {/if}   
        {if $user->hasCredential([['superadmin','contract_list_install_state']]) && $formFilter->equal->hasValidator('install_state_id')}
        {if $formFilter->hasColumn('install_state')}
            <td>
                
            </td>
        {/if}  
        {/if}  
         {if $formFilter->equal->hasValidator('admin_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_admin_status']])}
            {if $formFilter->hasColumn('admin_status_id')}
                <td class="CustomerContracts cols admin_status_id">{* partner *}      
                     <div class="filter" id="admin_status">    
                        <span class="filter-btn name-filter btn-table btn-sm p-0" id="admin_status">{__('admin_status')}<i id="time_state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                        <div class="filter-content filter-content-contracts table-filter" id="admin_status">
                        <input id="admin_status" class="searchFor" type="text">
                        <a id="admin_status" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                      {foreach $formFilter->in.admin_status_id->getOption('choices') as $state}
                          <div>    
                              <div class="filter-content-input">
                                  <input type="checkbox" class="CustomerContracts-in admin_status" name="admin_status_id" id="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}" {if $state->isLoaded() && in_array($state->get('status_id'),(array)$formFilter.in.admin_status_id->getValue()) || ($state->isNotLoaded() && in_array('NULL',(array)$formFilter.in.admin_status_id->getValue()))}checked="checked"{/if}/>
                                  <label for="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}">{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}</label>
                              </div>
                              <div class="filter-content-txt">
                                  
                              </div>            
                          </div>    
                      {/foreach}  
                        <input type="checkbox" class="CustomerContracts-in-select" name="admin_status"/>{__('Select/unselect all')}
                        </div>
                    </div>  
            
                </td>
            {/if}
        {/if} 
        {if $formFilter->equal->hasValidator('opc_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_opc_status']])}
            {if $formFilter->hasColumn('opc_status_id')}
            <td class="CustomerContracts cols opc_status_id">{* partner *}      
                 <div class="filter" id="opc_status">    
                <span class="filter-btn name-filter btn-table btn-sm p-0" id="opc_status">{__('attribution_status')}<i id="opc_status" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                <div class="filter-content filter-content-contracts table-filter" id="opc_status">
                <input id="opc_status" class="searchFor" type="text">
               <a id="opc_status" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
              {foreach $formFilter->in.opc_status_id->getOption('choices') as $state}
                  <div>  
                      <div class="filter-content-input">
                          <input type="checkbox" class="CustomerContracts-in opc_status" name="opc_status_id" id="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}" {if $state->isLoaded() && in_array($state->get('status_id'),(array)$formFilter.in.opc_status_id->getValue()) || ($state->isNotLoaded() && in_array('NULL',(array)$formFilter.in.opc_status_id->getValue()))}checked="checked"{/if}/>
                          <label for="{if $state->isLoaded()}{$state->get('status_id')}{else}NULL{/if}">{if $state->isLoaded()}{$state}{else}{__('Empty')}{/if}</label>
                      </div>
                      <div class="filter-content-txt">
                          
                      </div>            
                  </div>    
              {/foreach}  
                <input type="checkbox" class="CustomerContracts-in-select" name="opc_status"/>{__('Select/unselect all')}
                </div>
            </div>  
            </td>
            {/if}
        {/if}
         {if $formFilter->hasColumn('work_state_id')}
        <td class="CustomerContracts cols work_state_id">{* status *}
          </td>
        {/if}
         {if $formFilter->hasColumn('work_company_id')}
            <td class="CustomerContracts cols work_company_id">{* work_company_id *}
            
            </td>
       {/if}
        {if $formFilter->equal->hasValidator('work_partner_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner']])}
            {if $formFilter->hasColumn('work_partner_id')}
            <td class="CustomerContracts cols work_partner_id">{* work_partner_id *}      
                
            </td>
            {/if}
        {/if}
         {if $formFilter->equal->hasValidator('work_polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
            {if $formFilter->hasColumn('work_polluter_id')}
            <td class="CustomerContracts cols work_polluter_id">{* partner *}      
            
            </td>
            {/if}
        {/if}
        
        {if $formFilter->equal->hasValidator('work_partner_layer_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner_layer']])}
            {if $formFilter->hasColumn('work_partner_layer_id')}
               <td class="CustomerContracts cols  work_partner_layer_id">{* work_partner_layer_id *}      
                    
               </td>
           {/if}
        {/if}
        {if $formFilter->hasColumn('work_all_quantities')}
            <td class="CustomerContracts cols work_all_quantities">{* work_all_quantities *}
            </td>
        {/if}
        {if $formFilter->hasColumn('engine_id')}
            <td class="CustomerContracts cols engine_id">{* engine_id *}
            {if $formFilter->equal->hasValidator('engine_id')}
                
            {/if}    
            </td>
        {/if}
       {if $formFilter->hasColumn('pricing_id')}
       <td class="CustomerContracts cols pricing">{* pricing_id *}
       </td>
       {/if}
       
        {if $formFilter->hasColumn('work_surface_ite')}
            <td class="CustomerContracts cols work_surface_ite">{* work_surface_ite *}           
                {if $formFilter->search->hasValidator('work_surface_ite')}
                 <input type="text" class="CustomerContracts-search form-control" name="work_surface_ite" value="{(string)$formFilter.search.work_surface_ite}"/>
            {/if}    
            </td>
       {/if}
        {if $formFilter->hasColumn('work_pack_quantity')}
            <td class="CustomerContracts cols work_pack_quantity">{* work_pack_quantity *}
            {if $formFilter->search->hasValidator('work_pack_quantity')}
                 <input type="text" class="CustomerContracts-search form-control" name="work_pack_quantity" value="{(string)$formFilter.search.work_pack_quantity}"/>
            {/if}    
            </td>
       {/if}
        {if $formFilter->hasColumn('work_boiler_quantity')}
            <td class="CustomerContracts cols work_boiler_quantity">{* work_boiler_quantity *}
           {if $formFilter->search->hasValidator('work_boiler_quantity')}
                 <input type="text" class="CustomerContracts-search form-control" name="work_boiler_quantity" value="{(string)$formFilter.search.work_boiler_quantity}"/>
            {/if}    
            </td>
       {/if}
       
        {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_list_surface_parcel']])}
            {if $formFilter->hasColumn('surface_parcel_check')}
            <td class="CustomerContracts cols surface_parcel_check">
           
            </td>
            {/if}
        {/if}
        
        
       
       
        
        
        
         
        
       
        {*if $user->hasCredential([['superadmin','contract_list_advance_payment']])}  
            <td>
            <input type="text" class="CustomerContracts-search" name="advance_payment"   size="5" value="{$formFilter.search.advance_payment}"/>
            </td>  
            {/if*}
        {if $formFilter->equal->hasValidator('is_confirmed') && $user->hasCredential([['superadmin','contract_view_list_confirmed']])}
           {if $formFilter->hasColumn('is_confirmed')}
            <td class="CustomerContracts cols is_confirmed">
              </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_hold') && $user->hasCredential([['superadmin','admin','contract_view_list_hold']])}
         {if $formFilter->hasColumn('is_hold')}
            <td class="CustomerContracts cols is_hold">{* partner *}      
             </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_hold_quote') && $user->hasCredential([['superadmin','contract_view_list_hold_quote']])}
           {if $formFilter->hasColumn('is_hold_quote')}
                <td class="CustomerContracts cols is_hold_quote">{* partner *}      
                  </td>
            {/if}  
        {/if}  
        {if $formFilter->equal->hasValidator('is_document')}
            {if $formFilter->hasColumn('is_document')}
                <td class="CustomerContracts cols is_document">  
                                  </td>
            {/if}
        {/if}
         {if $formFilter->equal->hasValidator('is_photo')}
            {if $formFilter->hasColumn('is_photo')}
            <td class="CustomerContracts cols is_photo">
                            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_quality')}
            {if $formFilter->hasColumn('is_quality')}
            <td class="CustomerContracts cols is_quality">
                          </td>
            {/if}
        {/if}
       
       {if $formFilter->equal->hasValidator('created_by_id')}  
            {if $formFilter->hasColumn('creator')}
                <td class="CustomerContracts cols creator">             
                    <div class="filter" id="created_by">    
                       <span class="filter-btn name-filter btn-table btn-sm p-0" id="created_by">{__('creator')}<i id="created_by" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                       <div class="filter-content wide-filtre-content filter-content-contracts table-filter" id="created_by">
                      <input id="created_by" class="searchFor" type="text">
                      <a id="created_by" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                         {foreach $formFilter->in.created_by_id->getOption('choices') as $creator}
                                 {if $creator@first}
                                     <div class="filter-layout">
                                 {/if}
                                 <div>
                                     <div class="filter-content-input">
                                         <input type="checkbox" class="CustomerContracts-in created_by" name="created_by_id" id="{$creator->get('id')}" {if in_array($creator->get('id'),(array)$formFilter.in.created_by_id->getValue())}checked="checked"{/if}/>
                                         <label for="{$creator->get('id')}">{if $creator->isLoaded()}{$creator}{else}{__('Empty')}{/if}</label>
                                     </div>
                                     <div class="filter-content-txt">
                                         
                                     </div>                
                                 </div>
                                 {if $creator@last}
                                             </div>
                                 {/if}      
                         {/foreach}  
                           <input type="checkbox" class="CustomerContracts-in-select" name="created_by"/>{__('Select/unselect all')}
                       </div>
                      </div>    


                </td>
            {/if}
        {/if}
        {if $formFilter->hasColumn('slave_id')}  
                <td>
                    {*slave*}
                </td>
        {/if}
        {if $formFilter->hasColumn('company_id')}
            <td class="CustomerContracts company_id">{* company_id *}
           {if $formFilter->in->hasValidator('company_id')}
            {* ===================== Company ======================== *}
             <div class="filter" id="company_id">    
                 <span class="filter-btn name-filter btn-table btn-sm p-0" id="company_id">{__('Company')}<i id="company_id" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
                 <div class="filter-content filter-content-contracts table-filter" id="company_id">
                <input id="company_id" class="searchFor" type="text">
                <a id="company_id" href="" onclick="return false;" class="search-clear fa fa-times-circle fa-lg "></a>
                     {foreach $formFilter->in.company_id->getChoices() as $name=>$company}
                         <div>          
                              {if $name}
                                  <div class="filter-content-input">
                                      <input type="checkbox" class="CustomerContracts-in company" name="company_id" id="{$company->get('id')}" {if in_array($company->get('id'),(array)$formFilter.in.company_id->getValue())}checked="checked"{/if}/>
                                      <label for="{$company->get('id')}">{$company->get('name')}</label>
                                  </div>
                                  <div class="filter-content-txt">
                                      
                                  </div>                    
                              {else}
                                  <div class="filter-content-input">
                                      <input type="checkbox" class="CustomerContracts-in company" name="company_id" id="" {if in_array($company,(array)$formFilter.in.company_id->getValue())}checked="checked"{/if}/>
                                     <label for="">{__('Empty')}</label>
                                  </div>
                                  <div class="filter-content-txt">
                                      
                                  </div>                
                              {/if}
                         </div>  
                     {/foreach}  
                 <input type="checkbox" class="CustomerContracts-in-select" name="company"/>{__('Select/unselect all')}
                 </div>
             </div>
            {/if}  
            </td>
       {/if}
       {if $user->hasCredential([['superadmin','admin','contract_list_status']]) && $formFilter->equal->hasValidator('status')}
            {if $formFilter->hasColumn('status')}
            <td class="CustomerContracts cols status">
               </td>
            {/if}
       {/if}
       {if $formFilter->hasColumn('actions')}
       <td class="CustomerContracts cols actions">
           
           {* actions *}
           
       </td>
       {/if}
       {if $formFilter->hasColumn('is_billable')}
        <td class="CustomerContracts is_billable">{* is_billiable *}
            {if $formFilter->equal->hasValidator('is_billable')}
                 {/if}
        </td>
       {/if}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_101','app_domoprime_contract_list_surface_from_forms_101','app_domoprime_iso_contract_list_surface_from_form_101']])}
            {if $formFilter->hasColumn('surface_top')}
                <td class="CustomerContracts surface_top">

                </td>
            {/if}
        {/if}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_102','app_domoprime_contract_list_surface_from_forms_102','app_domoprime_iso_contract_list_surface_from_form_102']])}
            {if $formFilter->hasColumn('surface_wall')}
            <td class="CustomerContracts cols surface_wall">
           
            </td>
            {/if}
        {/if}
        {if $user->hasCredential([['superadmin_debug','app_domoprime_iso_contract_list_surface_103','app_domoprime_contract_list_surface_from_forms_103','app_domoprime_iso_contract_list_surface_from_form_103']])}  
            {if $formFilter->hasColumn('surface_floor')}
            <td class="CustomerContracts cols surface_floor">
         
            </td>
            {/if}
        {/if}
         {if $formFilter->hasColumn('amount')}
        <td></td>
        {/if}
    </tr>
    <tr class="input-list">
        <td>{* # *}</td>
        <td>&nbsp;</td>  
       {if $user->hasCredential([['superadmin','admin','contract_view_list_id']])}  
           {if $formFilter->hasColumn('id')}
            <td class="CustomerContracts cols id">
                 <input type="text" class="CustomerContracts-search form-control" name="id" value="{$formFilter.search.id}"/>
            </td>  
            {/if}    
       {/if}    
        <td></td>
       {if $formFilter->hasColumn('date')}
       <td class="CustomerContracts cols date">{* date *}          
       {if $formFilter->equal->hasValidator('opc_range_id')}
           <div style="display: inline;"> {__('Range')}:
           {if count($formFilter->equal.opc_range_id->getOption('choices')) > 1}
           {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="opc_range_id" options=$formFilter->equal.opc_range_id->getOption('choices') selected=(string)$formFilter.equal.opc_range_id}
           {else}
                {__('---')}
           {/if}
           </div>
       {/if}
      
       {if $formFilter->equal->hasValidator('sav_at_range_id')}
           <a href="javascript:void(0);" style="font-size: 15px;" class="ToggleTopPagerContract">+</a>
           <div style="display: none;margin-right: 12px;" class="TopPagerContractPlus">{__('Range')}:
           {if count($formFilter->equal.sav_at_range_id->getOption('choices')) > 1}
           {html_options class=" widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="sav_at_range_id" options=$formFilter->equal.sav_at_range_id->getOption('choices') selected=(string)$formFilter.equal.sav_at_range_id}
           {else}
                {__('---')}
           {/if}
           </div>
       {/if}
       </td>
       {/if}
       {if $formFilter->hasColumn('customer')}
       <td class="CustomerContracts customer">{* customer *}
       {if $formFilter->equal->hasValidator('domoprime_status')}
           <div>{__('Cumac')}   </div>        
           {if count($formFilter->equal.domoprime_status->getOption('choices')) > 1}
                {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="domoprime_status" options=$formFilter->equal.domoprime_status->getOption('choices') selected=(string)$formFilter.equal.domoprime_status}
           {else}
                {__('---')}
           {/if}
            <a href="javascript:void(0);" style="font-size: 15px;" class="ToggleCustomerCumacPagerContract">+</a>
             
       {/if}    
       </td>
       {/if}  
       
      
      
        
       
      {*  <td>
      {*      {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal" name="product_id" options=$formFilter->equal.product_id->getOption('choices') selected=(string)$formFilter.equal.product_id}
       </td> *}
       {* amount *}
      
      {if $formFilter->hasColumn('phone')}
       <td class="CustomerContracts cols phone">{* phone *}
           
       </td>
       {/if}
       {if $formFilter->hasColumn('postcode')}
       <td class="CustomerContracts cols postcode">{* postcode *}  
        {if $formFilter->equal->hasValidator('zone_id')}              
            {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="zone_id" options=$formFilter->equal.zone_id->getChoices()->toArray() selected=(string)$formFilter.equal.zone_id}          
       {/if}
       </td>
       {/if}
       {if $formFilter->hasColumn('city')}
       <td class="CustomerContracts cols city">{* city *}
       </td>
       {/if}
        {if $formFilter->hasColumn('class_id')} 
     {if $formFilter->equal->hasValidator('class_id') && $user->hasCredential([['superadmin_debugxx','app_domoprime_iso_contract_list_filter_header_class','contract_list_calculation_class_pager','app_domoprime_iso_contract_list_filter_class','app_domoprime_iso_contract_list_filter_class_energy_sector']])}
              <td>
            {__('Class')}
            {html_options class="widthSelectWithSearch widthSelect CustomerContracts-equal form-control"  name="class_id" options=$formFilter->equal.class_id->getOption('choices') selected=(string)$formFilter.equal.class_id}                                    
            </td>  
        {/if}  
        {/if}
       
       {if $formFilter->equal->hasValidator('team_id') && $user->hasCredential([['superadmin','admin','contract_view_list_team']])}
            {if $formFilter->hasColumn('team')}
               <td class="CustomerContracts cols team"> {* team *}
               {if count($formFilter->equal.team_id->getOption('choices')) > 1}
               {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="team_id" options=$formFilter->equal.team_id->getOption('choices') selected=(string)$formFilter.equal.team_id}
               {else}
                    {__('---')}
               {/if}
                </td>
            {/if}
         {elseif $user->hasCredential([['contract_list_display_team']])}
            {if $formFilter->hasColumn('team')}
                <td class="CustomerContracts cols team"></td>
            {/if}
       {/if}
        {if $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
            {if $formFilter->hasColumn('sale1')}
           <td class="CustomerContracts cols sale1">{* commercial1 *}
                {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="sale_1_id" options=$formFilter->equal.sale_1_id->getOption('choices') selected=(string)$formFilter.equal.sale_1_id}
           </td>
           {/if}
        {/if}
        {if $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
            {if $formFilter->hasColumn('sale2')}
            <td class="CustomerContracts cols sale2">{* commercial2 *}
                {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="sale_2_id" options=$formFilter->equal.sale_2_id->getOption('choices') selected=(string)$formFilter.equal.sale_2_id}
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('telepro_id')}
           {if $formFilter->hasColumn('telepro_id')}
            <td class="CustomerContracts cols telepro_id">{* telepro *}
                <div>
                    {if count($formFilter->equal.telepro_id->getOption('choices')) > 1}
                        {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="telepro_id" options=$formFilter->equal.telepro_id->getOption('choices') selected=(string)$formFilter.equal.telepro_id}
                    {else}
                        {__('---')}
                    {/if}
                </div>
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('assistant_id') && $user->hasCredential([['superadmin','admin','contract_view_list_assistant']])}  
         {if $formFilter->hasColumn('assistant_id')}
            <td class="CustomerContracts cols assistant_id">
                <div>
                    {if count($formFilter->equal.assistant_id->getOption('choices')) >1}
                       {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="assistant_id" options=$formFilter->equal.assistant_id->getOption('choices') selected=(string)$formFilter.equal.assistant_id}
                   {else}
                      {__('---')}
                   {/if}
                </div>
            </td>  
        {elseif $user->hasCredential([['contract_list_display_assistant']])}
             {if $formFilter->hasColumn('assistant')}
                 <td class="CustomerContracts cols assistant"></td>
             {/if}  
        {/if}  
        {/if}
         {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
            {if $formFilter->hasColumn('polluter')}
            <td class="CustomerContracts cols polluter">{* polluter *}      
            {if count($formFilter->equal.polluter_id->getOption('choices')) >1}
                {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect form-control " name="polluter_id" options=$formFilter->equal.polluter_id->getOption('choices') selected=(string)$formFilter.equal.polluter_id}
            {else}
               {__('---')}
            {/if}  
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('financial_partner_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner']])}
            {if $formFilter->hasColumn('financial_partner_id')}
            <td class="CustomerContracts cols financial_partner_id">{* financial_partner_id *}      
            {if count($formFilter->equal.financial_partner_id->getOption('choices')) >1}
                {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="financial_partner_id" options=$formFilter->equal.financial_partner_id->getOption('choices') selected=(string)$formFilter.equal.financial_partner_id}
            {else}
               {__('---')}
           {/if}  
             </td>
            {/if}
        {/if}
         {if $formFilter->equal->hasValidator('partner_layer_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner_layer']])}
            {if $formFilter->hasColumn('partner_layer_id')}            
               <td class="CustomerContracts cols  partner_layer_id">{* partner *}  
                   <div>
                        {if count($formFilter->equal.partner_layer_id->getOption('choices')) >1}
                            {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="partner_layer_id" options=$formFilter->equal.partner_layer_id->getOption('choices') selected=(string)$formFilter.equal.partner_layer_id}
                        {else}
                           {__('---')}
                       {/if}
                    </div>
               </td>
           {/if}
        {/if}
          {if $formFilter->hasColumn('state')}
        <td class="CustomerContracts cols state">{* status *}
            {html_options class="widthSelect widthSelectWithSearch  CustomerContracts-equal form-control" name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
        </td>
        {/if}
        {if $formFilter->equal->hasValidator('time_state_id') && $user->hasCredential([['superadmin','contract_view_list_time_state']])}
            {if $formFilter->hasColumn('time_state_id')}
            <td class="CustomerContracts cols time_state_id">    
            {if count($formFilter->equal.time_state_id->getOption('choices')) >1}
                {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect form-control " name="time_state_id" options=$formFilter->equal.time_state_id->getOption('choices') selected=(string)$formFilter.equal.time_state_id}
            {else}
               {__('---')}
           {/if}  
            </td>
            {/if}
        {/if}   
        {if $user->hasCredential([['superadmin','contract_list_install_state']]) && $formFilter->equal->hasValidator('install_state_id')} 
        {if $formFilter->hasColumn('install_state')}
              <td class="CustomerContracts cols install_state_id">
                {if count($formFilter->equal.install_state_id->getOption('choices')) > 1}
                    {html_options class=" CustomerContracts-equal widthSelectWithSearch widthSelect form-control" name="install_state_id" options=$formFilter->equal.install_state_id->getChoices() selected=(string)$formFilter.equal.install_state_id}  
                
                {else}
                    {__('---')}
                {/if}
              </td>
        {/if}  
        {/if}  
         {if $formFilter->equal->hasValidator('admin_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_admin_status']])}
            {if $formFilter->hasColumn('admin_status_id')}
                <td class="CustomerContracts cols admin_status_id">{* partner *}      
                    {if count($formFilter->equal.admin_status_id->getOption('choices')) >1}
                        {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="admin_status_id" options=$formFilter->equal.admin_status_id->getOption('choices') selected=(string)$formFilter.equal.admin_status_id}
                    {else}
                       {__('---')}
                   {/if}  
                </td>
            {/if}
        {/if} 
        {if $formFilter->equal->hasValidator('opc_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_opc_status']])}
            {if $formFilter->hasColumn('opc_status_id')}
            <td class="CustomerContracts cols opc_status_id">{* partner *}      
            {if count($formFilter->equal.opc_status_id->getOption('choices')) >1}
                {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="opc_status_id" options=$formFilter->equal.opc_status_id->getOption('choices') selected=(string)$formFilter.equal.opc_status_id}
            {else}
               {__('---')}
           {/if}    
            </td>
            {/if}
        {/if}
         {if $formFilter->hasColumn('work_state_id')}
        <td class="CustomerContracts cols work_state_id">
            {html_options class="widthSelect widthSelectWithSearch  CustomerContracts-equal form-control" name="work_state_id" options=$formFilter->equal.work_state_id->getOption('choices') selected=(string)$formFilter.equal.work_state_id}
        </td>
        {/if}
        
         {if $formFilter->hasColumn('work_company_id')}
            <td class="CustomerContracts cols work_company_id">{* work_company_id *}
            {if $formFilter->equal->hasValidator('work_company_id')}
                {if count($formFilter->equal.work_company_id->getOption('choices')) > 1}
                     {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="work_company_id" options=$formFilter->equal.work_company_id->getOption('choices') selected=(string)$formFilter.equal.company_id}
                {else}
                     {__('---')}
                {/if}
            {/if}    
            </td>
       {/if}
        {if $formFilter->equal->hasValidator('work_partner_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner']])}
            {if $formFilter->hasColumn('work_partner_id')}
            <td class="CustomerContracts cols work_partner_id">{* work_partner_id *}      
                {if count($formFilter->equal.work_partner_id->getOption('choices')) >1}
                    {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="work_partner_id" options=$formFilter->equal.work_partner_id->getOption('choices') selected=(string)$formFilter.equal.work_partner_id}
                {else}
                   {__('---')}
               {/if}  
            </td>
            {/if}
        {/if}
         {if $formFilter->equal->hasValidator('work_polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
            {if $formFilter->hasColumn('work_polluter_id')}
            <td class="CustomerContracts cols work_polluter_id">{* partner *}      
            {if count($formFilter->equal.work_polluter_id->getOption('choices')) >1}
                {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect form-control " name="work_polluter_id" options=$formFilter->equal.work_polluter_id->getOption('choices') selected=(string)$formFilter.equal.work_polluter_id}
            {else}
               {__('---')}
            {/if}  
            </td>
            {/if}
        {/if}
        
        {if $formFilter->equal->hasValidator('work_partner_layer_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner_layer']])}
            {if $formFilter->hasColumn('work_partner_layer_id')}
               <td class="CustomerContracts cols  work_partner_layer_id">{* work_partner_layer_id *}      
                    {if count($formFilter->equal.work_partner_layer_id->getOption('choices')) >1}
                        {html_options class="CustomerContracts-equal widthSelectWithSearch widthSelect  form-control" name="work_partner_layer_id" options=$formFilter->equal.work_partner_layer_id->getOption('choices') selected=(string)$formFilter.equal.work_partner_layer_id}
                    {else}
                       {__('---')}
                    {/if}  
               </td>
           {/if}
        {/if}
        {if $formFilter->hasColumn('work_all_quantities')}
            <td class="CustomerContracts cols work_all_quantities">{* work_all_quantities *}
            </td>
        {/if}
        {if $formFilter->hasColumn('engine_id')}
            <td class="CustomerContracts cols engine_id">{* engine_id *}
            {if $formFilter->equal->hasValidator('engine_id')}
                {if count($formFilter->equal.engine_id->getOption('choices')) > 1}
                     {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="engine_id" options=$formFilter->equal.engine_id->getOption('choices')->toArray() selected=(string)$formFilter.equal.engine_id}
                {else}
                     {__('---')}
                {/if}
            {/if}    
            </td>
        {/if}
       {if $formFilter->hasColumn('pricing_id')}
       <td class="CustomerContracts cols pricing">{* pricing_id *}
       </td>
       {/if}
       
        {if $formFilter->hasColumn('work_surface_ite')}
            <td class="CustomerContracts cols work_surface_ite">{* work_surface_ite *}
           {if $formFilter->search->hasValidator('work_surface_ite')}
                 <input type="text" class="CustomerContracts-search form-control" name="work_surface_ite" value="{(string)$formFilter.search.work_surface_ite}"/>
            {/if}    
            </td>
       {/if}
        {if $formFilter->hasColumn('work_pack_quantity')}
            <td class="CustomerContracts cols work_pack_quantity">{* work_pack_quantity *}
            {if $formFilter->search->hasValidator('work_pack_quantity')}
                 <input type="text" class="CustomerContracts-search form-control" name="work_pack_quantity" value="{(string)$formFilter.search.work_pack_quantity}"/>
            {/if}    
            </td>
       {/if}
        {if $formFilter->hasColumn('work_boiler_quantity')}
            <td class="CustomerContracts cols work_boiler_quantity">{* work_boiler_quantity *}
            {if $formFilter->search->hasValidator('work_boiler_quantity')}
                 <input type="text" class="CustomerContracts-search form-control" name="work_boiler_quantity" value="{(string)$formFilter.search.work_boiler_quantity}"/>
            {/if}    
            </td>
       {/if}
       
        {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_list_surface_parcel']])}
            {if $formFilter->hasColumn('surface_parcel_check')}
            <td class="CustomerContracts cols surface_parcel_check">
           
            </td>
            {/if}
        {/if}
        
        
       
       
        
        
        
         
        
       
        {*if $user->hasCredential([['superadmin','contract_list_advance_payment']])}  
            <td>
            <input type="text" class="CustomerContracts-search" name="advance_payment"   size="5" value="{$formFilter.search.advance_payment}"/>
            </td>  
            {/if*}
        {if $formFilter->equal->hasValidator('is_confirmed') && $user->hasCredential([['superadmin','contract_view_list_confirmed']])}
           {if $formFilter->hasColumn('is_confirmed')}
            <td class="CustomerContracts cols is_confirmed">
                 {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="is_confirmed" options=$formFilter->equal.is_confirmed->getOption('choices') selected=(string)$formFilter.equal.is_confirmed}
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_hold') && $user->hasCredential([['superadmin','admin','contract_view_list_hold']])}
         {if $formFilter->hasColumn('is_hold')}
            <td class="CustomerContracts cols is_hold">{* partner *}      
              {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="is_hold" options=$formFilter->equal.is_hold->getOption('choices') selected=(string)$formFilter.equal.is_hold}
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_hold_quote') && $user->hasCredential([['superadmin','contract_view_list_hold_quote']])}
           {if $formFilter->hasColumn('is_hold_quote')}
                <td class="CustomerContracts cols is_hold_quote">{* partner *}      
                  {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="is_hold_quote" options=$formFilter->equal.is_hold_quote->getOption('choices') selected=(string)$formFilter.equal.is_hold_quote}
                </td>
            {/if}  
        {/if}  
        {if $formFilter->equal->hasValidator('is_document')}
            {if $formFilter->hasColumn('is_document')}
                <td class="CustomerContracts cols is_document">  
                    <div>
                        <span>{$pager->getNumberOfActiveIsDocument()}</span>-
                        <span>{$pager->getNumberOfNoActiveIsDocument()}</span>/
                        <span>{$pager->getResults()}</span>
                    </div>
                    {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="is_document" options=$formFilter->equal.is_document->getOption('choices') selected=(string)$formFilter.equal.is_document}  
               </td>
            {/if}
        {/if}
         {if $formFilter->equal->hasValidator('is_photo')}
            {if $formFilter->hasColumn('is_photo')}
            <td class="CustomerContracts cols is_photo">
                <div>
                    <span>{$pager->getNumberOfActiveIsPhoto()}</span>-
                    <span>{$pager->getNumberOfNoActiveIsPhoto()}</span>/
                    <span>{$pager->getResults()}</span>
                </div>                
               {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="is_photo" options=$formFilter->equal.is_photo->getOption('choices') selected=(string)$formFilter.equal.is_photo}  
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('is_quality')}
            {if $formFilter->hasColumn('is_quality')}
            <td class="CustomerContracts cols is_quality">
                <div>
                    <span>{$pager->getNumberOfActiveIsQuality()}</span>-
                    <span>{$pager->getNumberOfNoActiveIsQuality()}</span>/
                    <span>{$pager->getResults()}</span>
                </div>                
                {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="is_quality" options=$formFilter->equal.is_quality->getOption('choices') selected=(string)$formFilter.equal.is_quality}  
           </td>
            {/if}
        {/if}
       
       {if $formFilter->equal->hasValidator('created_by_id')}  
            {if $formFilter->hasColumn('creator')}
            <td class="CustomerContracts cols creator">
                <div>
                 {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="created_by_id" options=$formFilter->equal.created_by_id->getOption('choices') selected=(string)$formFilter.equal.created_by_id}        
                </div>
            </td>
            {/if}
        {/if}
        {component name="/customers_contracts_master/TopContractPager"}        
      
       
        {if $formFilter->hasColumn('company_id')}
            <td class="CustomerContracts company_id">{* company_id *}
            {if $formFilter->equal->hasValidator('company_id')}
                {if count($formFilter->equal.company_id->getOption('choices')) > 1}
                     {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="company_id" options=$formFilter->equal.company_id->getOption('choices') selected=(string)$formFilter.equal.company_id}
                {else}
                     {__('---')}
                {/if}
            {/if}    
            </td>
       {/if}
       {if $user->hasCredential([['superadmin','admin','contract_list_status']]) && $formFilter->equal->hasValidator('status')}
            {if $formFilter->hasColumn('status')}
            <td class="CustomerContracts cols status">
            {html_options_format format="__" class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control" name="status" options=$formFilter->equal.status->getOption('choices') selected=(string)$formFilter.equal.status}
            </td>
            {/if}
       {/if}
       {if $formFilter->hasColumn('actions')}
       <td class="CustomerContracts cols actions">
           
           {* actions *}
           
       </td>
       {/if}
       {if $formFilter->hasColumn('is_billable')}
        <td class="CustomerContracts is_billable">{* is_billiable *}
            {if $formFilter->equal->hasValidator('is_billable')}
                  {html_options class="widthSelectWithSearch widthSelect  CustomerContracts-equal form-control"  name="is_billable" options=$formFilter->equal.is_billable->getOption('choices') selected=(string)$formFilter.equal.is_billable}
            {/if}
        </td>
       {/if}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_101','app_domoprime_contract_list_surface_from_forms_101','app_domoprime_iso_contract_list_surface_from_form_101']])}
            {if $formFilter->hasColumn('surface_top')}
                <td class="CustomerContracts surface_top">

                </td>
            {/if}
        {/if}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_102','app_domoprime_contract_list_surface_from_forms_102','app_domoprime_iso_contract_list_surface_from_form_102']])}
            {if $formFilter->hasColumn('surface_wall')}
            <td class="CustomerContracts cols surface_wall">
           
            </td>
            {/if}
        {/if}
        {if $user->hasCredential([['superadmin_debug','app_domoprime_iso_contract_list_surface_103','app_domoprime_contract_list_surface_from_forms_103','app_domoprime_iso_contract_list_surface_from_form_103']])}  
            {if $formFilter->hasColumn('surface_floor')}
            <td class="CustomerContracts cols surface_floor">
         
            </td>
            {/if}
        {/if}
         {if $formFilter->hasColumn('amount')}
        <td></td>
        {/if}
    </tr>
   
    </thead>
    <tbody>
   
 
    {foreach $pager as $item}
        {if !$item->getWorks()->isEmpty()}            
            {foreach $item->getWorks() as $work}      
                <tr class="{if !$work@first}CustomerContractsWithWork{/if} CustomerContracts {if $item->isConfirmed() && $user->hasCredential([['contract_list_confirmed_color']])}ConfirmedContract{else}list{/if} {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}DblClick{/if}" id="CustomerContracts-{$item->get('id')}" data-id="{$item->get('id')}" {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}name="{$item->getCustomer()|upper}"{/if} title="{include file="./includes/comments.tpl" comments=$item->comments}" 
                    style="{if $item@iteration % 2==0}background:#fff;{else}background:#f5f5f5;{/if} {if !$work@first}display:none;{/if} {*if $work@last}border-bottom:2px solid #ddd;{/if*}" data-iteration="{$item@iteration}">
                    <td class="CustomerContracts-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>            
                   <td>                            
                       <input class="CustomerContracts-selection" type="checkbox" id="{$item->get('id')}" {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}name="{$item->getCustomer()}"{/if}/>                      
                   </td>          
                   {if $user->hasCredential([['superadmin','admin','contract_view_list_id']])}
                       {if $formFilter->hasColumn('id')}
                           <td class="CustomerContracts cols id">
                            {format_number($item->get('id'),$settings_contracts->get('format_id','0000'))}
                             {component name="/partners_localization/btnForContractPager" item=$item}
                           </td>  
                       {/if}  
                  {/if}  
                    <td>
                       {if !$item->getWorks()->isEmpty()}


                                {format_number_choice("[0]0 work|[1]1 work|(1,Inf]%s works",$item->getWorks()->count(),$item->getWorks()->count())}
           
                           {else}
                               {__('---')}
                           {/if}    
                       </td>
                       {if $formFilter->hasColumn('date')}
                    <td class="CustomerContracts cols date">{* date *}                              
                          <div>              
                          <img class="CustomerContracts-Hold-Field-img"  {if !$item->isHold()}style="display:none"{/if} id="{$item->get('id')}" height="16px" src="{url('/icons/hold32x32.png','picture')}" alt='{__("Hold")}'/></a>                                                                    
                          <img class="CustomerContracts-Hold-Admin-Field-img"  {if !$item->isHoldAdmin()}style="display:none"{/if} id="{$item->get('id')}" height="16px" src="{url('/icons/holdred32x32.png','picture')}" alt='{__("Hold")}'/></a>                                                                    
                           
                          </div>              
                           
                          {if $user->hasCredential([['superadmin','contract_list_view_sav_at']])}
                               <div>   <i>{*__('date_acceptance')*}{if $item->hasSavAt()}{$work->getFormatter()->getSavAt()->getText()}{else}{__('---')}{/if}</i>  </div>      
                          {/if}
                     </td>
                     
                       {/if}
                    {if $formFilter->hasColumn('customer')}
                <td class="CustomerContracts cols customer">{* customer *}

                      {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_lastname']])}
                          {if $user->hasCredential([['superadmin','contract_list_company']])}
                              <div style="display: inline-block;">{$item->getCustomer()->get('company')}</div>
                              <div style="display: inline-block;">{$item->getCustomer()->getLastname()|upper} {$item->getCustomer()->getFirstname()|upper}</div>
                          {else}
                              {$item->getCustomer()->getLastname()|upper} {$item->getCustomer()->getFirstname()|upper}
                          {/if}  
                      {else}
                          {__('---')}
                      {/if}
                        <div class="CalculationForPager">
                      {component name="/app_domoprime/calculationForPager" item=$item}
                        </div>
                      {if $work@first}
                      <a href="javascript:void(0);" style="font-size: 15px;" class="ToggleCustomerPagerContract" data-id="{$item->get('id')}">+</a>
                      <div id="CustomerPagerContractPlus-{$item->get('id')}" style="display: none;">
                          {component name="/app_domoprime_yousign/QuotationSignatureForContractPager"  item=$item}                
                          {component name="/app_domoprime_yousign/DocumentSignatureForContractPager"  item=$item}
                          {component name="/customers_contracts_documents_check/checkerForContractPager" item=$item}
                      </div>
                      {/if}
                </td>
                {/if}
      
          {* amount *}
           
          {if $formFilter->hasColumn('phone')}
           <td class="CustomerContracts cols phone">{* phone *}
                {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_phone']])}                
                 <div>
                     <a href="tel:{$item->getCustomer()->get('phone')}">
                       
                         {$item->getCustomer()->get('phone')}
                     </a>
                 </div>
                  {else}
                    {__('---')}
                {/if}
                {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_mobile']])}
                 <div>
                   
                     {$item->getCustomer()->get('mobile')}
                 </div>
                 {else}
                    {__('---')}
                {/if}
            </td>
            {/if}
            {if $formFilter->hasColumn('postcode')}
                <td class="CustomerContracts cols postcode">{* postcode *}
                     {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_postcode']])}
                     {$item->getCustomer()->getAddress()->get('postcode')|upper}  
                         {else}
                        {__('---')}
                    {/if}
                </td>  
            {/if}
            
            {if $formFilter->hasColumn('city')}
            <td class="CustomerContracts cols city">{* city *}
                  {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_city']])}
                 {$item->getCustomer()->getAddress()->get('city')|escape|upper}  
                  {else}
                    {__('---')}
                {/if}
            </td>  
            {/if}
             {if $formFilter->hasColumn('class_id')}
      {if $formFilter->equal->hasValidator('class_id') && $user->hasCredential([['superadmin_debugxx','app_domoprime_iso_contract_list_filter_header_class','contract_list_calculation_class_pager','app_domoprime_iso_contract_list_filter_class','app_domoprime_iso_contract_list_filter_class_energy_sector']])}
          <td>
          {if $item->hasCalculation()}              
              {if $item->getCalculation()->hasClass()}
                  {if $item->getCalculation()->getClass()->hasI18n()}
                      {$item->getCalculation()->getClass()->getI18n()}
                  {else}
                      {__('---')}
                  {/if}
              {/if}
          {else}
              {__('---')}
          {/if}
       </td>  
       {/if}
       {/if}
             {if $user->hasCredential([['contract_list_display_team']]) || ($formFilter->in->hasValidator('team_id') && $user->hasCredential([['superadmin','admin','contract_view_list_team']]))}
            {if $formFilter->hasColumn('team')}
            <td class="CustomerContracts cols team">
               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_team']])}
                   {if $item->hasTeam()}
                      {$item->getTeam()->get('name')|upper}
                  {/if}
                 {else}
                   {__('---')}
               {/if}
           </td>
           {/if}                          
        {/if}     
            {if $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
            {if $formFilter->hasColumn('sale1')}
            <td class="CustomerContracts cols sale1">{* commercial1 *}
                {if $item->isAuthorized() || $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
                    {if $item->hasSale1()}
                     {$item->getSale1()->getName(false)|upper}
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
                 {else}
                    {__('---')}
                {/if}
            </td>
            {/if}
            {/if}
            {if $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
                {if $formFilter->hasColumn('sale2')}
                <td class="CustomerContracts cols sale2">{* commercial2 *}
                    {if $item->isAuthorized() || $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
                            {if $item->hasSale2()}
                            {$item->getSale2()->getName(false)|upper}
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
                      {else}
                        {__('---')}
                    {/if}
                </td>
                {/if}
            {/if}
             {if $formFilter->equal->hasValidator('telepro_id')}
                 {if $formFilter->hasColumn('telepro_id')}
                    <td class="CustomerContracts cols telepro_id">
                        {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_telepro']])}
                               {if $item->hasTelepro()}
                                   {$item->getTelepro()->getName(false)|upper}
                              {/if}
                         {else}
                           {__('---')}
                       {/if}
                   </td>
                   {/if}
            {/if}
                  {* assistant *}
                 
                 
            {if $user->hasCredential([['contract_list_display_assistant']]) || ($formFilter->equal->hasValidator('assistant_id') && $user->hasCredential([['superadmin','admin','contract_view_list_assistant']]))}  
                {if $formFilter->hasColumn('assistant_id')}
                    <td class="CustomerContracts cols assistant_id">
                     {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_assistant']])}
                        {if $item->hasAssistant()}
                            {$item->getAssistant()|upper}
                        {else}                    
                        {/if}    
                     {else}
                        {__('---')}
                    {/if}
                </td>  
                {/if}  
            {/if} 
            {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
                {if $formFilter->hasColumn('polluter')}
                <td class="CustomerContracts cols polluter">{* partner *}  
                    <div>{if $item->hasPolluter()}{$item->getPolluter()->get('name')|upper}{else}{__('---')}{/if}</div>
                </td>
                {/if}
           {/if}
             {if $formFilter->equal->hasValidator('financial_partner_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner']])}
               {if $formFilter->hasColumn('financial_partner_id')}
                <td class="CustomerContracts cols financial_partner_id">{* partner *}      
                  {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_partner']])}
                 <div>{if $item->hasPartner()}{$item->getPartner()->get('name')|upper}{else}{__('---')}{/if}</div>  
                 {component name="/products_installer_schedule/SendMailToInstallerButton" contract=$item}  
                 {component name="/partners_communication_emails/SendMailToPartnerButton" contract=$item}  
                 {component name="/partners_communication_whats_app/partnerForContractPager" contract=$item}  
                  {else}
                        {__('---')}
                    {/if}
                </td>
            {/if}
            {/if}
          {if $settings_contracts->hasLayer() && $user->hasCredential([['superadmin','admin','contract_view_list_partner_layer']])}
            {if $formFilter->hasColumn('partner_layer_id')}
                <td class="CustomerContracts cols partner_layer_id">{* partner *}      
                {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_partner_layer']])}
                <div>{if $item->hasPartnerLayer()}{$item->getPartnerLayer()->get('name')|upper}{else}{__('---')}{/if}</div>            
                 {else}
                       {__('---')}
                   {/if}
           </td>
           {/if}
        {/if}
         {if $formFilter->hasColumn('state')}
                <td class="CustomerContracts cols State state" id="{$item->get('id')}">{* status *}  
                  {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_state']])}
                   {if $item->hasStatus()}
                       {if $item->getStatus()->get('icon')}
                          <img src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                       {elseif $item->getStatus()->get('color')}
                       <div class="CustomerContracts State color" id="{$item->get('id')}" style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                       {/if}&nbsp;              
                       <span class="CustomerContracts State Text" id="{$item->get('id')}">{$item->getStatus()->getCustomerContractStatusI18n()->get('value')}</span>
                   {else}
                       {__('---')}
                   {/if}
                     {else}
                       {__('---')}
                   {/if}
               </td>
            {/if}
            {if $formFilter->equal->hasValidator('time_state_id') && $user->hasCredential([['superadmin','contract_view_list_time_state']])}
            {if $formFilter->hasColumn('time_state_id')}
                <td class="CustomerContracts cols time_state_id">{* partner *}      
                {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_time_state']])}                
                   {if $item->hasTimeStatus()}      
                        {if $item->getTimeStatus()->get('icon')}
                          <img src="{$item->getTimeStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                       {elseif $item->getTimeStatus()->get('color')}
                       <div class="CustomerContracts TimeStatus color" id="{$item->get('id')}" style="background:{$item->getTimeStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                       {/if}&nbsp;              
                       <span class="CustomerContracts TimeStatus Text" id="{$item->get('id')}">{$item->getTimeStatus()->getI18n()->get('value')}</span>  
                   {else}
                       {__('---')}
                   {/if}
               {else}
                 {__('---')}
             {/if}
           </td>
           {/if}
        {/if}
       {if $user->hasCredential([['superadmin','contract_list_install_state']]) && $formFilter->equal->hasValidator('install_state_id')}
        {if $formFilter->hasColumn('install_state')}
            <td class="CustomerContracts cols install_state">{* partner *}      

            {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_install_state']])}
           {if $item->hasInstallStatus()}
               {if $item->getInstallStatus()->get('icon')}
                  <img src="{$item->getInstallStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
               {elseif $item->getInstallStatus()->get('color')}
               <div class="color" style="background:{$item->getInstallStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
               {/if}&nbsp;  

               {$item->getInstallStatus()->getI18n()->get('value')}

           {else}
               {__('---')}
           {/if}
             {else}
                 pppp
               {__('---')}
           {/if}    
                     
                      
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('admin_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_admin_status']])}
            {if $formFilter->hasColumn('admin_status_id')}
                <td class="CustomerContracts cols admin_status_id">{* partner *}      
                 {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_admin_status']])}                
                    {if $item->hasAdminStatus()}
                        {if $item->getAdminStatus()->get('icon')}
                           <img src="{$item->getAdminStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                        {elseif $item->getAdminStatus()->get('color')}
                        <div style="background:{$item->getAdminStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                        {/if}&nbsp;              
                        <span>{$item->getAdminStatus()->getI18n()->get('value')}</span>
                    {else}
                        {__('---')}
                    {/if}
                      {else}
                        {__('---')}
                    {/if}
            </td>
            {/if}
        {/if}
        {if $formFilter->equal->hasValidator('opc_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_opc_status']])}
            {if $formFilter->hasColumn('opc_status_id')}
                <td class="CustomerContracts cols opc_status_id">{* partner *}    
                    {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_opc_status']])}  
                        {if $item->hasOpcStatus()}
                            {if $item->getOpcStatus()->get('icon')}
                               <img src="{$item->getOpcStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                            {elseif $item->getOpcStatus()->get('color')}
                            <div class="CustomerContracts" id="{$item->get('id')}" style="background:{$item->getOpcStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                            {/if}&nbsp;              
                            {if $item->getOpcStatus()->hasI18n()}
                            <span class="CustomerContracts" id="{$item->get('id')}">{$item->getOpcStatus()->getI18n()->get('value')}</span>
                            {else}
                                {__('---')}
                            {/if}    
                        {else}
                            {__('---')}
                        {/if}
                          {else}
                            {__('---')}
                    {/if}
            </td>
            {/if}
        {/if}
        {if $formFilter->hasColumn('work_state_id')}
                <td class="CustomerContracts cols State work_state_id" id="{$item->get('id')}">{* work_state_id *}  
                     {$work->getState()}
                </td>
            {/if}
            {if $formFilter->hasColumn('work_company_id')}

          <td class="CustomerContracts cols work_company_id">{* work_company_id *}
              {if $work->hasCompany()}
                {$work->getCompany()->get('name')}
                {else}
                   {__('---')}
              {/if}      
          </td>
        {/if}
        {if $formFilter->equal->hasValidator('work_partner_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner']])}
               {if $formFilter->hasColumn('work_partner_id')}
                    <td class="CustomerContracts cols work_partner_id">{* partner *}      
                     <div>{if $work->hasPartner()}{$work->getPartner()->get('name')|upper}{else}{__('---')}{/if}</div>  
                    </td>
                {/if}
            {/if}
          {if $formFilter->equal->hasValidator('work_polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
            {if $formFilter->hasColumn('work_polluter_id')}
            <td class="CustomerContracts cols work_polluter_id">{* partner *}  
                <div>{if $work->hasPolluter()}{$work->getPolluter()->get('name')|upper}{else}{__('---')}{/if}</div>
            </td>
            {/if}
        {/if}
          
         {if $formFilter->equal->hasValidator('work_partner_layer_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner_layer']])}
            {if $formFilter->hasColumn('work_partner_layer_id')}
                <td class="CustomerContracts cols work_partner_layer_id">{* work_partner_layer_id *}      
                    {$work->getPartnerLayer()}
                </td>
           {/if}
        {/if}
        {if $formFilter->hasColumn('work_all_quantities')}
            <td class="CustomerContracts cols work_all_quantities">{* work_all_quantities *}
                {if $work@first}
                        {foreach $item->getWorks()->copy() as $work_item}
                            <p style="display:inline;" {if !$work_item@first}class=" itemFirstWorkQte"{/if}>{if !$work_item@first},{/if}{$work_item->getSurface()}</p>
                        {/foreach}
                    {else}
                         {$work->getSurface()}
                {/if}              
            </td>
        {/if}
        {if $formFilter->hasColumn('engine_id')}

          <td class="CustomerContracts cols engine_id">{* engine_id *}
              {if $item->hasRequest()}
                {$item->getRequest()->getEngine()->get('name')}
                {else}
                   {__('---')}
              {/if}      
          </td>
        {/if}
        {if $formFilter->hasColumn('pricing_id')}
            <td class="CustomerContracts cols pricing_id">{* city *}
                  {if $item->getRequest()->hasPricing()}
                      {$item->getRequest()->getPricing()}
                        {else}
                        {__('---')}
                  {/if}
            </td>  
            {/if}
        {*if $formFilter->hasColumn('work_surface_ite')}
          <td class="CustomerContracts cols work_surface_ite">{* work_surface_ite *}
            {*    {$work->getSurfaceITE()}
          </td>
        {/if}
        {if $formFilter->hasColumn('work_pack_quantity')}
          <td class="CustomerContracts cols work_pack_quantity">{* work_pack_quantity *}
            {*    {$work->getPackQuantity()}
          </td>
        {/if}
        {if $formFilter->hasColumn('work_boiler_quantity')}
          <td class="CustomerContracts cols work_boiler_quantity">{* work_boiler_quantity *}
            {*    {$work->getBoilerQuantity()}
          </td>
        {/if*}
        
        {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_list_surface_parcel']])}
        {if $formFilter->hasColumn('surface_parcel_check')}
            <td class="CustomerContracts cols surface_parcel_check">
            {if $item->hasRequest()}
            {$item->getRequest()->getFormatter()->getParcelSurface()->getText()}  
             {else}
                 {__('---')}
             {/if}
        </td>
        {/if}
        {/if}
       
           
            
       
        
       
        
        
      
                            
             {*if $user->hasCredential([['superadmin','contract_list_advance_payment']])}  
            <td>
                 {$item->getFormattedAdvance()}
            </td>  
            {/if*}
            {if $formFilter->equal->hasValidator('is_confirmed') && $user->hasCredential([['superadmin','contract_view_list_confirmed']])}
                {if $formFilter->hasColumn('is_confirmed')}
                        <td class="CustomerContracts cols is_confirmed" id="{$item->get('id')}">
                       {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_confirmed']])}
                         {if $item->isConfirmed()}
                                 {__('Confirmed')}                      
                            {else}
                                {__('Not confirmed')}
                            {/if}
                         {else}
                            {__('---')}
                        {/if}
                    </td>
                {/if}
            {/if}
           
             {if $formFilter->equal->hasValidator('is_hold') && $user->hasCredential([['superadmin','admin','contract_view_list_hold']])}
               {if $formFilter->hasColumn('is_hold')}
                 <td class="CustomerContractHold cols CustomerContracts is_hold" id="{$item->get('id')}">
                        {$item->getHoldI18n()}
                  </td>
                {/if}
             {/if}
             {if $formFilter->equal->hasValidator('is_hold_quote') && $user->hasCredential([['superadmin','contract_view_list_hold_quote']])}
                {if $formFilter->hasColumn('is_hold_quote')}
                 <td class="CustomerContractHoldQuote cols CustomerContracts is_hold_quote" id="{$item->get('id')}">
                        {$item->getHoldQuoteI18n()}
                 </td>
                 {/if}
              {/if}
       
         {if $formFilter->equal->hasValidator('is_document')}
             {if $formFilter->hasColumn('is_document')}
                <td class="CustomerContracts cols is_document">    
                   {if $user->hasCredential([['superadmin','contract_list_change_is_document']])}
                   <a href="#" title="{__('Change document')}" class="CustomerContractChangeIsDocument" id="{$item->get('id')}" name="{$item->get('is_document')}"><img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/></a>
                   {else}
                     <img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/>
                   {/if}
               </td>
               {/if}
        {/if}
         {if $formFilter->equal->hasValidator('is_photo')}
             {if $formFilter->hasColumn('is_photo')}
                <td class="CustomerContracts  cols is_photo">  
                     {if $user->hasCredential([['superadmin','contract_list_change_is_photo']])}
                   <a href="#" title="{__('Change photo')}" class="CustomerContractChangeIsPhoto" id="{$item->get('id')}" name="{$item->get('is_photo')}"><img  src="{url('/icons/','picture')}{$item->get('is_photo')}.gif" alt='{__("user_`$item->get("is_photo")`")}'/></a>  
                    {else}
                     <img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/>
                   {/if}
               </td>
               {/if}
        {/if}
         {if $formFilter->equal->hasValidator('is_quality')}
             {if $formFilter->hasColumn('is_quality')}
                <td class="CustomerContracts cols is_quality">    
                     {if $user->hasCredential([['superadmin','contract_list_change_is_quality']])}
                 <a href="#" title="{__('Change quality')}" class="CustomerContractChangeIsQuality" id="{$item->get('id')}" name="{$item->get('is_quality')}"><img  src="{url('/icons/','picture')}{$item->get('is_quality')}.gif" alt='{__("user_`$item->get("is_quality")`")}'/></a>
                  {else}
                     <img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/>
                   {/if}
               </td>
               {/if}
        {/if}
       
        {if $formFilter->equal->hasValidator('created_by_id')}  
            {if $formFilter->hasColumn('creator')}
            <td class="CustomerContracts cols creator">
                 {if $item->hasCreatorUser()}
                     {$item->getCreatorUser()|upper}
                 {else}
                     {__('---')}
                 {/if}    
            </td>
            {/if}
        {/if}
         {component name="/customers_contracts_master/ItemsContractPager" item=$item}
           
            
             {if $formFilter->hasColumn('company_id')}
            <td class="CustomerContracts cols company_id">{* company_id *}
                {if $item->hasCompany()}
                  {$item->getCompany()->get('name')}
                  {else}
                     {__('---')}
                {/if}      
            </td>
           {/if}
            {if $user->hasCredential([['superadmin','admin','contract_list_status']]) && $formFilter->equal->hasValidator('status')}
                {if $formFilter->hasColumn('status')}
                    <td class="CustomerContracts cols Status status" id="{$item->get('id')}">
                     {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_status']])}
                            {__($item->get('status'))}
                      {else}
                        {__('---')}
                    {/if}
                </td>
                {/if}
            {/if}
            {if $formFilter->hasColumn('actions')}
            <td class="CustomerContracts cols actions">      
            {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}
                <div class="dropdown dropdown-contracts">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">....</button>
                        <div class="dropdown-menu">
                 
                 {if $user->hasCredential([['superadmin','contracts_confirmation']])}
                    {if $item->isConfirmed()}
                          {if $user->hasCredential([['superadmin','admin','contract_list_unconfirmed']])}
                                            <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Click to cancel confirmation')}" class="dropdown-item CustomerContracts-Confirm CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}" name="Cancel">
                                    <img class="CustomerContracts-Confirm-img" id="{$item->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Confirmed")}'/>
                                           {__('Click to cancel confirmation')}
                                </a>
                          {else}
                                         <span class="dropdown-item">                                
                                    <img class="CustomerContracts-Confirm-img" id="{$item->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Confirmed")}'/>
                                            {__("Confirmed")}
                                         </span>                            
                          {/if}    
                    {else}
                        {if $user->hasCredential([['superadmin','admin','contract_list_confirmed']])}
                                            <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Click to confirm')}" class="dropdown-item CustomerContracts-Confirm CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}" name="Confirm">
                                    <img class="CustomerContracts-Confirm-img" id="{$item->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/>
                                            {__('Click to confirm')}
                                </a>  
                        {else}
                                        <span class="action-item">
                                            <img class="CustomerContracts-Confirm-img dropdown-item" id="{$item->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/>
                                            {__("Refused")}
                                        </span>
                        {/if}    
                    {/if}
                {/if}
                {if $user->hasCredential([['superadmin','admin','contract_list_cancel']])}
                                    <a href="#" title="{if $item->isCancel()}{__('Click to remove cancellation')}{elseif $item->isUnCancel()}{__('Click to cancel')}{else}{__('Cancel')}{/if}" class="dropdown-item CustomerContractActions CustomerContracts-Cancel {if $item->isCancel()}UnCancel{elseif $item->isUnCancel()}Cancel{else}Cancel{/if} {if $item->isHold()}Hold{/if}" {if $item->isCancel() || $item->isUnCancel()}style="{if $item->isHold()}opacity:0.3;{/if}color:{if $item->isCancel()}#ff0000{else}#00ff00{/if}"{/if} id="{$item->get('id')}" name="{$item->getCustomer()|upper}">                                
                                    <i style="font-size: 18px;" class="fa fa-ban"/>
                                        {if $item->isCancel()}{__('Click to remove cancellation')}{elseif $item->isUnCancel()}{__('Click to cancel')}{else}{__('Cancel')}{/if}
                        </a>
                {/if}
                {if $user->hasCredential([['superadmin','admin','contract_list_blowing']])}
                                    <a href="#" title="{if $item->isBlowing()}{__('Click to remove blowing')}{elseif $item->isUnBlowing()}{__('Click to set blowing')}{else}{__('Blowing')}{/if}" class="dropdown-item CustomerContractActions CustomerContracts-Blowing {if $item->isBlowing()}UnBlowing{elseif $item->isUnBlowing()}Blowing{else}Blowing{/if} {if $item->isHold()}Hold{/if}" {if $item->isBlowing() || $item->isUnBlowing()}style="color:{if $item->isBlowing()}#ff0000{else}#00ff00{/if}"{/if} id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                <span style="font-weight: bold;font-size:18px;{if $item->isHold()}opacity:0.3;{/if}">S</span>
                                {if $item->isBlowing()}{__('Click to remove blowing')}{elseif $item->isUnBlowing()}{__('Click to set blowing')}{else}{__('Blowing')}{/if}</span>
                        </a>
                {/if}
               
                {if $user->hasCredential([['superadmin','admin','contract_list_placement']])}
                                    <a href="#" title="{if $item->isPlacement()}{__('Click to remove placement')}{elseif $item->isUnPlacement()}{__('Click to set placement')}{else}{__('Placement')}{/if}" class="dropdown-item CustomerContractActions CustomerContracts-Placement {if $item->isPlacement()}UnPlacement{elseif $item->isUnPlacement()}Placement{else}Placement{/if} {if $item->isHold()}Hold{/if}" {if $item->isPlacement() || $item->isUnPlacement()}style="color:{if $item->isPlacement()}#ff0000{else}#00ff00{/if}"{/if} id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                <span style="font-weight: bold;font-size:18px;{if $item->isHold()}opacity:0.3;{/if}">P</span>
                                {if $item->isPlacement()}{__('Click to remove placement')}{elseif $item->isUnPlacement()}{__('Click to set placement')}{else}{__('Placement')}{/if}</span>
                        </a>
                {/if}
                {if $user->hasCredential([['superadmin','admin','contract_modify','contract_view']])}
                                    <a href="#" title="{__('edit')}" class="dropdown-item CustomerContracts-View" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                 <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/>
                                        {__('edit')}
                        </a>
                {/if}    

              {*  <a href="#" title="{__('edit')}" class="CustomerContracts-Product" id="{$item->get('id')}">
                     <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a> *}
              {*  <a href="#" title="{__('contributor')}" class="CustomerContracts-Contributor" id="{$item->get('id')}">
                     <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a>  *}
                {if $user->hasCredential([['superadmin','admin','contract_customer_sms_send']])}
                                    <a href="#" title="{__('Send SMS')}" class="dropdown-item CustomerContracts-Sms" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/>
                                        {__('Send SMS')}
                        </a>
                {/if}    

                {if $user->hasCredential([['superadmin','admin','contract_customer_email_send']])}
                                    <a href="#" title="{__('Send Email')}" class="dropdown-item CustomerContracts-Email" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                        <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/>
                                        {__('Send Email')}
                        </a>
                {/if}
                {if $user->hasCredential([['superadmin','admin','contract_list_new_contract_comment']])}
                                    <a href="#" title="{__('New comment for contract ')}" class="dropdown-item CustomerContracts-ContractComment" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                <img  src="{url('/icons/comment16x16.png','picture')}" alt='{__("New comment for contract")}'/>
                                        {__('New comment for contract ')}
                        </a>
                {/if}
                 {if !$item->isHold() && $user->hasCredential([['superadmin','admin','app_domoprime_contract_list_premeeting_document']])}  
                    {if $item->hasPolluter()}
                                    <a target="_blank" class="dropdown-item" href="{url_to('app_domoprime',['action'=>'ExportPolluterPreMeetingDocumentPdf'])}?Contract={$item->get('id')}" title="{__('Pre Meeting Document')}" id="{$item->get('id')}">
                                    <i class="fa fa-file-o" style="font-size: 18px;"/>
                                            {__('Pre Meeting Polluter Document')}
                            </a>  
                        {else}                    
                                        <a target="_blank" class="dropdown-item" href="{url_to('app_domoprime',['action'=>'ExportPreMeetingDocumentPdf'])}?Contract={$item->get('id')}" title="{__('Pre Meeting Document')}" id="{$item->get('id')}">
                                <i class="fa fa-file-o" style="font-size: 18px;"/>
                                        {__('Pre Meeting Document')}
                        </a>  
                {/if}
                {/if}
                {component name="/app_domoprime/linkForGenerateDocumentsForContract" contract=$item}                                                      
                {component name="/app_domoprime_yousign/linkForDocumentsClassForContract" contract=$item}    
                {component name="/app_domoprime_yousign/linkForEvidencedDocumentsForContract" contract=$item}  
                {component name="/app_domoprime_yousign/linkForDocumentForContract" contract=$item}
                {component name="/app_domoprime_yousign/linkForDocumentsForContract" contract=$item}
                {component name="/app_domoprime_iso/linkForDocumentForContract" contract=$item}
                {component name="/app_domoprime_iso/linkForGenerateDocumentsForContract" contract=$item}
                {component name="/app_domoprime/linkForDocumentsClassForContract" contract=$item}
               
                {if $user->hasCredential([['superadmin','admin','contract_documents_form_list']])}
                                <a href="#" title="{__('Documents')}" class="dropdown-item CustomerContracts-DocumentsForm" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                       <img height="16px" src="{url('/icons/doc-green-32x32.png','picture')}" alt='{__("Documents")}'/>
                                {__('Documents')}
                    </a>  
                {/if}
                 {component name="/app_domoprime_iso/linkForGenerateCalculationForContract" contract=$item}          

                  {if $user->hasCredential([['superadmin','admin','domoprime_contract_generate']])}
                            <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Generate Cumac')}" class="dropdown-item Domoprime-Contract-Generate-Cumac CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                <img height="16px" src="{url('/icons/calculate_green_16x16.png','picture')}" alt='{__("Generate Cumac")}'/>
                                {__('Generate Cumac')}
                        </a>
                {/if}
                 {if $user->hasCredential([['superadmin','admin','contract_billings']])}  
                    {component name="/customers_contracts_billing/action" contract=$item}
                 {/if}    
                {if $user->hasCredential([['superadmin','admin','contract_one_exportKml']])}
                            <a href="{url_to('customers_contracts',['action'=>'ExportKMLContract'])}?contract={$item->get('id')}" class="dropdown-item" title="{__('Export Kml')}">
                            <img  src="{url('/icons/files/kml.gif','picture')}" alt='{__("Export Kml")}'/>
                                    {__('Export Kml')}
                    </a>
                {/if}
                {if $user->hasCredential([['superadmin','admin','contract_list_document_export_pdf']])}
                {component name="/customers_contracts_documents/ExportPdfContractLink" item=$item}
                {/if}
                {if $item->number_of_installers==1 && $user->hasCredential([['superadmin','admin']])}
                    {*---------
                   
                       A faire
                   
                    -------*}
                    {component name="/products_installer_schedule_document/PdfLink" contract=$item}                  
                {/if}    

                 {if $user->hasCredential([['superadmin','admin','contract_create_default_products']])}
                                    <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Create default products')}" class="dropdown-item CustomerContracts-CreateDefaultProducts CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}">
                                <img  height="16px" width="16px" src="{url('/icons/item16x16.png','picture')}" alt='{__("Create default products")}'/>
                                        {__('Create default products')}
                        </a>
                {/if}

                 {if $user->hasCredential([['superadmin','contract_hold']])}                    
                    {if $item->isHold()}
                         {if $user->hasCredential([['superadmin','admin','contract_list_unhold']])}
                                        <a href="#" title="{__('Click to unhold')}" class="dropdown-item CustomerContracts-Hold" id="{$item->get('id')}" name="Free">
                                        <img height="16px" class="CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/hold32x32.png','picture')}" alt='{__("Free")}'/>
                                            {__('Click to unhold')}
                                </a>
                         {else}
                                        <span class="dropdown-item">
                                    <img height="16px" class="CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/hold32x32.png','picture')}" alt='{__("Free")}'/>
                                            {__("Free")}
                                        </span>
                         {/if}    
                    {else}
                         {if $user->hasCredential([['superadmin','admin','contract_list_hold']])}
                                            <a href="#" title="{__('Click to hold')}" class="dropdown-item CustomerContracts-Hold" id="{$item->get('id')}" name="Hold">
                                    <img height="16px" class="CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/unhold32x32.png','picture')}" alt='{__("Hold")}'/>
                                                {__('Click to hold')}
                                </a>  
                        {else}
                                        <span class="dropdown-item">
                                            <img height="16px" class="dropdown-item CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/unhold32x32.png','picture')}" alt='{__("Hold")}'/>    
                                            {__("Hold")}
                                        </span>
                        {/if}    
                    {/if}
                {/if}
               
                 {if $user->hasCredential([['superadmin','contract_hold_quote']])}                              
                    {if $item->isHoldQuote()}
                         {if $user->hasCredential([['superadmin','contract_list_unhold_quote']])}
                                        <a href="#" title="{__('Click to unhold')}" class="dropdown-item CustomerContracts-HoldQuote" id="{$item->get('id')}" name="Free">
                                       <i style="color:blue" class="CustomerContracts-HoldQuote-img fa fa-lock" id="{$item->get('id')}"></i>
                                            {__('Click to unhold')}
                                </a>
                         {else}
                                        <div class="dropdown-item">
                                    <i style="color:blue" class="CustomerContracts-HoldQuote-img fa fa-lock" id="{$item->get('id')}"></i>
                                            {__("Free")}
                                </div>
                         {/if}    
                    {else}
                         {if $user->hasCredential([['superadmin','contract_list_hold_quote']])}
                                            <a href="#" title="{__('Click to hold')}" class="dropdown-item CustomerContracts-HoldQuote" id="{$item->get('id')}" name="Hold">
                                    <i style="color:blue" class="CustomerContracts-HoldQuote-img fa fa-unlock" id="{$item->get('id')}"></i>
                                                {__('Click to hold')}
                                </a>  
                        {else}
                                        <div class="dropdown-item">
                                            <i style="color:blue" class="dropdown-item CustomerContracts-HoldQuote-img fa fa-unlock" id="{$item->get('id')}"></i>
                                            {__("Hold")}
                                </div>
                        {/if}    
                    {/if}                    
                {/if}                
                {if $user->hasCredential([['superadmin','contract_copy']])}
                        <a href="#" title="{__('Copy')}" class="dropdown-item CustomerContracts-copy" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                <i class="fa fa-copy"/>
                                        {__('Copy')}
                        </a>
                {/if}
                 {if $user->hasCredential([['superadmin','contract_hold_admin']])}                    
                    {if $item->isHoldAdmin()}
                         {if $user->hasCredential([['superadmin','admin','contract_list_unhold_admin']])}
                                <a href="#" title="{__('Click to unhold')}" class="dropdown-item CustomerContracts-Hold-Admin" id="{$item->get('id')}" name="Free">
                                        <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/holdred32x32.png','picture')}" alt='{__("Free")}'/>
                                                {__('Click to unhold')}
                                </a>
                         {else}
                                <div class="dropdown-item">
                                    <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/holdred32x32.png','picture')}" alt='{__("Free")}'/>
                                            {__("Free")}
                                </div>
                         {/if}    
                    {else}
                        {if $user->hasCredential([['superadmin','admin','contract_list_hold_admin']])}
                                <a href="#" title="{__('Click to hold')}" class="dropdown-item CustomerContracts-Hold-Admin" id="{$item->get('id')}" name="Hold">
                                    <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/unholdred32x32.png','picture')}" alt='{__("Hold")}'/>
                                                {__('Click to hold')}
                                </a>  
                        {else}
                                <div class="dropdown-item">
                                    <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/unholdred32x32.png','picture')}" alt='{__("Hold")}'/>    
                                            {__("Hold")}
                                </div>
                        {/if}    
                    {/if}
                {/if}
                {component name="/customers_contracts_master/BtnTransfer" contract=$item}
                {component name="/customers_contracts_master/BtnSlavesTransfer" meeting=$item}
                {component name="/app_domoprime_iso/BtnTransfer" contract=$item}
                  {component name="/customers_communication_whats_app/customerForContractPager" contract=$item}
                {if $user->hasCredential([['superadmin','admin','contract_delete']])}                  
                    {if $item->get('status')=='ACTIVE'}
                                        <a href="#" title="{__('delete')}" class="dropdown-item CustomerContracts-Status Delete" id="{$item->get('id')}"  name="{$item->getCustomer()|upper} ({format_date($item->get('created_at'),'p')})">
                                    <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                                            {__('delete')}
                            </a>
                    {else}
                                        <a href="#" title="{__('Recycle')}" class="dropdown-item CustomerContracts-Status Recycle" id="{$item->get('id')}" name="{$item->getCustomer()|upper} {format_date($item->get('created_at',"p"))}">
                                    <img  src="{url('/icons/recycling16x16.png','picture')}" alt='{__("Recycle")}'/>
                                            {__('Recycle')}
                            </a>    
                    {/if}
                {/if}                        
                       
                    </div>
                </div>
               
                  {else}
                    {__('---')}
                {/if}
            </td>
            {/if}
             {if $formFilter->hasColumn('is_billable')}
          <td class="CustomerContracts cols is_billable">{* is_billable *}
                {__($item->get('is_billable'))}
          </td>
          {/if}
            {if $user->hasCredential([['superadmin_debugXX','app_domoprime_contract_list_surface_from_forms_101','app_domoprime_iso_contract_list_surface_from_form_101']])}
                {if $formFilter->hasColumn('surface_top')}
                <td class="CustomerContracts cols surface_top">
                {if $item->isAuthorized()}
                   {if $item->hasSurfaces() && $item->getSurfaces()->hasSurfaceTop()}
                        {$item->getSurfaces()->getSurfaceTop()->getText("#.00")}
                   {/if}    
                 {else}
                   {__('---')}
                {/if}    
                </td>
                {/if}
            {/if}
         {if $user->hasCredential([['superadmin_debugXX','app_domoprime_contract_list_surface_from_forms_102','app_domoprime_iso_contract_list_surface_from_form_102']])}
            {if $formFilter->hasColumn('surface_wall')}
                 <td class="CustomerContracts cols surface_wall">
               {if $item->isAuthorized()}
                   {if $item->getSurfaces()->hasSurfaceWall()}
                        {$item->getSurfaces()->getSurfaceWall()->getText("#.00")}                  
                   {/if}    
                 {else}
                   {__('---')}
               {/if}    
            </td>
            {/if}
        {/if}
         {if $user->hasCredential([['superadmin_debugXX','app_domoprime_contract_list_surface_from_forms_103','app_domoprime_iso_contract_list_surface_from_form_103']])}
            {if $formFilter->hasColumn('surface_floor')}
                 <td class="CustomerContracts cols surface_floor">
               {if $item->isAuthorized()}
                   {if $item->hasSurfaces() && $item->getSurfaces()->hasSurfaceFloor()}
                        {$item->getSurfaces()->getSurfaceFloor()->getText("#.00")}
                   {/if}    
                 {else}
                   {__('---')}
               {/if}    
            </td>
            {/if}
        {/if}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_101']])}
        {if $formFilter->hasColumn('surface_top')}
            <td class="101 CustomerContracts cols surface_top">
             {if $item->hasRequest()}
                 {$item->getRequest()->getFormatter()->getSurfaceTop()->getText()}
             {else}
                 {__('---')}
             {/if}    
        </td>
        {/if}
        {/if}
         {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_102']])}
            {if $formFilter->hasColumn('surface_wall')}
                 <td class="102 CustomerContracts  cols surface_wall">
                {if $item->hasRequest()}
                     {$item->getRequest()->getFormatter()->getSurfaceWall()->getText()}
                 {else}
                     {__('---')}
                 {/if}
            </td>
            {/if}
        {/if}
        {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_103']])}
            {if $formFilter->hasColumn('surface_floor')}
             <td class="103 CustomerContracts cols surface_floor">
                {if $item->hasRequest()}
                  {$item->getRequest()->getFormatter()->getSurfaceFloor()->getText()}  
                 {else}
                     {__('---')}
                 {/if}  
            </td>
            {/if}
        {/if}
        {if $formFilter->hasColumn('amount')}
        <td class="CustomerContracts cols amount">
               <div>{format_currency($item->get('total_price_with_taxe'),$settings_contracts->get('default_currency'))}</div>
                 <div>{if $item->hasPartner()}{$item->getPartner()->get('name')}{/if}</div>
          </td>  {/if}
    </tr>  
             {/foreach}
   
   
        {else}
                <tr class="CustomerContracts {if $item->isConfirmed() && $user->hasCredential([['contract_list_confirmed_color']])}ConfirmedContract{else}list{/if} {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}DblClick{/if}" id="CustomerContracts-{$item->get('id')}" data-id="{$item->get('id')}" {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}name="{$item->getCustomer()|upper}"{/if} title="{include file="./includes/comments.tpl" comments=$item->comments}" style="{if $item@iteration % 2==0}background:#fff;{else}background:#f5f5f5;{/if}" data-iteration="{$item@iteration}">
                        <td class="CustomerContracts-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>            
                       <td>                            
                           <input class="CustomerContracts-selection" type="checkbox" id="{$item->get('id')}" {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}name="{$item->getCustomer()}"{/if}/>                      
                       </td>          
                       {if $user->hasCredential([['superadmin','admin','contract_view_list_id']])}
                           {if $formFilter->hasColumn('id')}
                               <td class="CustomerContracts cols id">
                                {format_number($item->get('id'),$settings_contracts->get('format_id','0000'))}
                                 {component name="/partners_localization/btnForContractPager" item=$item}
                               </td>  
                           {/if}  
                      {/if}  
                       <td>
                             {* works*}
                        </td>
                      {if $formFilter->hasColumn('date')}
                        <td class="CustomerContracts cols date">{* date *}                              
                              <div>              
                              <img class="CustomerContracts-Hold-Field-img"  {if !$item->isHold()}style="display:none"{/if} id="{$item->get('id')}" height="16px" src="{url('/icons/hold32x32.png','picture')}" alt='{__("Hold")}'/></a>                                                                    
                              <img class="CustomerContracts-Hold-Admin-Field-img"  {if !$item->isHoldAdmin()}style="display:none"{/if} id="{$item->get('id')}" height="16px" src="{url('/icons/holdred32x32.png','picture')}" alt='{__("Hold")}'/></a>                                                                    
                               {*if $user->hasCredential([['admin','contract_list_opened_at']])}          
                                   {format_date($item->get('opened_at'),'a')}
                               {/if*}
                              </div>              
                              {*if $user->hasCredential([['superadmin','admin','contract_list_opc_at']]) && $item->get('opc_at')}
                               <div>                    
                                  <i>{__('Install AH')}:
                                      {if $user->hasCredential([['superadmin','admin','contract_display_list_opc_at_datetime']])}                                              
                                          <div>{$item->getFormatter()->getOpcAt()->getDateAndTime()}</div>                          
                                      {else}
                                          {$item->getFormatter()->getOpcAt()->getText()}
                                      {/if}
                                  </i>                  
                               </div>
                              {/if*}
                              {*if $user->hasCredential([['superadmin','contract_list_view_opc_range']])}
                                  <i>{__('Install AH')}:                    
                                        <div class="CustomerContractOpcAt" id="{$item->get('id')}">                            
                                        {if $item->hasOpcAt()}                        
                                            {$item->getFormatter()->getOpcAt()->getText()}    
                                            <span style="{if $item->getOpcRange()->hasColor()}font-weight: bold;color:{$item->getOpcRange()->get('color')};{/if}">{$item->getOpcRange()->getI18n()|upper}</span>
                                         {else}
                                             {__('---')}
                                         {/if}  
                                        </div>
                                 </i>                      
                               {/if*}                  
                               {*if $user->hasCredential([['superadmin','contract_list_view_pre_meeting_at','contract_display_list_pre_meeting_at_datetime']])}
                                <div>                    
                                 <i>{__('Pre meeting')}:  
                                      {if $item->hasPreMeetingAt()}
                                           {if $user->hasCredential([['superadmin','contract_display_list_pre_meeting_at_datetime']])}                                              
                                               <div>{$item->getFormatter()->getPreMeetingAt()->getDateAndTime()}</div>                          
                                            {else}                              
                                               {$item->getFormatter()->getPreMeetingAt()->getText()}                  
                                            {/if}
                                       {else}
                                             {__('---')}
                                         {/if}  
                                 </i>                  
                              </div>                      
                                 {/if*}    
                              {*if $user->hasCredential([['superadmin','admin','contract_list_apf_at']]) && $item->get('apf_at')}
                              <div>      
                                 <i>{__('Sent at')}:{format_date($item->get('apf_at'),'a')}</i>
                              </div>
                              {/if*}
                              {*if $user->hasCredential([['superadmin','admin','contract_list_payment_at']]) && $item->get('payment_at')}
                              <div>      
                                 <i>{__('Payment')}:{format_date($item->get('payment_at'),'a')}</i>
                              </div>
                              {/if*}
                              {*if $user->hasCredential([['superadmin','contract_list_view_sav_at']])}
                                   <div>      
                                  <i>{__('Install')}:{if $item->hasSavAt()}{$item->getFormatter()->getSavAt()->getText()}{else}{__('---')}{/if}</i>                      
                                   </div>      
                              {/if*}
                              {*if $user->hasCredential([['superadmin','contract_list_view_sav_at_range']])}
                                  <i>{__('Install')}:                    
                                        <div class="CustomerContractSavAt" id="{$item->get('id')}">                            
                                        {if $item->hasSavAt()}                        
                                            {$item->getFormatter()->getSavAt()->getText()}    
                                            <span style="{if $item->getSavAtRange()->hasColor()}font-weight: bold;color:{$item->getSavAtRange()->get('color')};{/if}">{$item->getSavAtRange()->getI18n()|upper}</span>
                                         {else}
                                             {__('---')}
                                         {/if}  
                                        </div>
                                 </i>                      
                                 {/if*}
                               {*if $user->hasCredential([['superadmin','contract_list_view_doc_at']])}
                                    <div>      
                                  <i>{__('AH Date')}:{if $item->hasDocAt()}{$item->getFormatter()->getDocAt()->getText()}{else}{__('---')}{/if}</i>                      
                                   </div>      
                              {/if*}
                              {*if $user->hasCredential([['superadmin','admin','contract_list_closed_at']]) && $item->get('closed_at')}
                              <div>      
                                 <i>{__('Close at')}:{format_date($item->get('closed_at'),'p')}</i>
                              </div>
                              {/if*}
                         </td>
                         {/if}
                         
                         {if $formFilter->hasColumn('customer')}
                         <td class="CustomerContracts cols customer">{* customer *}
                               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_lastname']])}
                                   {if $user->hasCredential([['superadmin','contract_list_company']])}
                                       <div>{$item->getCustomer()->get('company')}</div>
                                       <div>{$item->getCustomer()->getLastname()|upper} {$item->getCustomer()->getFirstname()|upper}</div>
                                   {else}
                                       {$item->getCustomer()->getLastname()|upper} {$item->getCustomer()->getFirstname()|upper}
                                   {/if}  
                               {else}
                                   {__('---')}
                               {/if}
                               <a href="javascript:void(0);" style="font-size: 15px;" class="ToggleCustomerPagerContract" data-id="{$item->get('id')}">+</a>
                                <div id="CustomerPagerContractPlus-{$item->get('id')}" style="display: none;">
                                    {component name="/app_domoprime/calculationForPager" item=$item}
                                    {component name="/app_domoprime_yousign/QuotationSignatureForContractPager"  item=$item}                
                                    {component name="/app_domoprime_yousign/DocumentSignatureForContractPager"  item=$item}
                                    {component name="/customers_contracts_documents_check/checkerForContractPager" item=$item}
                                </div>
                         </td>
                         {/if}
                         
                    
                        
                         
                         
                       {*  <td>
                             {if $item->hasProducts()}
                               {foreach $item->getProducts() as $product}
                                   {$product->get('meta_title')|upper}{if !$product@last}<br/>{/if}
                               {/foreach}
                             {/if}
                         </td> *}
                         {* amount *}
                          
                         {if $formFilter->hasColumn('phone')}
                          <td class="CustomerContracts cols phone">{* phone *}
                               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_phone']])}                
                                <div>
                                    <a href="tel:{$item->getCustomer()->get('phone')}">
                                        {*$item->getCustomer()->getFormattedPhone()*}
                                        {$item->getCustomer()->get('phone')}
                                    </a>
                                </div>
                                 {else}
                                   {__('---')}
                               {/if}
                               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_mobile']])}
                                <div>
                                    {*$item->getCustomer()->getFormattedMobile()*}
                                    {$item->getCustomer()->get('mobile')}
                                </div>
                                {else}
                                   {__('---')}
                               {/if}
                           </td>
                           {/if}
                           {if $formFilter->hasColumn('postcode')}
                               <td class="CustomerContracts cols postcode">{* postcode *}
                                    {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_postcode']])}
                                    {$item->getCustomer()->getAddress()->get('postcode')|upper}  
                                        {else}
                                       {__('---')}
                                   {/if}
                               </td>  
                           {/if}
                           {if $formFilter->hasColumn('city')}
                           <td class="CustomerContracts cols city">{* city *}
                                 {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_city']])}
                                {$item->getCustomer()->getAddress()->get('city')|escape|upper}  
                                 {else}
                                   {__('---')}
                               {/if}
                           </td>  
                           {/if}
                            {if $formFilter->hasColumn('class_id')}  
                     {if $formFilter->equal->hasValidator('class_id') && $user->hasCredential([['superadmin_debugxx','app_domoprime_iso_contract_list_filter_header_class','contract_list_calculation_class_pager','app_domoprime_iso_contract_list_filter_class','app_domoprime_iso_contract_list_filter_class_energy_sector']])}
                                   <td>
                               {if $item->hasCalculation()}              
                                   {if $item->getCalculation()->hasClass()}
                                       {if $item->getCalculation()->getClass()->hasI18n()}
                                           {$item->getCalculation()->getClass()->getI18n()}
                                       {else}
                                           {__('---')}
                                       {/if}
                                   {/if}
                               {else}
                                   {__('---')}
                               {/if}
                            </td>  
                          {/if}
                       {/if}  
                        
                            {if $user->hasCredential([['contract_list_display_team']]) || ($formFilter->in->hasValidator('team_id') && $user->hasCredential([['superadmin','admin','contract_view_list_team']]))}
                           {if $formFilter->hasColumn('team')}
                           <td class="CustomerContracts cols team">
                              {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_team']])}
                                  {if $item->hasTeam()}
                                     {$item->getTeam()->get('name')|upper}
                                 {/if}
                                {else}
                                  {__('---')}
                              {/if}
                          </td>
                          {/if}                          
                       {/if} 
                       {if $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
                           {if $formFilter->hasColumn('sale1')}
                           <td class="CustomerContracts cols sale1">{* commercial1 *}
                               {if $item->isAuthorized() || $user->hasCredential([['superadmin','admin','contract_list_view_sale1']])}
                                   {if $item->hasSale1()}
                                    {$item->getSale1()->getName(false)|upper}
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
                                {else}
                                   {__('---')}
                               {/if}
                           </td>
                           {/if}
                           {/if}
                           {if $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
                               {if $formFilter->hasColumn('sale2')}
                               <td class="CustomerContracts cols sale2">{* commercial2 *}
                                   {if $item->isAuthorized() || $user->hasCredential([['superadmin','admin','contract_list_view_sale2']])}
                                           {if $item->hasSale2()}
                                           {$item->getSale2()->getName(false)|upper}
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
                                     {else}
                                       {__('---')}
                                   {/if}
                               </td>
                               {/if}
                           {/if}
                            {if $formFilter->equal->hasValidator('telepro_id')}
                                {if $formFilter->hasColumn('telepro_id')}
                                   <td class="CustomerContracts cols telepro_id">
                                       {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_telepro']])}
                                              {if $item->hasTelepro()}
                                                  {$item->getTelepro()->getName(false)|upper}
                                             {/if}
                                        {else}
                                          {__('---')}
                                      {/if}
                                  </td>
                                  {/if}
                           {/if}
                                 {* assistant *}


                           {if $user->hasCredential([['contract_list_display_assistant']]) || ($formFilter->equal->hasValidator('assistant_id') && $user->hasCredential([['superadmin','admin','contract_view_list_assistant']]))}  
                               {if $formFilter->hasColumn('assistant_id')}
                                   <td class="CustomerContracts cols assistant_id">
                                    {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_assistant']])}
                                       {if $item->hasAssistant()}
                                           {$item->getAssistant()|upper}
                                       {else}                    
                                       {/if}    
                                    {else}
                                       {__('---')}
                                   {/if}
                               </td>  
                               {/if}  
                           {/if} 
                           {if $formFilter->equal->hasValidator('polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
                            {if $formFilter->hasColumn('polluter')}
                            <td class="CustomerContracts cols polluter">{* partner *}  
                                <div>{if $item->hasPolluter()}{$item->getPolluter()->get('name')|upper}{else}{__('---')}{/if}</div>
                            </td>
                            {/if}
                          {/if}
                          {if $formFilter->equal->hasValidator('financial_partner_id') && $user->hasCredential([['superadmin','admin','contract_view_list_partner']])}
                            {if $formFilter->hasColumn('financial_partner_id')}
                             <td class="CustomerContracts cols financial_partner_id">{* partner *}      
                               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_partner']])}
                              <div>{if $item->hasPartner()}{$item->getPartner()->get('name')|upper}{else}{__('---')}{/if}</div>  
                              {component name="/products_installer_schedule/SendMailToInstallerButton" contract=$item}  
                              {component name="/partners_communication_emails/SendMailToPartnerButton" contract=$item}  
                              {component name="/partners_communication_whats_app/partnerForContractPager" contract=$item}  
                               {else}
                                     {__('---')}
                                 {/if}
                             </td>
                         {/if}
                         {/if}
                          {if $settings_contracts->hasLayer() && $user->hasCredential([['superadmin','admin','contract_view_list_partner_layer']])}
                           {if $formFilter->hasColumn('partner_layer_id')}
                               <td class="CustomerContracts cols partner_layer_id">{* partner *}      
                               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_partner_layer']])}
                               <div>{if $item->hasPartnerLayer()}{$item->getPartnerLayer()->get('name')|upper}{else}{__('---')}{/if}</div>            
                                {else}
                                      {__('---')}
                                  {/if}
                          </td>
                          {/if}
                       {/if}
                        {if $formFilter->hasColumn('state')}
                            <td class="CustomerContracts cols State state" id="{$item->get('id')}">{* status *}  
                              {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_state']])}
                               {if $item->hasStatus()}
                                   {if $item->getStatus()->get('icon')}
                                      <img src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                                   {elseif $item->getStatus()->get('color')}
                                   <div class="CustomerContracts State color" id="{$item->get('id')}" style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                                   {/if}&nbsp;              
                                   <span class="CustomerContracts State Text" id="{$item->get('id')}">{$item->getStatus()->getCustomerContractStatusI18n()->get('value')}</span>
                               {else}
                                   {__('---')}
                               {/if}
                                 {else}
                                   {__('---')}
                               {/if}
                           </td>
                         {/if}
                         {if $formFilter->equal->hasValidator('time_state_id') && $user->hasCredential([['superadmin','contract_view_list_time_state']])}
                           {if $formFilter->hasColumn('time_state_id')}
                               <td class="CustomerContracts cols time_state_id">{* partner *}      
                               {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_time_state']])}                
                                  {if $item->hasTimeStatus()}      
                                       {if $item->getTimeStatus()->get('icon')}
                                         <img src="{$item->getTimeStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                                      {elseif $item->getTimeStatus()->get('color')}
                                      <div class="CustomerContracts TimeStatus color" id="{$item->get('id')}" style="background:{$item->getTimeStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                                      {/if}&nbsp;              
                                      <span class="CustomerContracts TimeStatus Text" id="{$item->get('id')}">{$item->getTimeStatus()->getI18n()->get('value')}</span>  
                                  {else}
                                      {__('---')}
                                  {/if}
                              {else}
                                {__('---')}
                            {/if}
                          </td>
                          {/if}
                       {/if}
                         {if $user->hasCredential([['superadmin','contract_list_install_state']]) && $formFilter->equal->hasValidator('install_state_id')}  
                        {if $formFilter->hasColumn('install_state')}
                         <td class="CustomerContracts cols install_state">{* partner *}
                             {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_install_state']])}
                            {if $item->hasInstallStatus()}
                                {if $item->getInstallStatus()->get('icon')}
                                   <img src="{$item->getInstallStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                                {elseif $item->getInstallStatus()->get('color')}
                                <div class="color" style="background:{$item->getInstallStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                                {/if}&nbsp;  

                                {$item->getInstallStatus()->getI18n()->get('value')}

                            {else}
                                {__('---')}
                            {/if}
                              {else}
                               
                                {__('---')}
                            {/if}    
                        </td>
                        {/if}
                         {/if}
                        {if $formFilter->equal->hasValidator('admin_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_admin_status']])}
                           {if $formFilter->hasColumn('admin_status_id')}
                               <td class="CustomerContracts cols admin_status_id">{* partner *}      
                                {*if $item->isAuthorized() || $user->hasCredential([['contract_list_view_admin_status']])}                
                                   {if $item->hasAdminStatus()}
                                       {if $item->getAdminStatus()->get('icon')}
                                          <img src="{$item->getAdminStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                                       {elseif $item->getAdminStatus()->get('color')}
                                       <div style="background:{$item->getAdminStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                                       {/if}&nbsp;              
                                       <span>{$item->getAdminStatus()->getI18n()->get('value')}</span>
                                   {else}
                                       {__('---')}
                                   {/if}
                                     {else}
                                       {__('---')}
                                   {/if*}
                           </td>
                           {/if}
                       {/if}
                          {if $formFilter->equal->hasValidator('opc_status_id') && $user->hasCredential([['superadmin','admin','contract_view_list_opc_status']])}
                           {if $formFilter->hasColumn('opc_status_id')}
                               <td class="CustomerContracts cols opc_status_id">{* partner *}      
                                {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_opc_status']])}                                                 
                                   {if $item->hasOpcStatus()} 
                                       {if $item->getOpcStatus()->get('icon')}
                                          <img src="{$item->getOpcStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/>
                                       {elseif $item->getOpcStatus()->get('color')}
                                       <div class="CustomerContracts" id="{$item->get('id')}" style="background:{$item->getOpcStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                                       {/if}&nbsp;   
                                       {if $item->getOpcStatus()->hasI18n()}                         
                                          {* ==========={$item->getOpcStatus()->get('id')}==i18n==={$item->getOpcStatus()->get('i18n')}===i18n={$item->getOpcStatus()->i18n->id}==== *}
                                           <span class="CustomerContracts" id="{$item->get('id')}">{$item->getOpcStatus()->getI18n()->get('value')}</span> 
                                       {else}
                                          <span class="CustomerContracts" id="{$item->get('id')}">{__('---')}</span>  
                                        {/if}
                                   {else}
                                       {__('---')}
                                   {/if}
                                     {else}
                                       {__('---')}
                                   {/if}
                           </td>
                           {/if}
                       {/if}
                        {if $formFilter->hasColumn('work_state_id')}
                           <td>
                               {*work_state_id*}
                           </td>
                           {/if}
                            {if $formFilter->hasColumn('work_company_id')}
                         <td class="CustomerContracts cols work_company_id">{* work_company_id *}
   
                         </td>
                         {/if}
                         {if $formFilter->equal->hasValidator('work_partner_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner']])}
                            {if $formFilter->hasColumn('work_partner_id')}
                                <td class="CustomerContracts cols work_partner_id">
                                    {*work_partner_id*}
                                </td>
                            {/if}
                           {/if}
                          {if $formFilter->equal->hasValidator('work_polluter_id') && $user->hasCredential([['superadmin','admin','contract_view_list_polluter']])}
                           {if $formFilter->hasColumn('work_polluter_id')}
                           <td class="CustomerContracts cols work_polluter_id">{* partner *}  

                           </td>
                           {/if}
                         {/if}
                        
                         {if $formFilter->equal->hasValidator('work_partner_layer_id') && $user->hasCredential([['superadmin','contract_work_view_list_partner_layer']])}
                            {if $formFilter->hasColumn('work_partner_layer_id')}
                            <td class="CustomerContracts cols work_partner_layer_id">
                                     {*work_partner_layer_id*}
                            </td>
                            {/if}
                       {/if}
                          
                           {if $formFilter->hasColumn('work_all_quantities')}
                            <td class="CustomerContracts cols work_all_quantities">{* work_all_quantities *}
                               
                            </td>
                        {/if} 
                        {if $formFilter->hasColumn('engine_id')}
                         <td class="CustomerContracts cols engine_id">{* engine_id *}
   
                         </td>
                         {/if}
                          {if $formFilter->hasColumn('pricing_id')}
                                <td class="CustomerContracts cols pricing_id">{* city *}

                                </td>  
                         {/if}
                        {*if $formFilter->hasColumn('work_surface_ite')}
                          <td class="CustomerContracts cols work_surface_ite">{* work_surface_ite *}
                               
                          {*</td>
                        {/if}
                        {if $formFilter->hasColumn('work_pack_quantity')}
                          <td class="CustomerContracts cols work_pack_quantity">{* work_pack_quantity *}
                               
                          {*</td>
                        {/if}
                        {if $formFilter->hasColumn('work_boiler_quantity')}
                          <td class="CustomerContracts cols work_boiler_quantity">{* work_boiler_quantity *}
                               
                          {*</td>
                        {/if*}
                       
                       {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_list_surface_parcel']])}
                       {if $formFilter->hasColumn('surface_parcel_check')}
                           <td class="CustomerContracts cols surface_parcel_check">
                           {if $item->hasRequest()}
                           {$item->getRequest()->getFormatter()->getParcelSurface()->getText()}  
                            {else}
                                {__('---')}
                            {/if}
                       </td>
                       {/if}
                       {/if}
                       
                           
                           
                       
                       
                      
                       
                        
                      
                                            
                            {*if $user->hasCredential([['superadmin','contract_list_advance_payment']])}  
                           <td>
                                {$item->getFormattedAdvance()}
                           </td>  
                           {/if*}
                           {if $formFilter->equal->hasValidator('is_confirmed') && $user->hasCredential([['superadmin','contract_view_list_confirmed']])}
                               {if $formFilter->hasColumn('is_confirmed')}
                                       <td class="CustomerContracts cols is_confirmed" id="{$item->get('id')}">
                                      {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_confirmed']])}
                                        {if $item->isConfirmed()}
                                                {__('Confirmed')}                      
                                           {else}
                                               {__('Not confirmed')}
                                           {/if}
                                        {else}
                                           {__('---')}
                                       {/if}
                                   </td>
                               {/if}
                           {/if}

                            {if $formFilter->equal->hasValidator('is_hold') && $user->hasCredential([['superadmin','admin','contract_view_list_hold']])}
                              {if $formFilter->hasColumn('is_hold')}
                                <td class="CustomerContractHold cols CustomerContracts is_hold" id="{$item->get('id')}">
                                       {$item->getHoldI18n()}
                                 </td>
                               {/if}
                            {/if}
                            {if $formFilter->equal->hasValidator('is_hold_quote') && $user->hasCredential([['superadmin','contract_view_list_hold_quote']])}
                               {if $formFilter->hasColumn('is_hold_quote')}
                                <td class="CustomerContractHoldQuote cols CustomerContracts hold_quote" id="{$item->get('id')}">
                                       {$item->getHoldQuoteI18n()}
                                </td>
                                {/if}
                             {/if}

                        {if $formFilter->equal->hasValidator('is_document')}
                            {if $formFilter->hasColumn('is_document')}
                               <td class="CustomerContracts cols is_document">    
                                  {if $user->hasCredential([['superadmin','contract_list_change_is_document']])}
                                  <a href="#" title="{__('Change document')}" class="CustomerContractChangeIsDocument" id="{$item->get('id')}" name="{$item->get('is_document')}"><img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/></a>
                                  {else}
                                    <img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/>
                                  {/if}
                              </td>
                              {/if}
                       {/if}
                        {if $formFilter->equal->hasValidator('is_photo')}
                            {if $formFilter->hasColumn('is_photo')}
                               <td class="CustomerContracts  cols is_photo">  
                                    {if $user->hasCredential([['superadmin','contract_list_change_is_photo']])}
                                  <a href="#" title="{__('Change photo')}" class="CustomerContractChangeIsPhoto" id="{$item->get('id')}" name="{$item->get('is_photo')}"><img  src="{url('/icons/','picture')}{$item->get('is_photo')}.gif" alt='{__("user_`$item->get("is_photo")`")}'/></a>  
                                   {else}
                                    <img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/>
                                  {/if}
                              </td>
                              {/if}
                       {/if}
                        {if $formFilter->equal->hasValidator('is_quality')}
                            {if $formFilter->hasColumn('is_quality')}
                               <td class="CustomerContracts cols is_quality">    
                                    {if $user->hasCredential([['superadmin','contract_list_change_is_quality']])}
                                <a href="#" title="{__('Change quality')}" class="CustomerContractChangeIsQuality" id="{$item->get('id')}" name="{$item->get('is_quality')}"><img  src="{url('/icons/','picture')}{$item->get('is_quality')}.gif" alt='{__("user_`$item->get("is_quality")`")}'/></a>
                                 {else}
                                    <img  src="{url('/icons/','picture')}{$item->get('is_document')}.gif" alt='{__("user_`$item->get("is_document")`")}'/>
                                  {/if}
                              </td>
                              {/if}
                       {/if}

                       {if $formFilter->equal->hasValidator('created_by_id')}  
                           {if $formFilter->hasColumn('creator')}
                           <td class="CustomerContracts cols creator">
                                {if $item->hasCreatorUser()}
                                    {$item->getCreatorUser()|upper}
                                {else}
                                    {__('---')}
                                {/if}    
                           </td>
                           {/if}
                       {/if}
                        {component name="/customers_contracts_master/ItemsContractPager" item=$item}
                       
                          
                            {if $formFilter->hasColumn('company_id')}
                         <td class="CustomerContracts cols company_id">{* company_id *}
                             {if $item->hasCompany()}
                               {$item->getCompany()->get('name')}
                               {else}
                                  {__('---')}
                             {/if}      
                         </td>
                         {/if}
                           {if $user->hasCredential([['superadmin','admin','contract_list_status']]) && $formFilter->equal->hasValidator('status')}
                               {if $formFilter->hasColumn('status')}
                                   <td class="CustomerContracts cols Status status" id="{$item->get('id')}">
                                    {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_status']])}
                                           {__($item->get('status'))}
                                     {else}
                                       {__('---')}
                                   {/if}
                               </td>
                               {/if}
                           {/if}
                           {if $formFilter->hasColumn('actions')}
                           <td class="CustomerContracts cols actions">      
                           {if $item->isAuthorized() || $user->hasCredential([['contract_list_view_actions']])}
                               <div class="dropdown dropdown-contracts">
                                       <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">....</button>
                                       <div class="dropdown-menu">

                                {if $user->hasCredential([['superadmin','contracts_confirmation']])}
                                   {if $item->isConfirmed()}
                                         {if $user->hasCredential([['superadmin','admin','contract_list_unconfirmed']])}
                                                           <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Click to cancel confirmation')}" class="dropdown-item CustomerContracts-Confirm CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}" name="Cancel">
                                                   <img class="CustomerContracts-Confirm-img" id="{$item->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Confirmed")}'/>
                                                          {__('Click to cancel confirmation')}
                                               </a>
                                         {else}
                                                        <span class="dropdown-item">                                
                                                   <img class="CustomerContracts-Confirm-img" id="{$item->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Confirmed")}'/>
                                                           {__("Confirmed")}
                                                        </span>                            
                                         {/if}    
                                   {else}
                                       {if $user->hasCredential([['superadmin','admin','contract_list_confirmed']])}
                                                           <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Click to confirm')}" class="dropdown-item CustomerContracts-Confirm CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}" name="Confirm">
                                                   <img class="CustomerContracts-Confirm-img" id="{$item->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/>
                                                           {__('Click to confirm')}
                                               </a>  
                                       {else}
                                                       <span class="action-item">
                                                           <img class="CustomerContracts-Confirm-img dropdown-item" id="{$item->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/>
                                                           {__("Refused")}
                                                       </span>
                                       {/if}    
                                   {/if}
                               {/if}
                               {if $user->hasCredential([['superadmin','admin','contract_list_cancel']])}
                                                   <a href="#" title="{if $item->isCancel()}{__('Click to remove cancellation')}{elseif $item->isUnCancel()}{__('Click to cancel')}{else}{__('Cancel')}{/if}" class="dropdown-item CustomerContractActions CustomerContracts-Cancel {if $item->isCancel()}UnCancel{elseif $item->isUnCancel()}Cancel{else}Cancel{/if} {if $item->isHold()}Hold{/if}" {if $item->isCancel() || $item->isUnCancel()}style="{if $item->isHold()}opacity:0.3;{/if}color:{if $item->isCancel()}#ff0000{else}#00ff00{/if}"{/if} id="{$item->get('id')}" name="{$item->getCustomer()|upper}">                                
                                                   <i style="font-size: 18px;" class="fa fa-ban"/>
                                                       {if $item->isCancel()}{__('Click to remove cancellation')}{elseif $item->isUnCancel()}{__('Click to cancel')}{else}{__('Cancel')}{/if}
                                       </a>
                               {/if}
                               {if $user->hasCredential([['superadmin','admin','contract_list_blowing']])}
                                                   <a href="#" title="{if $item->isBlowing()}{__('Click to remove blowing')}{elseif $item->isUnBlowing()}{__('Click to set blowing')}{else}{__('Blowing')}{/if}" class="dropdown-item CustomerContractActions CustomerContracts-Blowing {if $item->isBlowing()}UnBlowing{elseif $item->isUnBlowing()}Blowing{else}Blowing{/if} {if $item->isHold()}Hold{/if}" {if $item->isBlowing() || $item->isUnBlowing()}style="color:{if $item->isBlowing()}#ff0000{else}#00ff00{/if}"{/if} id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                               <span style="font-weight: bold;font-size:18px;{if $item->isHold()}opacity:0.3;{/if}">S</span>
                                               {if $item->isBlowing()}{__('Click to remove blowing')}{elseif $item->isUnBlowing()}{__('Click to set blowing')}{else}{__('Blowing')}{/if}</span>
                                       </a>
                               {/if}

                               {if $user->hasCredential([['superadmin','admin','contract_list_placement']])}
                                                   <a href="#" title="{if $item->isPlacement()}{__('Click to remove placement')}{elseif $item->isUnPlacement()}{__('Click to set placement')}{else}{__('Placement')}{/if}" class="dropdown-item CustomerContractActions CustomerContracts-Placement {if $item->isPlacement()}UnPlacement{elseif $item->isUnPlacement()}Placement{else}Placement{/if} {if $item->isHold()}Hold{/if}" {if $item->isPlacement() || $item->isUnPlacement()}style="color:{if $item->isPlacement()}#ff0000{else}#00ff00{/if}"{/if} id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                               <span style="font-weight: bold;font-size:18px;{if $item->isHold()}opacity:0.3;{/if}">P</span>
                                               {if $item->isPlacement()}{__('Click to remove placement')}{elseif $item->isUnPlacement()}{__('Click to set placement')}{else}{__('Placement')}{/if}</span>
                                       </a>
                               {/if}
                               {if $user->hasCredential([['superadmin','admin','contract_modify','contract_view']])}
                                                   <a href="#" title="{__('edit')}" class="dropdown-item CustomerContracts-View" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                                <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/>
                                                       {__('edit')}
                                       </a>
                               {/if}    

                             {*  <a href="#" title="{__('edit')}" class="CustomerContracts-Product" id="{$item->get('id')}">
                                    <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a> *}
                             {*  <a href="#" title="{__('contributor')}" class="CustomerContracts-Contributor" id="{$item->get('id')}">
                                    <img  src="{url('/icons/settings.gif','picture')}" alt='{__("edit")}'/></a>  *}
                               {if $user->hasCredential([['superadmin','admin','contract_customer_sms_send']])}
                                                   <a href="#" title="{__('Send SMS')}" class="dropdown-item CustomerContracts-Sms" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                               <img  src="{url('/icons/sms16x16.png','picture')}" alt='{__("Send SMS")}'/>
                                                       {__('Send SMS')}
                                       </a>
                               {/if}    

                               {if $user->hasCredential([['superadmin','admin','contract_customer_email_send']])}
                                                   <a href="#" title="{__('Send Email')}" class="dropdown-item CustomerContracts-Email" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                                       <img  src="{url('/icons/email16x16.png','picture')}" alt='{__("Send Email")}'/>
                                                       {__('Send Email')}
                                       </a>
                               {/if}
                               {if $user->hasCredential([['superadmin','admin','contract_list_new_contract_comment']])}
                                                   <a href="#" title="{__('New comment for contract ')}" class="dropdown-item CustomerContracts-ContractComment" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                               <img  src="{url('/icons/comment16x16.png','picture')}" alt='{__("New comment for contract")}'/>
                                                       {__('New comment for contract ')}
                                       </a>
                               {/if}
                                {if !$item->isHold() && $user->hasCredential([['superadmin','admin','app_domoprime_contract_list_premeeting_document']])}  
                                   {if $item->hasPolluter()}
                                                   <a target="_blank" class="dropdown-item" href="{url_to('app_domoprime',['action'=>'ExportPolluterPreMeetingDocumentPdf'])}?Contract={$item->get('id')}" title="{__('Pre Meeting Document')}" id="{$item->get('id')}">
                                                   <i class="fa fa-file-o" style="font-size: 18px;"/>
                                                           {__('Pre Meeting Polluter Document')}
                                           </a>  
                                       {else}                    
                                                       <a target="_blank" class="dropdown-item" href="{url_to('app_domoprime',['action'=>'ExportPreMeetingDocumentPdf'])}?Contract={$item->get('id')}" title="{__('Pre Meeting Document')}" id="{$item->get('id')}">
                                               <i class="fa fa-file-o" style="font-size: 18px;"/>
                                                       {__('Pre Meeting Document')}
                                       </a>  
                               {/if}
                               {/if}
                               {component name="/app_domoprime/linkForGenerateDocumentsForContract" contract=$item}                                                      
                               {component name="/app_domoprime_yousign/linkForDocumentsClassForContract" contract=$item}    
                               {component name="/app_domoprime_yousign/linkForEvidencedDocumentsForContract" contract=$item}  
                               {component name="/app_domoprime_yousign/linkForDocumentForContract" contract=$item}
                               {component name="/app_domoprime_yousign/linkForDocumentsForContract" contract=$item}
                               {component name="/app_domoprime_iso/linkForDocumentForContract" contract=$item}
                               {component name="/app_domoprime_iso/linkForGenerateDocumentsForContract" contract=$item}
                               {component name="/app_domoprime/linkForDocumentsClassForContract" contract=$item}

                               {if $user->hasCredential([['superadmin','admin','contract_documents_form_list']])}
                                               <a href="#" title="{__('Documents')}" class="dropdown-item CustomerContracts-DocumentsForm" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                      <img height="16px" src="{url('/icons/doc-green-32x32.png','picture')}" alt='{__("Documents")}'/>
                                               {__('Documents')}
                                   </a>  
                               {/if}
                                {component name="/app_domoprime_iso/linkForGenerateCalculationForContract" contract=$item}          

                                 {if $user->hasCredential([['superadmin','admin','domoprime_contract_generate']])}
                                           <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Generate Cumac')}" class="dropdown-item Domoprime-Contract-Generate-Cumac CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                               <img height="16px" src="{url('/icons/calculate_green_16x16.png','picture')}" alt='{__("Generate Cumac")}'/>
                                               {__('Generate Cumac')}
                                       </a>
                               {/if}
                                {if $user->hasCredential([['superadmin','admin','contract_billings']])}  
                                   {component name="/customers_contracts_billing/action" contract=$item}
                                {/if}    
                               {if $user->hasCredential([['superadmin','admin','contract_one_exportKml']])}
                                           <a href="{url_to('customers_contracts',['action'=>'ExportKMLContract'])}?contract={$item->get('id')}" class="dropdown-item" title="{__('Export Kml')}">
                                           <img  src="{url('/icons/files/kml.gif','picture')}" alt='{__("Export Kml")}'/>
                                                   {__('Export Kml')}
                                   </a>
                               {/if}
                               {if $user->hasCredential([['superadmin','admin','contract_list_document_export_pdf']])}
                               {component name="/customers_contracts_documents/ExportPdfContractLink" item=$item}
                               {/if}
                               {if $item->number_of_installers==1 && $user->hasCredential([['superadmin','admin']])}
                                   {*---------

                                       ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬ ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚  faire

                                   -------*}
                                   {component name="/products_installer_schedule_document/PdfLink" contract=$item}                  
                               {/if}    

                                {if $user->hasCredential([['superadmin','admin','contract_create_default_products']])}
                                                   <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Create default products')}" class="dropdown-item CustomerContracts-CreateDefaultProducts CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}">
                                               <img  height="16px" width="16px" src="{url('/icons/item16x16.png','picture')}" alt='{__("Create default products")}'/>
                                                       {__('Create default products')}
                                       </a>
                               {/if}

                                {if $user->hasCredential([['superadmin','contract_hold']])}                    
                                   {if $item->isHold()}
                                        {if $user->hasCredential([['superadmin','admin','contract_list_unhold']])}
                                                       <a href="#" title="{__('Click to unhold')}" class="dropdown-item CustomerContracts-Hold" id="{$item->get('id')}" name="Free">
                                                       <img height="16px" class="CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/hold32x32.png','picture')}" alt='{__("Free")}'/>
                                                           {__('Click to unhold')}
                                               </a>
                                        {else}
                                                       <span class="dropdown-item">
                                                   <img height="16px" class="CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/hold32x32.png','picture')}" alt='{__("Free")}'/>
                                                           {__("Free")}
                                                       </span>
                                        {/if}    
                                   {else}
                                        {if $user->hasCredential([['superadmin','admin','contract_list_hold']])}
                                                           <a href="#" title="{__('Click to hold')}" class="dropdown-item CustomerContracts-Hold" id="{$item->get('id')}" name="Hold">
                                                   <img height="16px" class="CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/unhold32x32.png','picture')}" alt='{__("Hold")}'/>
                                                               {__('Click to hold')}
                                               </a>  
                                       {else}
                                                       <span class="dropdown-item">
                                                           <img height="16px" class="dropdown-item CustomerContracts-Hold-img" id="{$item->get('id')}" src="{url('/icons/unhold32x32.png','picture')}" alt='{__("Hold")}'/>    
                                                           {__("Hold")}
                                                       </span>
                                       {/if}    
                                   {/if}
                               {/if}

                                {if $user->hasCredential([['superadmin','contract_hold_quote']])}                              
                                   {if $item->isHoldQuote()}
                                        {if $user->hasCredential([['superadmin','contract_list_unhold_quote']])}
                                                       <a href="#" title="{__('Click to unhold')}" class="dropdown-item CustomerContracts-HoldQuote" id="{$item->get('id')}" name="Free">
                                                      <i style="color:blue" class="CustomerContracts-HoldQuote-img fa fa-lock" id="{$item->get('id')}"></i>
                                                           {__('Click to unhold')}
                                               </a>
                                        {else}
                                                       <div class="dropdown-item">
                                                   <i style="color:blue" class="CustomerContracts-HoldQuote-img fa fa-lock" id="{$item->get('id')}"></i>
                                                           {__("Free")}
                                               </div>
                                        {/if}    
                                   {else}
                                        {if $user->hasCredential([['superadmin','contract_list_hold_quote']])}
                                                           <a href="#" title="{__('Click to hold')}" class="dropdown-item CustomerContracts-HoldQuote" id="{$item->get('id')}" name="Hold">
                                                   <i style="color:blue" class="CustomerContracts-HoldQuote-img fa fa-unlock" id="{$item->get('id')}"></i>
                                                               {__('Click to hold')}
                                               </a>  
                                       {else}
                                                       <div class="dropdown-item">
                                                           <i style="color:blue" class="dropdown-item CustomerContracts-HoldQuote-img fa fa-unlock" id="{$item->get('id')}"></i>
                                                           {__("Hold")}
                                               </div>
                                       {/if}    
                                   {/if}                    
                               {/if}                
                               {if $user->hasCredential([['superadmin','contract_copy']])}
                                                   <a href="#" title="{__('Copy')}" class="dropdown-item CustomerContracts-copy" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
                                               <i class="fa fa-copy"/>
                                                       {__('Copy')}
                                       </a>
                               {/if}
                                {if $user->hasCredential([['superadmin','contract_hold_admin']])}                    
                                   {if $item->isHoldAdmin()}
                                        {if $user->hasCredential([['superadmin','admin','contract_list_unhold_admin']])}
                                                           <a href="#" title="{__('Click to unhold')}" class="dropdown-item CustomerContracts-Hold-Admin" id="{$item->get('id')}" name="Free">
                                                       <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/holdred32x32.png','picture')}" alt='{__("Free")}'/>
                                                               {__('Click to unhold')}
                                               </a>
                                        {else}
                                                       <div class="dropdown-item">
                                                   <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/holdred32x32.png','picture')}" alt='{__("Free")}'/>
                                                           {__("Free")}
                                               </div>
                                        {/if}    
                                   {else}
                                       {if $user->hasCredential([['superadmin','admin','contract_list_hold_admin']])}
                                                           <a href="#" title="{__('Click to hold')}" class="dropdown-item CustomerContracts-Hold-Admin" id="{$item->get('id')}" name="Hold">
                                                   <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/unholdred32x32.png','picture')}" alt='{__("Hold")}'/>
                                                               {__('Click to hold')}
                                               </a>  
                                       {else}
                                                       <div class="dropdown-item">
                                                   <img height="16px" class="CustomerContracts-Hold-Admin-img" id="{$item->get('id')}" src="{url('/icons/unholdred32x32.png','picture')}" alt='{__("Hold")}'/>    
                                                           {__("Hold")}
                                               </div>
                                       {/if}    
                                   {/if}
                               {/if}
                               {component name="/customers_contracts_master/BtnTransfer" contract=$item}
                               {component name="/customers_contracts_master/BtnSlavesTransfer" meeting=$item}
                               {component name="/app_domoprime_iso/BtnTransfer" contract=$item}
                                 {component name="/customers_communication_whats_app/customerForContractPager" contract=$item}
                               {if $user->hasCredential([['superadmin','admin','contract_delete']])}                  
                                   {if $item->get('status')=='ACTIVE'}
                                                       <a href="#" title="{__('delete')}" class="dropdown-item CustomerContracts-Status Delete" id="{$item->get('id')}"  name="{$item->getCustomer()|upper} ({format_date($item->get('created_at'),'p')})">
                                                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                                                           {__('delete')}
                                           </a>
                                   {else}
                                                       <a href="#" title="{__('Recycle')}" class="dropdown-item CustomerContracts-Status Recycle" id="{$item->get('id')}" name="{$item->getCustomer()|upper} {format_date($item->get('created_at',"p"))}">
                                                   <img  src="{url('/icons/recycling16x16.png','picture')}" alt='{__("Recycle")}'/>
                                                           {__('Recycle')}
                                           </a>    
                                   {/if}
                               {/if}                        

                                   </div>
                               </div>

                                 {else}
                                   {__('---')}
                               {/if}
                           </td>
                           {/if}
                           {if $formFilter->hasColumn('is_billable')}
                         <td class="CustomerContracts cols is_billable">{* is_billable *}
                               {__($item->get('is_billable'))}
                         </td>
                         {/if}
                           {if $user->hasCredential([['superadmin_debugXX','app_domoprime_contract_list_surface_from_forms_101','app_domoprime_iso_contract_list_surface_from_form_101']])}
                               {if $formFilter->hasColumn('surface_top')}
                               <td class="CustomerContracts cols surface_top">
                               {if $item->isAuthorized()}
                                  {if $item->hasSurfaces() && $item->getSurfaces()->hasSurfaceTop()}
                                       {$item->getSurfaces()->getSurfaceTop()->getText("#.00")}
                                  {/if}    
                                {else}
                                  {__('---')}
                               {/if}    
                               </td>
                               {/if}
                           {/if}
                        {if $user->hasCredential([['superadmin_debugXX','app_domoprime_contract_list_surface_from_forms_102','app_domoprime_iso_contract_list_surface_from_form_102']])}
                           {if $formFilter->hasColumn('surface_wall')}
                                <td class="CustomerContracts cols surface_wall">
                              {if $item->isAuthorized()}
                                  {if $item->getSurfaces()->hasSurfaceWall()}
                                       {$item->getSurfaces()->getSurfaceWall()->getText("#.00")}                  
                                  {/if}    
                                {else}
                                  {__('---')}
                              {/if}    
                           </td>
                           {/if}
                       {/if}
                        {if $user->hasCredential([['superadmin_debugXX','app_domoprime_contract_list_surface_from_forms_103','app_domoprime_iso_contract_list_surface_from_form_103']])}
                           {if $formFilter->hasColumn('surface_floor')}
                                <td class="CustomerContracts cols surface_floor">
                              {if $item->isAuthorized()}
                                  {if $item->hasSurfaces() && $item->getSurfaces()->hasSurfaceFloor()}
                                       {$item->getSurfaces()->getSurfaceFloor()->getText("#.00")}
                                  {/if}    
                                {else}
                                  {__('---')}
                              {/if}    
                           </td>
                           {/if}
                       {/if}
                       {if $user->hasCredential([['app_domoprime_iso_contract_list_surface_101']])}
                       {if $formFilter->hasColumn('surface_top')}
                           <td class="101 CustomerContracts cols surface_top">
                            {if $item->hasRequest()}
                                {$item->getRequest()->getFormatter()->getSurfaceTop()->getText()}
                            {else}
                                {__('---')}
                            {/if}    
                       </td>
                       {/if}
                       {/if}
                        {if $user->hasCredential([['superadmin_debug','app_domoprime_iso_contract_list_surface_102']])}
                           {if $formFilter->hasColumn('surface_wall')}
                                <td class="102 CustomerContracts  cols surface_wall">
                               {if $item->hasRequest()}
                                    {$item->getRequest()->getFormatter()->getSurfaceWall()->getText()}
                                {else}
                                    {__('---')}
                                {/if}
                           </td>
                           {/if}
                       {/if}
                       {if $user->hasCredential([['superadmin_debug','app_domoprime_iso_contract_list_surface_103']])}
                           {if $formFilter->hasColumn('surface_floor')}
                            <td class="103 CustomerContracts cols surface_floor">
                               {if $item->hasRequest()}
                                 {$item->getRequest()->getFormatter()->getSurfaceFloor()->getText()}  
                                {else}
                                    {__('---')}
                                {/if}  
                           </td>
                           {/if}
                       {/if}
                       {if $formFilter->hasColumn('amount')}
                         <td class="CustomerContracts cols amount">
                              <div>{format_currency($item->get('total_price_with_taxe'),$settings_contracts->get('default_currency'))}</div>
                                <div>{if $item->hasPartner()}{$item->getPartner()->get('name')}{/if}</div>
                         </td>  
                         {/if}
                   </tr>
        {/if}
  
    {/foreach}
   </tbody>
</table>
   <table id="header-fixed"></table>
    </div>
        </div>
{if !$pager->getNbItems()}
     <span>{__('No contract')}</span>
{else}
   
         <input type="checkbox" id="CustomerContracts-all" />
          {if $user->hasCredential([['superadmin','admin','contract_multiple_process']])}
          <a style="opacity:0.5" class="CustomerContracts-actions_items" href="javascript:void(0);" title="{__('Multiple update process')}" id="CustomerContracts-Multiple">
              <i class="fa fa-refresh fa-1x"></i>
          </a>        
         {/if}
          {*if $user->hasCredential([['superadmin','admin','domoprime_contract_multiple_process']])}
          <a style="opacity:0.5" class="CustomerContracts-actions_items" href="javascript:void(0);" title="{__('Multiple Cumac process')}" id="CustomerContracts-Multiple-Calculation">
              <i class="fa fa-calculator fa-1x"></i>
          </a>        
         {/if*}
          {if $user->hasCredential([['superadmin','admin','contract_multiple_batch']])}
          <a href="javascript:void(0);" title="{__('Multiple work in progress')}" id="CustomerContracts-Multiple-Batch">
              <i class="fa fa-cog fa-1x"></i>
          </a>        
         {/if}
      {*  <input type="checkbox" id="CustomerContracts-all" />
          <a style="opacity:0.5" class="CustomerContracts-actions_items" href="#" title="{__('delete')}" id="CustomerContracts-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>          *}
   
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerContracts"}

</div>
<div id="Dialog-ContractComment" title="{__('Comment')}"></div>
<style>
    
    td { 
        
        white-space:nowrap;
      position:relative !important;
    }
    .divFilter{
       height: 90vh;
       overflow: scroll;
    }    
    .AllText{
        min-width:95px;
    }
    .AllText span{
      white-space: nowrap;
        max-width: 95%;
        display: inline;
 
        text-overflow: ellipsis;
        overflow: hidden;
 
    }
    table th:hover{
    cursor: col-resize;
}
 
table th.resizing {
    cursor: col-resize;
}
</style>
<script type="text/javascript">

      $('.searchFor').keyup(function(){
	         var valThis = $(this).val().toLowerCase();
	          $('input.'+$(this).attr("id")+'[type=checkbox]').each(function(){
	              var text = $("label[for='"+$(this).attr('id')+"']").text().toLowerCase();
	              if(text.includes(valThis)){  $(this).parent().css('color', 'green'); }else{  $(this).parent().css('color', 'black');};
	         });
	      });
	      // Search clear button
	      $(".search-clear").click(function(){
	        $(".searchFor").val("");
	        $('input.'+$(this).attr("id")+'[type=checkbox]').each(function(){
	        	$(this).parent().css('color', 'black');
	        });
	  });
          
          
    {JqueryScriptsReady}
    {/JqueryScriptsReady}   
          $("#list-top-contract").show();
         $(".containerDivResp").scroll(function() {             
               localStorage.setItem("scrollingLeft", $(this).scrollLeft());               
         });
    
         var scroll = parseInt(localStorage.getItem("scrollingLeft")); 
         if (!isNaN(scroll))
         $(".containerDivResp").scrollLeft(scroll);
        
             $(function() {
    var pressed = false;
    var start = undefined;
    var startX, startWidth;
    
    $("table th").mousedown(function(e) {
        start = $(this);
        pressed = true;
        startX = e.pageX;
        startWidth = $(this).width();
        $(start).addClass("resizing");
        $(this).find("span").css('display','inline');
      /* $(this).closest("table")
        .find("tr td:nth-child(" + ($(this).index()+1) + ")")
        .children().removeClass('part');*/
    });
    
    $(document).mousemove(function(e) {
        if(pressed) {     
            $(start).css("min-width",(startWidth+(e.pageX-startX)));       
        }
    });
    
    $(document).mouseup(function() {
        if(pressed) {
           
            $(start).removeClass("resizing");    
            pressed = false;
            if(startWidth>=70){
             $(start).find("span").css('display','inline-block');
            }
             
        }
    });
  });
     
        $(".CustomerContracts.columns").click(function() {  
            if ($(this).prop("checked"))
            {
                //if($(".CustomerContracts.cols."+$(this).attr('data-id')).length<=0)
                    //updateContractsFilter();
                // else
                    $(".CustomerContracts.cols."+$(this).attr('data-id')).show();
            }
            else
                $(".CustomerContracts.cols."+$(this).attr('data-id')).hide();
        });
       
       /* $('.resize>.resizableTH').resizable({
           {*minWidth: 120px,*}
           grid: [1, 10000]
        });      
       $( ".resize>.resizableTH" ).on( "resize", function( event, ui ) {
           $(this).css('width',$(this).css('width'));
        }); */

       
        function ChangeContractState(selector,id,state)
        {                        
                if (state=='Y'|| state=='N')
                {    
                    $("."+selector+"[id="+id+"]"+" img").attr({
                        src :"{url('/icons/','picture')}"+state+".gif",
                        alt : (state=='Y'?'{__("YES")}':'{__("NO")}'),
                        title : (state=='Y'?'{__("YES")}':'{__("NO")}')
                    });
                    $("."+selector+"[id="+id+"]").attr("name",state);
                }          
        }
   
        $("#contract-view-dialog").data('loaded',true);
       
        $('.buttonSlide').click(function(){
            $('.divFilter').css('background','#fff').animate({ display:'none'});
            $('#body').toggleClass('close-slide').slideDown(2000);
        });
       
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
            $(".CustomerContracts.columns:checked").each(function() { params.filter.cols.push($(this).attr('data-id')); });
            $(".CustomerContracts.resize").each(function() {  params.filter.sizes[$(this).attr('name')] =parseInt($(this).width()); });
            {* ================ EQUAL ============================= *}
            $(".CustomerContracts-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });
            {* ================ IN ============================= *}
            $(".CustomerContracts-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   });    
            {if !$user->hasCredential([['superadmin','admin','contract_list_status']]) && !$formFilter->hasColumn('status')}
                params.filter.equal.status='{$formFilter.equal.status}';
            {/if}            
             $(".CustomerContracts.DateFilter").each(function () { params.filter[$(this).attr('name')] =$(this).prop('checked'); });
             $(".CustomerContracts.Checkbox:checked").each(function () { params.filter[$(this).attr('name')] =true; });
          //  alert("params="+params.toSource()) */
            return params;
           
        }
       
        function updateContractsFilter()
        {  
           $("#contract-view-dialog").data('loaded',false);
           $("#contract-view-dialog").remove();
           $('.resteViewClose').remove();
           return $.ajax2({ data: getContractsFilterParameters(),
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}" ,
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-site-panel-dashboard-customers-contract-base" });
        }
       
        function updateContractsFilterWithPager()
        {                        
           $("#contract-view-dialog").data('loaded',false);
           $("#contract-view-dialog").remove();  
           $('.resteViewClose').remove();
           return $.ajax2({ data: getContractsFilterParameters(),
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}?page={$pager->getPage()}",
                                 errorTarget: ".customers-contract-errors",
                                 loading: "#tab-site-dashboard-customers-contract-loading",
                                 target: "#tab-site-panel-dashboard-customers-contract-base"
                });
        }
       
{*  function updateContractsFilterWithPager()
        {                                        
           return $.ajax2({ data: getContractsFilterParameters(),
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".customers-contract-errors",
                                 loading: "#tab-site-dashboard-customers-contract-loading",
                                 target: "#tab-site-panel-dashboard-customers-contract-base" });
        } *}
       
        function updateSitePager(n)
        {
           page_active=$(".CustomerContracts-pager .CustomerContracts-active").html()?parseInt($(".CustomerContracts-pager .CustomerContracts-active").html()):1;
           records_by_page=$("[name=CustomerContracts-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerContracts-count").each(function(id) { $(this).html(start+id) }); // Update index column          
           nb_results=parseInt($("#CustomerContracts-nb_results").html())-n;
           $("#CustocolumnsmerContracts-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
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
       
        {if $user->hasCredential([['contract_list_autocomplete_city']])}  
       
        $(".CustomerContracts-search[name=city]").keyup(function() {
             if ($(this).val().length > 3)
               updateContractsFilter();
        });
       
        {/if}
       
        {if $settings_contracts->get('autocomplete_list')=='YES'}
        $(".CustomerContracts-search[name=lastname],.CustomerContracts-search[name=phone],.CustomerContracts-begin[name=postcode]").keyup(function() {
             if ($(this).val().length > 3)
              updateContractsFilter();
        });              
        {/if}
        
        
        $(".CustomerContracts-equal,[name=CustomerContracts-nbitemsbypage]").change(function() { return updateContractsFilter(); });
         
        $("#CustomerContracts-filter,#CustomerContracts-columns-filter").click(function() { return updateContractsFilter(); });

        $(".CustomerContracts-in-select[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
       
        $(".CustomerContracts-columns-all[type=checkbox]").click(function() {  $(".CustomerContracts.ColsCheck").prop('checked',$(this).prop("checked"));  });
       
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
            $('.resteViewClose').remove();
             {*if (!$("#contract-view-dialog").data('loaded'))  return ;          
            $("#contract-view-dialog").dialog( {  autoOpen: false,  height: 'auto', width:'98%',  modal: true });          
            $("#contract-view-dialog").dialog('option','title','{__('Contract: ')}'+$(this).attr('name'));
            $("#contract-view-dialog" ).on( "dialogclose", function( event, ui ) { updateContractsFilterWithPager();  } );*}        
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContract'])}",
                errorTarget: ".customers-contract-view-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                        
                target: "#resteViewContractContent",
                success: function()
                         {    
                           // $("[id^=customer-contracts-tabs-] > .ui-tabs-nav").prepend('<a href="#" class="test resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');                                                                                  
                            $("#tab-site-static-site-panel-dashboard-customers-contract-ctn").prepend('<a href="#" class=" resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');  
                               $(".reste#resteViewContract").show();                            
                             $(".reste#resteContent,.divFilter").hide();  
                             /*$("#contract-view-dialog").dialog('open');*/                            
                         }
           });
    });
   
   {if $user->hasCredential([['superadmin','admin','contract_modify','contract_view']])}  
      $(".CustomerContracts.DblClick").dblclick( function () {
            $('.resteViewClose').remove();
              {*if (!$("#contract-view-dialog").data('loaded'))  return ;          
            $("#contract-view-dialog").dialog( {  autoOpen: false,  height: 'auto', width:'98%',  modal: true });          
            $("#contract-view-dialog").dialog('option','title','{__('Contract: ')}'+$(this).attr('name'));
            $("#contract-view-dialog" ).on( "dialogclose", function( event, ui ) { updateContractsFilterWithPager();  } );       *}  
                return $.ajax2({    
                data : { Contract: $(this).attr('id').replace('CustomerContracts-','') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContract'])}",
                errorTarget: ".customers-contract-view-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                        
                target: "#resteViewContractContent",
                success: function()
                         {   
                            
                           // $("[id^=customer-contracts-tabs-] > .ui-tabs-nav").prepend('<a href="#" class="test resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');                                                       
                            $("#tab-site-static-site-panel-dashboard-customers-contract-ctn").prepend('<a href="#" class=" resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');                                                
                             $(".reste#resteViewContract").show();                            
                             $(".reste#resteContent,.divFilter").hide();                            
                             /*$("#contract-view-dialog").dialog('open');    */                        
                         }
           });
    });
    {/if}
   
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
       
      $(".CustomerContracts-Status").click( function () {  
            if (!$(this).hasClass('Delete'))
                return ;          
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
                                 $(".CustomerContracts-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                
                                 $(".CustomerContracts-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                 $(".CustomerContracts.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                 $(".CustomerContracts-Status[id="+resp.id+"] img").attr({ alt:"{__('Recycle')}",src: "{url('/icons/recycling16x16.png','picture')}" });
                             }    
                         }
           });
       });
       
        $(".CustomerContracts-Status").click( function () {    
            if (!$(this).hasClass('Recycle'))
                return ;
            if (!confirm('{__("Contract \"#0#\" will be recycled. Confirm ?")}'.format(this.name))) return false;
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'RecycleContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                             if (resp.action=='RecycleContract')
                             {
                                  $(".CustomerContracts-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                
                                  $(".CustomerContracts-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                  $(".CustomerContracts.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                  $(".CustomerContracts-Status[id="+resp.id+"] img").attr({ alt:"{__('Delete')}",src: "{url('/icons/delete.gif','picture')}" });
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
   
     $("#CustomerContracts-New").click( function () {
            $('.resteViewClose').remove();
                {* if (!$("#contract-view-dialog").data('loaded'))  return ;      
            $("#contract-view-dialog").dialog( {  autoOpen: false,  height: 'auto', width:'98%',  modal: true });          
            $("#contract-view-dialog").dialog('option','title','{__('New')}');
            $("#contract-view-dialog" ).on( "dialogclose", function( event, ui ) { updateContractsFilterWithPager(); } );*}
            return $.ajax2({                
                    url: "{url_to('customers_contracts_ajax',['action'=>'NewContract'])}",
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",                            
                    target: "#resteViewContractContent",
                    success: function()
                         {  
                            
                             //$("[id^=customer-contracts-tabs] > .ui-tabs-nav").prepend('<a href="#" class="test resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');                                                                                                            
                             /*$("#contract-view-dialog").dialog('open');         */  
                             $("#tab-site-static-site-panel-dashboard-customers-contract-ctn").prepend('<a href="#" class="resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');  
                             $(".reste#resteViewContract").show();                            
                             $(".reste#resteContent,.divFilter").hide();
                         }
            });              
       });
         
   
   
     $("#site-panel-dashboard-customers-contract-static" ).off( "tabsbeforeactivate"); // Remove old events
   
      $("#site-panel-dashboard-customers-contract-static" ).on( "tabsbeforeactivate",
            function( event, ui )
            {            
                if (ui.newTab.attr('id')=='base') // Tab list is activated ?
                {                      
                   updateContractsFilterWithPager();
                }    
            }
    );
   
    {if $formFilter.search.lastname->getValue()}
       $(".CustomerContracts-search[name=lastname]").focus();  
       $(".CustomerContracts-search[name=lastname]").val($(".CustomerContracts-search[name=lastname]").val()+" ");      
       $(".CustomerContracts-search[name=lastname]").val($(".CustomerContracts-search[name=lastname]").val().trim());
    {/if}
       
    {if $formFilter.search.phone->getValue()}
       $(".CustomerContracts-search[name=phone]").focus();
       $(".CustomerContracts-search[name=phone]").val($(".CustomerContracts-search[name=phone]").val()+" ");      
       $(".CustomerContracts-search[name=phone]").val($(".CustomerContracts-search[name=phone]").val().trim());
    {/if}
       
    {if $formFilter.begin.postcode->getValue()}
       $(".CustomerContracts-begin[name=postcode]").focus();
       $(".CustomerContracts-begin[name=postcode]").val($(".CustomerContracts-begin[name=postcode]").val()+" ");      
       $(".CustomerContracts-begin[name=postcode]").val($(".CustomerContracts-begin[name=postcode]").val().trim());
    {/if}
   
    {if $formFilter.search.city->getValue()}
       $(".CustomerContracts-search[name=city]").focus();
       $(".CustomerContracts-search[name=city]").val($(".CustomerContracts-search[name=city]").val()+" ");      
       $(".CustomerContracts-search[name=city]").val($(".CustomerContracts-search[name=city]").val().trim());
    {/if}
       
     {if $user->hasCredential([['superadmin','admin','contract_billings']])}  
                    {component name="/customers_contracts_billing/actionJS" contract=$item JS=true}
     {/if}    
         
         
         
     $(".CustomerContracts-DocumentsForm").click( function () {    
            addTabField("customers-contract","document-form-"+$(this).attr('id'),$(this).attr('name')+" - {__('Documents')}");                      
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('app_domoprime_ajax',['action'=>'ListDocumentForContract'])}",                                            
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                target: "#tab-site-panel-dashboard-customers-contract-document-form-"+$(this).attr('id')
           });          
    });
   
   
     $("#CustomerContracts-Multiple").click(function(){
         var params={ MultipleContractSelection : {
                        selection : [] ,
                        token: '{mfForm::getToken('MultipleContractSelectionForm')}' }
                    };
         
         $(".CustomerContracts-selection:checked").each(function () {
           params.MultipleContractSelection.selection.push($(this).attr('id'));              
         });
         
         if ($.isEmptyObject(params.MultipleContractSelection.selection))
           return ;  
          
         hideTabField("customers-contract","base");
         addTabField("customers-contract","Multiple","{__('Multiple processes')}");        
         openTabField("customers-contract","Multiple");
         
         params.MultipleContractSelection.count=params.MultipleContractSelection.selection.length;
         return $.ajax2({   data: params,
                            url:"{url_to('customers_contracts_ajax',['action'=>'MultipleUpdateProcess'])}" ,
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-site-panel-dashboard-customers-contract-Multiple" });
    });
   
   
   
     $("#CustomerContracts-Multiple-Calculation").click(function(){
         var params={ MultipleContractSelection : {
                        selection : [] ,
                        token: '{mfForm::getToken('DomoprimeMultipleContractSelectionForm')}' }
                    };          
         $(".CustomerContracts-selection:checked").each(function () {
           params.MultipleContractSelection.selection.push($(this).attr('id'));              
         });
         if ($.isEmptyObject(params.MultipleContractSelection.selection))
           return ;  
         if (addTabField("customers-contract","multiple-calculation","{__('Cumac multiple process')}"))
         {
             openTabField("customers-contract","multiple-calculation");
         }
         params.MultipleContractSelection.count=params.MultipleContractSelection.selection.length;
         return $.ajax2({   data: params,
                            url:"{url_to('app_domoprime_ajax',['action'=>'MultipleUpdateProcess'])}" ,
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-site-panel-dashboard-customers-contract-multiple-calculation" });
    });
   
        $(".CustomerContracts-selection").click(function (){              
                $(".CustomerContracts-actions_items").css('opacity',($(".CustomerContracts-selection:checked").length?'1':'0.5'));
          });
           
          $("#CustomerContracts-all").click(function () {                
               $(".CustomerContracts-selection").prop("checked",$(this).prop("checked"));            
               $(".CustomerContracts-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
          });
         
         
     $(".Domoprime-Contract-Generate-Cumac").click(function () {
            if ($(this).hasClass('Hold'))
                return ;
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('app_domoprime_ajax',['action'=>'GenerateForContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                               
                         }
           });
     });            
     

    $( "#site-panel-dashboard-customers-contract-static" ).off( "tabsbeforeactivate"); // Remove old events
   
    $( "#site-panel-dashboard-customers-contract-static" ).on( "tabsbeforeactivate",
            function( event, ui )
            {            
                if (ui.newTab.attr('id')=='base') // Tab list is activated ?
                {                      
                   updateContractsFilterWithPager();
                }    
            }
    );
   
    $( "#site-panel-dashboard-customers-contract-static" ).off( "tabupdate"); // Remove old events
     
    $( "#site-panel-dashboard-customers-contract-static" ).on( "tabupdate",
            function( event, ui )
            {                            
               $("#dashboard-tabs").data('ajax_off',true);          
               updateContractsFilterWithPager();
            }
    );


   
    $(".Installations-Multiple-Btn").click(function () {        
                 
         var contract=$(this).attr('id');                  
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('products_installer_schedule_ajax',['action'=>'InstallersForContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                             $(".Installations-Ctn[id="+contract+"]").html(resp).show();                              
                             
                         }
           });
   
    });
   
    $(".Installations-Single-Btn").click(function () {      
       
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('products_installer_schedule_ajax',['action'=>'SendMailToInstallerForContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                             
                             
                         }
           });
   
    });
   
    $('.panel').off('mouseleave');
   
    $('.panel').on('mouseleave',function(){    $(this).hide(); $(this).addClass('DisplayOff'); });
       
     $("#CustomerContracts-GenerateCoordinatesFromFilter").click( function () {
            var params = getContractsFilterParameters();
            params.GenerateCoordinates= {   forced : $("#GenerateCoordinatesFromFilter-Force").prop("checked"),
                                            token :'{mfForm::getToken('GenerateCoordinatesFromFilterForm')}'
                                        };                                        
            return $.ajax2({                    
                data : params,
                url: "{url_to('customers_contracts_ajax',['action'=>'GenerateCoordinatesFromFilter'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                           
                         }
                });
           });
           
      {if $user->hasCredential([['superadmin','admin','contract_create_default_products']])}  
          $(".CustomerContracts-CreateDefaultProducts").click( function () {
            return $.ajax2({    
                data : { CustomerContract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'CreateDefaultProducts'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                           
                         }
                });
           });
    {/if}


     $(".CustomerContracts-ContractComment").click( function () {                            
            $("#Dialog-ContractComment").dialog( {   autoOpen: false, height: 'auto', width:'auto',  modal: true });
            $("#Dialog-ContractComment").dialog('option','title','{__('New comment for contract: ')}'+$(this).attr('name'));          
            return $.ajax2({    
                data : { Contract: $(this).attr('id'),  target: "#Dialog-ContractComment" },
                url: "{url_to('customers_contracts_comments_ajax',['action'=>'NewCommentFromList'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",                            
                target: "#Dialog-ContractComment",
                success: function()
                         {                                                        
                             $("#Dialog-ContractComment").dialog('open');                            
                         }
           });
    });
   
   
      $(".CustomerContracts-Confirm").click( function () {          
            if ($(this).hasClass('Hold'))
                return ;          
            if ($(this).attr('name')=='Confirm')
            {
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                   url: "{url_to('customers_contracts_ajax',['action'=>'ConfirmContract'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='ConfirmContract')
                                {    
                                      {if $user->hasCredential([['superadmin','admin','contract_list_unconfirmed']])}
                                      $(".CustomerContracts-Confirm[id="+resp.id+"]").attr({ name:"Cancel", title: "{__('Click to cancel confirmation')}" });                                                                                                                                                  
                                      $(".CustomerContracts-Confirm-img[id="+resp.id+"]").attr({
                                              src: "{url('/icons/approved16x16.png','picture')}",
                                              alt: "{__('Cancel')}"
                                      });
                                      $(".CustomerContracts.is_confirmed[id="+resp.id+"]").html('{__('Confirmed')}');
                                      {else}                                        
                                       $(".CustomerContracts-Confirm[id="+resp.id+"]").replaceWith('<img src="{url('/icons/approved16x16.png','picture')}" alt="{__("Confirmed")}"/>');
                                       $(".CustomerContracts.is_confirmed[id="+resp.id+"]").html('{__('Confirmed')}');                                      
                                      {/if}  
                                      {if $user->hasCredential([['contract_list_confirmed_color']])}
                                       $(".CustomerContracts[id=CustomerContracts-"+resp.id+"]").addClass("ConfirmedContract").removeClass("list");
                                      {/if}    
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                }
                             }
                 });
            }    
            else
            {
                return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                     url: "{url_to('customers_contracts_ajax',['action'=>'UnconfirmContract'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='UnconfirmContract')
                                {                              
                                      {if $user->hasCredential([['superadmin','admin','contract_list_confirmed']])}
                                        $(".CustomerContracts-Confirm[id="+resp.id+"]").attr({ name: "Confirm", title: "{__('Click to confirm')}" });                                    
                                        $(".CustomerContracts-Confirm-img[id="+resp.id+"]").attr({
                                                src: "{url('/icons/refused16x16.png','picture')}",
                                                alt: "{__('Confirm')}"
                                        });                                          
                                        $(".CustomerContracts.is_confirmed[id="+resp.id+"]").html('{__('Not confirmed')}');
                                      {else}
                                          $(".CustomerContracts.is_confirmed[id="+resp.id+"]").html('{__('Not confirmed')}');
                                          $(".CustomerContracts-Confirm[id="+resp.id+"]").replaceWith('<img src="{url('/icons/refused16x16.png','picture')}" alt="{__("Refused")}"/>');
                                      {/if}  
                                       {if $user->hasCredential([['contract_list_confirmed_color']])}
                                       $(".CustomerContracts[id=CustomerContracts-"+resp.id+"]").addClass("ConfirmedContract").removeClass("list");
                                      {/if}
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                }
                             }
                 });
            }    
         return false;          
     });
     
     
     
     
      $(".CustomerContracts-Hold").click( function () {  
            if ($(this).attr('name')=='Hold')
            {        
                {if $user->hasCredential([['superadmin','admin','contract_list_hold']])}
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                   url: "{url_to('customers_contracts_ajax',['action'=>'HoldContract'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='HoldContract')
                                {                                        
                                      $(".CustomerContracts-Hold[id="+resp.id+"]").attr({ name:"Unhold", title: "{__('Click to unhold')}" });
                                      $(".CustomerContracts-Hold-img[id="+resp.id+"]").attr({
                                              src: "{url('/icons/hold32x32.png','picture')}",
                                              alt: "{__('Free')}"
                                      });                                      
                                       $(".CustomerContractHold[id="+resp.id+"]").html('{__('YES')}');
                                       $(".CustomerContractActions[id="+resp.id+"]").css('opacity',0.3);
                                       $(".CustomerContractActions[id="+resp.id+"]").addClass('Hold');  
                                       $(".CustomerContracts-Hold-Field-img[id="+resp.id+"]").show();
                                }
                             }
                 });      
                 {/if}
            }    
            else
            {
            {if $user->hasCredential([['superadmin','admin','contract_list_unhold']])}
                return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'FreeContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='FreeContract')
                                {                                        
                                     $(".CustomerContracts-Hold[id="+resp.id+"]").attr({ name: "Hold", title: "{__('Click to hold')}" });                                    
                                      $(".CustomerContracts-Hold-img[id="+resp.id+"]").attr({
                                              src: "{url('/icons/unhold32x32.png','picture')}",
                                              alt: "{__('Hold')}"
                                      });                                        
                                      $(".CustomerContractHold[id="+resp.id+"]").html('{__('NO')}');
                                      $(".CustomerContractActions[id="+resp.id+"]").css('opacity',1);
                                      $(".CustomerContractActions[id="+resp.id+"]").removeClass('Hold');  
                                      $(".CustomerContracts-Hold-Field-img[id="+resp.id+"]").hide();
                                }
                             }
                 });
              {/if}
            }    
         return false;          
     });
     
     
      $("#CustomerContracts-Multiple-Batch").click(function(){          
         if (addTabField("customers-contract","multiple-batch","{__('Batch multiple process')}"))        
             openTabField("customers-contract","multiple-batch");                  
         return $.ajax2({    url:"{url_to('customers_contracts_ajax',['action'=>'MultipleBatchProcess'])}" ,
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-site-panel-dashboard-customers-contract-multiple-batch" });
    });
   
    $(".CustomerContracts-Cancel").click( function () {  
               if ($(this).hasClass('UnCancel'))            
                   return ;          
               if ($(this).hasClass('Hold'))            
                   return ;  
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'CancelContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='CancelContract')
                                {                                            
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                      $(".CustomerContracts-Cancel[id="+resp.id+"]").addClass('UnCancel').removeClass('Cancel');
                                      $(".CustomerContracts-Cancel[id="+resp.id+"]").css('color','#FF0000');
                                      $(".CustomerContracts-Cancel[id="+resp.id+"]").attr('title',"{__('Click to remove cancellation')}");                                    
                                      if (!resp.has_opc_at)
                                      {    
                                        $(".CustomerContractOpcAt[id="+resp.id+"]").html("{__('---')}");
                                      }
                                }
                             }
                 });              
                       
     });
     
     
     $(".CustomerContracts-Cancel").click( function () {  
               if ($(this).hasClass('Cancel'))            
                   return ;  
               if ($(this).hasClass('Hold'))            
                   return ;                
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'UnCancelContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='UnCancelContract')
                                {                                            
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                      $(".CustomerContracts-Cancel[id="+resp.id+"]").addClass('Cancel').removeClass('UnCancel');
                                      $(".CustomerContracts-Cancel[id="+resp.id+"]").css('color','#00FF00');                                    
                                      $(".CustomerContracts-Cancel[id="+resp.id+"]").attr('title',"{__('Click to cancel')}");
                                      if (!resp.has_opc_at)
                                      {    
                                        $(".CustomerContractOpcAt[id="+resp.id+"]").html("{__('---')}");
                                      }
                                }
                             }
                 });              
                       
     });
     
     
     
      $(".Partners-Single-Btn").click(function () {      
       
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('partners_communication_emails_ajax',['action'=>'SendMailToPartnerForContract'])}",
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success: function (resp)
                         {
                             
                             
                         }
           });
   
    });
   
   
   
   
     $(".CustomerContracts-Blowing").click( function () {  
               if ($(this).hasClass('UnBlowing'))            
                   return ;          
               if ($(this).hasClass('Hold'))            
                   return ;  
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'BlowingContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='BlowingContract')
                                {                                            
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                      $(".CustomerContracts-Blowing[id="+resp.id+"]").addClass('UnBlowing').removeClass('Blowing');
                                      $(".CustomerContracts-Blowing[id="+resp.id+"]").css('color','#FF0000');
                                      $(".CustomerContracts-Blowing[id="+resp.id+"]").attr('title',"{__('Click to remove blowing')}");                                                                          
                                }
                             }
                 });              
                       
     });
     
     
     $(".CustomerContracts-Blowing").click( function () {  
               if ($(this).hasClass('Blowing'))            
                   return ;  
               if ($(this).hasClass('Hold'))            
                   return ;                
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'UnBlowingContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='UnBlowingContract')
                                {                                            
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                      $(".CustomerContracts-Blowing[id="+resp.id+"]").addClass('Blowing').removeClass('UnBlowing');
                                      $(".CustomerContracts-Blowing[id="+resp.id+"]").css('color','#00FF00');                                    
                                      $(".CustomerContracts-Blowing[id="+resp.id+"]").attr('title',"{__('Click to set blowing')}");                                    
                                }
                             }
                 });              
                       
     });
     
     
      $(".CustomerContracts-Placement").click( function () {  
               if ($(this).hasClass('UnPlacement'))            
                   return ;          
               if ($(this).hasClass('Hold'))            
                   return ;  
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'PlacementContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='PlacementContract')
                                {                                            
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                      $(".CustomerContracts-Placement[id="+resp.id+"]").addClass('UnPlacement').removeClass('Placement');
                                      $(".CustomerContracts-Placement[id="+resp.id+"]").css('color','#FF0000');
                                      $(".CustomerContracts-Placement[id="+resp.id+"]").attr('title',"{__('Click to remove placement')}");                                                                          
                                }
                             }
                 });              
                       
     });
     
     
     $(".CustomerContracts-Placement").click( function () {  
               if ($(this).hasClass('Placement'))            
                   return ;  
               if ($(this).hasClass('Hold'))            
                   return ;                
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                    url: "{url_to('customers_contracts_ajax',['action'=>'UnPlacementContract'])}",              
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='UnPlacementContract')
                                {                                            
                                      $(".CustomerContracts.State.Text[id="+resp.id+"]").html(resp.state_i18n);    
                                      $(".CustomerContracts.State.color[id="+resp.id+"]").css("background-color",resp.state.color);
                                      $(".CustomerContracts-Placement[id="+resp.id+"]").addClass('Placement').removeClass('UnPlacement');
                                      $(".CustomerContracts-Placement[id="+resp.id+"]").css('color','#00FF00');                                    
                                      $(".CustomerContracts-Placement[id="+resp.id+"]").attr('title',"{__('Click to set placement')}");                                    
                                }
                             }
                 });              
                       
     });
     
     
      $(".CustomerContracts.date_sort").click(function () {
        var value=$(this).prop('checked');
        $(".date_sort").prop('checked',false);
        $(this).prop('checked',value);        
    });
   
    $(".CustomerContractsEraser").click(function () { $("#"+$(this).attr('id')).val('') });
   
   
   
    $(".CustomerContracts-Hold-Admin").click( function () {  
            if ($(this).attr('name')=='Hold')
            {              
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                   url: "{url_to('customers_contracts_ajax',['action'=>'HoldContractAdmin'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='HoldContractAdmin')
                                {                                        
                                      $(".CustomerContracts-Hold-Admin[id="+resp.id+"]").attr({ name:"Unhold", title: "{__('Click to unhold')}" });
                                      $(".CustomerContracts-Hold-Admin-img[id="+resp.id+"]").attr({
                                              src: "{url('/icons/holdred32x32.png','picture')}",
                                              alt: "{__('Free')}"
                                      });                                      
                                       $(".CustomerContractHold-Admin[id="+resp.id+"]").html('{__('YES')}');
                                     //  $(".CustomerContractActions[id="+resp.id+"]").css('opacity',0.3);
                                     //  $(".CustomerContractActions[id="+resp.id+"]").addClass('Hold');  
                                       $(".CustomerContracts-Hold-Admin-Field-img[id="+resp.id+"]").show();
                                }
                             }
                 });              
            }    
            else
            {
                return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                     url: "{url_to('customers_contracts_ajax',['action'=>'FreeContractAdmin'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='FreeContractAdmin')
                                {                                        
                                     $(".CustomerContracts-Hold-Admin[id="+resp.id+"]").attr({ name: "Hold", title: "{__('Click to hold')}" });                                    
                                      $(".CustomerContracts-Hold-Admin-img[id="+resp.id+"]").attr({
                                              src: "{url('/icons/unholdred32x32.png','picture')}",
                                              alt: "{__('Hold')}"
                                      });                                        
                                      $(".CustomerContractHold-Admin[id="+resp.id+"]").html('{__('NO')}');
                                    //  $(".CustomerContractActions[id="+resp.id+"]").css('opacity',1);
                                    //  $(".CustomerContractActions[id="+resp.id+"]").removeClass('Hold');  
                                      $(".CustomerContracts-Hold-Admin-Field-img[id="+resp.id+"]").hide();
                                }
                             }
                 });
            }    
         return false;          
     });
     
        $(".filter-btn").click(function(){
                $('.filter-content-contracts').hide(300);  
                $('.filter-content-contracts[id='+$(this).attr('id')+"]").toggle();
        });

        $("#site-panel-dashboard-customers-contract-static").click(function (e){    
            if ($(e.target).closest('.filter-content-contracts').length === 0 ) {
                if( $(e.target).closest('.filter-btn').length === 0 ){
                    $('.filter-content-contracts').hide(300);                
                }

            }
        });
       
       
           $(".CustomerContracts-copy").click( function () {    
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'CopyContract'])}",                                            
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                success : function (resp)
                        {
                             if (resp.errors)
                             {                                
                                return ;
                             }  
                             $("#tab-site-static-site-panel-dashboard-customers-contract-ctn").prepend('<a href="#" class="resteViewClose" id="resteViewContractClose" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>');  
                             $("#resteViewContractContent").html(resp);
                             $(".reste#resteViewContract").show();                            
                             $(".reste#resteContent,.divFilter").hide();                              
                        }
            });
        });
   
   
   
     $(".CustomerContracts-HoldQuote").click( function () {  
            if ($(this).attr('name')=='Hold')
            {        
                {if $user->hasCredential([['superadmin','admin','contract_list_hold_quote']])}
               return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                   url: "{url_to('customers_contracts_ajax',['action'=>'HoldQuoteContract'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='HoldQuoteContract')
                                {                                        
                                      $(".CustomerContracts-HoldQuote[id="+resp.id+"]").attr({ name:"Unhold", title: "{__('Click to unhold')}" });
                                     $(".CustomerContracts-HoldQuote-img[id="+resp.id+"]").addClass('fa-lock').removeClass('fa-unlock');                                      
                                       $(".CustomerContractHoldQuote[id="+resp.id+"]").html('{__('YES')}');
                                       $(".CustomerContractActions[id="+resp.id+"]").css('opacity',0.3);
                                       $(".CustomerContractActions[id="+resp.id+"]").addClass('Hold');  
                                       $(".CustomerContracts-HoldQuote-Field-img[id="+resp.id+"]").show();
                                }
                             }
                 });      
                 {/if}
            }    
            else
            {
            {if $user->hasCredential([['superadmin','admin','contract_list_unhold_quote']])}
                return $.ajax2({    
                    data : { Contract: $(this).attr('id') },                    
                     url: "{url_to('customers_contracts_ajax',['action'=>'FreeQuoteContract'])}",              
                 errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                    success: function (resp)
                             {
                                if (resp.action=='FreeQuoteContract')
                                {                                        
                                     $(".CustomerContracts-HoldQuote[id="+resp.id+"]").attr({ name: "Hold", title: "{__('Click to hold')}" });                                    
                                      $(".CustomerContracts-HoldQuote-img[id="+resp.id+"]").addClass('fa-unlock').removeClass('fa-lock');
                                      $(".CustomerContractHoldQuote[id="+resp.id+"]").html('{__('NO')}');
                                      $(".CustomerContractActions[id="+resp.id+"]").css('opacity',1);
                                      $(".CustomerContractActions[id="+resp.id+"]").removeClass('Hold');  
                                      $(".CustomerContracts-HoldQuote-Field-img[id="+resp.id+"]").hide();
                                }
                             }
                 });
            {/if}
            }    
         return false;          
     });
     
    $('.widthSelectWithSearch').select2({
        selectOnClose: true,
        width: '80px',
        dropdownAutoWidth:true
      });
     
      $('.widthSelectWithSearchFilter').select2({
            width: '107px',
            dropdownAutoWidth:true
      });
      $('.widthSelectWithSearchFilter2').select2({
            width: '100%',
            dropdownAutoWidth:true,
           // dropdownCssClass: "select2Filter"
      });
     
       $(".CustomerContractChangeIsDocument").click(function() {
                        return $.ajax2({
                            data : { CustomerContract: { id: $(this).attr('id') , value: $(this).attr('name'), token : '{mfForm::getToken('ChangeForm')}' } },
                            url: "{url_to('customers_contracts_ajax',['action'=>'ChangeIsDocument'])}",              
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function(resp) {
                                        if (resp.action != 'ChangeIsDocument') return ;
                                        ChangeContractState("CustomerContractChangeIsDocument",resp.id,resp.value);
                                     }
                    });
         });
         
          $(".CustomerContractChangeIsPhoto").click(function() {
                        return $.ajax2({
                            data : { CustomerContract: { id: $(this).attr('id') , value: $(this).attr('name'), token : '{mfForm::getToken('ChangeForm')}' } },
                            url: "{url_to('customers_contracts_ajax',['action'=>'ChangeIsPhoto'])}",              
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function(resp) {
                                        if (resp.action != 'ChangeIsPhoto') return ;
                                        ChangeContractState("CustomerContractChangeIsPhoto",resp.id,resp.value);
                                     }
                    });
         });
         
          $(".CustomerContractChangeIsQuality").click(function() {
                        return $.ajax2({
                            data : { CustomerContract: { id: $(this).attr('id') , value: $(this).attr('name'), token : '{mfForm::getToken('ChangeForm')}' } },
                            url: "{url_to('customers_contracts_ajax',['action'=>'ChangeIsQuality'])}",              
                            errorTarget: ".customers-contract-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function(resp) {
                                        if (resp.action != 'ChangeIsQuality') return ;
                                        ChangeContractState("CustomerContractChangeIsQuality",resp.id,resp.value);
                                     }
                    });
         });
         $(document).off('click','#resteViewContractClose');  
         $(document).on('click','#resteViewContractClose',function(){        
                $(".reste#resteViewContract").hide();
                updateContractsFilter();
                $(".reste#resteContent,.divFilter").show();              
          });
        $(".leftArrowContract").click(function () {
          var leftPos = $('.containerDivResp').scrollLeft();
          $(".containerDivResp").animate({ scrollLeft: leftPos - $(document).outerWidth() }, 800);
        });

        $(".rightArrowContract").click(function () {
          var leftPos = $('.containerDivResp').scrollLeft();
          $(".containerDivResp").animate({ scrollLeft: leftPos + $(document).outerWidth() }, 800);
        });

        $(".CustomerContracts-works-plus").click(function (){
            $(".CustomerContracts-works-content-"+$(this).attr('id')).slideToggle();
        });
       
        $('.ToggleTopPagerContract').click(function(){ $('.TopPagerContractPlus').slideToggle(500); });
        $('.ToggleCustomerPagerContract').click(function(){ $('#CustomerPagerContractPlus-'+$(this).data('id')).slideToggle(500); });
{*        $('.ToggleCustomerContractStatistics').click(function(){            
            return $.ajax2({    
                data : { Contract: $(this).attr('id') },
                url: "{url_to('app_domoprime_multi_ajax',['action'=>'StatisticsByPollutersForContracts'])}",                                            
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                target: "#CustomerContractStatistics-plus"
            });  
            //$('#CustomerContractStatistics-plus').slideToggle(500); 
        });*}
       
       
        {* ======================== Top menu fixed ======================== *}
          $('.input-list').css('top',$('#CustomerContracts-List thead .list-header').height());
          $('.ui-widget-header[id^="tab-site-static"][id$="customers-contract-ctn"]').css('top',$('#dashboard-tabs-ctn').height()+'px!important');
          $(document).scroll(function() {
               $(".divFilter").css({                  
                     "top": $(this).scrollTop() > 140 ? "33px" : "",
                     "position": $(this).scrollTop() > 140 ? "fixed" : "absolute",
                       
              });   
               var top =$('.filterContentContractsVisible').offset();
                //detect when user scroll to top and set position to relative else sets position to fixed
                $("#CustomerContracts-List thead tr th").css({
                 "z-index": "1",
                    "top": $(this).scrollTop() > 140 ? $(this).scrollTop()-($('.ui-widget-header[id^="tab-site-static"][id$="customers-contract-state-ctn"]').height()+($('#dashboard-tabs-ctn').height()+40)): "0px",
                  "position": "sticky",
                    "position": "-webkit-sticky",
                    "position": "-moz-sticky",
                    "position": "-ms-sticky",
                    "position": "-o-sticky",
                    "background-color": "#5797de",
                    "background-clip": "padding-box"      
              });    
             
               $('.filterContentContractsVisible').css({
                       "top": $('.filterContentContractsVisible').data('offset')
                });
          });
     
    $('#OnlyContract').click(function(){
            if($(this).prop("checked") == true){
                $(".CustomerContractsWithWork").show();                
                $(".itemFirstWorkQte").hide();                
            }
            else if($(this).prop("checked") == false){
                 $('.CustomerContracts.list').each(function(){
                     $(this).attr('style',$(this).data('iteration')%2==0?'background:#fff;':'background:#f5f5f5;');
                 });
                $(".CustomerContractsWithWork").hide();    
                 $(".itemFirstWorkQte").show();
            }
    });
     $(".filter-list-toggle").click(function(){
       $('.filter-list').slideToggle();
      }); 
      
      $('.CalculationForPager').hide();
      $(".ToggleCustomerCumacPagerContract").click(function(){
       $('.CalculationForPager').slideToggle();
      }); 
      
       $('th ').click(function(){
         $(this).toggleClass('AllText');
      });
      
</script>    

 {component name="/app_domoprime/javascriptForDocumentsClassForContract"}
 {component name="/app_domoprime_yousign/javascriptForDocumentsForContract"}
 {component name="/app_domoprime_iso/javascriptForDocumentForContract"}
 {component name="/app_domoprime_iso/javascriptForContractPager"}
 {component name="/app_domoprime_yousign/javascriptForDocumentForContract"}
 {component name="/app_domoprime_yousign/javascriptForDocumentsClassForContract"}
 {component name="/customers_contracts_master/javascriptForContract"}
 {component name="/customers_contracts_master/javascriptSlavesForContract"}
 {component name="/app_domoprime_yousign/javascriptForDocumentsEvidenceForContract"}
 {component name="/customers_communication_whats_app/javascriptForContractPager"}
 {component name="/partners_localization/javascriptForContractPager"}
 {component name="/partners_communication_whats_app/javascriptForContractPager"}
