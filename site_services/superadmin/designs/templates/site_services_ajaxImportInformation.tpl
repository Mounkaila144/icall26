{messages class="errors"}
<h3>{__("Import company")}</h3>
<div>
    <a href="#" class="btn" id="ImportInformation-Save"><i class="fa fa-save"></i>{__('Save')}</a>
    <a href="#" class="btn" id="ImportInformation-Cancel"><i class="fa fa-times"></i>{__('Cancel')}</a>
</div>
<div>
 <table class="tab-form">            
        <tr class="full-with">
        <td class="label"><span>{__("File")}{if $form->file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="ImportInformation[file]"/> 
            </div>          
        </td>
    </tr> 
</table> 
</div>
<script type="text/javascript">
         $('#ImportInformation-Save').click(function(){                           
         var params = { ImportInformation : {                                    
                                    token : '{$form->getCSRFToken()}'
                            }
                      };        
         return $.ajax2({     data : params,
                              files: ".files",
                              url : "{url_to('site_services_ajax',['action'=>'ImportInformation'])}",                              
                             loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services" }); 
      }); 
     
        $('#ImportInformation-Cancel').click(function(){
              return $.ajax2({ url: '{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}',
                               loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services" }); 
        });

</script>






