{component name="/site/sublink"}
{messages class="contract-multiple-errors"}
<h3>{__("Multiple update")}</h3>
<div>
    <a href="#" id="UserMultiple-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $form}
<div>    
    {format_number_choice('[0] no selected element|[1]one selected element|(1,Inf]%s selected elements',$form->getSelection()->count(),$form->getSelection()->count())} 
</div>
<fieldset>    
<table>
    <tr>
        <td>{__('Actions')}</td>
        <td>{__('Parameters')}</td>
    </tr>  
    {if $form->actions->getChoices()->in('generate_password')}
     <tr>
       <td>
            <input type="checkbox" class="UserMultipleActions" name="generate_password" {if $form->getActions()->in('generate_password')}checked=""{/if}/>
        </td>
        <td>{__('Generate password')}</td>            
    </tr>
    {/if}
    {if $form->actions->getChoices()->in('profile')}
        <tr>
            <td> <input type="checkbox" class="UserMultipleActions" name="profile" value="" {if $form->getActions()->in('profile')}checked=""{/if}/></td>
            <td style="width: 273px;">{__('Profile')}</td>
            <td>
                   <div class="error-form">{$form.profile_id->getError()}</div> 
                  {html_options class="UserMultiple" name="profile_id" options=$form->profile_id->getOption('choices') selected=(string)$form.profile_id} 
            </td>
        </tr>
    {/if}
</table>
<a href="#" id="MutipleUserProcess" class="btn">{__('Process')}</a>  
</fieldset>


<script type="text/javascript">
          
        $("#MutipleUserProcess").click(function() {            
           var params={ 
                   MultipleUserSelection : {
                    actions: [],                                     
                    selection : {$form->getSelection()->toJson()},
                    count : '{$form->getSelection()->count()}',
                    token :'{$form->getCSRFToken()}'
                        }
           };                                          
           $(".UserMultipleActions:checked").each(function() { params.MultipleUserSelection.actions.push($(this).attr('name')); });   
           $("select.UserMultiple option:selected").each(function() { params.MultipleUserSelection[$(this).parent().attr('name')]=$(this).val(); }); 
      //  alert("Params="+params.toSource());
           return $.ajax2({                   
                    data : params,
                    url: "{url_to('users_ajax',['action'=>'MultipleProcessSelection'])}",
                    errorTarget: ".site-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",
                    target: "#actions"
               });
        });
        
    $('#UserMultiple-Cancel').click(function(){               
             return $.ajax2({ 
                              url : "{url_to('users_ajax',['action'=>'ListPartial'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
        
      
</script>   

{/if}
