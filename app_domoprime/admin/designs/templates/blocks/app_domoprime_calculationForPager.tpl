<span style="font-weight: bold">{__('Cumac')}:</span>
{if $item->hasCalculation()}
    <span style="font-weight: bold;color:{if $item->getCalculation()->isAccepted()}#00ff00{else}#ff0000{/if}">{$item->getCalculation()->getStatusI18n()}</span>
{else}
    {__('---')}
{/if}