<div>
    {__('Partner layer')}:       
    {if !$partner_layers->isEmpty()}
    <select id="CustomerContractView-PartnerLayers-{$contract->get('id')}" name="partner_layers">
        {foreach $partner_layers as $layer_contact}
            <option data-json='{$layer_contact->toArrayForSelect()->toJson()}' value="{$layer_contact->get('id')}" {if ($selected && $selected==$layer_contact->get('name')) || ($selected==""  && $layer_contact->getPartner()->isDefault())}selected=""{/if}>{$layer_contact->getPartner()->get('name')|upper}-{$layer_contact->get('firstname')|upper} {$layer_contact->get('lastname')|upper}</option>
        {/foreach}        
    </select>
    {/if}   
    <span><button id="CustomerContractView-PartnerLayerImport">{__('Import')}</button></span>
</div>    
<br/>
<script type="text/javascript">
    $("#CustomerContractView-PartnerLayerImport").click(function() { 
        var data=$("#CustomerContractView-PartnerLayers-{$contract->get('id')} option:selected").data('json');
         $(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Input[id=poseur][name=nom]").val(data.firstname);
         $(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Input[id=poseur][name=prenom]").val(data.lastname);
         $(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Input[id=poseur][name=raison_sociale]").val(data.company.name);
         $(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Input[id=poseur][name=siret]").val(data.company.siret);
    });
</script>