<div id="dialogFileManagerFtpForImport" class="dialogs" title="{__('files')}" {* style="display:none" *}>
{include file="./../utils_dialogFileManagerFtpForImport.tpl"}
</div>
<script type="text/javascript">        
     
  //   $("#dialogFileManagerFtpForImport").find("script").remove(); // Remove script in dialog container          
     
  //   $("#dialogFileManagerFtpForImport").dialog('destroy'); // Remove old dialog 
               
     $("#dialogFileManagerFtpForImport").dialog({
                    "autoOpen":false,"height":"auto","modal":true,"width":"auto",
                  
                    buttons: {
                        "{__('select')|capitalize}": function() {
                               $("#dialogFileManagerFtpForImport").trigger({ type:'select',  
                                    selected: $("#dialogFileManagerFtpForImport").data('selected'),
                                    object : $("#dialogFileManagerFtpForImport").data('object')
                               });
                               $( this ).dialog( "close" );
                        },
                        "{__('cancel')|capitalize}": function() {
                            $( this ).dialog( "close" );                            
                        }
                    }
     });       
     
     $("#dialogFileManagerFtpForImport").unbind(); // Remove all events - mandatory in this place due to dialog init          
     
</script>