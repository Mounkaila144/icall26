<form method="post">
    <h1>Autoriser l'accès</h1>
    <p>L'application <strong>{$client->get('name')}</strong> souhaite accéder à vos données.</p>

        <p>Scopes par défaut du client:</p>

        <ul>
            {foreach from=$defaultClientScopes item=scope}
                <li>{$scope}</li>
            {/foreach}
        </ul>


    <button type="submit" name="approve" value="yes" class="btn btn-success test">Autoriser</button>
    <button type="submit" name="approve" value="no" class="btn btn-danger">Refuser</button>
</form>