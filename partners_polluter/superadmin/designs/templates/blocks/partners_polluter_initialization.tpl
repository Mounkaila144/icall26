<div>
<div>{$form.partners_polluter_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="partners_polluter_clean" {if $form.partners_polluter_clean->getValue()}checked=""{/if}/><span>{__('Remove partners polluter')}</span>
</div>
