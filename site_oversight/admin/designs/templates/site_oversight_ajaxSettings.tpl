{messages class="site-errors"}
<h3>{__("Oversight settings")|capitalize}</h3>
<div>    
    <a href="#" id="Save" class="btn" style="display:none"><i class="fa fa-save"></i>{__('Save')}</a>
    <a href="#" id="Cancel" class="btn"><i class="fa fa-remove"></i>{__('Cancel')}</a>
</div>
<fieldset>
    <h3>{__('Options')}</h3>
    <div>
       <div class="errors_settings">{$form.emails->getError()}</div>
       <label>{__('Emails')}</label>
       <textarea cols="80" rows="2" class="Settings" name="emails">{if $form->hasErrors()}{$form.emails}{else}{$settings->get('emails')}{/if}</textarea>
    </div>
     <div>
       <div class="errors_settings">{$form.oversights->getError()}</div>
       <label>{__('Oversights')}</label>
       <textarea cols="80" rows="2" class="Settings" name="oversights">{if $form->hasErrors()}{$form.oversights}{else}{$settings->get('oversights')}{/if}</textarea>
    </div>    
</fieldset>

<script type="text/javascript">

         $(".Settings").click(function(){  $("#Save").show();    });
         
        
        $('#Cancel').click(function(){ 
                return $.ajax2({ url:"{url_to('site_oversight_ajax',['action'=>'ListPartialMessage'])}",
                                 errorTarget: ".site-errors",
                                 target: "#actions" 
                               }); 
        });
         
         $('#Save').click(function(){ 
          var  params= { Settings: {  token :'{$form->getCSRFToken()}' } };
              $(".Settings").each(function() { params.Settings[this.name]=$(this).val(); });                                         
              return $.ajax2({ data : params,                                 
                                   url: "{url_to('site_oversight_ajax',['action'=>'Settings'])}",
                                   errorTarget: ".site-errors",
                                   target: "#actions"}); 
         });
      

</script>
