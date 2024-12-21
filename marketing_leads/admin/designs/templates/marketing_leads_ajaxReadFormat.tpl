{messages class="site-errors"}
<h3>{__('New format')}</h3>    
<div>   
    <a href="javascript:void(0);" id="LeadsFormats-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {__('Save')}</a> 
    <a href="javascript:void(0);" id="LeadsFormats-Cancel" class="btn"><i class="fa fa-times" style="color:#000; margin-right:10px;"></i>
        {__('Cancel')}</a>  
</div>
<div>{__("Format name")}:{$form.name}</div>
<table>
{foreach $header as $index=>$field}
    <tr>
        <td><div class="FieldsFromFile" id="{$index}" name="{$field}">{$field}</div></td>
        <td>{html_options class="Fields index-`$index`" name="field" options=$fields}</td>
    </tr>
{/foreach}    
</table>
<script type="text/javascript">
     
    {* =================== A C T I O N S ================================ *}
     
    $('#LeadsFormats-Cancel').click(function(){                                           
        return $.ajax2({                           
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}",
            errorTarget: ".site-errors",
            target: "#actions-wp-landing-page-site-list"
        }); 
    }); 
        
    $('#LeadsFormats-Save').click(function(){                                                  
        var params= { WpFormsLeadsImportReadFormat: { 
            token :'{mfForm::getToken('MarketingLeadsWpFormsLeadsImportFormatForm')}' , fields : [ ] ,name: '{$form.name}'} };  
        $(".FieldsFromFile").each(function () { 
            params.WpFormsLeadsImportReadFormat.fields.push({ name: $(this).attr('name'),
                                                            value: $(".Fields.index-"+$(this).attr('id')).val() 
                                                          });
        });
        return $.ajax2({ data: params,                                
                        errorTarget: ".site-errors",
                        url: "{url_to('marketing_leads_ajax',['action'=>'SaveReadFormat'])}", 
                        target: "#actions-wp-landing-page-site-list"
                    }); 
    });          
</script>