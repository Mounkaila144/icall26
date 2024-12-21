{messages class="customer-contract-export-import-format-errors"}
<div>
    <a id="CustomerMeetingFormImportFormat-Cancel" href="javascript:void(0);" class="btn"><i class="fa fa-times" style="color:#000; margin-right:10px;"></i>
        {__('Cancel')}</a>
<a href="javascript:void(0);" id="FormatExportImport" class="btn"><i class="fa fa-download" style="color:#000; margin-right:10px;"></i>
    {__('Import')}</a>          
</div>
<div> 
    <table>
        <tr>
            <td>{__('File')}:</td>
            <td>
                <div>{$form.file->getError()}</div> 
                <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))},{__('authorized formats: %s',$form->file->getExtensions())}</div>
                <input class="files" type="file" name="CustomerMeetingFormImport[file]"/>           
            </td>
        </tr> 
    </table>       
</div> 

<script type="text/javascript">
    
    {* =================== A C T I O N S ================================ *}          
    $('#FormatExportImport').click(function(){                                                  
        var params= {   iFrame:true, 
                        CustomerMeetingFormImport: {                               
                        token :'{$form->getCSRFToken()}' } };  
        $(".CustomerMeetingFormImport.Select option:selected").each(function () { params.CustomerMeetingFormImport[$(this).parent().attr('name')]=$(this).val(); });       
        return $.ajax2({ data: params, 
                        files: ".files",
                        url: "{url_to('customers_meeting_forms_ajax',['action'=>'Import'])}", 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions" 
                    }); 
    });  
    
    $('#CustomerMeetingFormImportFormat-Cancel').click(function(){ 
        return $.ajax2({ 
                        url: "{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}", 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions" 
                    }); 
    });
</script>        