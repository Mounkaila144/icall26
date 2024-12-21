<fieldset>
    <h3>{__('House information')}</h3>
    <table>
        <tr>
            <td>{__('Area')}</td>
            <td>
                <div>{$form.house.area->getError()}</div> 
                <input type="text" class="CustomerHouse-{$meeting->get('id')}" name="area" value="{$meeting->getCustomer()->getFirstHouse()->get('area')}"/> 
            </td>
            <td>
                {__('Orientation')}
            </td>
            <td>
                <div>{$form.house.orientation->getError()}</div> 
                  <input type="text" class="CustomerHouse-{$meeting->get('id')}" name="orientation" value="{$meeting->getCustomer()->getFirstHouse()->get('orientation')}"/>
            </td>
             <td>
                {__('Number of windows')}
            </td>
            <td>
                <div>{$form.house.windows->getError()}</div> 
                  <input type="text" class="CustomerHouse-{$meeting->get('id')}" name="windows" value="{$meeting->getCustomer()->getFirstHouse()->get('windows')}"/>
            </td>
             <td>
                {__('Removal')}
            </td>
            <td>
                <div>{$form.house.removal->getError()}</div> 
                  <input type="checkbox" class="CustomerHouse-{$meeting->get('id')}" name="removal" {if $meeting->getCustomer()->getFirstHouse()->get('removal')=='YES'}checked=""{/if}"/>
            </td>
        </tr>
    </table>
</fieldset>