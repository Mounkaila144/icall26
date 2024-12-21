{if $form->hasValidator('marketing_leads_clean')}
<div>
    <div>{$form.marketing_leads_clean->getError()}</div>
    <input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="marketing_leads_clean" {if $form.marketing_leads_clean->getValue()}checked=""{/if}/><span>{__('Remove leads')}</span>
</div>
{/if}