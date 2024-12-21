{component name="/site/sublink"} 
{messages class="CustomerContractStatus-errors"}
<h3>{__("Settings")}</h3>
<div>
    <a href="#" id="Settings-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>    
</div>

<fieldset>
    <h3>{__('Options')}</h3>
    <div>
       <div class="errors_settings">{$form.default_status_id->getError()}</div>
       <label>{__('Status by default')}</label>
       {html_options class="Settings" name="default_status_id" options=$form->default_status_id->getOption('choices') selected=$settings->get('default_status_id')}
    </div>  
    <div>
       <div class="errors_settings">{$form.default_attribution_id->getError()}</div>
       <label>{__('Attribution by default')}</label>
       {html_options class="Settings" name="default_attribution_id" options=$form->default_attribution_id->getOption('choices') selected=$settings->get('default_attribution_id')}
    </div>  
</fieldset>

<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".Settings").click(function() {  $('#Settings-Save').show(); });    
    
     $("input.Settings").click(function(){         
           //  $(".errors").messagesManager('clear');
             $("#Settings-Save").show();        
     });
         
     $("select.Settings").change(function(){
          //  $(".errors").messagesManager('clear');
            $("#Settings-Save").show();        
     });

     {* =================== A C T I O N S ================================ *}
    
      
      $('#Settings-Save').click(function(){                             
            var  params= {                  
                                Settings: {                                   
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.Settings,select.Settings").each(function() { params.Settings[this.name]=$(this).val(); });     
        //      alert("Params="+params.toSource());   return ;         
          return $.ajax2({ data : params,                            
                           url: "{url_to('customers_contracts_ajax',['action'=>'Settings'])}",
                           errorTarget: ".CustomerContractStatus-errors",                            
                           target: "#tab-dashboard-site-x-settings"}); 
        });  
     
</script>
