{messages class="Zone-errors"}
<h3>{__("New Zone")}</h3>
<div>
    <a href="#" id="DomoprimeZone-Save" class="btn"  >
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeZone-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>


    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("Code")}</span></td>
            <td>
                <div class="error-form">{$form.code->getError()}</div>
                <input type="number" class="DomoprimeZone Input form-control" name="code"  value="{$item->get('code')}"/>
                {*if $form->code.getOption('required')}*{/if*}
            </td>
        </tr>
        <tr>
            <td class="label">{__("Department")}</td>
            <td>
                <div class="error-form">{$form.dept->getError()}</div>
                <input type="text" class="DomoprimeZone Input form-control" name="dept" value="{$item->get('dept')|escape}"/>
                {*if $form->dept->getOption('required')}*{/if*}
            </td>
        </tr>
        <tr>
            <td class="label">{__("Sector")}</td>
            <td>
                <div class="error-form">{$form.sector_id->getError()}</div>
                {html_options name="sector_id" class="form-control DomoprimeZone Select" options=$form->sector_id->getOption('choices')}
            </td>
        </tr>
         <tr>
            <td class="label">{__("Region")}</td>
            <td>
                <div class="error-form">{$form.region_id->getError()}</div>
                {html_options name="region_id" class="form-control DomoprimeZone Select" options=$form->region_id->getOption('choices')}
            </td>
        </tr>

    </table>


<script type="text/javascript">


    {* =================== F I E L D S ================================ *}
    $(".Zone").click(function() {  $('#Zone-Save').show(); });



    {* =================== A C T I O N S ================================ *}
    $('#DomoprimeZone-Cancel').click(function(){
        return $.ajax2({
            url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialZone'])}",
            errorTarget: ".DomoprimeZone-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions" });
    });

    $('#DomoprimeZone-Save').click(function(){
        var  params= {
            DomoprimeZone: {
                token :'{$form->getCSRFToken()}'
            } };
        $(".DomoprimeZone.Input").each(function() {  params.DomoprimeZone[this.name]=$(this).val();  });  // Get foreign key
        $(".DomoprimeZone.Select option:selected").each(function () { params.DomoprimeZone[$(this).parent().attr('name')]=$(this).val(); });

        return $.ajax2({ data : params,
            errorTarget: ".Zone-errors",
            url: "{url_to('app_domoprime_ajax',['action'=>'NewZone'])}",
            target: "#actions" });
    });

</script>