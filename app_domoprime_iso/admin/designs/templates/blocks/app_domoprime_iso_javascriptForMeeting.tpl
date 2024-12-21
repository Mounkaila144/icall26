<script type="text/javascript">
    
     $(".CustomerMeetings-Migrate").click( function () {                
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('app_domoprime_iso_ajax',['action'=>'MigrateMeeting'])}",                                             
                errorTarget: ".customers-meeting-site-errors",              
                loading: "#tab-site-dashboard-customers-meeting-loading"
                 
           });           
    });
</script>
