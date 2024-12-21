{messages class="meeting-mutual-view-calculation-messages"}
<style>
    .LeftScreen { float: left; width: 50%; }
    .RightScreen { float: right; width: 50%; top: 10px; margin-top: 10px; text-align: center; }
    .Clear { clear: both; height: 1px; overflow: hidden; font-size: 0pt; margin-top: -1px; }
</style>
<div class="LeftScreen" id="LeftScreen">
    <h3>{__('Meeting calculation')}</h3>    
    <table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
        <thead> 
        <tr class="list-header">   
            <th class="footable-first-column" data-toggle="true">
                <span>{__('Meeting')}</span>
            </th>
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Commission')}</span>               
            </th>
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Decommission')}</span>  
            </th>
            <th data-hide="phone" style="display: table-cell;">
                <span>{__('Calculation date')}</span>                 
            </th> 
        </tr>
        </thead>
        <tr class="MutualCalculationMeeting list" id="MutualCalculationMeeting">        
            <td>{$meeting_calculation->getMeeting()->getCustomer()|upper}</td>
            <td>{$meeting_calculation->getCommissionI18n()}</td>
            <td>{$meeting_calculation->getDecommissionI18n()}</td>
            <td>{$meeting_calculation->getDateCalculation()}</td>  
        </tr>     
    </table> 
    <table class="tabl-list footable table">
        <thead>
            <tr class="list-header">
                <th>{__('Mutual')}</th>
                <th>{__('Products')}</th>
                <th>{__('Commission')}</th>
                <th>{__('Decommission')}</th>
            </tr>
        </thead>
        <tbody>
            {foreach $meeting_calculation->getMutualCalculations() as $mutual_calculation}
                <tr class="list">
                    <td rowspan="{$mutual_calculation->getProductCalculations()->count()+1}">{$mutual_calculation->getMutualPartnerForEngine()}</td> 
                </tr>
                {foreach $mutual_calculation->getProductCalculations() as $product}
                <tr class="list">
                    <td>{$product->geMutualProductForEngine()}</td>
                    <td>{$product->getCommissionI18n()}</td>
                    <td>{$product->getDecommissionI18n()}</td>
                </tr>
                {/foreach}
            {/foreach}
        </tbody>
    </table>  
</div>
<div id="response-calculation-2" class="RightScreen">
    <div id="div-launch-calculation-view-meeting" class="LauncheCalculationViewMeeting">
        <div>
            <span>{__('Date of calculation')}</span>
            <input type="text" class="datepicker MeetingViewMutualCalculationStart-{$meeting->get('id')}" name="date_calculation" />
        </div>
        <div>
            <a id="StartMeetingViewCalculation-{$meeting->get('id')}" href="javascript:void(0);" class="MeetingViewMutualCalculation btn"><i class="fa fa-calculator" style="margin-right: 10px;"></i>{__('Start')}</a>
        </div>
    </div>
    <div id="div-result-calculation-view-meeting">
        
    </div>
</div>
<div class="Clear"></div>

<script type="text/javascript">
    
    $('.datepicker').datepicker();
        
    $("#StartMeetingViewCalculation-{$meeting->get('id')}").click(function() {
        var params = { Meeting: {$meeting->get('id')} ,MeetingMutualCalculation: { token:"{mfForm::getToken('CustomerMeetingMutualCalculationForm')}" },  };
        $(".MeetingMutualCalculationStart-{$meeting->get('id')}").each(function() {
            params.MeetingMutualCalculation[$(this).attr('name')] = $(this).val();
        });
        return $.ajax2({    data : params,
                            url : "{url_to('app_mutual_ajax',['action'=>'StartMutualCalculationForViewMeeting'])}", 
                            errorTarget: ".meeting-mutual-view-calculation-messages",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function(response)
                                    {                                              
                                        if (response.error) 
                                        {
                                        }
                                        else{
                                            $("#LeftScreen").html(response);
{*                                            $("#div-result-calculation-view-meeting").html(response);*}
                                        }
                                    }
                        });
        
    });
    
</script>    