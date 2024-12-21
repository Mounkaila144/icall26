
    {messages class="site-errors"}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <div class="row bg-soft-info" >
                <div class="col mx-auto ">
                    <div class="card" >
                        <div class="card-header align-items-center text-center bg-soft-info">
                            <h3 class="card-title mb-0 flex-grow-1 text-center text-dark">{__("New format")}</h3>
                        </div>
                        <div>
                            <!-- Bouton Cancel aligné à gauche -->
                            <button type="button" id="Cancel-GoogleSheetNewFormat" class="btn  btn-sm pull-left">
                                {__('Cancel')}
                            </button>
                            <!-- Bouton Save aligné à droite -->
                            <button type="button" id="CustomerMeetingImportGoogleSheetFormat-Save" class="btn  btn-sm pull-right">
                                {__('Save')}
                            </button>

                        </div>

                        <div class="card-body">
                            <form id="CustomerMeetingImportGoogleSheetFormatForm" class="google-sheets" >
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{__("Name")}</label>

                                            <div class="error-form text-danger">{$form.name->getError()}</div>
                                            <input style="width: 100% ;height: 30px" type="text" class=" " name="Format[name]" value="{$form['name']->getValue()}" />
                                            {if $form->name->getOption('required')}*{/if}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{__("File")}  <span class="text-danger">{if $form->file_id->getOption('required')}*{/if}</span></label>
                                            <div class="error-form text-danger">{$form.file_id->getError()}</div>
                                            <select name="Format[file_id]" id="googleSheetFiles" class=" ">
                                                <option value="">{__("select")}</option>
                                                {foreach from=$form->getApi()->listAllFiles() item=file}
                                                    <option value="{$file.id}" data-name="{$file.name}" {if $form['file_id']->getValue() == $file.id}selected{/if}>{$file.name}</option>
                                                {/foreach}

                                            </select> <span id="loading-leaf" class=" d-none">{__("loading...")}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="sheetNameContainer">
                                            <label>{__("Leaf")} <span class="text-danger">{if $form->leaf_name->getOption('required')}*{/if}</span></label>
                                            <div class="error-form text-danger">{$form.leaf_name->getError()}</div>
                                            <select name="Format[leaf_name]" id="sheetName" class=" " disabled>
                                                <option value="">{__("select")}</option>
                                                {if $form['leaf_name']->getValue()}
                                                    <option value="{$form['leaf_name']->getValue()}" data-id="{$form['leaf_id']->getValue()}" selected>{$form['leaf_name']->getValue()}</option>
                                                {/if}
                                            </select>

                                            </select> <span id="loading-data" class=" d-none">{__("loading...")}</span>
                                        </div>
                                    </div>

                                </div>




                                <!-- Mappage des champs -->
                                <div id="fieldsMapping" {if !$form['fields']}style="display: none;"{/if}>
                                    <table class="table table-striped table-bordered ">
                                        {foreach $form['fields'] as $index => $fieldForm}
                                            <tr>
                                                <td>
                                                    <div class="FieldsFromFile" id="{$index}" name="{$fieldForm['name']->getValue()}">
                                                        {$form->formatHeaderForShow($fieldForm['name']->getValue())}
                                                    </div>
                                                </td>
                                                <td>
                                                    <select style="width: 300px" class=" select2  Fields index-{$index}" name="Format[fields][{$index}][value]">
                                                        {foreach $form->getFieldsFromForm() as $optionValue => $optionLabel}
                                                            <option value="{$optionValue}" {if $optionValue == $form->getFieldValueForShow($fieldForm['name']->getValue())}selected{/if}>
                                                                {$optionLabel}
                                                            </option>
                                                        {/foreach}
                                                    </select>
                                                    <input type="hidden" name="Format[fields][{$index}][name]" value="{$fieldForm['name']->getValue()}">
                                                    {if $fieldForm['value']->hasError()}
                                                        <div class="error-form text-danger">{$fieldForm['value']->getError()}</div>
                                                    {/if}
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
        } )
        $('input, select').on('input change', function() {
            var errorElement = $(this).closest('.form-group').find('.error-form');
            if (errorElement.text().trim().length > 0) {
                errorElement.empty();
            }
        });
        $('#Cancel-GoogleSheetNewFormat').click(function () {
            return $.ajax2({
                url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'ListPartialFormat'])}",
                loading: "#loading",
                target: "#tab-site-panel-dashboard-x-list-format-base"
            });
        });


        // Sauvegarde des données du formulaire lors du clic sur le bouton "Save"
        $('#CustomerMeetingImportGoogleSheetFormat-Save').click(function() {
            var paramsSave = {
                Format: {
                    token: '{$form->getCSRFToken()}',
                    file_name:$("#googleSheetFiles option:selected").data('name'),
                    leaf_id:$("#sheetNameContainer option:selected").data('id')
                }


            };

            $("#CustomerMeetingImportGoogleSheetFormatForm").find('input, select').each(function() {
                var name = $(this).attr('name');
                var value = $(this).val();
                if (name) {
                    paramsSave[name] = value;
                }
            });

            // Envoi de la requête AJAX
            return $.ajax2({
                data: paramsSave,
                url: "{url_to('customers_meetings_imports_google_sheet_ajax',['action'=>'NewFormat'])}",
                target: "#tab-site-panel-dashboard-x-list-format-base",
                loading: "#loading",
            });
        });

        // Gestion du changement de fichier Google Sheet pour charger les feuilles et remplir le champ file_name
        $('#googleSheetFiles').on('change', function() {
            var selected = $(this).val(); // ID du fichier sélectionné
            if (selected) {
                $('#sheetName').empty().append('<option value="">' + "{__("select")}" + '</option>');
                $('#loading-leaf').removeClass("d-none");
                $('#sheetNameContainer').show();

                var params = {
                    file: selected
                };
                $.ajax2({
                    data: params,
                    loading: "#loading",
                    url: "{url_to('utils_google_sheet_ajax',['action'=>'GetSheet'])}",
                    success: function(data) {
                        $('#sheetName').removeAttr('disabled');
                        $('#loading-leaf').addClass("d-none");
                        if (data.length > 0) {
                            $.each(data, function(i, sheet) {
                                $('#sheetName').append($('<option>', {
                                    value: sheet.name,
                                    text: sheet.name,
                                    'data-id': sheet.id
                                }));
                            });
                        } else {
                            $('#sheetName').append($('<option>', {
                                text: "{__("nothing leaf")}"
                            }));
                        }
                    }
                });
            } else {
                // Si aucun fichier sélectionné, on masque les champs concernés
                $('input[name="Format[file_name]"]').val('');
                $('#sheetNameContainer').hide();
                $('#fieldsMapping').hide();
            }
        });
        {if $form['file_id']->getValue()}
        $('#sheetName').removeAttr('disabled');
        $.ajax2({
            data: params = {
                file: "{$form['file_id']->getValue()}"
            },
            loading: "#loading",
            url: "{url_to('utils_google_sheet_ajax',['action'=>'GetSheet'])}",
            success: function(data) {
                if (data.length > 0) {
                    $.each(data, function(i, sheet) {
                        $('#sheetName').append($('<option>', {
                            value: sheet.name,
                            text: sheet.name
                        }));
                    });
                } else {
                    $('#sheetName').append($('<option>', {
                        text: "{__("nothing leaf")}"
                    }));
                }
            }
        });
        {/if}
        var fieldOptions = {
            {foreach $form->getFieldsFromForm() as $optionValue => $optionLabel}
            "{$optionValue}": "{$optionLabel}",
            {/foreach}
        };
        $('#googleSheetFiles, #sheetName').select2( {
            selectOnClose: true,
            width: '100%',
            dropdownAutoWidth:true
        } )


        $('#sheetName').on('change', function() {
            $('#loading-data').removeClass("d-none");

            var fileId = $('#googleSheetFiles').val();
            var leaf = $(this).val();
            if (fileId && leaf) {

                var params = {
                    file: fileId,
                    leaf: leaf
                };
                $.ajax2({
                    data: params,
                    loading: "#loading",
                    url: "{url_to('utils_google_sheet_ajax',['action'=>'GetSheetHeaders'])}",
                    success: function(headers) {
                        $('#loading-data').addClass("d-none");

                        var fieldsMapping = $('#fieldsMapping table');
                        fieldsMapping.empty();

                        if (headers.length > 0) {
                            $.each(headers, function(index, header) {
                                var safeHeader = $('<div>').text(header).html();
                                var row = '<tr>';
                                row += '<td>' + safeHeader + '</td>';
                                row += '<td>';
                                row += '<select style="width: 300px" class="form-control  select2" name="Format[fields][' + index + '][value]">';

                                $.each(fieldOptions, function(optionValue, optionLabel) {
                                    row += '<option value="' + optionValue + '">' + optionLabel + '</option>';
                                });

                                row += '</select>';
                                row += '<input type="hidden" name="Format[fields][' + index + '][name]" value="' + safeHeader + '">';
                                row += '</td>';
                                row += '</tr>';

                                fieldsMapping.append(row);
                            });

                            $('#fieldsMapping').show();
                            $('.select2', fieldsMapping).select2();

                        } else {
                            $('#fieldsMapping').hide();
                        }
                    }
                });
            } else {
                $('#fieldsMapping').hide();
            }
        });
    </script>