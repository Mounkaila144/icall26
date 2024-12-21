{messages class="errors"}
<h3>{__("Import company")}</h3>
<div>
    <a href="#" class="btn" id="ImportCompany-Save"><i class="fa fa-save"></i>{__('Save')}</a>
    <a href="#" class="btn" id="ImportCompany-Cancel"><i class="fa fa-times"></i>{__('Cancel')}</a>
</div>
<div>
 <table class="tab-form">            
        <tr class="full-with">
        <td class="label"><span>{__("File")}{if $form->file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="ImportCompany[file]"/> 
            </div>          
        </td>
    </tr> 
</table> 
</div>
<script type="text/javascript">
         $('#ImportCompany-Save').click(function(){                           
         var params = { ImportCompany : {                                    
                                    token : '{$form->getCSRFToken()}'
                            }
                      };        
         return $.ajax2({     data : params,
                              files: ".files",
                              url : "{url_to('site_ajax',['action'=>'ImportCompany'])}",                              
                              loading :"#tab-dashboard-site-loading",
                               target: "#tab-Dashboard-Site" }); 
      }); 
     
        $('#ImportCompany-Cancel').click(function(){
              return $.ajax2({ url: '{url_to('site_ajax',['action'=>'ListPartial'])}',
                                loading :"#tab-dashboard-site-loading",
                               target: "#tab-Dashboard-Site" }); 
        });

</script>





