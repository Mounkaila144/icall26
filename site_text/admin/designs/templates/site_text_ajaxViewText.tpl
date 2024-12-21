{messages class="SiteText-errors"}
<h3>{__("View text")}</h3>
<div>
    <a href="#" id="SiteText-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="SiteText-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
<table class="tab-form" cellpadding="0" cellspacing="0">      
     <tr class="full-with">
        <td class="label">{__('Module')}</td>
        <td>
            <div class="error-form">{$form.module->getError()}</div>     
            <input type="text" class="SiteText Input" size="40" name="module" value="{$item->get('module')|escape}"/>
        </td>
    </tr>
    <tr class="full-with">
        <td class="label">{__('Key')}</td>
        <td>
            <div class="error-form">{$form.key->getError()}</div>     
            <input type="text" class="SiteText Input" size="40" name="key" value="{$item->get('key')|escape}"/>
        </td>
    </tr>
      <tr class="full-with">
        <td class="label">{__('Value')}</td>
        <td>
            <div class="error-form">{$form.value->getError()}</div>     
            <input type="text" class="SiteText Input" size="40" name="value" value="{$item->get('value')|escape}"/>
        </td>
    </tr>
</table>    
   
  
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".SiteText").click(function() {  $('#SiteText-Save').show(); });           
         
    
     
     {* =================== A C T I O N S ================================ *}
     $('#SiteText-Cancel').click(function(){              
             return $.ajax2({  url : "{url_to('site_text_ajax',['action'=>'ListPartialText'])}",
                              errorTarget: ".SiteText-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
       $('#SiteText-Save').click(function(){                             
            var  params= {       SiteText: {     
                                   id : '{$item->get('id')}',
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".SiteText.Input").each(function() {  params.SiteText[$(this).attr('name')]=$(this).val();  });          
          return $.ajax2({ data : params,                            
                           errorTarget: ".SiteText-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",       
                           url: "{url_to('site_text_ajax',['action'=>'SaveText'])}",
                           target: "#actions" 
                        }); 
        });  
</script>

{else}
    {__('Text is invalid')}
{/if}    
