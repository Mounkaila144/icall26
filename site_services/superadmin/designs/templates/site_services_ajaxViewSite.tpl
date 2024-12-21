{messages class="site-services-errors"}
<h3>{__('View site description')}</h3>    
<div>
      <a href="#" id="SiteServicesSite-Save" class="btn"><i class="fa fa-save"></i>
        {__('Save')}</a>    
        <a href="#" class="btn" id="SiteServicesSite-Cancel" title="{__('Cancel')}"><i class="fa fa-times"></i>
        {__('Cancel')}</a>   
</div>
{if $item->isLoaded()}
<table class="tab-form" cellpadding="0" cellspacing="0">    
     <tr>
        <td class="label"><span>{__("Company")}{if $form->company->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.company->getError()}</div>               
             <textarea cols="50" rows="2" class="SiteServicesSite Input" name="company">{$item->get('company')}</textarea>
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Description")}{if $form->description->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.description->getError()}</div>               
             <textarea cols="50" rows="4" class="SiteServicesSite Input" name="description">{$item->get('description')}</textarea>
        </td>
    </tr>     
</table>  

<script type="text/javascript">
    
   
    {* =====================  A C T I O N S =============================== *}   
        
    $("#SiteServicesSite-Cancel").click( function () {                     
            return $.ajax2({                  
                url: "{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}",
              loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
           });  
    });
    
  $("#SiteServicesSite-Save").click( function () {      
         var params ={  SiteServicesSite: {   id : '{$item->get('id')}', token: '{$form->getCSRFToken()}'   } } ;           
           $(".SiteServicesSite.Input").each(function () { params.SiteServicesSite[$(this).attr('name')]=$(this).val(); });
            return $.ajax2({   
                data : params,
                url: "{url_to('site_services_ajax',['action'=>'SaveSite'])}",
                loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
           });  
    });  
</script>  

{else}
    {__('Site is invalid')}
{/if}    