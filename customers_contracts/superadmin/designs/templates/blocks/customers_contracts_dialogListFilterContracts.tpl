<div id="{$site->getSiteID()}-dialogListFilterContracts" class="dialogs" title="{__('Contracts')}" style="display:none">
  {include file="./../customers_contracts_ajaxDialogListFilterContracts.tpl"}  
</div>

<script type="text/javascript">
          
    if ($(".ui-dialog[aria-describedby={$site->getSiteID()}-dialogListFilterContracts]" ).length)
    {
       $(".ui-dialog[aria-describedby={$site->getSiteID()}-dialogListFilterContracts]" ).remove();     
    }
    
    $("#{$site->getSiteID()}-dialogListFilterContracts").dialog({
                    "autoOpen":false,"height":"auto","modal":true,"width":"auto",
                  
                    buttons: {
                        "{__('select')|capitalize}": function() {       
                               $("#{$site->getSiteID()}-dialogListFilterContracts").trigger({ type:'select',  
                                    selected: $("#{$site->getSiteID()}-dialogListFilterContracts").data('selected'),
                                    object : $("#{$site->getSiteID()}-dialogListFilterContracts").data('object')
                               });
                               $( this ).dialog( "close" );
                        },
                        "{__('cancel')|capitalize}": function() {
                            $( this ).dialog( "close" );
                        }
                    }
     }); 
        
</script>    