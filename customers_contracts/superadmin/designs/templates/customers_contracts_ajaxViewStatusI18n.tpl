{messages class="{$site->getSiteID()}-CustomerContractStatus-errors"}
<h3>{__("View status")|capitalize}</h3>
<div>
    <a href="#" id="CustomerContractStatus-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="CustomerContractStatus-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table>
    <tr>
        <td>{__('id')}</td>
        <td>{if $item->isLoaded()} 
            <span>{$item->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr>
    <tr>
        <td></td>
        <td><img id="{$item->get('lang')}" name="lang" src="{url("/flags/`$item->get('lang')`.png","picture")}" title="{format_country($item->get('lang'))}" />       
        </td>
    </tr>
     <tr>
        <td><span>{__("name")}</span>
        </td>
        <td><div id="CustomerContractStatus-error_name">{$form.status.name->getError()}</div>  
            <input type="text" class="CustomerContractStatus" name="name" size="48" value="{$item->getCustomerContractStatus()->get('name')}"/> 
        </td>
    </tr>     
      <tr>
        <td><span>{__("color")}</span></td>
        <td>
             <div>{$form.status.color->getError()}</div>               
             <input type="text" size="20" class="CustomerContractStatus" name="color" value="{$item->getCustomerContractStatus()->get('color')}"/> 
        </td>
    </tr>
    <tr>
        <td><span>{__("icon")}</span></td>
        <td>          
            {if $item->isLoaded()}
                <div id="CustomerContractStatus-error_icon"></div>                  
                <div id="CustomerContractStatus-icon_container" {if !$item->getCustomerContractStatus()->get('icon')}style="display:none"{/if}>
                    <img id="CustomerContractStatus-icon_img" {if $item->getCustomerContractStatus()->get('icon')}src="{$item->getCustomerContractStatus()->getIcon()->getURL('superadmin')}"{/if} height="32" width="32" alt="{__('icon')}"/>
                    <span id="CustomerContractStatus-icon_filename">{$item->getCustomerContractStatus()->get("icon")}</span>
                    <a href="#" title="{__('delete')}" id="CustomerContractStatus-DeleteIcon" name="{$item->getCustomerContractStatus()->get('id')}">
                       <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                    </a>
                </div>
                <a id="CustomerContractStatus-ChangeIcon" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>
                     <span id="CustomerContractStatus-text_icon">
                         {if $item->getCustomerContractStatus()->get("icon")} {__('change icon')|capitalize} {else} {__('add icon')|capitalize} {/if}
                     </span>
                </a>
                <div id="CustomerContractStatus-icon" style="display:none">
                     <input class="CustomerContractStatus-fileIcon" type="file" name="CustomerContractStatus[icon]"/> 
                     <a href="#" id="CustomerContractStatus-uploadIcon"><img id="CustomerContractStatus-uploadIcon" src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                     <img id="CustomerContractStatus-iconLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                </div>
            {else}
                <div id="CustomerContractStatus-error_icon">{$form.status.icon->getError()}</div>     
                <input class="files" type="file" name="CustomerContractStatus[status][icon]"/> 
                {if $form->status.icon->getOption('required')}*{/if}    
            {/if}               
            </td>         
    </tr>         
    <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="CustomerContractStatus-error_value">{$form.status_i18n.value->getError()}</div>
            <input type="text" size="10" class="CustomerContractStatusI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->status_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>


<script type="text/javascript">
    
      {* =================== F I L E S ================================ *}
      
        
         {* begin icon *} 
        $("#CustomerContractStatus-ChangeIcon").click(function() {
          $("#CustomerContractStatus-icon").show();
          $(this).hide();
           $("#CustomerContractStatus-Save").show();  
        });
     
        $('#CustomerContractStatus-uploadIcon').click(function(){ 
            return $.ajax2({ 
                loading:"#CustomerContractStatus-iconLoading",    
                errorTarget: ".{$site->getSiteID()}-CustomerContractStatus-errors",     
                data : { CustomerContractStatus: { 
                                   id: "{$item->get('id')}",
                                   token :"{mfForm::getToken('CustomerContractStatusIconForm')}"
                                } },
                url:"{url_to('customers_contracts_ajax',['action'=>'SaveIconStatusI18n'])}",               
                files: ".CustomerContractStatus-fileIcon",
                complete: function()
                          {
                              $(".CustomerContractStatus-fileIcon").val('');       
                          },
                success: function(response)
                         {
                              if (response.icon)
                              {    
                                   $("#CustomerContractStatus-icon_img").attr('src',"{$item->getCustomerContractStatus()->getIcon()->getURLPath('superadmin')}"+response.icon+"?"+$.now()); 
                                   $("#CustomerContractStatus-icon_filename").html(response.icon);
                                   $("#CustomerContractStatus-icon_container").show();

                                   $("#CustomerContractStatus-icon").hide(); 
                                   $("span#CustomerContractStatus-text_icon").html("{__('change icon')|capitalize}");
                                   $("#CustomerContractStatus-ChangeIcon").show();
                              }  
                         }
               }); 
      }); 
      
       $('#CustomerContractStatus-DeleteIcon').click(function(){ 
            if (!confirm("{__("Icon will be deleted. Confirm ?")}")) return false; 
            return $.ajax2({ 
                              data : { CustomerContractStatus: "{$item->getCustomerContractStatus()->get('id')}" }, 
                              url: "{url_to('customers_contracts_ajax',['action'=>'DeleteIconStatus'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerContractStatus-errors",
                              success :function(response) {
                                          if (response.action=='deleteIconStatus' && response.id=="{$item->getCustomerContractStatus()->get('id')}")
                                          {                                                     
                                                $("#CustomerContractStatus-icon_container").hide(); 
                                                $("span#CustomerContractStatus-text_icon").html("{__('add icon')|capitalize}");
                                          }
                              }
            });  
      }); 
      {* end icon *}

     
     
     {* =================== F I E L D S ================================ *}
     $(".CustomerContractStatus,.CustomerContractStatusI18n").click(function() {  $('#CustomerContractStatus-Save').show(); });    
    
     $("#CustomerContractStatus-ChangeIcon").click(function() {
        $("#CustomerContractStatus-icon").show();
        $(this).hide();
      });
      
     
    
     {* =================== A C T I O N S ================================ *}
     $('#CustomerContractStatus-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('CustomersContractStatusFormFilter')}" } },                              
                              url : "{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerContractStatus-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#CustomerContractStatus-Save').click(function(){                             
            var  params= {            
                                CustomerContractStatusI18n: { 
                                   status_i18n : { lang: "{$item->get('lang')}",status_id: "{$item->get('status_id')}"    },
                                   status : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerContractStatusI18n").each(function() { params.CustomerContractStatusI18n.status_i18n[this.name]=$(this).val(); });
          $("input.CustomerContractStatus").each(function() {  params.CustomerContractStatusI18n.status[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".CustomerContractStatus-files",
                           errorTarget: ".{$site->getSiteID()}-CustomerContractStatus-errors",
                           url: "{url_to('customers_contracts_ajax',['action'=>'SaveStatusI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>