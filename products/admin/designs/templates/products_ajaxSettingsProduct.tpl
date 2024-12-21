{component name="/site/sublink"}
{messages class="Product-errors"}
<h3>{__("Settings product")}</h3>
<div>
     <a href="#" id="Product-Save" style="display:none"><img src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
     <a href="#" id="Product-Cancel"><img src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>   

<fieldset>
    <h3>{__('currency options')}</h3>
    <div>
       <div>{$form.default_currency->getError()}</div>
       <label>{__('currency by default')}</label>                  
       {html_options_format class="Product-settings" name="default_currency" options=$form->default_currency->getOption('choices') selected=$settings->get('default_currency') format=currency_symbol}
    </div>   
</fieldset>


<script type="text/javascript">        
            
   
                 
         $("input.Product-settings").click(function(){         
             $(".Product-errors").messagesManager('clear');
             $("#Product-Save").show();        
         });
         
         $("select.Product-settings").change(function(){
            $(".Product-errors").messagesManager('clear');
            $("#Product-Save").show();        
         });
         
         $('#Product-Save').click(function(){ 
          var  params= { Settings: {  token :'{$form->getCSRFToken()}' } };
          $("input.Product-settings,select.Product-settings,textarea.Product-settings").each(function(id) { params.settings[this.name]=$(this).val(); });                             
             return $.ajax2({ data : params,                            
                           errorTarget: ".Product-errors",
                           url: "{url_to('products_ajax',['action'=>'Settings'])}",
                           target: "#actions"}); 
         });

         $('#Product-Cancel').click(function(){ 
                return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
                                 target: "#tab-dashboard-x-settings" 
                              }); 
        });
</script>