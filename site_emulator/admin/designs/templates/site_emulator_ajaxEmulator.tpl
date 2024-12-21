<!DOCTYPE html>
{component name="/site/sublink"} 
{*<html xmlns="http://www.w3.org/1999/xhtml"  lang="{$_request->getLanguage()}">
    <head>
{*        {stylesheets}*}
{*        {header}
*}
{*<link rel="stylesheet" type="text/css" href="{url('/web/css/main.css')}"/>
    <script type="text/javascript" src="{url('/web/js/jquery-1.11.1.min.js')}"></script> 
     <script type="text/javascript" src="{url('/web/js/jquery.custom.js')}"></script> 
    </head>
    <body> 
*}
{messages class="site-errors"}
<h3>{__("Emulator")}</h3>
<div class="tab-form">
<table cellpadding="0" cellspacing="0" >     
    <tr class="full-with">
            <td class="label"><span>{__("Url")}</span></td>
             <td>
                <div id="urlError" class="emulatorError">{$form.url->getError()}</div>
                <input type="text" size="48" class="Emulator" name="url" value="{$form.url->getValue()}"/>    
                {if $form->url->getOption('required')}*{/if}
                <p><i>Ex: <br> http://www.theme30dev.net/admin/site/emulator/admin/site/emulator/admin/</i></p>
             </td>
        </tr>  
        <tr class="full-with">
             <td class="label"><span>{__("Command")}</span></td>
             <td>
                 <div id="commandError" class="emulatorError">{$form.command->getError()}</div>
                <input type="text" size="48" class="Emulator" name="command" value="{$form.command->getValue()}"/>    
                {if $form->command->getOption('required')}*{/if}
                <p><i>Ex: <br> Emulator </i></p>
             </td>
        </tr>  
        <tr class="full-with">
             <td class="label"><span>{__("POST")}</span></td>
             <td>
                 <div id="postError" class="emulatorError">{$form.post->getError()}</div>
                 <textarea cols="45" rows="8" class="Emulator" name="post" id="EmulatorPost" ></textarea>
{*                <input type="text" size="80" class="Emulator" name="post" value="{$form.post->getValue()}"/>    *}
                {if $form->post->getOption('required')}*{/if} 
                <p><i>Ex: <br> { "User":"590","name ":"John" }</i></p>
             </td>
        </tr>  
</table> 
<div>
    <a href="#" id="Emulator-Send" class="btn" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('send')}"/>{__('send')}</a>
</div>

<pre><textarea id="response" style="display: none;" cols="60" rows="10"></textarea></pre>
</div>



<script type="text/javascript">
{*      {JqueryScriptsReady}
  {/JqueryScriptsReady} *} 
      
      
      
     {* =================== F I E L D S ================================ *}
         
     $(".Emulator").click(function() { $('#Emulator-Send').show(); });   
     $(".Emulator").focus(function() { $('.emulatorError').hide(); });   
     
     {* =================== A C T I O N S ================================ *}

         

      
     $('#Emulator-Send').click(function(){  
            var  params= {  };
            $("input.Emulator").each(function() { params[this.name]=$(this).val(); });
            if($("#EmulatorPost").val()===""){
                $('#postError').text("{__('Invalid post params')|UPPER}").css('color','red').show();
            }
            if($("input.Emulator[name=url]").val()===""){
                $('#urlError').text("{__('Invalid url')|UPPER}").css('color','red').show();
            }
            if($("input.Emulator[name=command]").val()===""){
                $('#commandError').text("{__('Invalid command')|UPPER}").css('color','red').show();
            }
            else{
                   try {                        
                       var data=JSON.parse($("#EmulatorPost").val());
                       return $.ajax2({
                        // If you don't set the url
                        // the request will be a GET to the same page
                        url: params['url']+params['command'],
                        data:  data,
                        success: function(result) {                    
                            $("#response").text(JSON.stringify(result)).show();
                            console.log(result);

                        }
                });
                } catch (e) {
                       $('#postError').text("{__('JSON Invalid')|UPPER}").css('color','red').show();
                }
            }
        });  
     
</script>
{*</body>
</html>*}