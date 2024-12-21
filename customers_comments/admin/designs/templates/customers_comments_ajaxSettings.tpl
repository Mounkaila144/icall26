{component name="/site/sublink"} 
{messages class="customers-comments-errors"}
<h3>{__("Customer comment settings")}</h3>
<div>
    <a href="#" id="Settings-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {__('Save')}</a>     
</div>

<fieldset>
    <h3>{__('Options')}</h3>     
     <div>                        
       <div class="errors_settings">{$form.dictionary->getError()}</div>     
       <label>{__('Dictionary (word separated by,)')}</label>    
       <textarea cols="80" rows="10" class="Settings Input" name="dictionary">{$settings->get('dictionary')}</textarea>  
    </div>
     <div>                        
       <div class="errors_settings">{$form.replacement->getError()}</div>     
       <label>{__('Replacement')}</label>    
       <input type="text" class="Settings Input" name="replacement" value="{$settings->get('replacement')}"/>
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
          $(".Settings.Input").each(function() { params.Settings[this.name]=$(this).val(); });               
          return $.ajax2({ data : params,                            
                           url: "{url_to('customers_comments_ajax',['action'=>'Settings'])}",
                           errorTarget: ".customers-comments-errors",
                           target: "#tab-dashboard-x-settings"}); 
        });  
     
</script>
