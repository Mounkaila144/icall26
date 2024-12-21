 {messages class="site-errors"}
<h3>{__("Import group")}</h3>
<div>
    <a href="#" class="btn" id="Save" style="display:none">
             <i class="fa fa-floppy-o"  style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="Cancel" class="btn">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">       
     <tr class="full-with">
        <td class="label"><span>{__("Name")} {if $form->name->getOption('required')}*{/if} </span>
        </td>
        <td><div class="error-form">{$form.name->getError()}</div>  
            <input type="text" class="ImportGroup Input" name="name" size="64" value="{$form.name}"/> 
        </td>
    </tr>    
        <tr class="full-with">
        <td class="label"><span>{__("File")}{if $form->file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="ImportGroup[file]"/> 
            </div>          
        </td>
    </tr> 
</table>

<script type="text/javascript">
    
         $('#Cancel').click(function(){ return  $.ajax2({ 
                url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                loading: "#tab-site-dashboard-x-settings-loading",
                errorTarget: ".site-errors",
                target: "#actions"});
         });
                 
            $(".ImportGroup").click(function() { 
                $("#Save").show();
            });
            
        $('#Save').click(function() { 
                 var params= { ImportGroup : {                                        
                                       token : '{$form->getCSRFToken()}' 
                                    } }; 
             
                   $(".ImportGroup.Input").each(function() {  params.ImportGroup[$(this).attr('name')]=$(this).val(); });
                   return $.ajax2({ data:params, 
                                    files: ".files",
                                    url:"{url_to('users_guard_ajax',['action'=>'ImportGroup'])}" , 
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                    errorTarget: ".site-errors",
                                    target: "#actions"}); 
                   
            });  
                      
   
</script>


