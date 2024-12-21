{messages class="DomoprimeZone-errors"}
<h3>{__("View Zone")}</h3>
<div>
    <a href="#" id="DomoprimeZone-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeZone-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {__('Cancel')}</a>
</div>
    <table class="tab-form">

        <tr class="full-with">
            <td class="label"><span>{__("Code")}</span></td>
            <td>
                <div class="error-form">{$form.code->getError()}</div>
                <input type="number"  class="DomoprimeZone" name="code" value="{$item->get('code')}"/>
            </td>
        </tr>
            <tr class="full-with">
                <td class="label"><span>{__("Department")}</span></td>
                <td>
                    <div class="error-form">{$form.dept->getError()}</div>
                    <input type="text"  class="DomoprimeZone" name="dept" value="{$item->get('dept')}"/>
                </td>
            </tr>
        <tr>
            <td class="label">{__("Sector")}</td>
            <td>
                <div class="error-form">{$form.sector_id->getError()}</div>
                {html_options name="sector_id" class="form-control DomoprimeZone Select" options=$form->sector_id->getOption('choices') selected=$item->get('sector_id')}
            </td>
        </tr>
        <tr>
            <td class="label">{__("Region")}</td>
            <td>
                <div class="error-form">{$form.region_id->getError()}</div>
                {html_options name="region_id" class="form-control DomoprimeZone Select" options=$form->region_id->getOption('choices') selected=$item->get('region_id')}
            </td>
        </tr>
    </table>

<script type="text/javascript">



    {* =================== F I E L D S ================================ *}
    $(".DomoprimeZone").click(function() {  $('#DomoprimeZone-Save').show(); });



    {* =================== A C T I O N S ================================ *}
    $('#DomoprimeZone-Cancel').click(function(){
        return $.ajax2({
            url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}",
            errorTarget: ".DomoprimeZone-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions" });
    });

    $('#DomoprimeZone-Save').click(function(){
        var  params= {       DomoprimeZone: {     
                                   id : '{$item->get('id')}',
                                   token :'{$form->getCSRFToken()}'
                                } };    
        $("input.DomoprimeZone").each(function() { params.DomoprimeZone[this.name]=$(this).val(); });
        $(".DomoprimeZone.Select option:selected").each(function () { params.DomoprimeZone[$(this).parent().attr('name')]=$(this).val(); });

        return $.ajax2({ 
            data : params,
            errorTarget: ".DomoprimeZone-errors",
            url: "{url_to('app_domoprime_ajax',['action'=>'SaveZone'])}",
            target: "#actions" });
    });

</script>

    
    