{messages class="Partner-errors"}
<h3>{__("View contact for partner: %s.",$item->getPartner()->get('name'))}</h3>
<div>
    <a href="#" id="PartnerContact-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="PartnerContact-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

<table>
        <tr>
     <td>{__("title")}</td>
     <td> 
         <div>{$form.sex->getError()}</div>                
         {foreach $form->sex->getOption("choices") as $name=>$gender}
                <input type="radio" class="PartnerContact" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                <span>{format_gender($gender,1,true)|capitalize}</span>
         {/foreach}{if $form->sex->getOption('required')}*{/if}
     </td>
 </tr>
    <tr>
        <td><span>{__("firstname")}</span></td>
        <td>
             <div>{$form.firstname->getError()}</div>               
             <input type="text" class="PartnerContact" name="firstname" size="64" value="{$item->get('firstname')}"/> 
             {if $form->firstname->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
        <td><span>{__("lastname")}</span></td>
        <td>
             <div>{$form.lastname->getError()}</div>               
             <input type="text" class="PartnerContact" name="lastname" size="64" value="{$item->get('lastname')}"/> 
             {if $form->lastname->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
     <td>{__("email")}</td>
     <td> 
         <div>{$form.email->getError()}</div> 
         <input type="text" class="PartnerContact" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
          {if $form->email->getOption('required')}*{/if} 
     </td>             
 </tr>  
 <tr>
     <td>{__("phone")}</td>
     <td> 
         <div>{$form.phone->getError()}</div> 
         <input type="text" class="PartnerContact" name="phone" value="{$item->get('phone')|escape}" size="30"/>
         {if $form->phone->getOption('required')}*{/if} 
     </td>             
 </tr>  
 <tr>
     <td>{__("mobile")}</td>
     <td> 
         <div>{$form.mobile->getError()}</div> 
         <input type="text" class="PartnerContact" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
         {if $form->mobile->getOption('required')}*{/if} 
     </td>             
 </tr>     
  <tr>
     <td>{__("fax")}</td>
     <td> 
         <div>{$form.fax->getError()}</div> 
         <input type="text" class="PartnerContact" name="fax" value="{$item->get('fax')|escape}" size="30"/>
         {if $form->fax->getOption('required')}*{/if} 
     </td>             
 </tr>     
</table>

<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".PartnerContact").click(function() {  $('#PartnerContact-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#PartnerContact-Cancel').click(function(){                           
             return $.ajax2({ data : { Partner : "{$item->getPartner()->get('id')}" },                              
                              url : "{url_to('partners_ajax',['action'=>'ListPartnerContact'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#PartnerContact-Save').click(function(){                             
            var  params= {            
                                PartnerContact: {  
                                   id: "{$item->get('id')}",
                                   country : $(".PartnerContact[name=country] option:selected").val() ,                                   
                                   token :'{$form->getCSRFToken()}'
                                } };                
          $("input.PartnerContact[type=text]").each(function() {  params.PartnerContact[this.name]=$(this).val();  });  // Get foreign key                  
          $("input.PartnerContact[type=radio]:checked").each(function() { params.PartnerContact[this.name]=$(this).val(); }); 
          return $.ajax2({ data : params,                            
                           errorTarget: ".Partner-errors",
                           url: "{url_to('partners_ajax',['action'=>'SavePartnerContact'])}",
                           target: "#actions" }); 
        });  
     
</script>