{messages class="marketing-leads-landing-page-errors"}
<h3>{__('Landing pages sites')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="MarketingLeadsWpLandingPageSite-New" title="{__('new site')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New site')}</a>   
    <a href="javascript:void(0);" class="btn" id="MarketingLeadsWpLandingPageSite-Settings" title="{__('settings')}" ><i class="fa fa-wrench" style="margin-right:10px;"></i>{__('Settings')}</a>   
    {if $user->hasCredential([['superadmin','admin','marketings_leads_cleanup']])}
        <a href="javascript:void(0);" class="btn" id="MarketingLeadsWpLandingPageSite-CleanUp" title="{__('clean up')}" ><i class="fa fa-cogs" style="margin-right:10px;"></i>{__('Clean Up')}</a>   
    {/if}
    
</div>
<div id="test-recovery-marketing-leads"></div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MarketingLeadsWpLandingPageSite"}
<button id="MarketingLeadsWpLandingPageSite-filter" class="btn-table" >{__("Filter")}</button>
<button id="MarketingLeadsWpLandingPageSite-init" class="btn-table">{__("Init")}</button>

<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
        <tr class="list-header">    
            <th>#</th>
            {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Id')}</span>
                <div>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>       
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Campaign')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.campaign->getValueExist('asc','_active')}" id="asc" name="campaign"><img  src='{url("/icons/sort_asc`$formFilter.order.campaign->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.campaign->getValueExist('desc','_active')}" id="desc" name="campaign"><img  src='{url("/icons/sort_desc`$formFilter.order.campaign->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Host site')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.host_site->getValueExist('asc','_active')}" id="asc" name="host_site"><img  src='{url("/icons/sort_asc`$formFilter.order.host_site->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.host_site->getValueExist('desc','_active')}" id="desc" name="host_site"><img  src='{url("/icons/sort_desc`$formFilter.order.host_site->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Host db')}</span>
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('Name db')}</span>    
                <div>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.name_db->getValueExist('asc','_active')}" id="asc" name="name_db"><img  src='{url("/icons/sort_asc`$formFilter.order.name_db->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="MarketingLeadsWpLandingPageSite-order{$formFilter.order.name_db->getValueExist('desc','_active')}" id="desc" name="name_db"><img  src='{url("/icons/sort_desc`$formFilter.order.name_db->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div> 
            </th>      
            <th  class="footable-first-column" data-toggle="true">
                <span>{__('User db')}</span>
            </th>            
            <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
        </tr>
    </thead> 
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}<td></td>{/if}
        <td>{* id *}</td>
        <td>
            {html_options class="MarketingLeadsWpForms-equal inputWidth" name="campaign" options=$formFilter->equal.campaign->getOption('choices') selected=(string)$formFilter.equal.campaign}        
        </td>
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="host_site" value="{$formFilter.search.host_site}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="host_db" value="{$formFilter.search.host_db}"/>
        </td>
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="name_db" value="{$formFilter.search.name_db}"/>
        </td>  
        <td>
            <input type="text" class="MarketingLeadsWpForms-search" name="user_db" value="{$formFilter.search.user_db}"/>
        </td>
        <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="MarketingLeadsWpLandingPageSite list" id="MarketingLeadsWpLandingPageSite-{$item->get('id')}"> 
        <td class="MarketingLeadsWpLandingPageSite-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>        
                <input class="MarketingLeadsWpLandingPageSite-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('host_site')}"/>   
            </td>
        {/if}
        <td>{$item->get('id')}</td>
        <td>{$item->get('campaign')}</td>     
        <td>{$item->get('host_site')}</td>      
        <td>{$item->get('host_db')}</td>      
        <td>{$item->get('name_db')}</td>      
        <td>{$item->get('user_db')}</td>      
        <td>               
            <a href="javascript:void(0);" title="{__('edit')}" class="MarketingLeadsWpLandingPageSite-View" id="{$item->get('id')}">
                <i class="fa fa-edit fa-lg"></i></a> 
            <a href="javascript:void(0);" title="{__('list forms')}" class="MarketingLeadsWpLandingPageSite-ListForms" id="{$item->get('id')}">
                <i class="fa fa-list fa-lg"></i></a>
            <a href="javascript:void(0);" title="{__('Ping')}" class="MarketingLeadsWpLandingPageSite-Ping" id="{$item->get('id')}"  name="{$item->get('host_site')}"><i class="fa fa-share-alt fa-lg"></i></a>
            <a href="javascript:void(0);" title="{__('Recovery')}" class="MarketingLeadsWpLandingPageSite-Recovery" id="{$item->get('id')}"  name="{$item->get('host_site')}"><i class="fa fa-play-circle-o fa-lg"></i></a>
            <a href="javascript:void(0);" title="{__('List')}" class="MarketingLeadsWpLandingPageSite-ListRecords" id="{$item->get('id')}"  name="{$item->get('host_site')}"><i class="fa fa-list-alt fa-lg"></i></a>
            {if $item->get('status')=='ACTIVE'}
                <a href="javascript:void(0);" title="{__('Disable')}" class="MarketingLeadsWpLandingPageSite-Status Delete" id="{$item->get('id')}" name="{$item->get('host_site')}"><i class="fa fa-trash fa-lg"></i></a>
            {else}
                <a href="javascript:void(0);" title="{__('Enable')}" class="MarketingLeadsWpLandingPageSite-Status Recycle" id="{$item->get('id')}" name="{$item->get('host_site')}"><i class="fa fa-recycle fa-lg"></i></a>
            {/if}
        </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
    <span>{__('No site')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="MarketingLeadsWpLandingPageSite-all" /> 
        <a style="opacity:0.5" class="MarketingLeadsWpLandingPageSite-actions_items" href="#" title="{__('delete')}" id="MarketingLeadsWpLandingPageSite-Deletes">
            <i class="fa fa-trash fa-lg"></i>
        </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MarketingLeadsWpLandingPageSite"}
<script type="text/javascript">
 
    function changeSiteMarketingLeadsWpLandingPageSiteIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MarketingLeadsWpLandingPageSite-ChangeIsActive[name="+this+"]";
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
    
    function getSiteMarketingLeadsWpLandingPageSiteFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MarketingLeadsWpForms-name] option:selected").val()  
                                },
                            lang: $("img.MarketingLeadsWpLandingPageSite").attr('id'),                                                                                                               
                            nbitemsbypage: $("[name=MarketingLeadsWpLandingPageSite-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                     } };
        if ($(".MarketingLeadsWpLandingPageSite-order_active").attr("name"))
            params.filter.order[$(".MarketingLeadsWpLandingPageSite-order_active").attr("name")] =$(".MarketingLeadsWpLandingPageSite-order_active").attr("id");   
        $(".MarketingLeadsWpForms-equal option:selected").each(function() { 
            params.filter.equal[$(this).parent().attr('name')] =$(this).val(); 
        });
        $(".MarketingLeadsWpLandingPageSite-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }
    
    function updateSiteMarketingLeadsWpLandingPageSiteFilter()
    {
        return $.ajax2({ data: getSiteMarketingLeadsWpLandingPageSiteFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}" , 
                        errorTarget: ".marketing-leads-landing-page-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
                    });
    }
    
    function updateSitePager(n)
    {
        page_active=$(".MarketingLeadsWpLandingPageSite-pager .MarketingLeadsWpLandingPageSite-active").html()?parseInt($(".MarketingLeadsWpLandingPageSite-pager .MarketingLeadsWpLandingPageSite-active").html()):1;
        records_by_page=$("[name=MarketingLeadsWpLandingPageSite-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MarketingLeadsWpLandingPageSite-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MarketingLeadsWpLandingPageSite-nb_results").html())-n;
        $("#MarketingLeadsWpLandingPageSite-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MarketingLeadsWpLandingPageSite-end_result").html($(".MarketingLeadsWpLandingPageSite-count:last").html());
    }
            
    {* ===============================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MarketingLeadsWpLandingPageSite-init").click(function() {   
           
        $.ajax2({ url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}",
                errorTarget: ".marketing-leads-landing-page-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions-wp-landing-page-site-list"
                }); 
    }); 
    
    $('.MarketingLeadsWpLandingPageSite-order').click(function() {
        $(".MarketingLeadsWpLandingPageSite-order_active").attr('class','MarketingLeadsWpLandingPageSite-order');
        $(this).attr('class','MarketingLeadsWpLandingPageSite-order_active');
        return updateSiteMarketingLeadsWpLandingPageSiteFilter();
    });
           
    $(".MarketingLeadsWpLandingPageSite-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMarketingLeadsWpLandingPageSiteFilter();
    });
            
    $("#MarketingLeadsWpLandingPageSite-filter").click(function() { return updateSiteMarketingLeadsWpLandingPageSiteFilter(); }); 

    $("[name=MarketingLeadsWpLandingPageSite-nbitemsbypage]").change(function() { return updateSiteMarketingLeadsWpLandingPageSiteFilter(); }); 

    // $("[name=MarketingLeadsWpLandingPageSite-equal]").change(function() { return updateSiteMarketingLeadsWpLandingPageSiteFilter(); }); 
    $(".MarketingLeadsWpForms-equal").change(function() { return updateSiteMarketingLeadsWpLandingPageSiteFilter(); }); 

    $(".MarketingLeadsWpLandingPageSite-pager").click(function () {
        return $.ajax2({ data: getSiteMarketingLeadsWpLandingPageSiteFilterParameters(), 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".marketing-leads-landing-page-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    {* ===============================  A C T I O N S =============================== *}  
    
    $("#MarketingLeadsWpLandingPageSite-New").click( function () { 
              
        return $.ajax2({                
            url: "{url_to('marketing_leads_ajax',['action'=>'NewWpLandingPageSite'])}",
            errorTarget: ".marketing-leads-landing-page-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
       });
    });
         
    $(".MarketingLeadsWpLandingPageSite-ListForms").click( function () { 
              
        return $.ajax2({ 
                data : { WpLandingPageSite: $(this).attr('id') },
                url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}",
                errorTarget: ".marketing-leads-landing-page-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions-wp-landing-page-site-list"
        });
    });
    
    $(".MarketingLeadsWpLandingPageSite-View").click( function () { 
               
        return $.ajax2({ data : { WpLandingPageSite : { 
                                id: $(this).attr('id'),                                            
                            } },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('marketing_leads_ajax',['action'=>'ViewWpLandingPageSite'])}",
                        errorTarget: ".marketing-leads-landing-page-errors",
                        target: "#actions-wp-landing-page-site-list"
                    });
    });           
    
    $(".MarketingLeadsWpLandingPageSite-TestRecovery").click( function () { 
       
        return $.ajax2({ data :{ WpLandingPageSite: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'TestRecoveryWpLandingPageSite'])}",
                        errorTarget: ".marketing-leads-landing-page-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#test-recovery-marketing-leads"
            });                                        
    });
    
    $(".MarketingLeadsWpLandingPageSite-Recovery").click( function () { 
       
        return $.ajax2({ data :{ WpLandingPageSite: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'RecoveryWpLandingPageSite'])}",
                        errorTarget: ".marketing-leads-landing-page-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
            });                                        
    });
    
    $(".MarketingLeadsWpLandingPageSite-Ping").click( function () { 
       
        return $.ajax2({ data :{ WpLandingPageSite: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'PingWpLandingPageSite'])}",
                        errorTarget: ".marketing-leads-landing-page-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
            });                                        
    });
    
    $(".MarketingLeadsWpLandingPageSite-ListRecords").click( function () { 
       
        return $.ajax2({ data :{ WpLandingPageSite: $(this).attr('id') },
                        url :"{url_to('marketing_leads_ajax',['action'=>'ListRecordsByWpLandingPageSite'])}",
                        errorTarget: ".marketing-leads-landing-page-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
            });                                        
    });

    $(".MarketingLeadsWpLandingPageSite-ChangeIsActive").click( function () { 
        return $.ajax2({ data: { WpLandingPageSite : { id: $(this).attr('name'), value: $(this).attr('id'), token: '{mfForm::getToken("ChangeForm")}' } },
                        url: "{url_to('marketing_leads_ajax',['action'=>'ChangeIsActiveWpLandingPageSite'])}",
                        errorTarget: ".marketing-leads-landing-page-errors",     
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success: function(resp) {
                                    if (resp.action=='ChangeIsActiveWpLandingPageSite')
                                        changeSiteMarketingLeadsWpLandingPageSiteIsActiveState(resp);
                                }
        });    
    });
    
    $(".MarketingLeadsWpLandingPageSite-Status").click(function () {
        if ($(this).hasClass('Delete'))
        {
            if (!confirm('{__("Landing page site \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { WpLandingPageSite: $(this).attr('id') },
                url: "{url_to('marketing_leads_ajax',['action'=>'DisabledStatusWpLandingPageSite'])}",
                success: function (resp)
                        {
                            if (resp.action=='DisableWpLandingPageSite')
                            {
                                $(".StatusMarketingLeadsWpLandingPageSite[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                $(".StatusMarketingLeadsWpLandingPageSite[id="+resp.id+"]").html("{__("MarketingLeadsWpLandingPageSite_DELETE")}");
                                $(".MarketingLeadsWpLandingPageSite-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');
                                $(".MarketingLeadsWpLandingPageSite-Status[id="+resp.id+"]").html('<i class="fa fa-recycle fa-lg"></i>');
                            }
                        }
            });
        }
        else
        {
            if (!confirm('{__("Landing page site \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { WpLandingPageSite: $(this).attr('id') },
                url: "{url_to('marketing_leads_ajax',['action'=>'EnabledStatusWpLandingPageSite'])}",
                success: function (resp)
                        {
                            if (resp.action=='EnableWpLandingPageSite')
                            {
                                $(".StatusMarketingLeadsWpLandingPageSite[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                $(".StatusMarketingLeadsWpLandingPageSite[id="+resp.id+"]").html("{__("MarketingLeadsWpLandingPageSite_ACTIVE")}");
                                $(".MarketingLeadsWpLandingPageSite-Status[id="+resp.id+"]").html('<i class="fa fa-trash fa-lg"></i>');
                                $(".MarketingLeadsWpLandingPageSite-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');
                            }
                        }
            });
        }
    });
    
    {* ============================================= SETTINGS ============================================= *}

    $("#MarketingLeadsWpLandingPageSite-Settings").click( function () { 
        return $.ajax2({ 
            url: "{url_to('marketing_leads_ajax',['action'=>'Settings'])}",
            errorTarget: ".marketing-leads-landing-page-errors",     
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });    
    });

    $("#MarketingLeadsWpLandingPageSite-CleanUp").click( function () { 
        return $.ajax2({ 
            url: "{url_to('marketing_leads_ajax',['action'=>'CleanUp'])}",
            errorTarget: ".marketing-leads-landing-page-errors",     
            loading: "#tab-site-dashboard-x-settings-loading",
{*            target: "#actions-wp-landing-page-site-list"*}
        });    
    });
</script>    