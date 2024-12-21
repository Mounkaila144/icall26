<fieldset>
    <h3>{__('Occupation information')}</h3>
    <table>
        <tr>
            <td>
                 <table>
                    <tr>
                       <td>
                           <fieldset>                           
                           <table>
                               <tr>
                                   <td>{__('Occupation')} </td>
                                   <td>
                                       <input type="text" class="Customer" size="48" name="occupation" value="{$item->getCustomer()->get('occupation')}"/>
                                   </td>
                               </tr>
                           </table>
                           </fieldset>
                       </td>
                    </tr>
                 </table>
            </td>
            <td>
                 <table>
                    <tr>
                       <td>
                           <fieldset>                           
                           <table>
                               <tr>
                                   <td>{__('Occupation')} </td>
                                   <td>
                                       <input type="text" class="CustomerContact" size="48" name="occupation" value="{$item->getCustomer()->getFirstContact()->get('occupation')}"/>
                                   </td>
                               </tr>
                           </table>
                           </fieldset>
                       </td>
                    </tr>
                 </table>
            </td>
        </tr>
    </table>
</fieldset>