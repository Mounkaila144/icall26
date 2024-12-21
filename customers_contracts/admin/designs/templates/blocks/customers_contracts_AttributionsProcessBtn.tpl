 <a href="#" id="UserAttribution-ProcessTeam" class="btn" title="{__('Process team for contract')}" >
      <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Process team for contract')} {$number_of_attributions}/{$number_of_contracts}</a>  
      
<script type="text/javascript">
    
       $("#UserAttribution-ProcessTeam").click( function () {                  
                return $.ajax2({ 
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('customers_contracts_ajax',['action'=>'ProcessAttributions'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
       });
       
</script>