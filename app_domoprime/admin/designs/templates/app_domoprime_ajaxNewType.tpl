{messages class="DomoprimeType-errors"}
<h3>{__("New type")}</h3>
<div>
    <a href="#" id="DomoprimeType-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeType-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form" cellpadding="0" cellspacing="0">      
     <tr class="full-with">
        <td class="label">{__('Name')}</td>
        <td>
            <div class="error-form">{$form.name->getError()}</div>     
            <input type="text" class="DomoprimeType Input" size="40" name="name" value="{$item->get('name')}"/>
        </td>
    </tr>
    <tr class="full-with">
        <td class="label">{__('Commercial')}</td>
        <td>
            <div class="error-form">{$form.commercial->getError()}</div>     
            <input type="text" class="DomoprimeType Input" size="40" name="commercial" value="{$item->get('commercial')}"/>
        </td>
    </tr>
</table>    
   
  
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeType").click(function() {  $('#DomoprimeType-Save').show(); });           
         
    
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeType-Cancel').click(function(){              
             return $.ajax2({  url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialType'])}",
                              errorTarget: ".DomoprimeType-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
       $('#DomoprimeType-Save').click(function(){                             
            var  params= {       DomoprimeSubventionType: {                                    
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".DomoprimeType.Input").each(function() {  params.DomoprimeSubventionType[$(this).attr('name')]=$(this).val();  });          
          return $.ajax2({ data : params,                            
                           errorTarget: ".DomoprimeType-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",       
                           url: "{url_to('app_domoprime_ajax',['action'=>'NewType'])}",
                           target: "#actions" 
                        }); 
        });  
</script>

