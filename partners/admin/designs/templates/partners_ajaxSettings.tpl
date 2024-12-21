{component name="/site/sublink"} 
{messages class="partner-errors"}
<h3>{__("Partner settings")}</h3>
<div>
    <a href="#" id="Settings-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
       {__('Save')}</a>    
  
</div>

<fieldset>
    <h3>{__('Options')}</h3>    
     <div>
       <div class="errors_settings">{$form.partner_group_id->getError()}</div>
       <label>{__('Default group for partner')}</label>
       {html_options class="Settings" name="partner_group_id" options=$form->partner_group_id->getOption('choices') selected=$settings->get('partner_group_id')}
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
          $("input.Settings[type=checkbox]").each(function() { params.Settings[this.name]=$(this).is(':checked'); }); 
        //      alert("Params="+params.toSource());   return ;         
          return $.ajax2({ data : params,                            
                           url: "{url_to('partners_ajax',['action'=>'Settings'])}",
                           errorTarget: ".partner-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           target: "#tab-dashboard-x-settings"}); 
        });  
    


</script>

