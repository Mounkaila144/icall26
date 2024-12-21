{messages class="site-errors"}
<h3>{__('Import text')}</h3> 
<div>
   <a href="#" id="SiteText-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:5px;"></i>{__('Save')}</a>
    <a href="#" id="SiteText-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:5px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">            
        <tr class="full-with">
        <td class="label"><span>{__("File")}{if $form->file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))}</div>
            <div>
               <input class="files SiteText" type="file"  name="ImportSiteText[file]"/> 
            </div>          
        </td>
    </tr> 
</table> 
<script type="text/javascript">
 
      $(".SiteText").click(function () { $("#SiteText-Save").show(); });
       
     {* =================== A C T I O N S ================================ *}
     $('#SiteText-Cancel').click(function(){                           
         return $.ajax2({      url : "{url_to('site_text_ajax',['action'=>'ListPartialText'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#SiteText-Save').click(function(){                           
         var params = { 
                        ImportSiteText : {                                    
                                    token : '{$form->getCSRFToken()}'
                            }
                      };        
         return $.ajax2({     data : params,
                              files: ".files",
                              url : "{url_to('site_text_ajax',['action'=>'ImportText'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
</script>   


   


