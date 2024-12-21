{messages class="Polluting-errors"}
<h3>{__("New contact for polluting: %s.",$item->getCompany()->get('name'))}</h3>
<div>
    <a href="#" id="PollutingContact-Save" class="btn" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="PollutingContact-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

<table class="tab-form">
        <tr>
     <td class="label">{__("title")}</td>
     <td class="label"> 
         <div>{$form.sex->getError()}</div>                
         {foreach $form->sex->getOption("choices") as $name=>$gender}
                <input type="radio" class="PollutingContact" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                <span>{format_gender($gender,1,true)|capitalize}</span>
         {/foreach}{if $form->sex->getOption('required')}*{/if}
     </td>
 </tr>
    <tr>
        <td class="label"><span>{__("firstname")}</span></td>
        <td class="label">
             <div>{$form.firstname->getError()}</div>               
             <input type="text" class="PollutingContact" name="firstname" size="25" value="{$item->get('firstname')}"/> 
             {if $form->firstname->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("lastname")}</span></td>
        <td class="label">
             <div>{$form.lastname->getError()}</div>               
             <input type="text" class="PollutingContact" name="lastname" size="25" value="{$item->get('lastname')}"/> 
             {if $form->lastname->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
     <td class="label">{__("email")}</td>
     <td class="label"> 
         <div>{$form.email->getError()}</div> 
         <input type="text" class="PollutingContact" name="email" size="25" value="{$item->get('email')|escape}" size="25"/>
          {if $form->email->getOption('required')}*{/if} 
     </td>             
 </tr>  
 <tr>
     <td class="label">{__("phone")}</td>
     <td class="label"> 
         <div>{$form.phone->getError()}</div> 
         <input type="text" class="PollutingContact" name="phone" value="{$item->get('phone')|escape}" size="25"/>
         {if $form->phone->getOption('required')}*{/if} 
     </td>             
 </tr>  
 <tr>
     <td class="label">{__("mobile")}</td>
     <td class="label"> 
         <div>{$form.mobile->getError()}</div> 
         <input type="text" class="PollutingContact" name="mobile" value="{$item->get('mobile')|escape}" size="25"/>
         {if $form->mobile->getOption('required')}*{/if} 
     </td>             
 </tr>     
  <tr>
     <td class="label">{__("fax")}</td>
     <td class="label"> 
         <div>{$form.fax->getError()}</div> 
         <input type="text" class="PollutingContact" name="fax" value="{$item->get('fax')|escape}" size="25"/>
         {if $form->fax->getOption('required')}*{/if} 
     </td>             
 </tr>  <tr>
     <td class="label">{__("function")}</td>
     <td class="label"> 
         <div>{$form.function->getError()}</div> 
         <input type="text" class="PollutingContact" name="function" value="{$item->get('function')|escape}" size="30"/>
         {if $form->function->getOption('required')}*{/if} 
     </td>             
 </tr>  
</table>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".PollutingContact").click(function() {  $('#PollutingContact-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#PollutingContact-Cancel').click(function(){                           
             return $.ajax2({ data : { DomoprimePolluting : "{$item->getCompany()->get('id')}" },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPollutingContact'])}",
                              errorTarget: ".Polluting-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#PollutingContact-Save').click(function(){                             
            var  params= {      Polluting: "{$item->getCompany()->get('id')}",      
                                PollutingContract: {  
                                   country : $(".PollutingContact[name=country] option:selected").val() ,                                   
                                   token :'{$form->getCSRFToken()}'
                                } };                
          $("input.PollutingContact[type=text]").each(function() {  params.PollutingContract[this.name]=$(this).val();  });  // Get foreign key                  
          $("input.PollutingContact[type=radio]:checked").each(function() { params.PollutingContract[this.name]=$(this).val(); }); 
          return $.ajax2({ data : params,                            
                           errorTarget: ".Polluting-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           url: "{url_to('app_domoprime_ajax',['action'=>'NewpollutingContact'])}",
                           target: "#actions" }); 
        });  
     
</script>
