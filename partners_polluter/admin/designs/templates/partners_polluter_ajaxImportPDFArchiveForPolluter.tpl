{messages class="PartnerPolluterModel-errors"}
{if $item->isLoaded()}
<h3>{__("Import PDF model archive for polluter [%s]",$item->get('name'))}</h3>
<div>
    <a href="#" id="Save" class="btn" style="">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
        <a href="#" id="Cancel" class="btn">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">   

        <tr class="full-with">
        <td class="label"><span>{__("ZIP")}{if $form->file->getOption('required')}*{/if}</span></td>
            <td>
                <div id="error_file" class="error-form">{$form.file->getError()}</div>
                <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))}</div>
                <div>
                    <input class="files" type="file" name="PolluterModelI18n[file]"/>
                </div>
            </td>
        </tr>

</table>


<script type="text/javascript">
     {* =================== F I E L D S ================================ *}
//     $(".PartnerPolluterModelI18n,.PartnerPolluterModel").click(function() {  $('#PartnerPolluterModel-Save').show(); });
                       
     {* =================== A C T I O N S ================================ *}
     $('#Cancel').click(function(){
             return $.ajax2({ data: { Polluter: '{$item->get('id')}' },
                              url : "{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                              errorTarget: ".PolluterModelI18n-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      $('#Save').click(function(){
            var  params= {
                           Polluter : '{$item->get('id')}',
                           PolluterModelI18n: {
                                 token :'{$form->getCSRFToken()}'
                                }
            };
            console.log(params);
          return $.ajax2({ data : params,
                           files: ".files",
                           errorTarget: ".PartnerPolluterModel-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           url: "{url_to('partners_polluter_ajax',['action'=>'UploadImportPDFArchiveForPolluter'])}",
                           target: "#actions" });
        });
     
  
     
</script>
{else}
    {__('Polluter is invalid')}
{/if}    