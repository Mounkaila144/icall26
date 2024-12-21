{messages class="site-errors"}
{if $item->isLoaded()}
<h3>{__('View pricing for [%s]',$item->getPolluter()->get('name'))}</h3>    
<div>     
       <a href="#" class="btn" style="display:none" id="DomoprimePolluterClassPricing-Save" title="{__('Save')}" >
      <i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('Save')}</a>  
      <a href="#" class="btn" id="DomoprimePolluterClassPricing-Cancel" title="{__('Cancel')}" >
      <i class="fa fa-times" style="margin-right:10px;"></i>
      {__('Cancel')}</a>      
</div>
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td class="label">{__('Class')}</td>
        <td>
            <div class="error-form">{$form.class_id->getError()}</div>     
            {html_options class="DomoprimePolluterClassPricing Select" name="class_id" options=$form->class_id->getOption('choices') selected=$item->get('class_id')}
        </td>
    </tr>   
    <tr class="full-with">
        <td class="label"><span>{__("Coef")}</span></td>
        <td>
            <div class="error-form">{$form.coef->getError()}</div>               
             <input type="text" size="20" class="DomoprimePolluterClassPricing Input" name="coef" value="{$item->getCoefficient()->getFormatted("#.000000")}"/> 
        </td>
    </tr>  
     <tr class="full-with">
        <td class="label"><span>{__("Multiple floor")}</span></td>
        <td>
            <div class="error-form">{$form.multiple_floor->getError()}</div>               
             <input type="text" size="20" class="DomoprimePolluterClassPricing Input" name="multiple_floor" value="{$item->get('multiple_floor')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple top")}</span></td>
        <td>
            <div class="error-form">{$form.multiple_top->getError()}</div>               
             <input type="text" size="20" class="DomoprimePolluterClassPricing Input" name="multiple_top" value="{$item->get('multiple_top')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple wall")}</span></td>
        <td>
            <div class="error-form">{$form.multiple_wall->getError()}</div>               
             <input type="text" size="20" class="DomoprimePolluterClassPricing Input" name="multiple_wall" value="{$item->get('multiple_wall')}"/> 
        </td>
    </tr>
</table>  
<script type="text/javascript">
  {* =================== F I E L D S ================================ *}
     $(".DomoprimePolluterClassPricing").click(function() {  $('#DomoprimePolluterClassPricing-Save').show(); });           
     
      $('#DomoprimePolluterClassPricing-Save').click(function(){                             
            var  params= {           
                                PolluterClassPricing: {      
                                   id : '{$item->get('id')}',
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".DomoprimePolluterClassPricing.Input").each(function() { params.PolluterClassPricing[$(this).attr('name')]=$(this).val(); });
          $(".DomoprimePolluterClassPricing.Select option:selected").each(function() {  params.PolluterClassPricing[$(this).parent().attr('name')]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
        //  $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,                           
                           url: "{url_to('app_domoprime_ajax',['action'=>'SavePricingForPolluter'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });  
     
    
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimePolluterClassPricing-Cancel").click( function () {             
            return $.ajax2({     
                data : {  Polluter : '{$item->getPolluter()->get('id')}' },
                url: "{url_to('app_domoprime_ajax',['action'=>'ListPartialPricingForPolluter'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
          
</script>    

{else}
    {__('Polluter is invalid.')}
{/if}  

