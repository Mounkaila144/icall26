<a href="#" id="UpdateSites" class="btn" title="{__('Update sites')}">{__('Update sites')}</a>
<script type="text/javascript">

  $("#UpdateSites").click(function (){      
      return $.ajax2({ url: "{url_to('modules_manager_ajax',['action'=>'UpdateSites'])}", 
                        loading: "#tab-dashboard-site-loading",
                        errorTarget: ".errors-tab-dashboard-sites",  
                        success: function (resp)
                                 {
                                     
                                 }
                    
            });
  });

</script>