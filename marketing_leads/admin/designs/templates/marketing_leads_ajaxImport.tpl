{messages class="marketing-leads-import-errors"}
{if $form->hasFormats()}
<div> 
    <table>
        <tr>
            <td>{__('Format')}:
            </td>
            <td><div>{$form.format_id->getError()}</div> 
                {html_options name="format_id" class="MarketingLeadsWpFormsLeadsImport Select" options=$form->format_id->getOption('choices')}
            </td>
        </tr>
        <tr>
            <td>{__('Header')}:
            </td>
            <td><div>{$form.has_header->getError()}</div> 
                <input type="checkbox" class="MarketingLeadsWpFormsLeadsImport Checkbox" name="has_header" value="" {if (string)$form.has_header=='YES'}checked=""{/if}/>
            </td>
        </tr>
        <tr>
            <td>{__('Mode')}:</td>
            <td>
                <div>{$form.mode->getError()}</div> 
                {html_options name="mode" class="MarketingLeadsWpFormsLeadsImport Select" options=$form->mode->getOption('choices')}
            </td>
        </tr>
        {if $form->hasValidator('site_id')}
        <tr>  
            <td>{__('Campaign')}:
            </td>
            <td>
                {html_options name="site_id" class="MarketingLeadsWpFormsLeadsImport Select" options=$form->site_id->getOption('choices')}
            </td>
        </tr>
        {/if}
        <tr>
            <td>{__('File')}:</td>
            <td>
                <div>{$form.file->getError()}</div> 
                <div>{__('Max size for file %s.',format_size($form->file->getOption('max_size')))},{__('authorized formats: %s',$form->file->getExtensions())}</div>
                <input class="files" type="file" name="WpFormsLeadsImport[file]"/>           
            </td>
        </tr> 
    </table>       
</div>
<a href="#" id="Import-leads" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
    {__('Import leads')}</a>   
        
{/if}        
<script type="text/javascript">
    
    {* =================== A C T I O N S ================================ *}          
    $('#Import-leads').click(function(){                                                  
        var params= { iFrame:true, 
                        WpFormsLeadsImport: {                               
                        token :'{$form->getCSRFToken()}' } };  
        $(".MarketingLeadsWpFormsLeadsImport.Select option:selected").each(function () { params.WpFormsLeadsImport[$(this).parent().attr('name')]=$(this).val(); });
        $(".MarketingLeadsWpFormsLeadsImport.Checkbox").each(function () { params.WpFormsLeadsImport[$(this).attr('name')]=$(this).is(':checked')?true:false });
        
        return $.ajax2({ data: params, 
                        files: ".files",
                        errorTarget: ".marketing-leads-import-errors",
                        url: "{url_to('marketing_leads_ajax',['action'=>'Import'])}", 
                        target: "#marketing-leads-import-dialog"
                    }); 
    });          
</script>        