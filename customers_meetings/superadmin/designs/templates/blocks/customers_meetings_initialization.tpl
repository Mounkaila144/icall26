<div>
<div>{$form.meetings_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="meetings_clean" {if $form.meetings_clean->getValue()}checked=""{/if}/><span>{__('Remove meetings')}</span>
</div>
