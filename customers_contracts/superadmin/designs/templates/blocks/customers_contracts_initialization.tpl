{if $form->hasValidator('contracts_clean')}
<div>
<div>{$form.contracts_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="contracts_clean" {if $form.contracts_clean->getValue()}checked=""{/if}/><span>{__('Remove contracts')}</span>
</div>
{/if}

