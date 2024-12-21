{messages class="site-errors"}
<div class="row justify-content-center">
    <div class="col-12 col-lg-11">
        <div class="row bg-soft-info" >
            <div class="col mx-auto ">
                <div class="card">
                    <div class="card-header align-items-center text-center bg-soft-info">
                        <h3 class="card-title mb-0 flex-grow-1 text-center text-dark">{__("New Client")}</h3>
                    </div>
                    <div>
                        <button type="button" id="Cancel-ServicesZapier" class="btn  btn-sm pull-left">
                            {__('Cancel')}
                        </button>

                        <button type="button" id="ServicesZapierClient-Save" class="btn  btn-sm pull-right">
                            {__('Save')}
                        </button>
                    </div>

                    <div class="card-body">
                        <form id="ServicesZapierClientForm" >

                            <div class="row justify-content-center">
                                <div class="col-md-4"> {* Correction classe colonne *}
                                    <div class="form-group">
                                        <label>{__("Name")}</label>
                                        <div class="error-form text-danger" id="name-error"></div>
                                        <input type="text" class="form-control" name="name" id="name" value="{$form['name']->getValue()}"/>
                                    </div>
                                </div>
                                 <div class="col-md-4"> {* Correction classe colonne *}
                                    <div class="form-group">
                                        <label>{__("Redirect uri")}</label>
                                        <div class="error-form text-danger" id="redirect_uri-error"></div>
                                        <input type="text" class="form-control" name="redirect_uri" id="redirect_uri" value="{$form['redirect_uri']->getValue()}"/>
                                    </div>
                                </div>

                                <div class="col-md-4"> {* Correction classe colonne *}
                                    <div class="form-group" >
                                        <label>{__("Scopes")}</label>
                                        <div class="scope-input input-group mb-3">
                                            <input type="text" class="form-control" name="scope" id="scope" value="{$form['scope']->getValue()}"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#Cancel-ServicesZapier').click(function () {
        // ... (votre logique d'annulation)
    });




    $('#ServicesZapierClient-Save').click(function() {
        var paramsSave = {
            Client: {
                name: $("#name").val(), // récupérer la valeur ici
                redirect_uri: $("#redirect_uri").val(), // récupérer la valeur ici
                scope: $("#scope").val(), // joindre les scope avec "|" ici
                token: '{$form->getCSRFToken()}'
            }
        };

        return $.ajax2({

            data: paramsSave,
            url: "{url_to('services_zapier_ajax',['action'=>'NewClient'])}",
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