{messages class="wp-forms-errors"}
<h3>{__('Liste leads')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="MarketingLeadsWpForms-New" title="{__('new lead')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New lead')}</a>   
    <a href="javascript:void(0);" class="btn" id="MarketingLeadsWpForms-Return" title="{__('return')}" ><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MarketingLeadsWpForms"}
<button id="MarketingLeadsWpForms-filter" class="btn-table" >{__("Filter")}</button>   
<button id="MarketingLeadsWpForms-init" class="btn-table">{__("Init")}</button>

<table class="tabl-list footable table" cellpadding="0" cellspacing="0"> 
    <thead>
        <tr class="list-header">    
            <th>#</th> 
{*            {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}*}
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Id')}</span>
                <div>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>       
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Firstname')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.firstname->getValueExist('asc','_active')}" id="asc" name="firstname"><img  src='{url("/icons/sort_asc`$formFilter.order.firstname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.firstname->getValueExist('desc','_active')}" id="desc" name="firstname"><img  src='{url("/icons/sort_desc`$formFilter.order.firstname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Lastname')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Phone')}</span>
            </th>       
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Email')}</span>    
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Address')}</span>    
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Number of people')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.number_of_people->getValueExist('asc','_active')}" id="asc" name="number_of_people"><img  src='{url("/icons/sort_asc`$formFilter.order.number_of_people->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.number_of_people->getValueExist('desc','_active')}" id="desc" name="number_of_people"><img  src='{url("/icons/sort_desc`$formFilter.order.number_of_people->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Income')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.income->getValueExist('asc','_active')}" id="asc" name="income"><img  src='{url("/icons/sort_asc`$formFilter.order.income->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.income->getValueExist('desc','_active')}" id="desc" name="income"><img  src='{url("/icons/sort_desc`$formFilter.order.income->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Owner')}</span>    
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Postcode')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpForms-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Energy')}</span> 
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('City')}</span>    
            </th>      
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Phone status')}</span>    
            </th>      
            <th class="footable-first-column" data-toggle="true">
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
                <div>
                    <a href="#" class="CustomerMarketingLeadsWpForms-order{$formFilter.order.referrer->getValueExist('asc','_active')}" id="asc" name="referrer"><img  src='{url("/icons/sort_asc`$formFilter.order.referrer->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="CustomerMarketingLeadsWpForms-order{$formFilter.order.referrer->getValueExist('desc','_active')}" id="desc" name="referrer"><img  src='{url("/icons/sort_desc`$formFilter.order.referrer->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>    
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('utm_source')}</span>    
            </th>  
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('utm_medium')}</span>    
            </th>  
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('utm_campaign')}</span>    
            </th>  
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Created at')}</span>    
            </th>
            <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
        </tr>
    </thead> 
    <tr class="input-list">
        <td>{* # *}</td>
{*        {if $pager->getNbItems()>5}<td></td>{/if}*}
        <td>{* id *}</td>
        <td>{* firstname *}
            <input type="text" class="MarketingLeadsWpForms-search" name="firstname" value="{$formFilter.search.firstname}"/>
        </td>  
        <td>{* lastname *}
            <input type="text" class="MarketingLeadsWpForms-search" name="lastname" value="{$formFilter.search.lastname}"/>
        </td>  
        <td>{* phone *}
            <input type="text" class="MarketingLeadsWpForms-search" name="phone" value="{$formFilter.search.phone}"/>
        </td>  
        <td>{* email *}
            <input type="text" class="MarketingLeadsWpForms-search" name="email" value="{$formFilter.search.email}"/>
        </td>  
        <td>{* address *}
            <input type="text" class="MarketingLeadsWpForms-search" name="address" value="{$formFilter.search.address}"/>
        </td>  
        <td>{* number_of_people *}
            <input type="text" class="MarketingLeadsWpForms-search" name="number_of_people" value="{$formFilter.search.number_of_people}"/>
        </td>
        <td>{* income *}
            <input type="text" class="MarketingLeadsWpForms-search" name="income" value="{$formFilter.search.income}"/>
        </td>
        <td>{* owner *}
            {html_options class="MarketingLeadsWpForms-equal" name="owner" options=$formFilter->equal.owner->getOption('choices') selected=(string)$formFilter.equal.owner}
        </td>
        <td>{* postcode *}
            <input type="text" class="MarketingLeadsWpForms-search" name="postcode" value="{$formFilter.search.postcode}"/>
        </td>
        <td>{* energy *}
            {html_options class="MarketingLeadsWpForms-equal" name="energy" options=$formFilter->equal.energy->getOption('choices') selected=(string)$formFilter.equal.energy}
        </td>
        <td>{* city *}
            <input type="text" class="MarketingLeadsWpForms-search" name="city" value="{$formFilter.search.city}"/>
        </td>
        <td>{* phone_status *}</td>
        <td>{* duplicate_wpf *}</td>
        <td>{* zone *}</td>
        <td>{* is_duplicated *}</td>
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="referrer" value="{$formFilter.search.referrer}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="utm_source" value="{$formFilter.search.utm_source}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="utm_medium" value="{$formFilter.search.utm_medium}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="utm_campaign" value="{$formFilter.search.utm_campaign}"/>
        </td>
        <td>{* created_at *}</td>
        <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="MarketingLeadsWpForms list" id="MarketingLeadsWpForms-{$item->get('id')}"> 
        <td class="MarketingLeadsWpForms-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
       {* {if $pager->getNbItems()>5}
            <td>        
                <input class="MarketingLeadsWpForms-selection" type="checkbox" id="{$item->get('id')}" name="Impot income {$item->get('id')}"/>   
            </td>
        {/if}*}
        <td><span>{$item->get('id')}</span></td>
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
            {$item->get('duplicate_wpf')}
        </td>
        <td> 
            {$item->get('zone')}
        </td>
        <td> 
            {$item->get('is_duplicate')}
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
            {$item->getFormatter()->getCreatedAt()->getDateAndTime("a","t",__("at"))}
        </td> 
        <td> 
            <a href="javascript:void(0);" title="{__('edit')}" class="MarketingLeadsWpForms-View" id="{$item->get('id')}"><i class="fa fa-edit fa-lg"></i></a> 
{*            <a href="javascript:void(0);" title="{__('transfer to appointment')}" class="MarketingLeadsWpForms-TransferToMeeting" id="{$item->get('id')}"><i class="fa fa-flask fa-lg"></i></a> *}
            <a href="javascript:void(0);" title="{__('Delete')}" class="MarketingLeadsWpForms-Delete" id="{$item->get('id')}" name="{$item->get('lastname')}"><i class="fa fa-trash fa-lg"></i></a>
        </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
    <span>{__('No forms')}</span>
{else}
    {*{if $pager->getNbItems()>5}
        <input type="checkbox" id="MarketingLeadsWpForms-all" /> 
        <a style="opacity:0.5" class="MarketingLeadsWpForms-actions_items" href="#" title="{__('delete')}" id="MarketingLeadsWpForms-Delete"> <i class="fa fa-trash"></i>        </a>         
    {/if}*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MarketingLeadsWpForms"}
<script type="text/javascript">
 
    function changeSiteMarketingLeadsWpFormsIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MarketingLeadsWpForms-ChangeIsActive[name="+this+"]";
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
    
    function getSiteMarketingLeadsWpFormsFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    owner : $("[name=MarketingLeadsWpForms-owner] option:selected").val(),
                                    energy : $("[name=MarketingLeadsWpForms-energy] option:selected").val(),
                                },                                                                                                         
                            nbitemsbypage: $("[name=MarketingLeadsWpForms-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    }, WpLandingPageSite: {$landing_page_site->get('id')} };
        if ($(".MarketingLeadsWpForms-order_active").attr("name"))
            params.filter.order[$(".MarketingLeadsWpForms-order_active").attr("name")] =$(".MarketingLeadsWpForms-order_active").attr("id");   
        $(".MarketingLeadsWpForms-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        $(".MarketingLeadsWpForms-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });
        return params;                  
    }
    
    function updateSiteMarketingLeadsWpFormsFilter()
    {  
        return $.ajax2({ data: getSiteMarketingLeadsWpFormsFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}", 
                        errorTarget: ".wp-forms-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
                    });
    }
    
    function updateSitePager(n)
    {
        page_active=$(".MarketingLeadsWpForms-pager .MarketingLeadsWpForms-active").html()?parseInt($(".MarketingLeadsWpForms-pager .MarketingLeadsWpForms-active").html()):1;
        records_by_page=$("[name=MarketingLeadsWpForms-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MarketingLeadsWpForms-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MarketingLeadsWpForms-nb_results").html())-n;
        $("#MarketingLeadsWpForms-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MarketingLeadsWpForms-end_result").html($(".MarketingLeadsWpForms-count:last").html());
    }
    
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MarketingLeadsWpForms-init").click(function() {   
        $.ajax2({ data: { WpLandingPageSite: {$landing_page_site->get('id')} },
                url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}",
                errorTarget: ".wp-forms-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions-wp-landing-page-site-list"}); 
    }); 
    
    $('.MarketingLeadsWpForms-order').click(function() {
        $(".MarketingLeadsWpForms-order_active").attr('class','MarketingLeadsWpForms-order');
        $(this).attr('class','MarketingLeadsWpForms-order_active');
        return updateSiteMarketingLeadsWpFormsFilter();
    });
           
    $(".MarketingLeadsWpForms-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMarketingLeadsWpFormsFilter();
    });
            
    $("#MarketingLeadsWpForms-filter").click(function() { return updateSiteMarketingLeadsWpFormsFilter(); }); 

    $("[name=MarketingLeadsWpForms-nbitemsbypage]").change(function() { return updateSiteMarketingLeadsWpFormsFilter(); }); 

    $(".MarketingLeadsWpForms-equal").change(function() { return updateSiteMarketingLeadsWpFormsFilter(); }); 

    $(".MarketingLeadsWpForms-pager").click(function () {  
        return $.ajax2({ data: getSiteMarketingLeadsWpFormsFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".wp-forms-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    {* =====================  A C T I O N S =============================== *}  
      
    $("#MarketingLeadsWpForms-Return").click( function () {    
        return $.ajax2({ 
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}",
            errorTarget: ".wp-forms-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
       });
    });
    
    $("#MarketingLeadsWpForms-New").click( function () {    
        return $.ajax2({ 
            data: { WpLandingPageSite: {$landing_page_site->get('id')} },
            url: "{url_to('marketing_leads_ajax',['action'=>'NewWpForms'])}",
            errorTarget: ".wp-forms-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
       });
    });
    
    $(".MarketingLeadsWpForms-View").click( function () {    
        return $.ajax2({ data : { WpForms : $(this).attr('id'), WpLandingPageSite: {$landing_page_site->get('id')}},
                        url:"{url_to('marketing_leads_ajax',['action'=>'ViewWpForms'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        errorTarget: ".wp-forms-errors",
                        target: "#actions-wp-landing-page-site-list"
                    });
    }); 
               
         
    $(".MarketingLeadsWpForms-Delete").click( function () { 
        if (!confirm('{__("Form \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ WpForms: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'DisabledStatusWpForms'])}",
                        errorTarget: ".wp-forms-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='DisableWpForms')
                            {    
                                $("tr#MarketingLeadsWpForms-"+resp.id).remove();  
                                if ($('.MarketingLeadsWpForms').length==0)
                                    return $.ajax2({ data: { WpLandingPageSite: {$landing_page_site->get('id')} }, 
                                                    url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}",
                                                    errorTarget: ".wp-forms-errors",
                                                    target: "#actions-wp-landing-page-site-list"
                                                });
                                updateSitePager(1);
                            }       
                        }
            });                                        
    });
</script>    