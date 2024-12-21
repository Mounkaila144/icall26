<fieldset>
    <legend><h3>{__('Zone')}</h3></legend>
<div>
    <span id="AppDomoprime-Zone">{__('----')}</span>
</div>
</fieldset>
<script type="text/javascript">
    $(".CustomerAddress[name=postcode]").keyup(function () { 
         $("#AppDomoprime-Zone").html("{__('----')}");
        if ($(this).val().length < 5)
            return ;
        return $.ajax2({   data: { ZoneFromPostcode : { postcode : $(this).val(), token: '{mfForm::getToken('DomoprimeZoneFromPostcodeForm')}' } }, 
                                url: "{url_to('app_domoprime_ajax',['action'=>'GetZoneFromPostcode'])}", 
                                errorTarget: ".site-meeting-errors",
                                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                                success : function (resp)
                                        {
                                            $("#AppDomoprime-Zone").html(resp.zone);
                                        }
                                }); 
    });
</script>     
