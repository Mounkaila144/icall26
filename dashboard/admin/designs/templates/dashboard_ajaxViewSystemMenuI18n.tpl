{component name="/site/sublink"} 
{messages class="SystemMenu-errors"}
<h3>{__("View admin menu")}</h3>
<div>
    <a href="#" id="SystemMenu-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="SystemMenu-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<table class="tab-form">
    <tr>
        
   
       {* <td class="label"><span>{__("name")}</span>
        </td>
        <td><div id="SystemMenu-error_name" class="error-form">{$form.menu.name->getError()}</div>  
            <input type="text" class="SystemMenu" name="name" size="48" value="{$item_i18n->getSystemMenu()->get('name')}"/>*} 
  
         <td class="label"><span>{__("value")}{if $form->menu_i18n.value->getOption('required')}*{/if} </span></td>
         <td>
            <div id="SystemMenu-error_value" class="error-form">{$form.menu_i18n.value->getError()}</div>
            <input type="text" class="SystemMenuI18n" name="value" size="40" value="{$item_i18n->get('value')}"/>    
            
         </td>
    </tr>   
</table>
<script type="text/javascript">
     
    
     {* =================== A C T I O N S ================================ *}
   
      
      $('#SystemMenu-Save').click(function(){                             
            var  params= {            
                                SystemMenuI18n: { 
                                   menu_i18n : { lang: "{$item_i18n->get('lang')}" ,menu_id: "{$item_i18n->get('menu_id')}" },
                                   menu : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.SystemMenuI18n").each(function() { params.SystemMenuI18n.menu_i18n[this.name]=$(this).val(); });
          $("input.SystemMenu").each(function() {  params.SystemMenuI18n.menu[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           errorTarget: ".SystemMenu-errors",
                           url: "{url_to('dashboard_ajax',['action'=>'SaveSystemMenuI18n'])}",
                           target: "#tab-dashboard-x-settings"});
        });  
        
        
             $('#SystemMenu-Cancel').click(function(){                           
             return $.ajax2({                              
                              url : "{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}",
                              errorTarget: ".SystemMenu-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#tab-dashboard-x-settings"});
                 });
     
</script>