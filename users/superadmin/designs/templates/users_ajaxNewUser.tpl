{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("New user")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">
      <tr>
             <td>{__("title")}</td>
             <td> 
                 <div>{$form.sex->getError()}</div>                
                 {foreach $form->sex->getOption("choices") as $name=>$gender}
                        <input type="radio" class="{$site->getSiteID()}-User" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        <label for="id_gender" class="top">{format_gender($gender,1,true)|capitalize}</label>
                 {/foreach} {if $form->getValidator('sex')->getOption('required')}*{/if}
             </td>
         </tr>
    <tr>
        <td>{__("username")}</td>
        <td> 
            <div>{$form.username->getError()}</div> 
            <input type="text" class="{$site->getSiteID()}-User" name="username" value="{$item->get('username')|escape}" size="30"/>{if $form->username->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__("firstname")}</td>
        <td>
            <div>{$form.firstname->getError()}</div>  
            <input type="text" class="{$site->getSiteID()}-User" name="firstname" value="{$item->get('firstname')|escape}" size="30"/>{if $form->firstname->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__("lastname")}</td>
        <td> 
            <div>{$form.lastname->getError()}</div> 
            <input type="text" class="{$site->getSiteID()}-User" name="lastname" value="{$item->get('lastname')|escape}" size="30"/>{if $form->lastname->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__("email")}</td>
        <td> 
            <div>{$form.email->getError()}</div> 
            <input type="text" class="{$site->getSiteID()}-User" name="email" value="{$item->get('email')|escape}" size="30"/>{if $form->email->getOption('required')}*{/if}
        </td>
    </tr> 
     <tr>
        <td>{__("mobile")}</td>
        <td> 
            <div>{$form.mobile->getError()}</div> 
            <input type="text" class="{$site->getSiteID()}-User" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
        </td>
    </tr> 
    <tr>
        <td>{__('Team')}</td>
        <td>
            <div>{$form.team_id->getError()}</div> 
            {html_options_format format="__" class="`$site->getSiteID()`-User" name="team_id" options=$form->team_id->getOption('choices') selected=$item->get('team_id')}
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
                          <input class="{$site->getSiteID()}-files" type="file" name="User[picture]"/> 
                    </div> 
         </td>
    </tr>     *}   
</table>  
<script type="text/javascript">
        
        $('#{$site->getSiteID()}-Cancel').click(function(){  return $.ajax2({ 
                        url: "{url_to('users_dashboard_ajax',['action'=>'ListPartial'])}",
                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                        errorTarget: ".{$site->getSiteID()}-site-errors",
                        target: "#{$site->getSiteID()}-actions"}); 
        });
         
        $(".{$site->getSiteID()}-User").click(function() { $("#{$site->getSiteID()}-Save").show(); });
        
      {*  $("#{$site->getSiteID()}-AddPicture").click(function() {
             $("#{$site->getSiteID()}-picture").show();
             $(this).hide();
         }); *}
         
        $('#{$site->getSiteID()}-Save').click(function(){ 
              var params= { User: { team_id:  $(".{$site->getSiteID()}-User[name=team_id] option:selected").val(), 
                                    token :'{$form->getCSRFToken()}' } };
              $("input.{$site->getSiteID()}-User[type=text]").each(function() { params.User[this.name]=$(this).val(); });
              $("input.{$site->getSiteID()}-User[type=radio]:checked").each(function() { params.User[this.name]=$(this).val(); });
              return $.ajax2({  data: params, 
                              //  files: ".{$site->getSiteID()}-files",
                                url: "{url_to('users_dashboard_ajax',['action'=>'NewUser'])}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"
                               }); 
        });  
    
</script>
