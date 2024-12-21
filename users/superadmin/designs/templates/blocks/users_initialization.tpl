<div>
    <div>{$form.users_clean->getError()}</div> 
    <input type="checkbox" class="{$site->getSiteID()}-SiteInitialization  Checkbox" name="users_clean" {if $form.users_clean->getValue()}checked=""{/if}/><span>{__('Remove Users')}</span>
</div>