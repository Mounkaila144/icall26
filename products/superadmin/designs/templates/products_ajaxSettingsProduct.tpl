{messages class="{$site->getSiteID()}-Product-errors"}
<h3>{__("Settings product")}</h3>
<div>
     <a href="#" id="{$site->getSiteID()}-Product-Save" style="display:none"><img src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
     <a href="#" id="{$site->getSiteID()}-Product-Cancel"><img src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>   

<fieldset>
    <h3>{__('currency options')}</h3>
    <div>
       <div>{$form.default_currency->getError()}</div>
       <label>{__('currency by default')}</label>                  
       {html_options_format class="{$site->getSiteID()}-Product-settings" name="default_currency" options=$form->default_currency->getOption('choices') selected=$settings->get('default_currency') format=currency_symbol}
    </div>   
</fieldset>


<script type="text/javascript">        
            
   
                 
         $("input.{$site->getSiteID()}-Product-settings").click(function(){         
             $(".{$site->getSiteID()}-Product-errors").messagesManager('clear');
             $("#{$site->getSiteID()}-Product-Save").show();        
         });
         
         $("select.{$site->getSiteID()}-Product-settings").change(function(){
            $(".{$site->getSiteID()}-Product-errors").messagesManager('clear');
            $("#{$site->getSiteID()}-Product-Save").show();        
         });
         
         $('#{$site->getSiteID()}-Product-Save').click(function(){ 
          var  params= { Settings: {  token :'{$form->getCSRFToken()}' } };
          $("input.{$site->getSiteID()}-Product-settings,select.{$site->getSiteID()}-Product-settings,textarea.{$site->getSiteID()}-Product-settings").each(function(id) { params.settings[this.name]=$(this).val(); });                             
             return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-Product-errors",
                           url: "{url_to('products_ajax',['action'=>'Settings'])}",
                           target: "#{$site->getSiteID()}-actions"}); 
         });

         $('#{$site->getSiteID()}-Product-Cancel').click(function(){ 
                return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
                                 target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings" 
                              }); 
        });
</script>