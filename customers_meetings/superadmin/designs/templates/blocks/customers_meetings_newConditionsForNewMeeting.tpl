<fieldset>
    <h3>{__('Conditions meeting')}</h3>
    <table>
        <tr>
            <td>{__('Couple')} </td>
            <td>
                <input type="checkbox" class="Customer" size="48" name="firstname" value="{$item->getCustomer()->get('firstname')}"/>
            </td>        
            <td>{__('See with mister')} </td>
            <td>
                <input type="checkbox" class="Customer" size="48" name="firstname" value="{$item->getCustomer()->get('firstname')}"/>
            </td>        
            <td>{__('See with madam')} </td>
            <td>
                <input type="checkbox" class="Customer" size="48" name="firstname" value="{$item->getCustomer()->get('firstname')}"/>
            </td>            
        </tr>  
    </table>
    <table>
        <tr>
            <td>
                <div>{__('Remarks')}</div>                
            </td>
            <td><textarea cols="80" rows="5"></textarea>
            </td>
        </tr>
    </table>
</fieldset>