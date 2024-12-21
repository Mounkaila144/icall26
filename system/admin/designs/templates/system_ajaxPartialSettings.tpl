{messages class="system-errors"}
<h3>{__("Settings")}</h3>
<div>
 <div style="float:left">
    <a href="#" id="Settings-Save" class="btn btn-primary">
         <i class="fa fa-floppy-o" style="margin-right:10px;"></i>
        {__('Save')}</a>    
</div>
<div style="clear:both"></div>
<fieldset>
     <legend>{__('Options')}</legend>
    <table>   
        <tr>
            <td>{__('Holidays')}</td>
            <td>
                 <div class="errors_settings error-form">{$form.holidays->getError()}</div>                                   
                 <textarea rows="4" cols="80" class="Settings Input" type="text" name="holidays">{if $form->hasErrors()}{$form->holidays->getErrorsAsString()}{else}{$settings->getFormattedHolidays()->implode(';')}{/if}</textarea>                 
            </td>
        </tr>
        <tr>
            <td>
                 <label>{__('Open days')}<span class="obligation">{if $form->open_days->getOption('required')}*{/if}</span></label>
            </td>
            <td>     
                 <div class="errors_settings error-form">{$form.open_days->getError()}</div>      
            {html_options size="7" multiple="" name="open_days" class="Settings Multiple Select" options=$form->open_days->getOption("choices") selected=$settings->get('open_days')}                    
            </td>
        </tr>  
     <tr>
        <td>
       <label>{__('Time shift')}<span class="obligation">{if $form->time_shift->getOption('required')}*{/if}</span></label>
        </td>
        <td>
          <div class="errors_settings error-form">{$form.time_shift->getError()}</div>         
          {html_options class="Settings Select Single" name="time_shift"  selected=$settings->get('time_shift') options=$form->time_shift->getOption('choices')}          
        </td>
    </tr>     
    </table>
</fieldset>
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".Settings").click(function() {  $('#Save').show(); });    
    
     $("input.Settings").click(function(){         
           //  $(".errors").messagesManager('clear');
             $("#Save").show();        
     });
         
     $("select.Settings").change(function(){
          //  $(".errors").messagesManager('clear');
            $("#Save").show();        
     });

     {* =================== A C T I O N S ================================ *}
    
      
      $('#Settings-Save').click(function(){                             
            var  params= {                  
                                Settings: {                                   
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".Settings.Input").each(function() { params.Settings[this.name]=$(this).val(); });     
          $("input.Settings[type=checkbox]").each(function() { params.Settings[this.name]=$(this).is(':checked'); }); 
          $(".Settings.Select.Single option:selected").each(function() { params.Settings[$(this).parent().attr('name')]=$(this).val(); });     
          $(".Settings.Select.Multiple option:selected").each(function() { 
              if (!params.Settings[$(this).parent().attr('name')])
                  params.Settings[$(this).parent().attr('name')]=[ ];
              params.Settings[$(this).parent().attr('name')].push($(this).val());
          }); 
       //      alert("Params="+params.toSource());   return ;         
          return $.ajax2({ data : params,     
                           errorTarget : ".system-errors",
                           url: "{url_to('system_ajax',['action'=>'PartialSettings'])}",                                                  
                           target: "#actions"}); 
        }); 
        
    
</script>

