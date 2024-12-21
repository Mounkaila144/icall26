<div>
<div>{$form.meetings_form_scoring_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="meetings_form_scoring_clean" {if $form.meetings_form_scoring_clean->getValue()}checked=""{/if}/><span>{__('Remove meetings forms scoring')}</span>
<div>{$form.meetings_form_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="meetings_form_clean" {if $form.meetings_form_clean->getValue()}checked=""{/if}/><span>{__('Remove meetings forms')}</span>
</div>

