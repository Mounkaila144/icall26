
    {messages class="site-errors"}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <div class="row bg-soft-info" >
                <div class="col mx-auto">
                    <div class="card" >
                        <div class="card-header align-items-center text-center bg-soft-info">
                            <h3 class="card-title mb-0 flex-grow-1 text-center text-dark">{__("Format [%s]", $format->get('name'))}</h3>
                        </div>

                        <div>
                            <button type="button" id="Cancel-GoogleSheetViewFormat" class="btn  pull-left btn-sm">
                                {__('Cancel')}
                            </button>
                            <a href="#" id="CustomerMeetingImportGoogleSheetFormat-Save" class="btn  pull-right btn-sm">
                                <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
                                {__('Save')}
                            </a>

                        </div>

                        <div class="card-body">
                            <form id="CustomerMeetingImportGoogleSheetFormatViewForm" class="google-sheets">
                                <!-- Champs du formulaire -->
                                <div class="form-group">
                                    <label>{__("Name")}</label>
                                    <div class="error-form text-danger">{$form.name->getError()}</div>
                                    <input type="text" class="Format form-control" name="name" value="{$format->get('name')}" />
                                    {if $form->name->getOption('required')}*{/if}
                                </div>

                                <!-- Mappage des champs -->
                                <div id="fieldsMapping">
                                    <table class="table table-striped table-bordered text-center">
                                        {foreach $form->getApi()->getSheetHeaders($format->get('file_id'), $format->get('leaf_name')) as $index => $field}
                                            <tr>
                                                <td>
                                                    <div class="FieldsFromFile" id="{$index}" name="{$field}">
                                                        {$form->formatHeaderForShow($field)}
                                                    </div>
                                                </td>
                                                <td>
                                                    <select style="width: 300px" class="form-control select2  Fields index-{$index}" name="field">
                                                        {foreach $form->getFieldsFromForm() as $optionValue => $optionLabel}
                                                            <option value="{$optionValue}" {if $optionValue == $form->getFieldValueForShowByFieldName($field)}selected{/if}>
                                                                {$optionLabel}
                                                            </option>
                                                        {/foreach}
                                                    </select>
                                                </td>
                                            </tr>
                                        {/foreach}
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('.select2').select2( {
        selectOnClose: true,
        width: '100%',
        dropdownAutoWidth:true
    } )    // Vider les messages d'erreurs si l'utilisateur modifie un champ
    $('input, select').on('input change', function() {
        var errorElement = $(this).closest('.form-group').find('.error-form');
        if (errorElement.text().trim().length > 0) {
            errorElement.empty();
        }
    });

    // Bouton pour annuler la vue actuelle
    $('#Cancel-GoogleSheetViewFormat').click(function () {
        return $.ajax2({
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialFormat'])}",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-format-base"
        });
    });

    // Bouton pour sauvegarder le formulaire
    $('#CustomerMeetingImportGoogleSheetFormat-Save').click(function() {
        // Préparer les paramètres à envoyer avec la requête AJAX

        var params = {
            CustomerMeetingImportGoogleSheetFormat: {
                id: {$format->get('id')},
                file_id: '{$format->get('file_id')}',
                leaf_id: '{$format->get('leaf_id')}',
                leaf_name: '{$format->get('leaf_name')}',
                file_name: '{$format->get('file_name')}',
                token: '{$form->getCSRFToken()}',
                fields: []
            }
        };
        $("input.Format").each(function() { params.CustomerMeetingImportGoogleSheetFormat[this.name]=$(this).val(); });
        // Collecter les valeurs des champs dynamiques
        $(".FieldsFromFile").each(function () {
            var fieldName = $(this).attr('name');
            var fieldValue = $(".Fields.index-" + $(this).attr('id')).val();
            params.CustomerMeetingImportGoogleSheetFormat.fields.push({
                name: fieldName,
                value: fieldValue
            });
        });

        // Envoyer la requête AJAX
        return $.ajax2({
            data: params,
            url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'SaveFormat'])}",
            loading: "#loading",
            errorTarget: ".site-errors",
            target: "#tab-site-panel-dashboard-x-list-format-base",
        });
    });
</script>
