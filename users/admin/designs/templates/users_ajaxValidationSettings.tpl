{component name="/site/sublink"} 
{messages class="users-errors"}
<h3>{__("Settings")}</h3>
<div>
    <a href="#" id="Settings-Save" class="btn">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('save')}</a>      
</div>

<fieldset>
    <div  class="containerDivResp">
    <table>        

     
      <tr>
       <td>
        <label>{__('Email')}</label>    
       </td>
       <td>
           <div class="errors_settings">{$form.email->getError()}</div>     
         <input type="text" class="Settings" name="email" value="{$settings->get('email')}"/>            
       </td>
     </tr>
     
    </table>
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
                           url: "{url_to('users_ajax',['action'=>'ValidationSettings'])}",
                           errorTarget: ".users-errors",      
                           loading: "#tab-site-dashboard-x-settings-loading",                 
                           target: "#tab-dashboard-x-settings"}); 
        });  
     
</script>
