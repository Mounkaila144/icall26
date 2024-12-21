{messages class="errors"}
<h3>{__("Remote Theme creation")}</h3>
<div>
    <a id="Save" href="#" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
    <a href="#" id="Cancel"><img src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a> 
</div>  
<table>
    <tr>
        <td>
          {__('Theme name')}  
        </td>
        <td>
            <div>{$form.theme->getError()}</div>
            <input type="text" class="theme" name="theme" size="48" value="{$form.theme|escape}"/>
            {if $form->theme->getOption('required')}*{/if}
        </td>
    </tr>
     <tr>
        <td>
          {__('Login')}  
        </td>
        <td>
            <div>{$form.login->getError()}</div>
            <input type="text" class="theme" name="login" size="5" value="{$form.login|escape}"/>
            {if $form->login->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>
          {__('Password')}  
        </td>
        <td>
            <div>{$form.password->getError()}</div>
            <input type="text" class="theme" name="password" value="{$form.password|escape}"/>
            {if $form->password->getOption('required')}*{/if}
        </td>
    </tr>
</table>


<script type="text/javascript">

  $("input.theme").click(function(){         
             $(".errors").messagesManager('clear');
             $("#Save").show();        
  });
         
  $("#Cancel").click(function() {  return $.ajax2({ url :"{url_to('themes_ajax_theme',['action'=>'ListPartial'])}", target: "#actions" });  }); 
  
  $('#Save').click(function(){ 
          var  params= { Theme: {  token :'{$form->getCSRFToken()}' } };
          $("input.theme,").each(function() { params.Theme[this.name]=$(this).val(); });                             
             return $.ajax2({ data : params,url: "{url_to('themes_ajax_theme',['action'=>'NewRemoteFrontendTheme'])}",target: "#actions"}); 
   });
</script>
