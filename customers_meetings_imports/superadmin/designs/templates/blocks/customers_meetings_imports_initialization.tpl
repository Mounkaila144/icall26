{if $form->hasValidator('meetings_import_clean')}
<div>
<div>{$form.meetings_import_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="meetings_import_clean" {if $form.meetings_import_clean->getValue()}checked=""{/if}/><span>{__('Remove meetings imports')}</span>
</div>
{/if}

