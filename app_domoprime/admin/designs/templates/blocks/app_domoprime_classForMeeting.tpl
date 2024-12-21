<fieldset>
    <legend><h3>{__('Class')}</h3></legend>
<div>
    <span id="AppDomoprime-Class-{$meeting->get('id')}">
        {if !$engine->hasError()}
            {$engine->getClass()->getI18n()}
        {else}
            {__('---')}
        {/if}    
    </span>
</div>
</fieldset>
