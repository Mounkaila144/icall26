{messages class="meeting-mutual-calculation-messages"}
<div>
    <a id="StartMeetingCalculation-{$meeting->get('id')}" style="display:none;" href="javascript:void(0);" class="MeetingMutualCalculation btn"><i class="fa fa-play" style="margin-right: 10px;"></i>{__('Start')}</a>
</div>
<div>
    <span>{__('Date of calculation')}</span>
    <input type="text" class="datepicker MeetingMutualCalculationStart-{$meeting->get('id')}" name="date_calculation" />
</div>

<script type="text/javascript">
    
    $('.datepicker').datepicker();
    
    $(".MeetingMutualCalculationStart-{$meeting->get('id')}").click(function() { $("#StartMeetingCalculation-{$meeting->get('id')}").show(); });
    
    $("#StartMeetingCalculation-{$meeting->get('id')}").click(function() {
        var params = { Meeting: {$meeting->get('id')} ,MeetingMutualCalculation: { token:"{mfForm::getToken('CustomerMeetingMutualCalculationForm')}" },  };
        $(".MeetingMutualCalculationStart-{$meeting->get('id')}").each(function() {
            params.MeetingMutualCalculation[$(this).attr('name')] = $(this).val();
        });
        return $.ajax2({    data : params,
                            url : "{url_to('app_mutual_ajax',['action'=>'StartMutualCalculationForMeeting'])}", 
                            errorTarget: ".meeting-mutual-calculation-messages",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function(response)
                                    {                                              
                                        if (response.error) 
                                        {
                                        }
                                        else
                                            $("#meeting-mutual-calculation-dialog-{$meeting->get('id')}").html(response);
                                    }
                        });
        
    });
    
</script>    