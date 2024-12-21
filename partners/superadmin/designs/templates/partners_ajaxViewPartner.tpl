{messages class="{$site->getSiteID()}-Partner-errors"}
<h3>{__("View partner")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Partner-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-Partner-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    <table>
        <tr>
            <td><span>{__("name")}</span></td>
            <td>
                 <div>{$form.name->getError()}</div>               
                 <input type="text" class="{$site->getSiteID()}-Partner" name="name" size="64" value="{$item->get('name')}"/> 
                 {if $form->name->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td>{__("web")}</td>
             <td> 
                 <div>{$form.web->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="web" size="64" value="{$item->get('web')|escape}" size="30"/>
                 {if $form->web->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td>{__("email")}</td>
             <td> 
                 <div>{$form.email->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                  {if $form->email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td>{__("address1")}</td>
             <td> 
                 <div>{$form.address1->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="address1" size="64"  value="{$item->get('address1')|escape}" size="30" />
                 {if $form->address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td>{__("address2")}</td>
             <td> 
                 <div>{$form.address2->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="address2" size="64" value="{$item->get('address2')|escape}" size="30" />
                 {if $form->address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
          <tr>
             <td>{__("city")}</td>
             <td> 
                 <div>{$form.city->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="city" size="32" value="{$item->get('city')|escape}" size="30"/>
                 {if $form->city->getOption('required')}*{/if} 
                 <div id="{$site->getSiteID()}-Partner-cities_container"></div>
             </td>             
         </tr>  
         <tr>
             <td>{__("country")}</td>
             <td> 
                 <div>{$form.country->getError()}</div>                 
                 {select_country class="{$site->getSiteID()}-Partner" name="country" selected=$item->get('country')}
             </td> 
         </tr>  
          <tr>
             <td>{__("phone")}</td>
             <td> 
                 <div>{$form.phone->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                 {if $form->phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td>{__("mobile")}</td>
             <td> 
                 <div>{$form.mobile->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                 {if $form->mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
         <tr>
             <td>{__("fax")}</td>
             <td> 
                 <div>{$form.fax->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="fax" value="{$item->get('fax')|escape}" size="30" />
                 {if $form->fax->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td>{__("GPS coordinates")}</td>
             <td> 
                 <div>{$form.coordinates->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="coordinates" value="{$item->get('coordinates')|escape}" size="30"/>
                 {if $form->coordinates->getOption('required')}*{/if} 
             </td>             
         </tr>   
    </table>
{else}
    <span>{__('Partner is invalid.')}</span>
{/if}    

<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-Partner").click(function() {  $('#{$site->getSiteID()}-Partner-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-Partner-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                              errorTarget: ".{$site->getSiteID()}-Partner-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#{$site->getSiteID()}-Partner-Save').click(function(){                             
            var  params= {            
                                Partner: {   
                                   id: "{$item->get('id')}",
                                   country : $(".{$site->getSiteID()}-Partner[name=country] option:selected").val(),
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $("input.{$site->getSiteID()}-Partner").each(function() {  params.Partner[this.name]=$(this).val();  });  // Get foreign key               
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-Partner-errors",
                           url: "{url_to('partners_ajax',['action'=>'SavePartner'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>