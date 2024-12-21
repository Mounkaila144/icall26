{if $model->getI18n()->isLoaded()}
    {foreach $billings as $billing}
        {eval $model->getI18n()->get('body')}
    {/foreach}
{else}
    {__('No model exists.')}
{/if}          