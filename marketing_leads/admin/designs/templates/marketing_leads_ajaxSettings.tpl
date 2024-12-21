{messages class="MarketingLeads-errors"}
<h3>{__("Settings")}</h3>
<div>
    <a href="javascript:void(0);" id="MarketingLeadsWpLandingPageSiteSettings-Save" style="display:none" class="btn"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{__('Save')}</a>    
    <a href="javascript:void(0);" id="MarketingLeadsWpLandingPageSiteSettings-Cancel" class="btn"><i class="fa fa-arrow-left" style="margin-right: 10px;"></i>{__('Return')}</a>    
    <a href="javascript:void(0);" id="MarketingLeadsWpLandingPageSiteSettings-Import" class="btn"><i class="fa fa-download" style="margin-right: 10px;"></i>{__('Import')}</a>    
</div>

<fieldset>
    <h3>{__('Options')}</h3>
    <div class="tab-form">
       <div class="errors_settings">{$form.max_leads_to_fetch->getError()}</div>
       <label>{__('Max leads to fetch')}</label>
       <input type="text" class="Settings" name="max_leads_to_fetch" value="{$settings->get('max_leads_to_fetch')}" />
    </div>  
    <div class="tab-form">
        <span>{__('Lead default status')}</span>
        <div class="form-errors">{$form.default_state->getError()}</div> 
        <div class="field">
            {html_options name="default_state" class="Settings" options=$form->default_state->getOption('choices') selected=$settings->get('default_state') }
        </div>
        {if $form->default_state->getOption('required')}*{/if} 
    </div>
    <div class="tab-form">
        <span>{__('State')}</span>
        <div class="form-errors">{$form.state->getError()}</div> 
        <div class="field">
            {html_options name="state" class="Settings" options=$form->state->getOption('choices') selected=$settings->get('state') }
        </div>
        {if $form->state->getOption('required')}*{/if} 
    </div>
    <div class="tab-form">
       <div class="errors_settings">{$form.blacklist_phones_list->getError()}</div>
       <label>{__('Blacklist phones list')}</label>
       <input type="text" class="Settings" name="blacklist_phones_list" value="{if $settings->hasBlacklistPhonesList()}{$settings->getBlacklistPhonesList()->implode(',')}{/if}" />
    </div>
</fieldset>

<script type="text/javascript">
     
    {* =================== F I E L D S ================================ *}
    $(".Settings").click(function() {  $('#MarketingLeadsWpLandingPageSiteSettings-Save').show(); });    

    $("input.Settings").click(function(){         
        $("#Settings-Save").show();        
    });

    $("select.Settings").change(function(){
        $("#MarketingLeadsWpLandingPageSiteSettings-Save").show();        
    });

    {* =================== A C T I O N S ================================ *}
    
    $('#MarketingLeadsWpLandingPageSiteSettings-Cancel').click(function(){  
        return $.ajax2({                          
                        url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialWpLandingPageSite'])}",
                        errorTarget: ".MarketingLeads-errors",                            
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
            }); 
    }); 
    
    $('#MarketingLeadsWpLandingPageSiteSettings-Save').click(function(){                             
        var  params= {                  
                        Settings: {                                   
                            token :'{$form->getCSRFToken()}'
                        } };
        $("input.Settings,select.Settings").each(function() { params.Settings[$(this).attr('name')]=$(this).val(); });     

        return $.ajax2({ data : params,                            
                        url: "{url_to('marketing_leads_ajax',['action'=>'Settings'])}",
                        errorTarget: ".MarketingLeads-errors",                            
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
            }); 
    });  
    
    $('#MarketingLeadsWpLandingPageSiteSettings-Import').click(function(){                             

        return $.ajax2({                          
                        url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}",
                        errorTarget: ".MarketingLeads-errors",                            
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
            }); 
    });  
    
</script>
