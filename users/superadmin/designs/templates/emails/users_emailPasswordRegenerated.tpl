<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
    </head>
    <body>   
        <div id="body">            
            <div id="banner">{banner class="banner" site=$site->getSite() application='frontend'}</div>
            <div id="middle">
                <h4>{__('Your new password')}</h4>
                <p>{$user->get('firstname')|capitalize} {$user->get('lastname')|capitalize},</p>
                {if $user->get('application')=='admin'}                                
                    <p>{__('Site')}: <a href="{url('/','url','admin',$site)}">[{$site->getHost()}/admin/]</a></p>    
                    <p>{__('Username/Email')}: [{$user->get('email')} {__('or')} {$user->get('username')}]</p>                                   
                {else}                                     
                    <p>{__('Site')}: <a href="{url('/','url','frontend',$site)}">[{$site->getHost()}]</a></p>    
                    <p>{__('Username')}: [{$user->get('email')}</p>                                     
                {/if}
                 <p>{__('Password')}: [{$password}]</p>      
                {if $company->get("picture")}<img id="company_picture" src='{$company->getPicture()->getUrl()}' height="128" alt="{__('my picture')}"/>{/if}
                  <h3>{$company->get('name')}</h3>
                  <div>{$company->get('address1')}</div>
                  <div>{$company->get('address2')}</div>
                  <div>{$company->get('postcode')} {$company->get('city')} - {format_country($company->get('country'))}</div>
                  {if $company->get('siret')}<div>{__('siret')}:{$company->get('siret')}</div>{/if}
            </div>
        </div>
    </body>    
</html>
