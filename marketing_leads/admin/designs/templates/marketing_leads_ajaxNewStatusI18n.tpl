{messages class="MarketingLeadsStatus-errors"}
<h3>{__("New Status")}</h3>
<div>
    <a href="#" id="MarketingLeadsStatus-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="MarketingLeadsStatus-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.status_i18n.lang site=$status_i18n->getSite()}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.status_i18n.lang->getError()}</div>      
            <img class="MarketingLeadsStatusI18n" id="{$form.status_i18n.lang}" name="lang" src="{url("/flags/`$form.status_i18n.lang`.png","picture")}" title="{if !$form.status_i18n.lang->getError()}{format_country($form.status_i18n.lang)}{/if}" />
            <a id="MarketingLeadsStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label"><span>{__("Name")}</span></td>
        <td>
            <div class="error-form">{$form.status.name->getError()}</div>               
             <input type="text" size="20" class="MarketingLeadsStatus" name="name" value="{$status_i18n->getMarketingLeadsWpFormsStatus()->get('name')}"/> 
        </td>
    </tr>  
     <tr class="full-with">
         <td class="label"><span>{__("Color")}</span></td>
        <td>
             <div class="error-form">{$form.status.color->getError()}</div>               
             <input type="text" size="20" class="MarketingLeadsStatus" name="color" value="{$status_i18n->getMarketingLeadsWpFormsStatus()->get('color')}"/> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label"><span>{__("Icon")}</span></td>
        <td>                       
            <div id="error_icon" class="error-form">{$form.status.icon->getError()}</div>                 
            <a id="ChangeIcon" href="#"><i class="fa fa-plus" style="margin-right: 10px;"></i>
               <span id="text_icon">{__('Add Picture')}</span></a>
            <div id="icon" style="display:none">
               <div>{__('Max size for picture %s.',format_size($form->status.icon->getOption('max_size')))}</div>
               <input class="MarketingLeadsStatus-files" type="file" name="MarketingLeadsStatus[status][icon]"/> 
            </div>
            {if $form->status.icon->getOption('required')}*{/if} 
        </td>
    </tr>    
    <tr class="full-with">
        <td class="label"><span>{__("Value")}</span></td>
        <td>
           <div id="error_pages" class="error-form">{$form.status_i18n.value->getError()}</div>
           <input type="text" size="40" class="MarketingLeadsStatusI18n" name="value" value="{$status_i18n->get('value')}"/>    
           {if $form->status_i18n.value->getOption('required')}*{/if} 
        </td>
    </tr>  
</table> 

<script type="text/javascript">
    $(".MarketingLeadsStatus[name=color]").minicolors();
     
    {* =================== F I E L D S ================================ *}
    $(".MarketingLeadsStatus,.MarketingLeadsStatusI18n").click(function() {  $('#MarketingLeadsStatus-Save').show(); });    

    $(".MarketingLeadsStatus-files").change(function() {  $('#MarketingLeadsStatus-Save').show(); });   

    $("#ChangeIcon").click(function() {
        $("#icon").show();
        $(this).hide();
    });
         
    {* =================== L A N G U A G E ================================ *}
    $( "#MarketingLeadsStatus-ChangeLang").click(function() {
        $("#MarketingLeadsStatus-Save").show();
        $("#dialogListLanguages").dialog("open");
    });  

    $("#dialogListLanguages").bind('select',function(event){                    
        $(".MarketingLeadsStatusI18n[name=lang]").attr({
                                id: event.selected.id,
                                src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                title: event.selected.lang
                            });         
    }); 
    
    {* =================== A C T I O N S ================================ *}
    $('#MarketingLeadsStatus-Cancel').click(function(){   
{*        $(".dialogs").dialog("destroy").remove(); *}
        return $.ajax2({ data: { filter: { lang:$("img.MarketingLeadsStatusI18n").attr('id'), token: "{mfForm::getToken('MarketingLeadsWpFormsStatusFormFilter')}" } },                              
                        url : "{url_to('marketing_leads_ajax',['action'=>'ListPartialStatus'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions"}); 
    });
      
    $('#MarketingLeadsStatus-Save').click(function(){                             
        var  params= {  iFrame:true,             
                        MarketingLeadsStatus: { 
                            status_i18n : { lang: $(".MarketingLeadsStatusI18n[name=lang]").attr('id')  },
                            status : { },
                            token :'{$form->getCSRFToken()}'
                        } };
        $("input.MarketingLeadsStatusI18n").each(function() { params.MarketingLeadsStatus.status_i18n[this.name]=$(this).val(); });
        $("input.MarketingLeadsStatus").each(function() {  params.MarketingLeadsStatus.status[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
{*        $(".dialogs").dialog("destroy").remove(); *}
        return $.ajax2({ data : params,  
                        files: ".MarketingLeadsStatus-files",
                        url: "{url_to('marketing_leads_ajax',['action'=>'SaveNewStatusI18n'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",     
                        target: "#actions"}); 
    });  
</script>
