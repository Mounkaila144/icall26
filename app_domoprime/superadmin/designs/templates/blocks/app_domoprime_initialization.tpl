{if $form->hasValidator('app_domoprime_clean')}
<div>
<div>{$form.app_domoprime_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="app_domoprime_clean" {if $form.app_domoprime_clean->getValue()}checked=""{/if}/><span>{__('Remove Cumac information')}</span>
</div>
<div>
<div>{$form.app_domoprime_polluters_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="app_domoprime_polluters_clean" {if $form.app_domoprime_polluters_clean->getValue()}checked=""{/if}/><span>{__('Remove Cumac polluters')}</span>
</div>
{/if}

