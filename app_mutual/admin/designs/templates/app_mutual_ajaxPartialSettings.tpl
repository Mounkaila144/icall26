{messages class='app-mutual-settings-error'}
<div>    
    <a href="javascript:void(0);" id="SettingsMutual-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{__('Save')}</a>
</div>
<fieldset>
    <legend><h3>{__('Settings')}</h3></legend>
    <div class="tab-form">
        <div>         
            <div class="error-form">{$form.nb_days_to_add->getError()}</div>
            <label class="">{__('Number of days to add')}</label>
            <input type="text" class="SettingsMutual" name="nb_days_to_add" value="{$settings->get('nb_days_to_add')}"/>
        </div>
        <div>         
            <div class="error-form">{$form.nb_meetings_to_process->getError()}</div>
            <label class="">{__('Number of meetings to process')}</label>
            <input type="text" class="SettingsMutual" name="nb_meetings_to_process" value="{$settings->get('nb_meetings_to_process')}"/>
        </div>
    </div>
</fieldset>

<script type="text/javascript">

    $("input.SettingsMutual,textarea.SettingsMutual").click(function(){         
        $("#SettingsMutual-Save").show();        
    });
         
    $(".SettingsMutual").change(function(){
        $("#SettingsMutual-Save").show();        
    });
         
    $('#SettingsMutual-Save').click(function(){ 
        var  params = { Settings: {  token :'{$form->getCSRFToken()}' } };
        $("input.SettingsMutual,textarea.SettingsMutual").each(function() { params.Settings[$(this).attr('name')]=$(this).val(); });                                         
        return $.ajax2({ data : params,                                 
                        url: "{url_to('app_mutual_ajax',['action'=>'PartialSettings'])}",
                        errorTatget: '.app-mutual-settings-error',
                        target: "#actions-mutual-settings"}); 
    });
    
</script>
