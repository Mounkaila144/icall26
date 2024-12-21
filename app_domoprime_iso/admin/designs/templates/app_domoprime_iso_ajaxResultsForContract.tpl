{messages class="site-app-domoprime-results-errors"}

    {if !$engine->hasError()}
    <table>     
         <tr>
            <td> {$engine->getName()}</td>
        </tr>
        {if $engine->getPolluterSource()}
         <tr>
            <td>
                {__('Polluter')} ({$engine->getPolluterSourceI18n()}):
            </td>
            <td>
                {if $engine->hasPolluter()}
                    {$engine->getPolluter()->get('name')|upper}
                {else}
                    {__('No polluter')}
                {/if}    
            </td>
        </tr>
        {/if}
        <tr>
            <td>
                {__('Zone')}:
            </td>
            <td>
                {$engine->getZone()->getSector()->get('name')}
            </td>
        </tr>
         <tr>
            <td>
                {__('Region')}:
            </td>
            <td>
                {$engine->getZone()->getRegion()->get('name')} 
            </td>
        </tr>
        <tr>
            <td>
                {__('Energy')}:
            </td>
            <td>
                {$engine->getEnergy()->getI18n()}
            </td>
        </tr>
        <tr>
            <td>
                {__('Revenue')}:
            </td>
            <td>
                {$engine->getFormattedRevenue()}
            </td>
        </tr>
        <tr>
            <td>
                {__('Number of people')}:
            </td>
            <td>
                {$engine->getFormattedNumberOfPeople()}
            </td>
        </tr>       
        <tr>
            <td>
                {__('Level')}:
            </td>
            <td>
                {$engine->getClass()->getI18n()->get('value')}
            </td>
        </tr>   
        <tr>
            <td>{__('Products')}</td>
            <td>
                <table> 
                    <tr>
                        <th>
                            {__('#')}
                        </th>
                        <th>
                            {__('Product')}
                        </th>
                         <th>
                            {__('Surface')}
                        </th>
                         <th>
                            {__('Qmac')}
                        </th>
                        {if $user->hasCredential([['superadmin','admin','app_domoprime_results_qmac_value']])}
                           <th>
                            {__('Qmac €')}
                        </th>
                        {/if}
                        {if $user->hasCredential([['superadmin','admin','app_domoprime_results_layer']])}
                        <th>
                            {__('Settings price')}
                        </th>
                        {/if}
                        {if $user->hasCredential([['superadmin','admin','app_domoprime_results_margin']])}
                          <th>
                            {__('Margin')}
                        </th>
                        {/if}
                    </tr>
            {foreach $engine->getProducts() as $product}            
                <tr>
                    <td>
                        {$product@index+1}
                    </td>
                    <td>{$product->getProduct()->get('meta_title')}
                    </td>
                    <td>
                        {if $product->hasSurface()}
                            {format_number($engine->getSurfaceFromProduct($product->getProduct()),"#")}
                        {else}
                            {__('---')}    
                        {/if}
                    </td>
                    <td>{if $product->hasSurface()}
                            {$product->getTotalQmac()}
                        {else}
                            {__('---')}    
                        {/if}
                    </td>
                    {if $user->hasCredential([['superadmin','admin','app_domoprime_results_qmac_value']])}
                    <td>
                        {if $product->hasSurface()}
                        {$product->getTotalValueQmac()}
                         {else}
                            {__('---')}    
                        {/if}
                    </td>
                    {/if}
                    {if $user->hasCredential([['superadmin','admin','app_domoprime_results_layer']])}
                    <td>{if $product->hasSurface()}
                        {$product->getTotalPose()}
                         {else}
                            {__('---')}    
                        {/if}
                    </td>
                    {/if}
                    {if $user->hasCredential([['superadmin','admin','app_domoprime_results_margin']])}
                      <td>{if $product->hasSurface()}
                        {$product->getTotalMargin()}
                         {else}
                            {__('---')}    
                        {/if}
                    </td>
                    {/if}
                </tr>
            {/foreach}    
                </table>
            </td>
        </tr>
    </table>
            <div>    
     {if $user->hasCredential([['superadmin','admin','app_domoprime_results_global']])}            
                <strong>{__('Global')}</strong>
     {if $engine->hasPolluter()}            
    <div>
    {__('Coef. Polluter')}:{$engine->getClassPolluterPricing()->getCoefficient()}
    </div>
    {/if}
    <div>
     {__('Qmac')}: {$engine->getTotalQmac()}
    </div>
    <div>
    {__('Qmac value')}: {$engine->getTotalValueQmac()} €
    </div>
    <div>
    {__('Pose')}: {$engine->getTotalPose()} €
    </div>
    <div>
    {__('Marge')}: {$engine->getTotalMargin()} €
    </div>
    <br>
    {/if}
    <div>
       {if $report} 
        {if $report->isAccepted()}
        <span>{__('Accepted')}</span>
        {if $report->hasAcceptedBy()}
           {__('by')} {$report->getAcceptedBy()|upper}
        {/if}    
        {elseif $report->IsRefused()}
             <span>{__('Refused')}</span>
             <div>{__('Causes')}:{$engine->getCauses()}</div>
        {else}
            {__('Require validation')}
        {/if}    
        {* 
        {if $engine->isAccepted()}
            <span>{__('Accepted')}</span>
        {elseif $engine->isRefused()}
            <span>{__('Refused')}
            </span>
        {else}
            {__('Require validation')}
        {/if}    *}
      {/if}  
      </div>

    {else}
        {__('Engine has some errors.')}    
    {/if}


