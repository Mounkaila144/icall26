{messages class="site-errors"}
<h3>{__('New format')}</h3>    
<div>   
    <a href="javascript:void(0);" id="LeadsFormats-Read" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {__('Read')}</a>  
    <a href="javascript:void(0);" id="LeadsFormats-Cancel" class="btn"><i class="fa fa-times" style="color:#000; margin-right:10px;"></i>
        {__('Cancel')}</a>  
</div>
<table cellpadding="0" cellspacing="0">  
    <tr>
        <td>{__('Name')}</td>
        <td> 
            <div>{$form.name->getError()}</div> 
            <input class="MarketingLeadsWpFormsLeadsImportFormat" type="text" name="name" value="{$form.name}"/> 
            {if $form->name->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td>{__('file')}:</td>
        <td>
            <div>{$form.file->getError()}</div> 
            <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))}</div>
            <input class="files" type="file" name="WpFormsLeadsImportFormat[file]"/>           
        </td>
    </tr>       
</table>

<script type="text/javascript">
    
    {* =================== A C T I O N S ================================ *}
     
    $('#LeadsFormats-Cancel').click(function(){                                           
        return $.ajax2({                           
                    url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFormat'])}",
                    errorTarget: ".site-errors",
                    target: "#actions-wp-landing-page-site-list"}); 
    }); 
        
    $('#LeadsFormats-Read').click(function(){                                                  
        var params= { iFrame:true, 
                        WpFormsLeadsImportFormat: { 
                            name : $(".MarketingLeadsWpFormsLeadsImportFormat[name=name]").val(),
                            token :'{$form->getCSRFToken()}' } };                            
        return $.ajax2({ data: params, 
                        files: ".files",
                        errorTarget: ".site-errors",
                        url: "{url_to('marketing_leads_ajax',['action'=>'ReadFormat'])}", 
                        target: "#actions-wp-landing-page-site-list"
                    }); 
    });          
</script>