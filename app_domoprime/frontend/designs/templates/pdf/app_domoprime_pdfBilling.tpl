{if $model->getI18n()->isLoaded()}
    {eval $model->getI18n()->get('body')}
{else}
    {__('No model exists.')}
{/if}    
           
