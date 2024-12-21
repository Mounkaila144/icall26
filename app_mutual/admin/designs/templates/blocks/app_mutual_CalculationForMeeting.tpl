<a id="OpenMeetingMutualCalculationDialog-{$meeting->get('id')}" href="javascript:void(0);" class="OpenMeetingMutualCalculationDialog" title="{__('Meeting calculation')}" ><i class="fa fa-calculator"></i></a>

<div id="meeting-mutual-calculation-dialog-{$meeting->get('id')}" title="Calculation" style="display: none;"></div>

<script type="text/javascript">
    
    if ($("[aria-describedby=meeting-mutual-calculation-dialog-{$meeting->get('id')}]").length)
        $("[aria-describedby=meeting-mutual-calculation-dialog-{$meeting->get('id')}]").remove();
    
    $("#OpenMeetingMutualCalculationDialog-{$meeting->get('id')}").click(function() {
        $("#meeting-mutual-calculation-dialog-{$meeting->get('id')}").dialog({  autoOpen: false, modal: true,  height: 'auto', width:'50%' });
        return $.ajax2({    data : { Meeting: {$meeting->get('id')} },
                            url : "{url_to('app_mutual_ajax',['action'=>'CalculationMutualForMeeting'])}", 
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            errorTarget: ".meeting-mutual-calculation-messages",
                            success : function(response)
                                    {                                              
                                        if (response.error) 
                                        {
                                        }
                                        else{
                                            $("#meeting-mutual-calculation-dialog-{$meeting->get('id')}").html(response);
                                            $("#meeting-mutual-calculation-dialog-{$meeting->get('id')}").dialog('open');
                                        }
                                    }
                        });
    });
    
</script>    