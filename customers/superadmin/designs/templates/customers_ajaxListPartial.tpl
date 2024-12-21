{messages class="Customers-errors"}
<div>  
    <a class="btn" id="Import" href="#">
        <img src="{url('/icons/import.gif','picture')}" alt="{__('import')}"/>{__('import')|capitalize}
    </a>     
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Customers"}
<button id="filter">{__("Filter")}</button>   <button id="init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
     <tr>
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>{__('id')}
             <div>
                 <a href="#" class="order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                 <a href="#" class="order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>        
         <th>{__('firstname')}
               <div>
              <a href="#" class="order{$formFilter.order.firstname->getValueExist('asc','_active')}" id="asc" name="firstname"><img  src='{url("/icons/sort_asc`$formFilter.order.firstname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.firstname->getValueExist('desc','_active')}" id="desc" name="firstname"><img  src='{url("/icons/sort_desc`$formFilter.order.firstname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         <th>{__('lastname')}
              <div>
              <a href="#" class="order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
          <th>{__('email')}
               <div>
              <a href="#" class="order{$formFilter.order.email->getValueExist('asc','_active')}" id="asc" name="email"><img  src='{url("/icons/sort_asc`$formFilter.order.email->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.email->getValueExist('desc','_active')}" id="desc" name="email"><img  src='{url("/icons/sort_desc`$formFilter.order.email->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
          </th>
          <th>{__('professional')}</th>     
          <th>{__('state')}</th>         
          <th>{__('date creation')}
                <div>
              <a href="#" class="order{$formFilter.order.created_at->getValueExist('asc','_active')}" id="asc" name="created_at"><img  src='{url("/icons/sort_asc`$formFilter.order.created_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="order{$formFilter.order.created_at->getValueExist('desc','_active')}" id="desc" name="created_at"><img  src='{url("/icons/sort_desc`$formFilter.order.created_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
          </th>
         
          <th>{__('status')}
                
          </th>
          <th>{__('actions')}</th>
     </tr>
     <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="search" type="text" size="5" name="id" value="{$formFilter.search.id}"></td>          
            <td><input class="search" type="text" size="5" name="firstname" value="{$formFilter.search.firstname}"></td>
            <td><input class="search" type="text" size="5" name="lastname" value="{$formFilter.search.lastname}"></td>
            <td><input class="search" type="text" size="5" name="email" value="{$formFilter.search.email}"></td>
            <td>{* professional *}</td>     
           {* <td>{html_options_format name="is_active" options=$formFilter->search.is_active->getOption('choices') selected=(string)$formFilter.search.is_active format="__"}</td> *}
            <td></td>
            <td></td>              
            <td></td>
            <td></td>
        </tr>       
        {foreach $pager as $customer}
        <tr class="customers" id="customer_{$customer->get('id')}">
            <td class="customers_count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$customer@iteration}</td>
            {if $pager->getNbItems()>5}<td><input class="selection" type="checkbox" name="{$customer->getId()}" id="{$customer->get('firstname')} {$customer->get('lastname')} ({$customer->get('username')})" /></td>{/if}
            <td>
                {$customer->getId()}
            </td>           
            <td>
                {$customer->get('firstname')|escape}
            </td>
             <td>
                {$customer->get('lastname')|escape}
            </td>
            <td>
                {$customer->get('email')|escape}
            </td>
            <td>{$customer->get('isProfessional')|escape}</td>     
            <td>
               {* {$customer->get('is_active')} *}
               <a href="#" title="{__('change')}" class="Change" id="{$customer->get('id')}" name="{$customer->get('is_active')}"><img  src="{url('/icons/','picture')}{$customer->get('is_active')}.gif" alt='{__("user_`$customer->get("is_active")`")}'/></a>
            </td>
            <td>
                {$customer->get('created_at')}
            </td>            
            <td>
                {$customer->get('status')}
            </td>
            <td>
            {*   <a href="#" title="{__('regenerate password')}" class="RegeneratePassword" id="{$customer->get('id')}" name="{$customer->get('firstname')} {$customer->get('lastname')}"><img  src="{url('/icons/password.png','picture')}" alt='{__("regenerate password")}'/></a>
               <a href="#" title="{__('groups')}" class="ViewGroup" id="{$customer->get('id')}" name="{$customer->get('firstname')} {$customer->get('lastname')}"><img  src="{url('/icons/group.png','picture')}" alt='{__("group")}'/></a>
               <a href="#" title="{__('permissions')}" class="ViewPermissions" id="{$customer->get('id')}" name="{$customer->get('firstname')} {$customer->get('lastname')}"><img  src="{url('/icons/permission.png','picture')}" alt='{__("permissions")}'/></a>
               <a href="#" title="{__('addresses')}" class="Addresses" id="{$customer->get('id')}"><img  src="{url('/icons/address16x16.png','picture')}" alt='{__("Addresses")}'/></a>
               <a href="#" title="{__('edit')}" class="View" id="{$customer->get('id')}" name="{$customer->get('firstname')} {$customer->get('lastname')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
               <a href="#" title="{__('delete')}" class="Delete" id="{$customer->get('id')}" name="{$customer->get('firstname')} {$customer->get('lastname')} ({$customer->get('username')})"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a> *}
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()}  
     {__("no result")}
{else}
   {if $pager->getNbItems()>5}
       <input type="checkbox" id="all" />  
       <a href="#" title="{__('enable')}" id="Enabled" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/YES.gif','picture')}" alt='{__("yes")}'/>
       <a href="#" title="{__('disable')}" id="Disabled" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/NO.gif','picture')}" alt='{__("no")}'/></a>
       <a href="#" title="{__('delete')}" id="Delete" style="opacity:0.5" class="actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
  {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Customers"}
<script type="text/javascript">
        function getCustomersFilterParameters()
        {
            params={ filter: {  order : { }, 
                                     search: { is_active : $("[name=is_active]").val() }, 
                                     nbitemsbypage: $("[name=nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");
            $(".search").each(function(id) { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateCustomersFilter()
        {
           return $.ajax2({ data: getCustomersFilterParameters(), url:"{url('module/customers/admin/List')}" , target: "#middle" });
        }
        
        function updatePager(n)
        {
           page_active=$(".pager .active").html()?parseInt($(".pager .active").html()):1;
           records_by_page=$("[name=nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".customers_count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#end_result").html($(".customers_count:last").html());
        }
        
         function changeCustomerState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.Change#"+this;
                if (resp.state=='YES'||resp.state=='NO') 
                {    
                    $(sel+" img").attr({
                        src :"{url('/icons/','picture')}"+resp.state+".gif",
                        alt : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}'),
                        title : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}')
                    });
                    $(sel).attr("name",resp.state);
                }
            });  
        }
  {JqueryScriptsReady}         
         // {* PAGER - begin *}
         $('.order').click(function() {
             $(".order_active").attr('class','order');
             $(this).attr('class','order_active');
             return updateCustomersFilter();
         });
         
          $("[name=nbitemsbypage],[name=is_active]").change(function() {  return updateCustomersFilter(); }); 
          
          $(".search").keypress(function(event) {
                        if (event.keyCode==13)
                        return updateCustomersFilter();
          });
                   
          $("#filter").click(function() {  return updateCustomersFilter(); }); 
          
          $("#init").click(function() { return $.ajax2({ url:"{url_to('customers_site_ajax',['action'=>'List'])}",target: "#middle"}); }); 
          
          $(".pager").click(function () {
             return $.ajax2({ data: getCustomersFilterParameters(), url:"{url_to('customers_site_ajax',['action'=>'List'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),target: "#middle"});
          });
          
          $("#all").click(function () {  $(".selection").attr("checked",($(this).attr("checked")=="checked"));  });
           // {* PAGER - end *}         
           
           // {* ACTIONS - begin *}
          $("#Enabled,#Disabled").click( function () { 
                params={ users : { selection : {  } , value :(this.id=='Disabled'?'NO':'YES'),token: "{mfForm::getToken('changeUsersForm')}" } };
                idx=0;
                $(".selection:checked").each(function (id) { 
                    if ($(".Change#"+this.name).attr('name')!=params.users.value)
                       params.users.selection[idx++]= this.name;
                });
                if ($.isEmptyObject(params.users.selection))
                   return ;
                return $.ajax2({ data: params ,
                                url: "{url_to('customers_site_ajax',['action'=>'ChangeCustomers'])}",
                                success:function(resp) { 
                                         if (resp.action=='ChangeCustomers')
                                         {  
                                                changeCustomerState(resp);
                                         }
                                }
                });
          });
          
          $("#Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".selection:checked").each(function (id) { 
                params.selection[id]=this.name;
                text+=this.id+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm("{__('Customers :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ data :params,
                              url: "{url_to('customers_site_ajax',['action'=>'DeleteCustomers'])}",
                              success: function(resp) {
                                            if (resp.action=='deleteCustomers')
                                            {                                    
                                                if ($(".customers").length-resp.parameters.length==0)
                                                   return $.ajax2({ url:"{url_to('customers_site_ajax',['action'=>'ListPartial'])}",target: "#actions" });
                                                $.each(resp.parameters, function (id) {  $("tr#customer_"+this).remove(); });
                                                updatePager(resp.parameters.length); 
                                                $("input#all").attr("checked",false);                                    
                                            }       
                              }
             });    
          });
          
          $(".Delete").click( function () { 
                if (!confirm('{__("Customer \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({ data : { user: this.id },
                                 url :"{url_to('customers_site_ajax',['action'=>'DeleteCustomer'])}",
                                 success: function(resp) {
                                        if (resp.action=='deleteCustomer')
                                        {    
                                            if ($(".customers").length-1==0)
                                               return $.ajax2({ url:"{url_to('customers_site_ajax',['action'=>'ListPartial'])}",target: "#actions"});
                                            $("tr#customer_"+resp.id).remove();  
                                            updatePager(1); 
                                        }
                                 }
                        }); 
          });
          
          $(".View").click( function () { 
               return $.ajax2({ data :{ id: this.id },url: "{url_to('customers_site_ajax',['action'=>'ViewCustomer'])}",target: "#actions"});
          });
          
          $(".Addresses").click( function () { 
               return $.ajax2({ data :{ id: this.id },url: "{url_to('customers_site_ajax',['action'=>'AddressCustomerListPartial'])}",target: "#actions"});
          });
          
          $("#New").click( function () { 
              return $.ajax2({ url:"{url_to('customers_site_ajax',['action'=>'NewCustomer'])}",target: "#actions"});
          });
               
          $(".Change").click( function () { 
                    return $.ajax2({ data : { id: this.id , value:this.name },
                                     url: "{url_to('customers_site_ajax',['action'=>'ChangeCustomer'])}",
                                     success:function(resp) { 
                                         if (resp.action=='ChangeCustomer')
                                              changeCustomerState(resp);
                                     }
                         });
          });
          
          $(".RegeneratePassword").click( function () { 
                   return $.ajax2({ data : { id: this.id },
                                    url :"{url_to('customers_site_ajax',['action'=>'RegeneratePasswordCustomer'])}",
                                    success: function(resp) { 
                                           if (resp.action=='RegeneratePasswordCustomer'&&resp.params.id&&resp.params.date)
                                           {
                                                 $("#lastpasswordgen_"+resp.params.id).html(resp.params.date);
                                           } 
                                    }
                         });
          });
          
          $(".ViewPermissions").click( function () { 
                return $.ajax2({ data : { customer: this.id },url: "{url_to('customers_site_ajax',['action'=>'PermissionsList'])}",target: "#actions"});
          });
          
          $(".ViewGroup").click( function () { 
                return $.ajax2({ data : { customer: this.id },url: "{url_to('customers_site_ajax',['action'=>'GroupsList'])}",target: "#actions"});
          });
          
          $(".selection,#all").click(function (){               
                $(".actions_items").css('opacity',($(".selection:checked").length?'1':'0.5'));
          });

            $("#Import").click( function () { 
                return $.ajax2({
                    url: "{url_to('customers_site_ajax',['action'=>'ImportCustomer'])}",
                    target: "#actions"
               });
          });
 {/JqueryScriptsReady}               
</script>