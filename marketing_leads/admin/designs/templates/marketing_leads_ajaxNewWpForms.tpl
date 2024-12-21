{messages class="MarketingLeadsWpForms-new-errors"}
<h3>{__("New lead")}</h3>
<div>
    <a href="javascript:void(0);" id="MarketingLeadsWpForms-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="javascript:void(0);" id="MarketingLeadsWpForms-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>

<table class="tab-form">
    <tr>
        <td class="label"><span>{__("Id Wordpress")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.id_wp->getError()}</div>  
            <input type="text" class="MarketingLeadsWpForms" name="id_wp" size="48" value="{$item->get('id_wp')}"/> 
            {if $form->id_wp->getOption('required')}*{/if} 
        </td>
    </tr>     
    <tr>
        <td class="label"><span>{__("Firstname")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.firstname->getError()}</div>  
            <input type="text" class="MarketingLeadsWpForms" name="firstname" size="48" value="{$item->get('firstname')}"/> 
            {if $form->firstname->getOption('required')}*{/if} 
        </td>
    </tr>     
    <tr>
        <td class="label"><span>{__("Lastname")}</span></td>
        <td>
           <div id="MarketingLeadsWpForms-error_text" class="error-form">{$form.lastname->getError()}</div>
           <input type="text" class="MarketingLeadsWpForms" name="lastname" size="40" value="{$item->get('lastname')}"/>    
           {if $form->lastname->getOption('required')}*{/if} 
        </td>
    </tr>   
    <tr>
        <td class="label"><span>{__("Income")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.income->getError()}</div>  
            <input type="text" class="MarketingLeadsWpForms" name="income" size="48" value="{$item->get('income')}"/> 
            {if $form->income->getOption('required')}*{/if} 
        </td>
    </tr>     
    <tr>
        <td class="label"><span>{__("Number of people")}</span></td>
        <td>
           <div id="MarketingLeadsWpForms-error_text" class="error-form">{$form.number_of_people->getError()}</div>
           <input type="text" class="MarketingLeadsWpForms" name="number_of_people" size="40" value="{$item->get('number_of_people')}"/>    
           {if $form->number_of_people->getOption('required')}*{/if} 
        </td>
    </tr>   
    <tr>
        <td class="label"><span>{__("Owner")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.owner->getError()}</div>  
            {html_options class="MarketingLeadsWpFormsSelect" name="owner" options=$form->owner->getOption('choices') selected=$item->get('owner') }
            {if $form->owner->getOption('required')}*{/if}
        </td>
    </tr>     
    <tr>
        <td class="label"><span>{__("Energy")}</span></td>
        <td>
           <div id="MarketingLeadsWpForms-error_text" class="error-form">{$form.energy->getError()}</div>
           {html_options class="MarketingLeadsWpFormsSelect" name="energy" options=$form->energy->getOption('choices') selected= $item->get('energy') }
           {if $form->energy->getOption('required')}*{/if} 
        </td>
    </tr>   
    <tr>
        <td class="label"><span>{__("Phone")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.phone->getError()}</div>  
            <input type="text" class="MarketingLeadsWpForms" name="phone" size="48" value="{$item->get('phone')}"/> 
            {if $form->phone->getOption('required')}*{/if} 
        </td>
    </tr>     
    <tr>
        <td class="label"><span>{__("Email")}</span></td>
        <td>
           <div id="MarketingLeadsWpForms-error_text" class="error-form">{$form.email->getError()}</div>
           <input type="text" class="MarketingLeadsWpForms" name="email" size="40" value="{$item->get('email')}"/>    
           {if $form->email->getOption('required')}*{/if} 
        </td>
    </tr>   
    <tr>
        <td class="label"><span>{__("Address")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.address->getError()}</div>  
            <input type="text" class="MarketingLeadsWpForms" name="address" size="48" value="{$item->get('address')}"/> 
            {if $form->address->getOption('required')}*{/if} 
        </td>
    </tr>     
    <tr>
        <td class="label"><span>{__("Postcode")}</span></td>
        <td>
           <div id="MarketingLeadsWpForms-error_text" class="error-form">{$form.postcode->getError()}</div>
           <input type="text" class="MarketingLeadsWpForms" name="postcode" size="40" value="{$item->get('postcode')}"/>    
           {if $form->postcode->getOption('required')}*{/if} 
        </td>
    </tr>   
    <tr>
        <td class="label"><span>{__("City")}</span></td>
        <td>
            <div id="MarketingLeadsWpForms-error_name" class="error-form">{$form.city->getError()}</div>  
            <input type="text" class="MarketingLeadsWpForms" name="city" size="48" value="{$item->get('city')}"/> 
            {if $form->city->getOption('required')}*{/if} 
        </td>
    </tr>
</table>   
<script type="text/javascript">
   {* =================== F I E L D S ================================ *}
    $(".MarketingLeadsWpForms").click(function() {  $('#MarketingLeadsWpForms-Save').show(); });    
    $(".MarketingLeadsWpFormsSelect").change(function() {  $('#MarketingLeadsWpForms-Save').show(); });    
    
    {* =================== A C T I O N S ================================ *}
    $('#MarketingLeadsWpForms-Cancel').click(function(){                           
        return $.ajax2({ data: { WpLandingPageSite: {$landing_page_site->get('id')} },                            
                        url : "{url_to('marketing_leads_ajax',['action'=>'ListPartialWpForms'])}",
                        errorTarget: ".MarketingLeadsWpForms-new-errors",
                        loading: "#tab-site-dashboard-marketing-leads-loading",                         
                        target: "#actions-wp-landing-page-site-list"
                    }); 
    });
      
    $('#MarketingLeadsWpForms-Save').click(function(){                             
        var  params= {  WpLandingPageSite: {$landing_page_site->get('id')},        
                        WpForms: { 
                            token :'{$form->getCSRFToken()}'
                        } };
        $("input.MarketingLeadsWpForms").each(function() { params.WpForms[$(this).attr('name')]=$(this).val(); });
        $(".MarketingLeadsWpFormsSelect option:selected").each(function() {  params.WpForms[$(this).parent().attr('name')]=$(this).val();  }); 
        return $.ajax2({ data : params,  
                        errorTarget: ".MarketingLeadsWpForms-new-errors",
                        url: "{url_to('marketing_leads_ajax',['action'=>'NewWpForms'])}",
                        loading: "#tab-site-dashboard-marketing-leads-loading",
                        target: "#actions-wp-landing-page-site-list"
                    }); 
    });  
</script>
