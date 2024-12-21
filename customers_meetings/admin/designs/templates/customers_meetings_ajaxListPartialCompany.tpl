
{messages class="site-customers-meeting-company-errors"}
    <h3>{__('Meeting companies')}</h3>    
    <div>   
      <a href="#" class="btn" id="CustomerMeetingCompany-New" title="{__('New company')}" >
           <i class="fa fa-plus" style="margin-right: 10px"></i>{__('New company')}</a>            
    </div>
    {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetingCompany"}
    <button class="btn-table" id="CustomerMeetingCompany-filter">{__("Filter")}</button>   
    <button class="btn-table" id="CustomerMeetingCompany-init">{__("Init")}</button> 
    <div class="containerDivResp">
    <table class="tabl-list" cellpadding="0" cellspacing="0">    
        <tr class="list-header">
            <th>#</th>       
            <th>
                <span>{__('Name')}</span>
            </th>  
            <th>
                <span>{__('Commercial Name')}</span>
            </th>   
              <th>
                <span>{__('Email')}</span>
            </th>    
            <th>
                <span>{__('Active')}</span>
            </th>                  
            <th>
                <span>{__('Actions')}</span>
            </th>                  
        </tr>
        <tr>
            <td>{* # *}
            </td>
            <td>{* date *}
                <input type="text" class="CustomerMeetingCompany-search" name="name"   size="5" value="{$formFilter.search.name}"/>
            </td> 
            <td>{* date *}
              
            </td>  
            <td>
                
            </td>
            <td>{* date *}
                {html_options class=" CustomerMeetingCompany-equal"  name="is_active" options=$formFilter->equal.is_active->getOption('choices') selected=(string)$formFilter.equal.is_active}
            </td>            
        </tr>
        {foreach $pager as $item}
            <tr class="CustomerMeetingCompany-list list" id="CustomerMeetingCompany-{$item->get('id')}"> 
                    <td class="CustomerMeetingCompany-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
                    <td>                
                       {$item->get('name')}
                    </td>                                  
                    <td>
                       {__($item->get('postcodes'))}
                    </td>
                      <td>
                       {$item->get('email')}
                    </td>
                    <td>
                        <a href="#" class="CustomerMeetingCompany-status"  id="{$item->get('id')}"  name="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__("`$item->get("is_active")`")}' title='{__("`$item->get("is_active")`")}'/></a>
                    </td>
                    <td>

                         <a href="#" title="{__('Edit')}" class="CustomerMeetingCompany-View" id="{$item->get('id')}">
                              <i class="fa fa-edit" style="margin-right: 10px;font-size:15px;"></i>
                         </a>                   
                           <a href="#" title="{__('Remove')}" class="CustomerMeetingCompany-Remove" id="{$item->get('id')}" name="{$item->get('name')}" >
                                    <i class="fa fa-times" style="margin-right: 10px;font-size:15px;"></i>
                            </a>                            
                    </td>
            </tr>    
        {/foreach}  
    </table> 
    </div>
    {if !$pager->hasItems()}
         <span>{__('No company')}</span>   
    {/if}
    {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetingCompany"}

    <script type="text/javascript">


        function getCustomerMeetingCompanyFilterParameters()
        {
            var params={   
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },                                                                                                                                 
                                nbitemsbypage: $("[name=CustomerMeetingCompany-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerMeetingCompany-order_active").attr("name"))
                 params.filter.order[$(".CustomerMeetingCompany-order_active").attr("name")] =$(".CustomerMeetingCompany-order_active").attr("id");   
            $(".CustomerMeetingCompany-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            {* ================ EQUAL ============================= *}
            $(".CustomerMeetingCompany-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });           
            return params;                  
        }
        
        function updateCustomerMeetingCompanyFilter()
        {          
           return $.ajax2({ data: getCustomerMeetingCompanyFilterParameters(), 
                            url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialCompany'])}" , 
                            errorTarget: ".site-customers-meeting-company-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",                             
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerMeetingCompany-pager .CustomerMeetingCompany-active").html()?parseInt($(".CustomerMeetingCompany-pager .CustomerMeetingCompany-active").html()):1;
           records_by_page=$("[name=CustomerMeetingCompany-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerMeetingCompany-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerMeetingCompany-nb_results").html())-n;
           $("#CustomerMeetingCompany-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerMeetingCompany-end_result").html($(".CustomerMeetingCompany-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#CustomerMeetingCompany-init").click(function() {               
               $.ajax2({    
                            url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialCompany'])}",
                            errorTarget: ".site-customers-meeting-company-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",                             
                            target: "#actions"
                       }); 
           }); 
           
            $('.CustomerMeetingCompany-order').click(function() {
                $(".CustomerMeetingCompany-order_active").attr('class','CustomerMeetingCompany-order');
                $(this).attr('class','CustomerMeetingCompany-order_active');
                return updateCustomerMeetingCompanyFilter();
           });
           
            $(".CustomerMeetingCompany-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateCustomerMeetingCompanyFilter();
            });
            
          $(".CustomerMeetingCompany-equal[name=is_active]").change(function() { return updateCustomerMeetingCompanyFilter(); }); 
             
          $("#CustomerMeetingCompany-filter").click(function() { return updateCustomerMeetingCompanyFilter(); }); 
          
          $("[name=CustomerMeetingCompany-nbitemsbypage]").change(function() { return updateCustomerMeetingCompanyFilter(); }); 
                  
           
           $(".CustomerMeetingCompany-pager").click(function () {                       
                return $.ajax2({ data: getCustomerMeetingCompanyFilterParameters(), 
                                 url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialCompany'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-customers-meeting-company-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",                             
                                target: "#actions"
                });
        });
        
        
        {* =====================  A C T I O N S =============================== *}   

        $("#CustomerMeetingCompany-New").click( function () {                     
                return $.ajax2({   
                    url: "{url_to('customers_meeting_ajax',['action'=>'NewCompany'])}",
                    errorTarget: ".site-customers-meeting-company-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",                             
                    target: "#actions"
               });  
        });
        
        $(".CustomerMeetingCompany-View").click( function () {                     
                return $.ajax2({   
                    data : { CustomerMeetingCompany: $(this).attr('id')  },
                    url: "{url_to('customers_meeting_ajax',['action'=>'ViewCompany'])}",
                    errorTarget: ".site-customers-meeting-company-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",                             
                    target: "#actions"
               });  
        });
      
   
       $(".CustomerMeetingCompany-Remove").click( function () { 
                
                if (!confirm('{__("Company \"#0#\" will be removed. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({     
                    data : { CustomerMeetingCompany: $(this).attr('id') },
                    url: "{url_to('customers_meeting_ajax',['action'=>'DeleteCompany'])}",
                    errorTarget: ".site-customers-meeting-company-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",   
                    success: function (resp)
                            {
                                 if (resp.action=='DeleteCompany')
                                 {                                  
                                    $("#CustomerMeetingCompany-"+resp.id).remove();    
                                    if ($(".CustomerMeetingCompany-list").length==0)
                                    {
                                         $("#CustomerMeetingCompany-list").after("{__("No company")}")
                                    }  
                                 }    
                            }
               });
          
       });
       
         $('.CustomerMeetingCompany-status').click(function(){    
                var params = { CustomerMeetingCompany : { 
                                    value : $(this).attr('name'),
                                    id : $(this).attr('id'),
                                    token : '{mfForm::getToken('ChangeForm')}'
                             } };
                return $.ajax2({  
                   data: params,
                   url:"{url_to('customers_meeting_ajax',['action'=>'ChangeIsActiveCompany'])}", 
                   errorTarget: ".site-customers-meeting-company-errors",
                   loading: "#tab-site-dashboard-x-settings-loading", 
                   success : function (resp){
                                if(resp.action=="ChangeIsActiveCompany")
                                {
                                    $(".CustomerMeetingCompany-status[id='"+resp.id+"'] img").attr({
                                        src :"{url('/icons/','picture')}"+resp.value+".gif",
                                        alt : (resp.value=='YES'?"{__('YES')}":"{__('NO')}"),
                                        title : (resp.value=='YES'?"{__('YES')}":"{__('NO')}")
                                    });
                                    $(".CustomerMeetingCompany-status[id='"+resp.id+"']").attr("name",resp.value);
                                }
                            }
                });
        });
        
      
        
    </script>  
   

