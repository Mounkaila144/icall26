<div>
    {__('Attributions completion')} <span class="Fields" name="number_of_contracts">{$number_of_contracts}</span> <a href="#"id="AttributionsTreatmentProcess"><i class="fa fa-cog"/><a/>
</div>

<script type="text/javascript">
  
    $("#AttributionsTreatmentProcess").click(function () {
            return $.ajax2({     url:"{url_to('customers_contracts_ajax',['action'=>'TreatmentAttributionsProcess'])}",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 errorTarget: ".customers-contract-treatment-errors",                             
                                 success: function (resp)
                                        {
                                               $(".Fields[name=number_of_contracts]").html(resp.number_of_contracts);
                                        }
                });
    });
</script> 
