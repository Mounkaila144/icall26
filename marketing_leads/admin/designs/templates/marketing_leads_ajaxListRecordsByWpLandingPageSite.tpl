{messages class="records-by-landing-oage-site-errors"}
<h3>{__('Records')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="MarketingLeadsRecordsByLandingPageSite-Return" title="{__('return')}" ><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MarketingLeadsRecordsByLandingPageSite"}
<button id="MarketingLeadsRecordsByLandingPageSite-filter" class="btn-table" >{__("Filter")}</button>   
<button id="MarketingLeadsRecordsByLandingPageSite-init" class="btn-table">{__("Init")}</button>

<table class="tabl-list footable table" cellpadding="0" cellspacing="0"> 
    <thead>
        <tr class="list-header">    
            <th>#</th> 
{*            {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}*}
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Id')}</span>
                <div>
                    <a href="#" class="MarketingLeadsRecordsByLandingPageSite-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsRecordsByLandingPageSite-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Nom complet')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Email')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Téléphone')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Code postal')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Energie')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Revenu')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Nombre de personnes')}</span>    
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Situation')}</span>    
            </th>     
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Doublon')}</span>    
            </th>     
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Zone')}</span>    
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
                <span>{__('Created at')}</span>    
            </th>     
  
            <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
        </tr>
    </thead> 
    <tr class="input-list">
        <td>{* # *}</td>
{*        {if $pager->getNbItems()>5}<td></td>{/if}*}
        <td>{* id *}</td>
        <td>
           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="nom_prenom" value="{$formFilter.search.nom_prenom}"/>
        </td>
        <td>
           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="email" value="{$formFilter.search.email}"/>
        </td>
        <td>
           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="tel" value="{$formFilter.search.tel}"/>
        </td>
        <td>
           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="postcode" value="{$formFilter.search.postcode}"/>
        </td>
        <td>
{*           {html_options class="MarketingLeadsRecordsByLandingPageSite-equal" name="energy" selected=$formFilter.equal.energy}*}
        </td>
        <td>
{*           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="revenu" value="{$formFilter.search.revenu}"/>*}
        </td>
        <td>
           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="nb_fiscal" value="{$formFilter.search.nb_fiscal}"/>
        </td>
        <td>
{*           <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="situation" value="{$formFilter.search.situation}"/>*}
        </td>
        <td>{* doublon *}</td>
        <td>{* zone *}</td>
        <td>
            <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="referrer" value="{$formFilter.search.referrer}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="utm_source" value="{$formFilter.search.utm_source}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="utm_medium" value="{$formFilter.search.utm_medium}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsRecordsByLandingPageSite-search" name="utm_campaign" value="{$formFilter.search.utm_campaign}"/>
        </td> 
        <td>{* created_at *}</td>
        <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="MarketingLeadsRecordsByLandingPageSite list" id="MarketingLeadsRecordsByLandingPageSite-{$item->get('id')}"> 
        <td class="MarketingLeadsRecordsByLandingPageSite-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {*{if $pager->getNbItems()>5}
            <td>        
                <input class="MarketingLeadsRecordsByLandingPageSite-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('id')}"/>   
            </td>
        {/if}*}
        <td><span>{$item->get('id')}</span></td>
        <td> 
            {$item->get('nom_prenom')}
        </td>
        <td> 
            {$item->get('email')}
        </td>
        <td> 
            {$item->get('tel')}
        </td>
        <td> 
            {$item->get('postcode')}
        </td>
        <td> 
            {$item->get('energy')}
        </td>
        <td> 
            {$item->get('revenu')}
        </td>
        <td> 
            {$item->get('nb_fiscal')}
        </td>
        <td> 
            {$item->get('situation')}
        </td>
        <td> 
            {$item->get('doublon')}
        </td>
        <td> 
            {$item->get('zone_geo')}
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
            {if $item->getFormatter()->getCreatedAt()}
                {$item->getFormatter()->getCreatedAt()->getDateAndTime("a","t",__("at"))}
            {/if}
        </td>
        <td></td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
    <span>{__('No record')}</span>
{else}

{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MarketingLeadsRecordsByLandingPageSite"}
<script type="text/javascript">
    
    function getSiteMarketingLeadsRecordsByLandingPageSiteFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    owner : $("[name=MarketingLeadsRecordsByLandingPageSite-owner] option:selected").val(),
                                    energy : $("[name=MarketingLeadsRecordsByLandingPageSite-energy] option:selected").val(),
                                },                                                                                                         
                            nbitemsbypage: $("[name=MarketingLeadsRecordsByLandingPageSite-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    }, WpLandingPageSite: {$server->get('id')} };
        if ($(".MarketingLeadsRecordsByLandingPageSite-order_active").attr("name"))
            params.filter.order[$(".MarketingLeadsRecordsByLandingPageSite-order_active").attr("name")] =$(".MarketingLeadsRecordsByLandingPageSite-order_active").attr("id");   
        $(".MarketingLeadsRecordsByLandingPageSite-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        $(".MarketingLeadsRecordsByLandingPageSite-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });
        return params;                  
    }
    
    function updateSiteMarketingLeadsRecordsByLandingPageSiteFilter()
    {  
        return $.ajax2({ data: getSiteMarketingLeadsRecordsByLandingPageSiteFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListRecordsByWpLandingPageSite'])}", 
                        errorTarget: ".records-by-landing-oage-site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
                    });
    }
    
    function updateSitePager(n)
    {
        page_active=$(".MarketingLeadsRecordsByLandingPageSite-pager .MarketingLeadsRecordsByLandingPageSite-active").html()?parseInt($(".MarketingLeadsRecordsByLandingPageSite-pager .MarketingLeadsRecordsByLandingPageSite-active").html()):1;
        records_by_page=$("[name=MarketingLeadsRecordsByLandingPageSite-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MarketingLeadsRecordsByLandingPageSite-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MarketingLeadsRecordsByLandingPageSite-nb_results").html())-n;
        $("#MarketingLeadsRecordsByLandingPageSite-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MarketingLeadsRecordsByLandingPageSite-end_result").html($(".MarketingLeadsRecordsByLandingPageSite-count:last").html());
    }
    
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MarketingLeadsRecordsByLandingPageSite-init").click(function() {   
        $.ajax2({ data: { WpLandingPageSite: {$server->get('id')} },
                url:"{url_to('marketing_leads_ajax',['action'=>'ListRecordsByWpLandingPageSite'])}",
                errorTarget: ".records-by-landing-oage-site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions-wp-landing-page-site-list"}); 
    }); 
    
    $('.MarketingLeadsRecordsByLandingPageSite-order').click(function() {
        $(".MarketingLeadsRecordsByLandingPageSite-order_active").attr('class','MarketingLeadsRecordsByLandingPageSite-order');
        $(this).attr('class','MarketingLeadsRecordsByLandingPageSite-order_active');
        return updateSiteMarketingLeadsRecordsByLandingPageSiteFilter();
    });
           
    $(".MarketingLeadsRecordsByLandingPageSite-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMarketingLeadsRecordsByLandingPageSiteFilter();
    });
            
    $("#MarketingLeadsRecordsByLandingPageSite-filter").click(function() { return updateSiteMarketingLeadsRecordsByLandingPageSiteFilter(); }); 

    $("[name=MarketingLeadsRecordsByLandingPageSite-nbitemsbypage]").change(function() { return updateSiteMarketingLeadsRecordsByLandingPageSiteFilter(); }); 

    $(".MarketingLeadsRecordsByLandingPageSite-equal").change(function() { return updateSiteMarketingLeadsRecordsByLandingPageSiteFilter(); }); 

    $(".MarketingLeadsRecordsByLandingPageSite-pager").click(function () {  
        return $.ajax2({ data: getSiteMarketingLeadsRecordsByLandingPageSiteFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListRecordsByWpLandingPageSite'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".records-by-landing-oage-site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    {* =====================  A C T I O N S =============================== *}  
    
    $("#MarketingLeadsRecordsByLandingPageSite-Return").click( function () {    
        return $.ajax2({ 
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}",
            errorTarget: ".wp-forms-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
       });
    });
    
</script>    