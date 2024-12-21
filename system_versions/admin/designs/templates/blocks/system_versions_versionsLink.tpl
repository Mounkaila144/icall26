 <a title="{__('Versions')}" id="user-versions-info" href="#" class="logout-btn"><i class="fa fa-info" style="cursor: pointer;"></i></a> 
<div id="system-versions-dialog" title="{__('Versions')}"></div>
<script type="text/javascript">
    
    if ($("[aria-describedby=system-versions-dialog]").length)
        $("[aria-describedby=system-versions-dialog").remove();
    
    $("#user-versions-info").click(function(){
        $("#system-versions-dialog").dialog( {  autoOpen: false,  height: 'auto', width:'50%',  modal: true });
        return $.ajax2({   
            url:"{url_to('system_versions_ajax',['action'=>'ListVersions'])}" , 
            target: "#system-versions-dialog",
            success: function()
            {                                                         
                $("#system-versions-dialog").dialog('open');                            
            }
        });
    });
</script>

