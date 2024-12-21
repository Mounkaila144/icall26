{messages class="ServiceImpotIncome-errors"}
<h3>{__("View")}</h3>
{if $item->isLoaded()} 
<div>
    <a href="javascript:void(0);" id="MarketingLeadsWpLandingPageSite-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('save')}</a>
    <a href="javascript:void(0);" id="MarketingLeadsWpLandingPageSite-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('cancel')}</a>
</div>
<table class="tab-form" cellpadding="0" cellspacing="0"> 
    <tr>
        <td class="label"><span>{__("Host site")}</span></td>
        <td>
            <div>{$form.host_site->getError()}</div>               
            <input type="text" size="20" class="MarketingLeadsWpLandingPageSite" name="host_site" value="{$item->get('host_site')}"/> 
            {if $form->host_site->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Host db")}</span></td>
        <td>
            <div id="error_pages" class="error-form">{$form.host_db->getError()}</div>
            <input type="text" size="10" class="MarketingLeadsWpLandingPageSite" name="host_db" value="{$item->get('host_db')}"/>    
            {if $form->host_db->getOption('required')}*{/if} 
        </td>
    </tr>  
    <tr>
        <td class="label"><span>{__("Name db")}</span></td>
        <td>
            <div id="error_pages" class="error-form">{$form.name_db->getError()}</div>
            <input type="text" size="10" class="MarketingLeadsWpLandingPageSite" name="name_db" value="{$item->get('name_db')}"/>    
            {if $form->name_db->getOption('required')}*{/if} 
        </td>
    </tr>  
    <tr>
        <td class="label"><span>{__("User db")}</span></td>
        <td>
            <div id="error_pages" class="error-form">{$form.user_db->getError()}</div>
            <input type="text" size="10" class="MarketingLeadsWpLandingPageSite" name="user_db" value="{$item->get('user_db')}"/>    
            {if $form->user_db->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Password db")}</span></td>
        <td>
            <div id="error_pages" class="error-form">{$form.password_db->getError()}</div>
            <input type="password" class="MarketingLeadsWpLandingPageSite" name="password_db" value="{$item->get('password_db')}"/>
            {if $form->password_db->getOption('required')}*{/if} 
        </td>
    </tr>  
    <tr>
        <td class="label"><span>{__("Campaign")}</span></td>
        <td>
            <div id="error_pages" class="error-form">{$form.campaign->getError()}</div>
            <input class="MarketingLeadsWpLandingPageSite" name="campaign" value="{$item->get('campaign')}"/>
            {if $form->campaign->getOption('required')}*{/if} 
        </td>
    </tr>  
</table>      
<script type="text/javascript">
    
    {* ================================ F I E L D S ================================ *}
    $(".MarketingLeadsWpLandingPageSite").click(function() {  $('#MarketingLeadsWpLandingPageSite-Save').show(); });    
    $(".MarketingLeadsWpLandingPageSiteSelect").change(function() {  $('#MarketingLeadsWpLandingPageSite-Save').show(); });    
     
    {* ================================ A C T I O N S ================================ *}
    $('#MarketingLeadsWpLandingPageSite-Cancel').click(function(){
        return $.ajax2({                              
                        url : "{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}",
                        errorTarget: ".MarketingLeadsWpLandingPageSite-errors",
                        loading: "#tab-site-dashboard-marketing-leads-loading",                         
                        target: "#actions-wp-landing-page-site-list"
                }); 
    });
      
    $('#MarketingLeadsWpLandingPageSite-Save').click(function(){                             
        var  params= {  WpLandingPageSite: { 
                            id: {$item->get('id')},
                            token :'{$form->getCSRFToken()}'
                        } };
        $("input.MarketingLeadsWpLandingPageSite").each(function() { params.WpLandingPageSite[$(this).attr('name')]=$(this).val(); });
        $(".MarketingLeadsWpLandingPageSiteSelection option:selected").each(function() { params.WpLandingPageSite[$(this).parent().attr('name')]=$(this).val(); });
        
        return $.ajax2({ data : params,  
                        url: "{url_to('marketing_leads_ajax',['action'=>'SaveWpLandingPageSite'])}",
                        errorTarget: ".MarketingLeadsWpLandingPageSite-errors",
                        loading: "#tab-site-dashboard-marketing-leads-loading",
                        target: "#actions-wp-landing-page-site-list"}); 
    });  
</script>
{/if}