{messages class="errors"}
<h3>{__("load module")|capitalize}</h3>
<div>
    <a href="#" id="moduleManagerAdmin-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="moduleManagerAdmin-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>           
</div>
<table cellpadding="0" cellspacing="0">
    <tr>
        <td><span>{__("file")}</span></td>
        <td>
            <div id="moduleManagerAdmin-error_file" class="moduleManagerAdmin-errors">{$form.file->getError()}</div>                                                      
            <div id="moduleManagerAdmin-file">
               <input class="moduleManagerAdmin-files" type="file" name="modules[file]"/> 
            </div>
            {if $form->file->getOption('required')}*{/if}   
        </td>
    </tr>
</table>
<script type="text/javascript">
    
     $('#moduleManagerAdmin-Cancel').click(function(){     
           return $.ajax2({ url: "{url_to('modules_manager_ajax_moduleManagerAdmin',['action'=>'ListPartialModuleManagerAdmin'])}",target: "#actions"}); 
     });
     
     $(".moduleManagerAdmin-files").change(function() {
        $("#moduleManagerAdmin-Save").show();     
     });
      
     $('#moduleManagerAdmin-Save').click(function(){ 
              
          var params= {  iFrame:true,                          
                         modules: {                               
                                    token :'{$form->getCSRFToken()}' 
                             } };          
            //  alert("Params="+params.toSource()); return;
              return $.ajax2({ 
                  data : params,                  
                  url:"{url_to('modules_manager_ajax_moduleManagerAdmin',['action'=>'SaveLoadModuleManagerAdmin'])}",
                  files: ".moduleManagerAdmin-files",  
                  target: "#actions"
                 /* success:function (response)
                          {
                              $(".moduleManagerAdmin-files").val('');                          
                              $(".moduleManagerAdmin-errors").html(""); // clear form error fields 
                              if (response.errors)
                                  $.each(response.errors,function(id,value) {  $("#moduleManagerAdmin-error_"+id).html(value); }); 
                          }*/
              });
              
         });
        
</script>
