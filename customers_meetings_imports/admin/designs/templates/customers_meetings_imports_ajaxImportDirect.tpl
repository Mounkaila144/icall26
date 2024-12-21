{messages class="customer-meeting-import-errors"}
{if $import}
   <div>
       {__('File')}:{$import->get('file')}
   </div>    
   <table>
   {foreach $import->getFile()->getCsv()->getHeader() as $index=>$name}
       <tr>          
            <td><div class="FieldsFromFile" id="{$index}" name="{$name}">{$name}</div></td>
            <td>{html_options class="Fields index-`$index`" name="field" options=$fields}</td>
       </tr>    
   {/foreach}    
   </table>
    
     <a href="javascript:void(0);" id="Load" class="btn"><i class="fa fa-upload" style="color:#000; margin-right:10px;"></i>
    {__('Load file')}</a>             
    <a href="javascript:void(0);" id="Import" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
    {__('Import file')}</a>   
              
<script type="text/javascript">
     
     
    {* =================== A C T I O N S ================================ *}          
        
    $('#Import').click(function(){                                                  
        var params= {   CustomerMeetingImportFile: '{$import->get('id')}',
                        CustomerMeetingImport:  { token :'{mfForm::getToken('CustomerMeetingFormatDirectForm')}',fields : [ ] }                                
                    };                
        $(".FieldsFromFile").each(function () { 
            params.CustomerMeetingImport.fields.push({ name: $(this).attr('name'),
                                                            value: $(".Fields.index-"+$(this).attr('id')).val() 
                                                        });
        });
        return $.ajax2({ data: params,                         
                         errorTarget: ".customer-meeting-import-errors",
                         url: "{url_to('customers_meeting_imports_ajax',['action'=>'ProcessImportDirect'])}", 
                         target: "#meeting-direct-import-dialog"
                         }); 
    });  
    
    $('#Load').click(function(){                                                         
        return $.ajax2({   errorTarget: ".customer-meeting-import-errors",
                         url: "{url_to('customers_meeting_imports_ajax',['action'=>'ImportDirect'])}", 
                         target: "#meeting-direct-import-dialog"
                         }); 
    });  
</script> 
    
    
{else}    
<div> 
    <table>   
        <tr>
            <td>{__('File')}:</td>
            <td>
                <div>{$form.file->getError()}</div> 
                <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))},{__('authorized formats: %s',$form->file->getExtensions())}</div>
                <input class="files" type="file" name="CustomerMeetingImport[file]"/>           
            </td>
        </tr> 
    </table>
            
</div>
<a href="javascript:void(0);" id="Load" class="btn"><i class="fa fa-upload" style="color:#000; margin-right:10px;"></i>
    {__('Load file')}</a>   
              
<script type="text/javascript">
     
     
    {* =================== A C T I O N S ================================ *}          
        
    $('#Load').click(function(){                                                  
        var params= { iFrame:true, 
                      CustomerMeetingImport: {                               
                        token :'{$form->getCSRFToken()}' } };        
        return $.ajax2({ data: params, 
                         files: ".files",
                         errorTarget: ".customer-meeting-import-errors",
                         url: "{url_to('customers_meeting_imports_ajax',['action'=>'ImportDirect'])}", 
                         target: "#meeting-direct-import-dialog"
                         }); 
    });          
</script>    
{/if}