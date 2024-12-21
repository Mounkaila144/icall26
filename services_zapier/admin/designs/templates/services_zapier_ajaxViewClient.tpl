{messages class="site-errors"}
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header align-items-center text-center bg-soft-info">
                <h3 class="card-title mb-0 text-center text-dark">{__("View Client")}</h3>
            </div>
            <div class="card-body">
                <form id="ServicesZapierClientForm">
                    <div class="row justify-content-center">

                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{__("Name")}</label>
                                <div class="error-form text-danger" id="name-error"></div>
                                <input type="text" class="form-control" name="name" id="name" value="{$client->get('name')}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="redirect_uri">{__("Redirect uri")}</label>
                                <div class="error-form text-danger" id="redirect_uri-error"></div>
                                <input type="text" class="form-control" name="redirect_uri" id="redirect_uri" value="{$client->get('redirect_uri')}"/>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="name">{__("Scope")}</label>
                                <div class="error-form text-danger" id="name-error"></div>
                                <input type="text" class="form-control" name="scope" id="scope" value="{$client->get('scope')}"/>
                            </div>

                        </div>

                    <div class="text-center mt-3">

                        <button type="button" id="Cancel-ServicesZapier" class="btn btn-sm mr-3">{__('Cancel')}</button>

                        <button type="button" id="ServicesZapierClient-Save" class="btn  btn-sm ">{__('Save')}</button>

                    </div>

                </form>

            </div>



        </div>
    </div>
</div>
<script type="text/javascript">
    $('#Cancel-ServicesZapier').click(function () {
        // ... (votre logique d'annulation)
    });

    var scopeIndex = 0;
    function addScopeInput() {
        var newInput = $('<div class="scope-input input-group mb-3">').append(
            $('<input  type="text" class="form-control" name="scope[]" value=""/>'),

            $('<i class="fa mt-2 fa-lg fa-trash text-danger remove-scope mx-3" aria-hidden="true"></i>')
        );



        $("#scope-container").append(newInput);

        $(".remove-scope").click(function() {
            $(this).parent().remove();

        });
    };

    $('#add-scope').click(addScopeInput);



    $('#ServicesZapierClient-Save').click(function() {
        var scope = [];
        $("input[name='scope[]']").each(function(){

            if($(this).val().trim()) //Pour éviter les valeurs vides
                scope.push($(this).val().trim());

        });

        var paramsSave = {
            Client: {
                client_id: "{$client->get('client_id')}", // récupérer la valeur ici
                name: $("#name").val(), // récupérer la valeur ici
                redirect_uri: $("#redirect_uri").val(), // récupérer la valeur ici
                scope: $("#scope").val(),  // joindre les scope avec "|" ici
                token: '{$form->getCSRFToken()}'
            }
        };

        return $.ajax2({

            data: paramsSave,
            url: "{url_to('services_zapier_ajax',['action'=>'SaveClient'])}",
            target: "#tab-site-panel-dashboard-x-list-client-base", // REMPLACER PAR VOTRE CIBLE.
            loading: "#loading",
            success: function(response) { // fonction success
                if (response.errors) {  // Afficher les erreurs si il y en a
                    $("#redirect_uri-error").html(response.errors.redirect_uri);
                }
            }

        });
    });

</script>