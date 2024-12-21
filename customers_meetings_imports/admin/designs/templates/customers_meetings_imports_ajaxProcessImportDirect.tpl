{messages class="customer-meeting-import-errors"}
   <div>
       {__('File')}:{$import->get('file')} ({format_size($import->get('filesize'))})
   </div>    
{if $form->isValid()}
    <div>
{__('Number of lines')}:{$import->get('number_of_lines')}
</div>
<div>
<div id="ProgressBar" style="background-color: #ff0000;">
</div>
<div>{__('Lines processed')}: <span id="LinesProcessed">---</span></div>
</div>    
<div>{__('Number of errors in file')}: <a id="nb_errors" href="#" style="display: none;">---</a></div>   
    
<script type="text/javascript">
       
    var timeout_import= window.setTimeout(callImportDirectAjax,500); 
    
    function callImportDirectAjax()
    {
        clearTimeout(timeout_import); 
        return $.ajax2({ data : { Import : "{$import->get('id')}" },
                        url:"{url_to('customers_meeting_imports_ajax',['action'=>'ProcessImportDirectFileLines'])}",                                                  
                        errorTarget: ".customer-meeting-direct-import-errors",
                        error: function ()
                        {
                            clearTimeout(timeout_import); 
                        },                         
                        success: function(resp){ 
                            $("#ProgressBar").html(resp.pourcentage);
                            $("#ProgressBar").width(resp.pourcentage);
                            $("#LinesProcessed").html(resp.lines_processed);
                            $("#nb_errors").html(resp.nb_errors);
                            clearTimeout(timeout_import);                                
                            if ($.isPlainObject(resp))
                            {    
                                if (!resp.isProcessed && !resp.error)
                                {                                      
                                   timeout_import= window.setTimeout(callImportDirectAjax,500);
                                }
                                if(resp.isProcessed)
                                {                                  
                                    $("#nb_errors").show();
                                }
                            }
                            if (resp.infos)
                            {
                                $(".customer-meeting-direct-import-errors").messagesManager('info',resp.infos);
                            }
                        } 
            });        
    }             
         
</script>     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
{else}    
   <table>
   {foreach $import->getFile()->getCsv()->getHeader() as $index=>$name}
       <tr>          
           <td><div class="FieldsFromFile" id="{$index}" name="{$name}">{$name}</div></td>
            <td>
                {html_options class="Fields index-`$index`" name="field" options=$form->getFieldsFromForm() selected=$form->getFieldValueForShow($name)} 
            </td>
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
   
{/if}