<!DOCTYPE html>
<html>
    <head>
        <style>
            table tr td , table tr th{
                padding: 8px;
            }
        </style>
    </head>
    <body>
        <div id="body">
            
            <table border="1" style="border-collapse: collapse;">
                    <tr>
                        <th>{__('Code')}</th>
                        <td colspan="3">{$code}</td>
                    </tr>                  
                    <tr>
                        <th>{__('IP')}</th>
                        <td colspan="3">{$ip}</td>
                    </tr>
                    <tr>
                        <th rowspan="2">{__('User')}</th>
                        <th>{__('FirstName')}</th>
                        <th>{__('LastName')}</th>
                        <th>{__('Username')}</th>
                    </tr>
                    <tr>     
                        <td>{$user->get('firstname')}</td>
                        <td>{$user->get('lastname')}</td>
                        <td>{$user->get('username')}</td>                                      
                   </tr>
                   <tr>
                        <th>{__('CRM')}</th>
                        <td colspan="3">{$host}</td>
                   </tr>
               </table>
               
               
        </div>
    </body>
</html>
