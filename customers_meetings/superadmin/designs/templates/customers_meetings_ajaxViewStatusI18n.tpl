{messages class="{$site->getSiteID()}-CustomerMeetingStatus-errors"}
<h3>{__("View status")|capitalize}</h3>
<div>
    <a href="#" id="CustomerMeetingStatus-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="CustomerMeetingStatus-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
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
        <td><div id="CustomerMeetingStatus-error_name">{$form.status.name->getError()}</div>  
            <input type="text" class="CustomerMeetingStatus" name="name" size="48" value="{$item->getCustomerMeetingStatus()->get('name')}"/> 
        </td>
    </tr>     
      <tr>
        <td><span>{__("color")}</span></td>
        <td>
             <div>{$form.status.color->getError()}</div>               
             <input type="text" size="20" class="CustomerMeetingStatus" name="color" value="{$item->getCustomerMeetingStatus()->get('color')}"/> 
        </td>
    </tr>
    <tr>
        <td><span>{__("icon")}</span></td>
        <td>          
            {if $item->isLoaded()}
                <div id="CustomerMeetingStatus-error_icon"></div>                  
                <div id="CustomerMeetingStatus-icon_container" {if !$item->getCustomerMeetingStatus()->get('icon')}style="display:none"{/if}>
                    <img id="CustomerMeetingStatus-icon_img" {if $item->getCustomerMeetingStatus()->get('icon')}src="{$item->getCustomerMeetingStatus()->getIcon()->getURL('superadmin')}"{/if} height="32" width="32" alt="{__('icon')}"/>
                    <span id="CustomerMeetingStatus-icon_filename">{$item->getCustomerMeetingStatus()->get("icon")}</span>
                    <a href="#" title="{__('delete')}" id="CustomerMeetingStatus-DeleteIcon" name="{$item->getCustomerMeetingStatus()->get('id')}">
                       <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                    </a>
                </div>
                <a id="CustomerMeetingStatus-ChangeIcon" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>
                     <span id="CustomerMeetingStatus-text_icon">
                         {if $item->getCustomerMeetingStatus()->get("icon")} {__('change icon')|capitalize} {else} {__('add icon')|capitalize} {/if}
                     </span>
                </a>
                <div id="CustomerMeetingStatus-icon" style="display:none">
                     <input class="CustomerMeetingStatus-fileIcon" type="file" name="CustomerMeetingStatus[icon]"/> 
                     <a href="#" id="CustomerMeetingStatus-uploadIcon"><img id="CustomerMeetingStatus-uploadIcon" src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                     <img id="CustomerMeetingStatus-iconLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                </div>
            {else}
                <div id="CustomerMeetingStatus-error_icon">{$form.status.icon->getError()}</div>     
                <input class="files" type="file" name="CustomerMeetingStatus[status][icon]"/> 
                {if $form->status.icon->getOption('required')}*{/if}    
            {/if}               
            </td>         
    </tr>         
    <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="CustomerMeetingStatus-error_value">{$form.status_i18n.value->getError()}</div>
            <input type="text" size="10" class="CustomerMeetingStatusI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->status_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>

<script type="text/javascript">
    
      {* =================== F I L E S ================================ *}
      
        
         {* begin icon *} 
        $("#CustomerMeetingStatus-ChangeIcon").click(function() {
          $("#CustomerMeetingStatus-icon").show();
          $(this).hide();
           $("#CustomerMeetingStatus-Save").show();  
        });
     
        $('#CustomerMeetingStatus-uploadIcon').click(function(){ 
            return $.ajax2({ 
                loading:"#CustomerMeetingStatus-iconLoading",    
                errorTarget: ".{$site->getSiteID()}-CustomerMeetingStatus-errors",     
                data : { CustomerMeetingStatus: { 
                                   id: "{$item->get('id')}",
                                   token :"{mfForm::getToken('CustomerMeetingStatusIconForm')}"
                                } },
                url:"{url_to('customers_meeting_ajax',['action'=>'SaveIconStatusI18n'])}",               
                files: ".CustomerMeetingStatus-fileIcon",
                complete: function()
                          {
                              $(".CustomerMeetingStatus-fileIcon").val('');       
                          },
                success: function(response)
                         {
                              if (response.icon)
                              {    
                                   $("#CustomerMeetingStatus-icon_img").attr('src',"{$item->getCustomerMeetingStatus()->getIcon()->getURLPath('superadmin')}"+response.icon+"?"+$.now()); 
                                   $("#CustomerMeetingStatus-icon_filename").html(response.icon);
                                   $("#CustomerMeetingStatus-icon_container").show();

                                   $("#CustomerMeetingStatus-icon").hide(); 
                                   $("span#CustomerMeetingStatus-text_icon").html("{__('change icon')|capitalize}");
                                   $("#CustomerMeetingStatus-ChangeIcon").show();
                              }  
                         }
               }); 
      }); 
      
       $('#CustomerMeetingStatus-DeleteIcon').click(function(){ 
            if (!confirm("{__("Icon will be deleted. Confirm ?")}")) return false; 
            return $.ajax2({ 
                              data : { CustomerMeetingStatus: "{$item->getCustomerMeetingStatus()->get('id')}" }, 
                              url: "{url_to('customers_meeting_ajax',['action'=>'DeleteIconStatus'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerMeetingStatus-errors",
                              success :function(response) {
                                          if (response.action=='deleteIconStatus' && response.id=="{$item->getCustomerMeetingStatus()->get('id')}")
                                          {                                                     
                                                $("#CustomerMeetingStatus-icon_container").hide(); 
                                                $("span#CustomerMeetingStatus-text_icon").html("{__('add icon')|capitalize}");
                                          }
                              }
            });  
      }); 
      {* end icon *}

     
     
     {* =================== F I E L D S ================================ *}
     $(".CustomerMeetingStatus,.CustomerMeetingStatusI18n").click(function() {  $('#CustomerMeetingStatus-Save').show(); });    
    
     $("#CustomerMeetingStatus-ChangeIcon").click(function() {
        $("#CustomerMeetingStatus-icon").show();
        $(this).hide();
      });
      
     
    
     {* =================== A C T I O N S ================================ *}
     $('#CustomerMeetingStatus-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('CustomersMeetingStatusFormFilter')}" } },                              
                              url : "{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerMeetingStatus-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#CustomerMeetingStatus-Save').click(function(){                             
            var  params= {            
                                CustomerMeetingStatusI18n: { 
                                   status_i18n : { lang: "{$item->get('lang')}",status_id: "{$item->get('status_id')}"    },
                                   status : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerMeetingStatusI18n").each(function() { params.CustomerMeetingStatusI18n.status_i18n[this.name]=$(this).val(); });
          $("input.CustomerMeetingStatus").each(function() {  params.CustomerMeetingStatusI18n.status[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".CustomerMeetingStatus-files",
                           errorTarget: ".{$site->getSiteID()}-CustomerMeetingStatus-errors",
                           url: "{url_to('customers_meeting_ajax',['action'=>'SaveStatusI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>