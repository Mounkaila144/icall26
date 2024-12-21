{if $user->hasCredential([['superadmin','admin','marketing_leads_import']])} 
    <div>
        <a  href="javascript:void(0);" id="MarketingLeadsWpFormsLeads-Import" class="btn widthAFilter" title="{__('Import')}" ><i class="fa fa-plus"></i>
            {__('Import')}</a>
    </div>
    <div id="marketing-leads-import-dialog" style="display:none" class="dialogs" title="{__('Import file')}"></div>

<script type="text/javascript">
    if ($("[aria-describedby=marketing-leads-import-dialog]").length)
        $("[aria-describedby=marketing-leads-import-dialog]").remove();
      
    $("#MarketingLeadsWpFormsLeads-Import").click(function(){          
        $("#marketing-leads-import-dialog").dialog( {  autoOpen: false,  height: 'auto', width:'50%',  modal: true });  
        return $.ajax2({   
                            url:"{url_to('marketing_leads_ajax',['action'=>'Import'])}" , 
                            errorTarget: ".marketing-leads-site-errors",
                            loading: "#tab-site-dashboard-marketing-leads-loading",
                            target: "#marketing-leads-import-dialog",
                            success: function()
                            {                                                         
                                $("#marketing-leads-import-dialog").dialog('open');                            
                            }
                });
    });
</script>
{/if}