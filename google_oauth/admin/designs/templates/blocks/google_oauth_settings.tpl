<fieldset class="form-control col-12  h-auto" >
      <legend class="setting-legend"><h4>{__('Google Oauth')}</h4></legend>       
        <div class="form-group row no-gutters mb-1">
           <div class="col-3">
            <label class="col-sm-12 col-form-label">{__("Secret Code")}{*if $form->supplier_admin_recipients->getOption('required')}*{/if*}</label>
          </div>
          <div class="col-8 v-middel">
            <div class="error-form">{*$form.supplier_admin_recipients->getError()*}</div>
            <textarea cols="30" rows="5" class="Settings form-control Input"  name="google_app_secret">{$settings->get('google_app_secret')}</textarea>
          </div>    
       </div>        
</fieldset>        
