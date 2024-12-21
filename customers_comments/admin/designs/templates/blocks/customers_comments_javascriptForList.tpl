<script type="text/javascript">
    $(".Comments-Log-Customer").click( function () { 
               return $.ajax2({ data :{ id: $(this).attr('id') },
                                url: "{url_to('customers_comments_ajax',['action'=>'ListPartialLogForCustomer'])}",
                                errorTarget: ".customers-errors",
                                loading: "#tab-site-dashboard-x-customers-loading",
                                target: "#tab-site-panel-dashboard-x-customers-base"});
          });

</script>
