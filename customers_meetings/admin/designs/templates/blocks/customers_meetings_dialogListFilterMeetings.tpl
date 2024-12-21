<div id="DialogListFilterMeetings" class="dialogs" title="{__('Meetings')}" style="display:none">
   {include file="./../customers_meetings_ajaxDialogListFilterMeetings.tpl"}   
</div>

<script type="text/javascript">
          
    if ($(".ui-dialog[aria-describedby=DialogListFilterMeetings]" ).length)
    {
       $(".ui-dialog[aria-describedby=DialogListFilterMeetings]" ).remove();     
    }
    
    $("#DialogListFilterMeetings").dialog({
                    "autoOpen":false,"height":"auto","modal":true,"width":"auto",
                  
                    buttons: {
                        "{__('Select')}": function() {       
                               $("#DialogListFilterMeetings").trigger({ type:'select',  
                                    selected: $("#DialogListFilterMeetings").data('selected'),
                                    object : $("#DialogListFilterMeetings").data('object')
                               });
                               $( this ).dialog( "close" );
                        },
                        "{__('Cancel')}": function() {
                            $( this ).dialog( "close" );
                        }
                    }
     }); 
        
</script>    
