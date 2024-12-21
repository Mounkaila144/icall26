{if $form->hasValidator('partners_layer_clean')}
<div>
<div>{$form.partners_layer_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="partners_layer_clean" {if $form.partners_layer_clean->getValue()}checked=""{/if}/><span>{__('Remove partners layer')}</span>
</div>
{/if}
