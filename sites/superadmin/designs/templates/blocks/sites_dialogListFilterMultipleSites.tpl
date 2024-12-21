<style> .ui-dialog { font-size: 62.5%; } </style>
<div id="dialogListFilterMultipleSites" class="dialogs" title="{__('sites')}" style="display:none">
{include file="./../sites_ajaxDialogListFilterMultipleSites.tpl"} 
</div>
<script type="text/javascript">
     
    {JqueryScriptsReady}                   
     
     $("#dialogListFilterMultipleSites").find("script").remove (); // Remove script in dialog container

     $("#dialogListFilterMultipleSites").dialog({
                    "autoOpen":false,"height":"auto","modal":true,"width":"auto",
                  
                    buttons: {
                        "{__('select')|capitalize}": function() {       
                               if ($("#dialogListFilterMultipleSites").data("selected").length==0)
                               {                                   
                                   $(".errors_ListFilterMultipleSites").messagesManager('warning',"{__('no site selected.')}"); 
                                   return ;
                               }
                               $("#dialogListFilterMultipleSites").trigger({ type:'select',  
                                       selected: $("#dialogListFilterMultipleSites").data("selected")
                               });
                               $( this ).dialog( "close" );
                        },
                        "{__('cancel')|capitalize}": function() {
                            $( this ).dialog( "close" );
                        }
                    }
     });  
         
    {/JqueryScriptsReady}      
</script> 
