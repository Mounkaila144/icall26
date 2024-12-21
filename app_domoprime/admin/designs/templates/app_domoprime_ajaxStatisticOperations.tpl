{messages class="domoprime-statistic-operation-errors"}
{$formFilter.range->getError()}
<div class="divFilter">
 <div style="text-align: center" class="li1"><span class="buttonSlide">{*<img width="16px" height="16px" src="{url('/icons/info-btn.jpg','picture')}" title="tab">*}
    <i class="fa fa-bars fa-2x" style="color: black;"></i> </span></div>
    <div class="filter">
    <div class="date-filter">
    De: <br><input type="text" id="domoprime-statistic-operation-opened_at-from" class="inputWidth DomoprimeStatisticOperation range opened_at date" name="from" value="{format_date((string)$formFilter->getDateFilter('from'),'a')}"/>
    <br>
    A: <br><input type="text" id="domoprime-statistic-operation-opened_at-to" class="inputWidth DomoprimeStatisticOperation range opened_at date" name="to" value="{format_date((string)$formFilter->getDateFilter('to'),'a')}"/>
<div>
                <input type="checkbox" class="DomoprimeStatisticOperation date_sort" name="date_install"  {if $formFilter.date_install->getValue()}checked="checked"{/if}/>
                <div style="width:100px">{__('Use date of installation')}</div>                
            </div>
    </div>

<div class="date-filter fi">
    Code Postal: <br><input type="text" class="inputWidth DomoprimeStatisticOperation begin" name="postcode" value="{$formFilter.begin.postcode}"/>
</div>
    </div>
    <div class="fi filter">
{if $formFilter->in->hasValidator('telepro_id')} 
    
        <div class="filter" id="telepro">   
            <span class="filter-btn name-filter btn-table" id="telepro">{__('Telepro')}<i id="telepro" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="telepro">
            {foreach $formFilter->in.telepro_id->getOption('choices') as $telepro}
                <div>
                    <input type="checkbox" class="DomoprimeStatisticOperation-in telepro" name="telepro_id" id="{$telepro->get('id')}" {if in_array($telepro->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>{if $telepro->isLoaded()}{$telepro}{else}{__('Empty')}{/if}
                </div>    
            {/foreach}    
            <input type="checkbox" class="DomoprimeStatisticOperation-in-select" name="telepro"/>{__('Select/unselect all')}
            </div>
        </div>
            
{/if}
{* ========================= SALE 1 ======================== *}
{if $formFilter->in->hasValidator('sale_1_id')}  
        <div class="filter" id="sale_1">    
            <span class="filter-btn name-filter btn-table" id="sale_1">{__('Sale1')}<i id="sale_1" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="sale_1">
        {foreach $formFilter->in.sale_1_id->getOption('choices') as $sale}
            <div>
                 <input type="checkbox" class="DomoprimeStatisticOperation-in sale_1" name="sale_1_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_1_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
            </div>    
        {/foreach}  
          <input type="checkbox" class="DomoprimeStatisticOperation-in-select" name="sale_1"/>{__('Select/unselect all')}
          </div>
        </div>
{/if}  
{* ========================= SALE 2 ======================== *}
{if $formFilter->in->hasValidator('sale_2_id')}  
        <div class="filter" id="sale_2">    
            <span class="filter-btn name-filter btn-table" id="sale_2">{__('Sale2')}<i id="sale_2" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="sale_2">
        {foreach $formFilter->in.sale_2_id->getOption('choices') as $sale}
            <div>
                 <input type="checkbox" class="DomoprimeStatisticOperation-in sale_2" name="sale_2_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sale_2_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
            </div>    
        {/foreach}  
          <input type="checkbox" class="DomoprimeStatisticOperation-in-select" name="sale_2"/>{__('Select/unselect all')}
          </div>
        </div>
{/if} 
{* ================== TEAM =========================== *}
    {if $formFilter->in->hasValidator('team_id')}    
  <div class="filter" id="team">    
      <span class="filter-btn name-filter btn-table" id="team">{__('Team')}<i id="team" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="team">
    {foreach $formFilter->in.team_id->getOption('choices') as $team}
        <div>
             <input type="checkbox" class="DomoprimeStatisticOperation-in team" name="team_id" id="{$team->get('id')}" {if in_array($team->get('id'),(array)$formFilter.in.team_id->getValue())}checked="checked"{/if}/>{if $team->isLoaded()}{$team->get('name')}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeStatisticOperation-in-select" name="team"/>{__('Select/unselect all')}
      </div>
  </div>     
    {/if} 
{* ================== PRODUCT =========================== *}
 {* <div class="filter" id="product">    
      <span class="filter-btn name-filter btn-table" id="product">{__('Products')}<i id="product" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="product">
    {foreach $formFilter->in.product_id->getOption('choices') as $product}
        <div>           
             <input type="checkbox" class="DomoprimeStatisticOperation-in product" name="product_id" id="{$product->get('id')}" {if in_array($product->get('id'),(array)$formFilter.in.product_id->getValue())}checked="checked"{/if}/>{if $product->isLoaded()}{$product->get('meta_title')}{else}{__('Empty')}{/if}
        </div>    
    {/foreach}  
      <input type="checkbox" class="DomoprimeStatisticOperation-in-select" name="product"/>{__('Select/unselect all')}
      </div>
  </div> *}
  </div> 
<div style="clear: both"></div>
<div class="filter fi">
    <button id="DomoprimeStatisticOperation-filter" class="inputWidth btn">{__("Filter")}</button> <br> 
    <button  id="DomoprimeStatisticOperation-init" class="inputWidth btn">{__("Init")}</button> 
</div>
</div>
<div class="reste">
    <table class="tabl-list footable table">
           <thead>
               <tr class="list-header">
                    <th>{__('Status')}</th>
            <th>{__('Number of contracts')}</th>
            <th>{__('Number of operations')}</th>           
            <th colspan="4">{__('Cumacs')}</th>            
            <th colspan="4">{__('Surfaces')}</th>             
               </tr>
          <tr class="list-header">             
            <th></th>
            <th></th>
             <th></th>
            <th>{__('Total')}</th>
             <th>{__('101')}</th>
             <th>{__('102')}</th>
             <th>{__('103')}</th>
            <th>{__('Total')}</th>
             <th>{__('101')}</th>
             <th>{__('102')}</th>
             <th>{__('103')}</th>
        </tr>
           </thead>
        {foreach $formFilter->getSheet()->getRows() as $row}
            <tr class="list">
                <td>{if $row->isNull()}
                        {__('Not defined')}
                    {elseif $row->isString()}                       
                        {if $row@last}
                        <strong>{$row->get()}</strong>
                        {else}
                          {$row->get()}
                        {/if}    
                    {else}
                         {if $row->get()->get('icon')} 
                            <img src="{$row->get()->getIcon()->getURL()}" height="32" width="32" alt="{$row->get()->getI18n()}"/> 
                        {elseif $row->get()->get('color')}
                        <div class="color" style="background:{$row->get()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                        {/if}  &nbsp; 
                        <a href="#" class="DomoprimeStatisticOperationFilter" id="{$row->get()->get('id')}">{$row->get()->getI18n()}</a>
                    {/if}    
                </td>
                {foreach $row->getColumns() as $column}
                <td>
                    {if $row@last}
                        <strong>{$column}</strong>
                    {else}
                         {$column}
                    {/if}    
                </td>               
                {/foreach}
            </tr>
        {/foreach}    
    </table>
</div>
<script type="text/javascript">
    
     {JqueryScriptsReady}  
             
     {/JqueryScriptsReady}  
       $('.buttonSlide').click(function(){
            $('#body').toggleClass('close-slide');
        });
      
      var dates = $( ".DomoprimeStatisticOperation#domoprime-statistic-operation-opened_at-from, .DomoprimeStatisticOperation#domoprime-statistic-operation-opened_at-to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "domoprime-statistic-operation-opened_at-from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
               
     $(".DomoprimeStatisticOperationFilter").click(function() {          
           var params= {  filter : {$formFilter->getfilterToJson()} 
                       };                       
          params.filter.equal.state_id=$(this).attr('id');
        //  if ($(this).attr('name'))         
        //      params.filter.equal.financial_partner_id=$(this).attr('name');       
          openTab("customers-contract",true);       
          return $.ajax2({ 
                data : params,
                url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialContract'])}" ,
               //  errorTarget: ".statistics-account-errors",                  
                loading: "#tab-site-dashboard-customers-contract-loading",
                target: "#tab-site-panel-dashboard-customers-contract-base"});                        
      }); 
      
                                                             
      
      $("#DomoprimeStatisticOperation-filter").click(function() {      
            var params= { 
              filter : {    range : { opened_at : { to : $(".DomoprimeStatisticOperation.range.opened_at[name=to]").val(), 
                                                    from: $(".DomoprimeStatisticOperation.range.opened_at[name=from]").val() 
                                                  }
                                    },
                            begin : { 
                                postcode : $(".DomoprimeStatisticOperation.begin[name=postcode]").val()
                            },
                            in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },                            
                            token:'{$formFilter->getCSRFToken()}'
                       }  
        };
                        
        $(".DomoprimeStatisticOperation-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   }); 
        $(".DomoprimeStatisticOperation.date_sort").each(function () { params.filter[$(this).attr('name')] =$(this).prop('checked'); });
        return $.ajax2({ 
                data : params,
                url:"{url_to('app_domoprime_ajax',['action'=>'StatisticOperations'])}",
                errorTarget: ".domoprime-statistic-operation-errors",                  
                loading: "#tab-site-dashboard-statistics-app-domoprime-operation-loading",
                target: "#tab-site-panel-dashboard-statistics-app-domoprime-operation-base"}); 
                
      }); 
      
       $("#DomoprimeStatisticOperation-init").click(function() {              
        return $.ajax2({                 
                url:"{url_to('app_domoprime_ajax',['action'=>'StatisticOperations'])}",
                errorTarget: ".statistics-account-errors",                  
                loading: "#tab-site-dashboard-statistics-app-domoprime-operation-loading",
                target: "#tab-site-panel-dashboard-statistics-app-domoprime-operation-base"}); 
      }); 
      
      $(".DomoprimeStatisticOperation-Modes").click(function(){ 
        var params= { 
              filter : {    
                            range : { opened_at : { to : $(".DomoprimeStatisticOperation.range.opened_at[name=to]").val(), 
                                                    from: $(".DomoprimeStatisticOperation.range.opened_at[name=from]").val() 
                                                  }
                                    },
                            begin : { 
                                postcode : $(".DomoprimeStatisticOperation.range[name=postcode]").val()
                            },
                            in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },
                            mode: $(this).attr('name'),
                            token:'{$formFilter->getCSRFToken()}'
                       }  
        };  
        $(".DomoprimeStatisticOperation-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   }); 
        return $.ajax2({ 
                data : params,
                url:"{url_to('app_domoprime_ajax',['action'=>'StatisticOperations'])}",
                errorTarget: ".statistics-account-errors",                  
                loading: "#tab-site-dashboard-statistics-app-domoprime-operation-loading",
                target: "#tab-site-panel-dashboard-statistics-app-domoprime-operation-base"}); 
      });
      
     
      $('.tab-account-last th,.tab-account-last td').width($(".table-td-cal th :first").width());
      
        $(".filter-btn").click(function() {   
            $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();                     
    });     
    
    $(".DomoprimeStatisticOperation-in-select[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });
    
    $('.filter').mouseleave( function() { $('.filter-content').hide();} );
       
</script>    
