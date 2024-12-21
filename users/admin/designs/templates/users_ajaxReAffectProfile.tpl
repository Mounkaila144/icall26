{messages class="site-errors"}
{if $profile->isLoaded()}
<fieldset>
    <legend><h3>{__("Re affect profile %s ",$profile->get('name'))}</h3></legend>
    <div>
      <a href="#" id="Save" class="btn" style="display:none">
           <i class="fa fa-floppy-o"  style="margin-right:10px;"></i>{__('Save')}</a>
      <a href="#" id="Cancel" class="btn">
          <i class="fa fa-times" class="btn" style="margin-right:10px;"></i>{__('Cancel')}</a>
    </div>
    <table class="tab-form" cellspacing="0">
        <tr class="full-with">
            <td class="label">{__("Profile to affect")}</td>
            <td> 
                <div class="error-form">{$form.profile_id->getError()}</div> 
                {html_options class="Profile Select" name="profile_id" options=$form->profile_id->getOption('choices') selected=$form.profile_id}
            </td>
        </tr>
    </table>  
</fieldset>
<script type="text/javascript">
    
        $('.widthSelectWithSearch').select2({
            selectOnClose: true,
            width: '80px',
            dropdownAutoWidth:true
        });
      
      
        $('#Cancel').click(function(){ return $.ajax2({ 
                        url:"{url_to('users_ajax',['action'=>'ListPartialProfile'])}" , 
                        loading: "#tab-site-dashboard-x-settings-loading",
                        errorTarget: ".site-errors",
                        target: "#actions"}); 
        });
         
    $(".Profile").click(function() { $("#Save").show(); });
        
        
        $('#Save').click(function(){ 
              var params= {  Profile: '{$profile->get('id')}',
                             ProfileReAffect: {                                    
                                    token :'{$form->getCSRFToken()}' 
                                  } };
              $(".Profile.Select option:selected").each(function() { params.ProfileReAffect[$(this).parent().attr('name')]=$(this).val(); });
              return $.ajax2({  data:params, 
                                url:"{url_to('users_ajax',['action'=>'SaveReAffectProfile'])}" , 
                                loading: "#tab-site-dashboard-x-settings-loading",
                                errorTarget: ".site-errors",
                                target: "#actions"}); 
         });  
</script>
{else}
    {__('Profile is invalid.')}
{/if}    
