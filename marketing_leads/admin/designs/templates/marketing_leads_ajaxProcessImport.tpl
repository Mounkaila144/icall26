{messages class="marketing-leads-import-errors"}
<div id="MarketingLeadsWpFormsLeadsImportImportMaker">
    {__('File')}:{$import->get('file')}
</div>
<div>
    {__('Size')}:{format_size($import->get('filesize'))}
</div>
<div>
    {__('Number of lines')}:{$import->get('number_of_lines')}
</div>
<div>
    <div id="ProgressBar" style="background-color: #ff0000;"></div>
    <div>{__('Lines processed')}: <span id="LinesProcessed">---</span></div>
</div>   
<div>{__('Import log file')}: <a target='_blank' id="log_file" href="#" style="display: none;">log.csv</a></div>   
<div>{__('Number of errors in file')}: <a id="nb_errors" href="#" style="display: none;">---</a></div>   

<script type="text/javascript">
       
    var timeout_import= window.setTimeout(callImportAjax,500); 
    
    function callImportAjax()
    {
        clearTimeout(timeout_import); 
        return $.ajax2({ data : { Import : "{$import->get('id')}", Mode: "{$mode}" },
                        url:"{url_to('marketing_leads_ajax',['action'=>'ProcessImportFileLines'])}",                                                  
                        errorTarget: ".marketing-leads-import-errors",
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
                                    timeout_import= window.setTimeout(callImportAjax,500);
                                }
                                if(resp.isProcessed)
                                {
                                    $("#log_file").attr("href",resp.log_file);
                                    $("#log_file").show();
                                    $("#nb_errors").show();
                                }
                            }
                            if (resp.infos)
                            {
                                $(".marketing-leads-import-errors").messagesManager('info',resp.infos);
                            }
                        } 
            });        
    }             
    
    $("#ReStart").click(function() { 
        callImportAjax();
    });
    
    $("#nb_errors").click(function(){
        
        openTab("x-settings");
        $("#marketing-leads-import-dialog").dialog('close');
        
        $.ajax2({
            url: "{url_to('marketing_leads_ajax',['action'=>'ListFiles'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#tab-dashboard-x-settings"  
        });
        
        setTimeout(function(){
            return $.ajax2({
                data: { Import : "{$import->get('id')}" },
                url: "{url_to('marketing_leads_ajax',['action'=>'ViewLog'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions-wp-landing-page-site-list"  
            });
        }, 500);
    });
    
</script> 