 {if $user->hasCredential([['superadmin','meeting_direct_import']])} 
       <div>
  <a  href="javascript:void(0);" id="CustomerMeetings-DirectImport" class="btn widthAFilter" title="{__('Import')}" >
      <i class="fa fa-upload"></i>{__('Import')}</a>
      </div>
  <div id="meeting-direct-import-dialog" style="display:none" class="dialogs" title="{__('Import file')}"></div>


  <script type="text/javascript">
      if ($("[aria-describedby=meeting-direct-import-dialog]").length)
          $("[aria-describedby=meeting-direct-import-dialog").remove();
      
$("#CustomerMeetings-DirectImport").click(function(){          
        $("#meeting-direct-import-dialog").dialog( {  autoOpen: false,  height: 'auto', width:'50%',  modal: true });  
        return $.ajax2({   
                            url:"{url_to('customers_meeting_imports_ajax',['action'=>'ImportDirect'])}" , 
                            errorTarget: ".customers-meeting-site-errors",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#meeting-direct-import-dialog",
                            success: function()
                            {                                                         
                                $("#meeting-direct-import-dialog").dialog('open');                            
                            }
                });
    });
</script>

  {/if}
