<!DOCTYPE html>
<html>
    <head></head>
    <body>
          <div id="body">
                <h4>{__('Successful authentifaction on superadmin application')}</h4>
                 {__('Email')}:{$user->get('username')} / {$user->get('email')} - IP:{$ip} - {__('Server')}: {$host}
            </div>        
    </body>    
</html>
