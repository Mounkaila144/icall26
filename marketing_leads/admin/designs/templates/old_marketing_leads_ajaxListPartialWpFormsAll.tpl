<div class="divFilter">
    <div style="text-align: center" class="li1"><span class="buttonSlide">{*<img width="16px" height="16px" src="{url('/icons/info-btn.jpg','picture')}" title="tab">*}
        <i class="fa fa-bars fa-2x" style="color: black;"></i> </span>
    </div>
    
    <div class="filter">                
        <div class="" class="date">
            <span style="display: inline">
                {*{__('from')}*}
                De:<br>
                <input placeholder="Date début" class="MarketingLeadsWpFormsAll range inputWidth" id="created_at_from" type="text" size="6" name="created_at[from]" value="{format_date((string)$formFilter.range.created_at.from,'a')}"/>
            </span><br>
            <span>
                A:<br> {*{__('to')}*}
                <input placeholder="Date fin"  class="MarketingLeadsWpFormsAll range inputWidth" id="created_at_to" type="text" size="6" name="created_at[to]" value="{format_date((string)$formFilter.range.created_at.to,'a')}"/>
            </span><br>         
        </div><br>
        {*<div class="filter" id="state">    
            <span class="filter-btn name-filter btn-table" id="state">{__('State')}<i id="state" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="state">
                {foreach $formFilter->in.state->getOption('choices') as $key=>$state}
                    <div>
                        <input type="checkbox" class="MarketingLeadsWpFormsAll-in state" name="state" id="{$key}" {if in_array($key,(array)$formFilter.in.state->getValue())}checked="checked"{/if}/>{$state|upper} 
                    </div>    
                {/foreach}  
                <input type="checkbox" class="MarketingLeadsWpFormsAll-in-select" name="state"/>{__('Select/unselect all')}
            </div>
        </div>*}
        <div class="filter" id="state_id">    
            <span class="filter-btn name-filter btn-table" id="state_id">{__('State lead')}<i id="state_id" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="state_id">
                {foreach $formFilter->in.state_id->getOption('choices') as $key=>$state}
                    <div>
                        <input type="checkbox" class="MarketingLeadsWpFormsAll-in state_id" name="state_id" id="{$key}" {if in_array($key,(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{$state|upper} 
                    </div>    
                {/foreach}  
                <input type="checkbox" class="MarketingLeadsWpFormsAll-in-select" name="state_id"/>{__('Select/unselect all')}
            </div>
        </div>
        <div class="filter" id="campaign">    
            <span class="filter-btn name-filter btn-table" id="campaign">{__('Campaign')}<i id="campaign" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="campaign">
                {foreach $formFilter->in.campaign->getOption('choices') as $campaign}
                    <div>
                        <input type="checkbox" class="MarketingLeadsWpFormsAll-in campaign" name="campaign" id="{$campaign}" {if in_array($campaign,(array)$formFilter.in.campaign->getValue())}checked="checked"{/if}/>{$campaign|upper} 
                    </div>    
                {/foreach}  
                <input type="checkbox" class="MarketingLeadsWpFormsAll-in-select" name="campaign"/>{__('Select/unselect all')}
            </div>
        </div>
        <div class="filter" id="site_id">    
            <span class="filter-btn name-filter btn-table" id="site_id">{__('Site')}<i id="site_id" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="site_id">
                {foreach $formFilter->in.site_id->getOption('choices') as $site=>$host}
                    <div>
                        <input type="checkbox" class="MarketingLeadsWpFormsAll-in site_id" name="site_id" id="{$site}" {if in_array($site,(array)$formFilter.in.site_id->getValue())}checked="checked"{/if}/>{$host|upper} 
                    </div>    
                {/foreach}  
                <input type="checkbox" class="MarketingLeadsWpFormsAll-in-select" name="site_id"/>{__('Select/unselect all')}
            </div>
        </div>
        <div>
            {if $user->hasCredential([['superadmin','admin','wp_forms_leads_export']])} 
                <a href="{url_to('marketing_leads',['action'=>'ExportCsvWpFormsLeads'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range'])}" class="btn widthAFilter" title="{__('Export')}" target="_blank" >
                <i class="fa fa-caret-square-o-down" style="margin-right: 10px"></i>{__('Export')}</a>   
            {/if}
        </div>
        <div>
            {if $user->hasCredential([['superadmin','admin','wp_forms_leads_import']])} 
                <div>
                    {component name="/marketing_leads/importLink"}
                </div>
            {/if}
        </div>
    </div>
    <div class="filter fi">
        <button id="MarketingLeadsWpFormsAll-filter" class="btn inputWidth">{__("Filter")}</button><br>
        <button class="btn inputWidth" id="MarketingLeadsWpFormsAll-init">{__("Init")}</button>
    </div>
</div>
{* END Filter *}

<div class="reste">
{messages class="marketing-leads-errors"}
<h3>{__('List leads all')}</h3>    

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MarketingLeadsWpFormsAll"}

<div class="table">
<div class="containerDivResp">
<table class="tabl-list footable table" cellpadding="0" cellspacing="0"> 
    <thead>
        <tr class="list-header">    
            <th>#</th> 
            {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Id')}</span>
                <div>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>       
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Campaign')}</span>
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Firstname')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.firstname->getValueExist('asc','_active')}" id="asc" name="firstname"><img  src='{url("/icons/sort_asc`$formFilter.order.firstname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.firstname->getValueExist('desc','_active')}" id="desc" name="firstname"><img  src='{url("/icons/sort_desc`$formFilter.order.firstname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Lastname')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Phone')}</span>
            </th>       
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Email')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Address')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Number of people')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.number_of_people->getValueExist('asc','_active')}" id="asc" name="number_of_people"><img  src='{url("/icons/sort_asc`$formFilter.order.number_of_people->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.number_of_people->getValueExist('desc','_active')}" id="desc" name="number_of_people"><img  src='{url("/icons/sort_desc`$formFilter.order.number_of_people->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Income')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.income->getValueExist('asc','_active')}" id="asc" name="income"><img  src='{url("/icons/sort_asc`$formFilter.order.income->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.income->getValueExist('desc','_active')}" id="desc" name="income"><img  src='{url("/icons/sort_desc`$formFilter.order.income->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Owner')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Postcode')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpFormsAll-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Energy')}</span> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('City')}</span>    
            </th>
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Phone status')}</span>    
            </th>
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Duplicated')}</span>    
            </th>
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Zone')}</span> 
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Duplicate wpf')}</span>    
            </th>
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('referrer')}</span>                     
            </th>    
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('utm source')}</span>    
            </th>  
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('utm medium')}</span>    
            </th>  
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('utm campaign')}</span>    
            </th>  
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Status')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Created at')}</span>    
            </th>      
            <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
        </tr>
    </thead>
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}<td></td>{/if}
        <td>{* id *}</td>
        <td>
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="campaign" options=$formFilter->equal.campaign->getOption('choices') selected=(string)$formFilter.equal.campaign}        
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="firstname" value="{$formFilter.search.firstname}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="lastname" value="{$formFilter.search.lastname}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="phone" value="{$formFilter.search.phone}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="email" value="{$formFilter.search.email}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="address" value="{$formFilter.search.address}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="number_of_people" value="{$formFilter.search.number_of_people}"/>
        </td>
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="income" value="{$formFilter.search.income}"/>
        </td>
        <td>
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="owner" options=$formFilter->equal.owner->getOption('choices') selected=(string)$formFilter.equal.owner}
        </td>
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="postcode" value="{$formFilter.search.postcode}"/>
        </td>
        <td>
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="energy" options=$formFilter->equal.energy->getOption('choices') selected=(string)$formFilter.equal.energy}
        </td>
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="city" value="{$formFilter.search.city}"/>
        </td>
        <td>{* phone_status *}
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="phone_status" options=$formFilter->equal.phone_status->getOption('choices') selected=(string)$formFilter.equal.phone_status}
        </td>
        <td>{* is_duplicate *}
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="is_duplicate" options=$formFilter->equal.is_duplicate->getOption('choices') selected=(string)$formFilter.equal.is_duplicate}
        </td>
        <td>{* zone *}
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="zone" options=$formFilter->equal.zone->getOption('choices') selected=(string)$formFilter.equal.zone}
        </td>
        <td>{* duplicate_wpf *}            
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="duplicate_wpf" options=$formFilter->equal.duplicate_wpf->getOption('choices') selected=(string)$formFilter.equal.duplicate_wpf}
        </td>
         <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="referrer" value="{$formFilter.search.referrer}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="utm_source" value="{$formFilter.search.utm_source}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="utm_medium" value="{$formFilter.search.utm_medium}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpFormsAll-search" name="utm_campaign" value="{$formFilter.search.utm_campaign}"/>
        </td> 
        <td>
            {html_options class="MarketingLeadsWpFormsAll-equal inputWidth" name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
        </td>
        <td>{* created_at *}</td>
        <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="MarketingLeadsWpFormsAll list" id="MarketingLeadsWpFormsAll-{$item->get('id')}"> 
        <td class="MarketingLeadsWpFormsAll-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>        
                <input class="MarketingLeadsWpFormsAll-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('firstname')}"/>   
            </td>
        {/if}
        <td><span>{$item->get('id')}</span></td>
        <td> 
            {$item->getSite()->get('campaign')}
        </td>
        <td> 
            {$item->get('firstname')}
        </td>
        <td> 
            {$item->get('lastname')}
        </td>
        <td> 
            {$item->get('phone')}
        </td>
        <td> 
            {$item->get('email')}
        </td>
        <td> 
            {$item->get('address')}
        </td>
        <td> 
            {$item->get('number_of_people')}
        </td>
        <td> 
            {$item->getFormatter()->getIncome()->getAmount()}
        </td>
        <td> 
            {$item->getFormatter()->getOwner()}
        </td>
        <td> 
            {$item->get('postcode')}
        </td>
        <td> 
            {$item->getFormatter()->getEnergy()}
        </td>
        <td> 
            {$item->get('city')}
        </td>
        <td> 
           {__($item->get('phone_status'))}
        </td>
        <td> 
            {__($item->get('is_duplicate'))}
        </td>
        <td> 
            {$item->get('zone')}
        </td>
        <td> 
            {__($item->get('duplicate_wpf'))}
        </td>
        <td> 
            {$item->get('referrer')}
        </td>
        <td> 
            {$item->get('utm_source')}
        </td>
        <td> 
            {$item->get('utm_medium')}
        </td>
        <td> 
            {$item->get('utm_campaign')}
        </td>
        <td> 
            {if $item->hasStatus()}
                <div class="color" style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>
                {$item->getStatus()->getI18n()->get('value')}
            {else}
                {__('----')}
            {/if}
        </td>
        <td> 
            {$item->getFormatter()->getCreatedAt()->getDateAndTime("a","t",__("at"))}
        </td> 
        <td>
            <a href="javascript:void(0);" title="{__('Transfer to appointment')}" class="MarketingLeadsWpForms-TransferToMeeting2" id="{$item->get('id')}"><i class="fa fa-calendar fa-lg"></i></a> 
            <a href="javascript:void(0);" title="{__('Delete')}" class="MarketingLeadsWpFormsAll-Delete" id="{$item->get('id')}" name="{$item->get('lastname')}"><i class="fa fa-trash fa-lg"></i></a>
        </td>
    </tr>    
    {/foreach}    
</table> 
</div>
</div>
{if !$pager->getNbItems()}
    <span>{__('No leads')}</span>
{else}
    <input type="checkbox" id="MarketingLeadsWpFormsAll-all" /> 
    {if $user->hasCredential([['superadmin','admin','marketing_leads_multiple_process']])} 
    <a style="opacity:0.5" class="MarketingLeadsWpFormsAll-actions_items" href="javascript:void(0);" title="{__('Multiple update process')}" id="MarketingLeadsWpFormsAll-Multiple">
        <i class="fa fa-refresh"></i>
    </a>
    {/if}
    {if $user->hasCredential([['superadmin','admin','marketing_leads_multiple_transfer']])}
    <a style="opacity:0.5" class="MarketingLeadsWpFormsTransfer-actions_items" href="javascript:void(0);" title="{__('Multiple transfer process')}" id="MarketingLeadsWpFormsAll-MultipleTransfer">
        <i class="fa fa-calendar"></i>
    </a>
   {/if} 
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MarketingLeadsWpFormsAll"}
</div>
<script type="text/javascript">
    
    function changeSiteMarketingLeadsWpFormsAllIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MarketingLeadsWpFormsAll-ChangeIsActive[name="+this+"]";
            if (resp.state=='YES'||resp.state=='NO') 
            {    
                $(sel+" img").attr({
                    src :"{url('/icons/','picture')}"+resp.state+".gif",
                    alt : (resp.state=='YES'?'{__("YES")}':'{__("NO")}'),
                    title : (resp.state=='YES'?'{__("YES")}':'{__("NO")}')
                });
                $(sel).attr("id",resp.state);
            }
        });  
    }
    
    function getSiteMarketingLeadsWpFormsAllFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                range: $(".MarketingLeadsWpFormsAll.range").getFilter(),
                                equal: { 
                                    owner : $("[name=MarketingLeadsWpFormsAll-owner] option:selected").val(),
                                    energy : $("[name=MarketingLeadsWpFormsAll-energy] option:selected").val(),
                                }, 
                                in : { {foreach $formFilter->in->getFields() as $name}{$name}: [],{/foreach} },
                            nbitemsbypage: $("[name=MarketingLeadsWpFormsAll-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    }};
        if ($(".MarketingLeadsWpFormsAll-order_active").attr("name"))
            params.filter.order[$(".MarketingLeadsWpFormsAll-order_active").attr("name")] =$(".MarketingLeadsWpFormsAll-order_active").attr("id");   
        $(".MarketingLeadsWpFormsAll-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        $(".MarketingLeadsWpFormsAll-equal option:selected").each(function() { 
            params.filter.equal[$(this).parent().attr('name')] =$(this).val(); 
        });
        $(".MarketingLeadsWpFormsAll-in:checked").each( function(){  params.filter.in[this.name].push($(this).attr('id'));   });    
        return params;                  
    }
    
    function updateSiteMarketingLeadsWpFormsAllFilter()
    {  
        return $.ajax2({ data: getSiteMarketingLeadsWpFormsAllFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpFormsAll'])}", 
                        errorTarget: ".marketing-leads-errors",
                        loading: "#tab-site-dashboard-marketing-leads-loading",
                        target: "#actions-wp-forms-list-all"
                    });
    }
    
    function updateSitePager(n)
    {
        page_active=$(".MarketingLeadsWpFormsAll-pager .MarketingLeadsWpFormsAll-active").html()?parseInt($(".MarketingLeadsWpFormsAll-pager .MarketingLeadsWpFormsAll-active").html()):1;
        records_by_page=$("[name=MarketingLeadsWpFormsAll-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MarketingLeadsWpFormsAll-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MarketingLeadsWpFormsAll-nb_results").html())-n;
        $("#MarketingLeadsWpFormsAll-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MarketingLeadsWpFormsAll-end_result").html($(".MarketingLeadsWpFormsAll-count:last").html());
    }
    
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $('.filter').mouseleave( function() { $('.filter-content').hide();} );
    
    $("#MarketingLeadsWpFormsAll-init").click(function() {   
        $.ajax2({
                url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpFormsAll'])}",
                errorTarget: ".marketing-leads-errors",
                loading: "#tab-site-dashboard-marketing-leads-loading",                         
                target: "#actions-wp-forms-list-all"}); 
    }); 
    
    $('.MarketingLeadsWpFormsAll-order').click(function() {
        $(".MarketingLeadsWpFormsAll-order_active").attr('class','MarketingLeadsWpFormsAll-order');
        $(this).attr('class','MarketingLeadsWpFormsAll-order_active');
        return updateSiteMarketingLeadsWpFormsAllFilter();
    });
           
    $(".MarketingLeadsWpFormsAll-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMarketingLeadsWpFormsAllFilter();
    });
            
    $("#MarketingLeadsWpFormsAll-filter").click(function() { return updateSiteMarketingLeadsWpFormsAllFilter(); }); 

    $("[name=MarketingLeadsWpFormsAll-nbitemsbypage]").change(function() { return updateSiteMarketingLeadsWpFormsAllFilter(); }); 

    $(".MarketingLeadsWpFormsAll-equal").change(function() { return updateSiteMarketingLeadsWpFormsAllFilter(); }); 

    $(".MarketingLeadsWpFormsAll-pager").click(function () {  
        return $.ajax2({ data: getSiteMarketingLeadsWpFormsAllFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpFormsAll'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".marketing-leads-errors",
                        loading: "#tab-site-dashboard-marketing-leads-loading",
                        target: "#actions-wp-forms-list-all"
        });
    });
    
    $(".filter-btn").click(function() {   
        $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();            
    });
    
    $(".MarketingLeadsWpFormsAll-in-select[type=checkbox]").click(function() {  $("."+$(this).attr('name')).prop('checked',$(this).prop("checked"));  });

    {* =====================  A C T I O N S =============================== *}      
    $(".MarketingLeadsWpFormsAll-Delete").click( function () { 
        if (!confirm('{__("Form \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ WpForms: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'DisabledStatusWpForms'])}",
                        errorTarget: ".marketing-leads-errors",     
                        loading: "#tab-site-dashboard-marketing-leads-loading",
                        success : function(resp) {
                            if (resp.action=='DisableWpForms')
                            {    
                                $("tr#MarketingLeadsWpFormsAll-"+resp.id).remove();  
                                if ($('.MarketingLeadsWpFormsAll').length==0)
                                    return $.ajax2({ 
                                                    url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}",
                                                    errorTarget: ".wp-forms-all-errors",
                                                    target: "#actions-wp-forms-list-all"
                                                });
                                updateSitePager(1);
                            }       
                        }
            });                                        
    });
    
    var dates1 = $( "#created_at_from, #created_at_to" ).datepicker({
        onSelect: function( selectedDate ) {
            var option = this.id == "created_at_from" ? "minDate" : "maxDate",
                    instance = $( this ).data( "datepicker" ),
                    date = $.datepicker.parseDate(
                            instance.settings.dateFormat ||
                            $.datepicker._defaults.dateFormat,
                            selectedDate, instance.settings );
            dates1.not( this ).datepicker( "option", option, date );
    } } );
    
    {* =================================== MULTIPLE UPDATE ==================================== *}
    
    $("#MarketingLeadsWpFormsAll-Multiple").click(function(){ 
        var params={ MultipleMarketingLeadsSelection : { 
                       selection : [] , 
                       token: '{mfForm::getToken('MultipleMarketingLeadsSelectionForm')}' }
                   };          
        $(".MarketingLeadsWpFormsAll-selection:checked").each(function () { 
          params.MultipleMarketingLeadsSelection.selection.push($(this).attr('id'));               
        });
        if ($.isEmptyObject(params.MultipleMarketingLeadsSelection.selection))
            return ;  
        if (addTabField("marketing-leads","Multiple","{__('Multiple processes')}"))
        {
            openTabField("marketing-leads","Multiple");
        }
        params.MultipleMarketingLeadsSelection.count=params.MultipleMarketingLeadsSelection.selection.length;
        return $.ajax2({   data: params,
                           url:"{url_to('marketing_leads_ajax',['action'=>'MultipleUpdateProcess'])}",
                           errorTarget: ".marketing-leads-errors",
                           loading: "#tab-site-dashboard-marketing-leads-loading",
                           target: "#tab-site-panel-dashboard-marketing-leads-Multiple" });
    });
    
    $("#MarketingLeadsWpFormsAll-all").click(function () {                
        $(".MarketingLeadsWpFormsAll-selection").prop("checked",$(this).prop("checked"));             
        $(".MarketingLeadsWpFormsAll-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
        $(".MarketingLeadsWpFormsTransfer-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
    });
    
    $(".MarketingLeadsWpFormsAll-selection").click(function () {                           
        $(".MarketingLeadsWpFormsAll-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
        $(".MarketingLeadsWpFormsTransfer-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
    });
    
    {* ==================================== TRANSFER TO MEETING ==================================== *}
    
    $(".MarketingLeadsWpForms-TransferToMeeting2").click( function () {    
        return $.ajax2({ data : { WpForms : $(this).attr('id') },
                        url:"{url_to('marketing_leads_ajax',['action'=>'TransferToMeeting'])}",
                        errorTarget: ".marketing-leads-errors",
                        loading: "#tab-site-dashboard-marketing-leads-loading",
                        success: function(resp)
                                {
                                    
                                }
                    });
    });
    
    $("#MarketingLeadsWpFormsAll-MultipleTransfer").click(function(){ 
        var params={ MultipleMarketingLeadsSelection : { 
                       selection : [], 
                       token: '{mfForm::getToken('MultipleMarketingLeadsSelectionForm')}' }
                    };          
        $(".MarketingLeadsWpFormsAll-selection:checked").each(function () { 
            params.MultipleMarketingLeadsSelection.selection.push($(this).attr('id'));               
        });
        if ($.isEmptyObject(params.MultipleMarketingLeadsSelection.selection))
            return ;  

        params.MultipleMarketingLeadsSelection.count=params.MultipleMarketingLeadsSelection.selection.length;
        return $.ajax2({   data: params,
                           url:"{url_to('marketing_leads_ajax',['action'=>'MultipleTransferProcess'])}",
                           errorTarget: ".marketing-leads-errors",
                           loading: "#tab-site-dashboard-marketing-leads-loading",
                           target: "#actions-wp-forms-list-all"
                       });
    })
</script>    