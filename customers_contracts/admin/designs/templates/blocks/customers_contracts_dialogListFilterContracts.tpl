<div id="dialogListFilterContracts" class="dialogs" title="{__('Contracts')}" style="display:none">
  {include file="./../customers_contracts_ajaxDialogListFilterContracts.tpl"}  
</div>

<script type="text/javascript">
          
    if ($(".ui-dialog[aria-describedby=dialogListFilterContracts]" ).length)
    {
       $(".ui-dialog[aria-describedby=dialogListFilterContracts]" ).remove();     
    }
    
    $("#dialogListFilterContracts").dialog({
                    "autoOpen":false,"height":"auto","modal":true,"width":"auto",
                  
                    buttons: {
                        "{__('select')|capitalize}": function() {       
                               $("#dialogListFilterContracts").trigger({ type:'select',  
                                    selected: $("#dialogListFilterContracts").data('selected'),
                                    object : $("#dialogListFilterContracts").data('object')
                               });
                               $( this ).dialog( "close" );
                        },
                        "{__('cancel')|capitalize}": function() {
                            $( this ).dialog( "close" );
                        }
                    }
     }); 
        
</script>    