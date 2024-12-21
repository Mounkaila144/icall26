{messages class="site-errors"}
<h3>{__('Import polluter')}</h3> 
<div>
   <a href="#" id="DomoprimeImportPolluter-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:5px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeImportPolluter-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:5px;"></i>{__('Cancel')}</a>
</div>
<div id="my-dropzone" class="dropzone">

<div class="dz-message"><span class="my-dz-legend">{__('Drop files or click here to upload')}</span></div>

</div>
<script type="text/javascript">
 
    if ($("#my-dropzone").find('.dz-default').length)
             $("#my-dropzone")[0].dropzone.off().destroy();
    
    $("#my-dropzone").dropzone({ 
        url:"{url_to("app_domoprime",['action'=>'UploadImportPolluter'])}",
        clickable: true,
        uploadMultiple: false,
        paramName: "ImportPolluter[file]",
        maxFiles: 1,
        params: { "ImportPolluter[token]": "{mfForm::getToken('ImportPolluterUploadForm')}" },    
        init: function(){            
            this.on('queuecomplete', function(){
                
            });
        },
        success : function (resp)
                {
                    if (!resp.xhr.response) return ;
                    try
                    {
                         response = $.parseJSON(resp.xhr.response);                        
                         if (response.info)
                            $(".site-errors").messagesManager('info',response.info);                          
                    }
                    catch (e)
                    {                                           
                    }                 
                }
    }); 
   
       
          {* =====================  A C T I O N S =============================== *}  
      
        $("#DomoprimeImportPolluter-Cancel").click(function() {                  
               return $.ajax2({                                                
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}" , 
                            loading: "#tab-site-dashboard-x-settings-loading",                            
                                errorTarget: ".site-errors",
                                target: "#actions" 
                         }); 
           });
</script>   


   


