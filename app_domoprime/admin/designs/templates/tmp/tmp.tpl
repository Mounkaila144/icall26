 <script type="text/javascript">

            function getSiteDomoprimeBillingForViewContractFilterParameters()
            {
                var params={    Contract: '{$contract->get('id')}',
                                filter: {  order : { }, 
                                        search : { },
                                        equal: { },                                                                                                                                   
                                    nbitemsbypage: $("[name=DomoprimeBillingForViewContract-nbitemsbypage]").val(),
                                    token:'{$formFilter->getCSRFToken()}'
                             } };
                if ($(".DomoprimeBillingForViewContract-order_active").attr("name"))
                     params.filter.order[$(".DomoprimeBillingForViewContract-order_active").attr("name")] =$(".DomoprimeBillingForViewContract-order_active").attr("id");   
                $(".DomoprimeBillingForViewContract-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
                return params;                  
            }

            function updateSiteDomoprimeBillingForViewContractFilter()
            {           
               return $.ajax2({ data: getSiteDomoprimeBillingForViewContractFilterParameters(), 
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}"
                                 });
            }

            function updateSitePager(n)
            {
               page_active=$(".DomoprimeBillingForViewContract-pager .DomoprimeBillingForViewContract-active").html()?parseInt($(".DomoprimeBillingForViewContract-pager .DomoprimeBillingForViewContract-active").html()):1;
               records_by_page=$("[name=DomoprimeBillingForViewContract-nbitemsbypage]").val();
               start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
               $(".DomoprimeBillingForViewContract-count").each(function(id) { $(this).html(start+id) }); // Update index column           
               nb_results=parseInt($("#DomoprimeBillingForViewContract-nb_results").html())-n;
               $("#DomoprimeBillingForViewContract-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
               $("#DomoprimeBillingForViewContract-end_result").html($(".DomoprimeBillingForViewContract-count:last").html());
            }



              {* =====================  P A G E R  A C T I O N S =============================== *}  

               $("#DomoprimeBillingForViewContract-init").click(function() {                  
                   return $.ajax2({                     
                                data : { Contract: '{$contract->get('id')}' },
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}" 
                             }); 
               });

              $('.DomoprimeBillingForViewContract-order').click(function() {
                    $(".DomoprimeBillingForViewContract-order_active").attr('class','DomoprimeBillingForViewContract-order');
                    $(this).attr('class','DomoprimeBillingForViewContract-order_active');
                    return updateSiteDomoprimeBillingForViewContractFilter();
               });

                $(".DomoprimeBillingForViewContract-search").keypress(function(event) {
                    if (event.keyCode==13)
                        return updateSiteDomoprimeBillingForViewContractFilter();
                });

              $("#DomoprimeBillingForViewContract-filter").click(function() { return updateSiteDomoprimeBillingForViewContractFilter(); }); 

              $("[name=DomoprimeBillingForViewContract-nbitemsbypage]").change(function() { return updateSiteDomoprimeBillingForViewContractFilter(); }); 

             // $("[name=DomoprimeBillingForViewContract-name]").change(function() { return updateSiteDomoprimeBillingForViewContractFilter(); }); 

               $(".DomoprimeBillingForViewContract-pager").click(function () {                    
                    return $.ajax2({ data: getSiteDomoprimeBillingForViewContractFilterParameters(), 
                                     url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                    errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                        loading: "#tab-site-dashboard-customers-contract-loading",
                                    target: "#billings-target-{$contract->get('id')}"
                    });
            });
              {* =====================  A C T I O N S =============================== *}  



                $(".DomoprimeBillingForViewContract-View").click(function() {                  
                   return $.ajax2({                     
                                data : { Contract: '{$contract->get('id')}', DomoprimeBilling: $(this).attr('id') },
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}" 
                             }); 
               });


                $(".DomoprimeBillingForViewContract-SendEmail").click(function () { 
               return $.ajax2({ data : { Billing: $(this).attr('id') },                                              
                                url:"{url_to('app_domoprime_ajax',['action'=>'SendEmailBilling'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                success : function (resp)
                                        {
                                        }
                             }); 
           });
    </script>  
    
    
    
