{component name="/site/sublink"} 
{messages class="CustomerMeetingStatus-errors"}
<h3>{__("Meeting settings")}</h3>
<div>
    <a href="#" id="Settings-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>    
</div>

<fieldset>
    <h3>{__('Options')}</h3>
    <div>
       <div class="errors_settings">{$form.status_transfer_to_contract_id->getError()}</div>
       <label>{__('Status for transfer to contract')}</label>
       {html_options class="Settings" name="status_transfer_to_contract_id" options=$form->status_transfer_to_contract_id->getOption('choices') selected=$settings->get('status_transfer_to_contract_id')}
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
                           url: "{url_to('customers_meeting_ajax',['action'=>'Settings'])}",
                           errorTarget: ".CustomerMeetingStatus-errors",
                           target: "#tab-dashboard-x-settings"}); 
        });  
     
</script>
