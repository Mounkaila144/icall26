{messages class="MarketingLeadsStatus-errors"}
<h3>{__("View Status")}</h3>
<div>
    <a href="#" id="MarketingLeadsStatus-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="MarketingLeadsStatus-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {__('Cancel')}</a>
</div>
<table class="tab-form">
    <tr>
        <td></td>
        <td><img id="{$item->get('lang')}" name="lang" src="{url("/flags/`$item->get('lang')`.png","picture")}" title="{format_country($item->get('lang'))}" />       
        </td>
    </tr>
    <tr class="full-with">
        <td class="label"><span>{__("name")}</span>
        </td>
        <td><div id="MarketingLeadsStatus-error_name" class="error-form">{$form.status.name->getError()}</div>  
            <input type="text" class="MarketingLeadsStatus" name="name" size="48" value="{$item->getMarketingLeadsWpFormsStatus()->get('name')}"/> 
        </td>
    </tr>     
    <tr class="full-with">
        <td class="label"><span>{__("color")}</span></td>
        <td>
            <div class="error-form">{$form.status.color->getError()}</div>               
            <input type="text" size="20" class="MarketingLeadsStatus" name="color" value="{$item->getMarketingLeadsWpFormsStatus()->get('color')}"/> 
        </td>
    </tr>
    <tr class="full-with">
        <td class="label"><span>{__("icon")}</span></td>
        <td>          
        {if $item->isLoaded()}
            <div id="MarketingLeadsStatus-error_icon"></div>                  
            <div id="MarketingLeadsStatus-icon_container" {if !$item->getMarketingLeadsWpFormsStatus()->get('icon')}style="display:none"{/if}>
                <img id="MarketingLeadsStatus-icon_img" {if $item->getMarketingLeadsWpFormsStatus()->get('icon')}src="{$item->getMarketingLeadsWpFormsStatus()->getIcon()->getURL('superadmin')}"{/if} height="32" width="32" alt="{__('icon')}"/>
                <span id="MarketingLeadsStatus-icon_filename">{$item->getMarketingLeadsWpFormsStatus()->get("icon")}</span>
                <a href="#" title="{__('delete')}" id="MarketingLeadsStatus-DeleteIcon" name="{$item->getMarketingLeadsWpFormsStatus()->get('id')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
            </div>
            <a id="MarketingLeadsStatus-ChangeIcon" href="#"><i class="fa fa-plus" style="margin-right: 10px;"></i>{*<img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>*}
                <span id="MarketingLeadsStatus-text_icon">
                    {if $item->getMarketingLeadsWpFormsStatus()->get("icon")} {__('Change icon')} {else} {__('Add icon')} {/if}
                </span>
            </a>
            <div id="MarketingLeadsStatus-icon" style="display:none">
                <input class="MarketingLeadsStatus-fileIcon" type="file" name="MarketingLeadsStatus[icon]"/> 
                <a href="#" id="MarketingLeadsStatus-uploadIcon"><img id="MarketingLeadsStatus-uploadIcon" src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                <img id="MarketingLeadsStatus-iconLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>
        {else}
            <div id="MarketingLeadsStatus-error_icon">{$form.status.icon->getError()}</div>     
            <input class="files" type="file" name="MarketingLeadsStatus[status][icon]"/> 
            {if $form->status.icon->getOption('required')}*{/if}    
        {/if}               
        </td>         
    </tr>         
    <tr class="full-with">
        <td class="label"><span>{__("value")}</span></td>
        <td>
           <div id="MarketingLeadsStatus-error_value" class="error-form">{$form.status_i18n.value->getError()}</div>
           <input type="text" size="40" class="MarketingLeadsStatusI18n" name="value" value="{$item->get('value')}"/>    
           {if $form->status_i18n.value->getOption('required')}*{/if} 
        </td>
    </tr>   
</table>
  
<script type="text/javascript">
    $(".MarketingLeadsStatus[name=color]").minicolors();
    {* =================== F I L E S ================================ *}
    
    {* begin icon *} 
    $("#MarketingLeadsStatus-ChangeIcon").click(function() {
        $("#MarketingLeadsStatus-icon").show();
        $(this).hide();
        $("#MarketingLeadsStatus-Save").show();  
    });
     
    $('#MarketingLeadsStatus-uploadIcon').click(function(){ 
        return $.ajax2({ 
                loading: "#MarketingLeadsStatus-iconLoading",    
                errorTarget: ".MarketingLeadsStatus-errors",     
                data : { MarketingLeadsStatus: { 
                            id: "{$item->get('id')}",
                            token :"{mfForm::getToken('MarketingLeadsStatusIconForm')}"
                        } },
                url:"{url_to('marketing_leads_ajax',['action'=>'SaveIconStatusI18n'])}",               
                files: ".MarketingLeadsStatus-fileIcon",
                complete: function()
                        {
                            $(".MarketingLeadsStatus-fileIcon").val('');       
                        },
                success: function(response)
                        {
                            if (response.icon)
                            {    
                                $("#MarketingLeadsStatus-icon_img").attr('src',"{$item->getMarketingLeadsWpFormsStatus()->getIcon()->getURLPath('superadmin')}"+response.icon+"?"+$.now()); 
                                $("#MarketingLeadsStatus-icon_filename").html(response.icon);
                                $("#MarketingLeadsStatus-icon_container").show();

                                $("#MarketingLeadsStatus-icon").hide(); 
                                $("span#MarketingLeadsStatus-text_icon").html("{__('Change Icon')}");
                                $("#MarketingLeadsStatus-ChangeIcon").show();
                            }  
                        }
            }); 
    }); 
      
    $('#MarketingLeadsStatus-DeleteIcon').click(function(){ 
        if (!confirm("{__("Icon will be deleted. Confirm ?")}")) return false; 
        return $.ajax2({ 
                        data : { MarketingLeadsStatus: "{$item->getMarketingLeadsWpFormsStatus()->get('id')}" }, 
                        url: "{url_to('marketing_leads_ajax',['action'=>'DeleteIconStatus'])}",
                        errorTarget: ".MarketingLeadsStatus-errors",
                        success :function(response) {
                                if (response.action=='deleteIconStatus' && response.id=="{$item->getMarketingLeadsWpFormsStatus()->get('id')}")
                                {                                                     
                                    $("#MarketingLeadsStatus-icon_container").hide(); 
                                    $("span#MarketingLeadsStatus-text_icon").html("{__('Add Icon')}");
                                }
                        }
        });  
    }); 
    {* end icon *}

    {* =================== F I E L D S ================================ *}
    $(".MarketingLeadsStatus,.MarketingLeadsStatusI18n").click(function() {  $('#MarketingLeadsStatus-Save').show(); });    
    
    $("#MarketingLeadsStatus-ChangeIcon").click(function() {
        $("#MarketingLeadsStatus-icon").show();
        $(this).hide();
    });
    
    {* =================== A C T I O N S ================================ *}
    $('#MarketingLeadsStatus-Cancel').click(function(){                           
        return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('MarketingLeadsWpFormsStatusFormFilter')}" } },                              
                        url : "{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}",
                        errorTarget: ".MarketingLeadsStatus-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });

    $('#MarketingLeadsStatus-Save').click(function(){                             
        var  params= {            
                        MarketingLeadsStatusI18n: { 
                           status_i18n : { lang: "{$item->get('lang')}",status_id: "{$item->get('status_id')}"    },
                           status : { },
                           token :'{$form->getCSRFToken()}'
                        } };
        $("input.MarketingLeadsStatusI18n").each(function() { params.MarketingLeadsStatusI18n.status_i18n[this.name]=$(this).val(); });
        $("input.MarketingLeadsStatus").each(function() {  params.MarketingLeadsStatusI18n.status[this.name]=$(this).val();  });  // Get foreign key  
        //    alert("Params="+params.toSource());   return ;       
        return $.ajax2({ data : params,  
                        files: ".MarketingLeadsStatus-files",
                        errorTarget: ".MarketingLeadsStatus-errors",
                        url: "{url_to('marketing_leads_ajax',['action'=>'SaveStatusI18n'])}",
                        target: "#actions" }); 
    });  
     
</script>