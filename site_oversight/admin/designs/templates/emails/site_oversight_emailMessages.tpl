<table>
       <tr>
        <th>{__('From')}</th> 
        <th>{__('Message')}</th> 
    </tr>
{foreach $messages as $message}
    <tr>
        <td>{__('Alert')}: {$message->get('header')}</td>
        <td>{$message->get('message')}</td>
    </tr>
    
    
{/foreach}    
</table>