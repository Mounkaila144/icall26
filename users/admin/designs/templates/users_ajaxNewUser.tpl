{messages class="site-errors"}
<h3>{__("New user")}</h3>
<div>
    <a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">
      <tr>
             <td>{__("title")}</td>
             <td> 
                 <div>{$form.sex->getError()}</div>                
                 {foreach $form->sex->getOption("choices") as $name=>$gender}
                        <input type="radio" class="User" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        <label for="id_gender" class="top">{format_gender($gender,1,true)|capitalize}</label>
                 {/foreach} {if $form->getValidator('sex')->getOption('required')}*{/if}
             </td>
         </tr>
    <tr>
        <td>{__("username")}</td>
        <td> 
            <div>{$form.username->getError()}</div> 
            <input type="text" class="User" name="username" value="{$item->get('username')|escape}" size="30"/>{if $form->username->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__("firstname")}</td>
        <td>
            <div>{$form.firstname->getError()}</div>  
            <input type="text" class="User" name="firstname" value="{$item->get('firstname')|escape}" size="30"/>{if $form->firstname->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__("lastname")}</td>
        <td> 
            <div>{$form.lastname->getError()}</div> 
            <input type="text" class="User" name="lastname" value="{$item->get('lastname')|escape}" size="30"/>{if $form->lastname->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__("email")}</td>
        <td> 
            <div>{$form.email->getError()}</div> 
            <input type="text" class="User" name="email" value="{$item->get('email')|escape}" size="30"/>{if $form->email->getOption('required')}*{/if}
        </td>
    </tr>  
     <tr>
        <td>{__("mobile")}</td>
        <td> 
            <div>{$form.mobile->getError()}</div> 
            <input type="text" class="User" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
        </td>
    </tr> 
    <tr>
        <td>{__('Team')}</td>
        <td>
            <div>{$form.team_id->getError()}</div> 
            {html_options_format format="__" class="User" name="team_id" options=$form->team_id->getOption('choices') selected=$item->get('team_id')}
        </td>
    </tr>
   {* <tr>
        <td>{__('picture')}:</td>
        <td>
                    <div class="errors_newuser_form" id="error_newuser_picture"></div> 
                    <div>
                        <a id="AddPicture" class="pictureNotExist" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('edit')}"/>{__('add picture')|capitalize}</a> 
                    </div>
                    <div id="picture" style="display:none">
                          <input class="files" type="file" name="User[picture]"/> 
                    </div> 
         </td>
    </tr>     *}   
</table> 

<h4>{__('Functions')}</h4>
{if $form->functions->getOption('choices')}        
    <table class="tab-form">
    {foreach $form->functions->getOption('choices') as $id=>$function}
        <tr>
            <td>
                <input type="checkbox" class="UserFunction" id="{$id}" {if in_array($id,$form->getDefault('functions'))}checked="checked"{/if}/><span>{$function}</span>
            </td>
        </tr>
    {/foreach}  
    </table>
{/if}

<h4>{__('Groups')}</h4>
  {if $form->groups->getOption('choices')}        
        <table class="tab-form">
        {foreach $form->groups->getOption('choices') as $id=>$group}
            <tr>
                <td>
                    <input type="checkbox" class="UserGroup" id="{$id}" {if in_array($id,$form->getDefault('groups'))}checked="checked"{/if}/><span>{$group}</span>
                </td>
            </tr>
        {/foreach}  
        </table>
    {/if}
<script type="text/javascript">
        
        $('#Cancel').click(function(){  return $.ajax2({ 
                        url: "{url_to('users_ajax',['action'=>'ListPartial'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        errorTarget: ".site-errors",
                        target: "#actions"}); 
        });
         
        $(".User,.UserFunction,.UserGroup").click(function() { $("#Save").show(); });
        
      {*  $("#AddPicture").click(function() {
             $("#picture").show();
             $(this).hide();
         }); *}
         
        $('#Save').click(function(){ 
              var params= { User: { team_id:  $(".User[name=team_id] option:selected").val(), 
                                    functions : [], groups : [],
                                    token :'{$form->getCSRFToken()}' } };
              $("input.User[type=text]").each(function() { params.User[this.name]=$(this).val(); });
              $("input.User[type=radio]:checked").each(function() { params.User[this.name]=$(this).val(); });
              $("input.UserFunction[type=checkbox]:checked").each(function() { params.User.functions.push($(this).attr('id')); }); 
              $("input.UserGroup[type=checkbox]:checked").each(function() { params.User.groups.push($(this).attr('id')); });
              return $.ajax2({  data: params, 
                              //  files: ".files",
                                url: "{url_to('users_ajax',['action'=>'NewUser'])}",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                errorTarget: ".site-errors",
                                target: "#actions"
                               }); 
        });  
    
</script>
