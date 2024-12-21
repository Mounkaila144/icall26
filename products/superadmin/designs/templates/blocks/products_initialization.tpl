<div>
<div>{$form.products_clean->getError()}</div>
<input type="checkbox" class="{$site->getSiteID()}-SiteInitialization Checkbox" name="products_clean" {if $form.products_clean->getValue()}checked=""{/if}/><span>{__('Remove products')}</span>
</div>

