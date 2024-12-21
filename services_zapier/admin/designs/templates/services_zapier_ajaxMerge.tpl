{component name="/site/sublink"}

<div class="site-errors">
    {messages class="site-errors"}
</div>
<h1 class="text-center">{__('Files')}</h1>
<div class="container">
    <div class="row text-center">
            <div class="col-6">
                <!-- Premier Fichier -->
                <input type="file" name="MergePDF[file1]" id="fileUpload1" class="file" style="display:none;" />
                <button type="button" id="UploadButton1" class="btn">
                    {__('First File')} <i class="fa fa-upload"></i>
                </button>
                <span id="fileName1" class="file-name " style=" display: none;"></span>
            </div>
            <div class="col-6">
                <!-- Deuxième Fichier -->
                <input type="file" name="MergePDF[file2]" id="fileUpload2" class="file" style="display:none;" />
                <button type="button" id="UploadButton2" class="btn">
                    {__('Second File')} <i class="fa fa-upload"></i>
                </button>
                <span id="fileName2" class="file-name " style=" display: none;"></span>
            </div>
    </div>
    <div class="row text-center">
        <!-- Bouton pour fusionner les fichiers -->
        <div class="col-md-12" style="margin-top: 20px;">
            <button id="Save-Settings" class="btn">
                {__("Merge Files")} <i class="fa fa-file-pdf-o"></i>
            </button>
        </div>
    </div>

    {if isset($mergedPdfFilename)}
    <div class="row text-center">
        <!-- Bouton pour fusionner les fichiers -->
        <div class="col-md-12" style="margin-top: 20px;">
            <a href="{$mergedPdfUrl}" class="btn " download>
                {__('Télécharger le PDF fusionné')}
            </a>
        </div>
        </div>
    {/if}
</div>

<script type="text/javascript">
        function displayFileName(inputId, displayId) {
            $(inputId).change(function() {
                const fileName = this.files.length ? this.files[0].name : '';
                $(displayId).text(fileName).toggle(!!fileName);
            });
        }

        $('#UploadButton1').click(() => $('#fileUpload1').click());
        $('#UploadButton2').click(() => $('#fileUpload2').click());

        displayFileName('#fileUpload1', '#fileName1');
        displayFileName('#fileUpload2', '#fileName2');

        $('#Save-Settings').click(function() {
            alert('Fichiers envoyés pour fusion!');
            $('#MergePDF-secretFileLoading').show();

            $.ajax2({
                url: "{url_to('services_zapier_ajax', ['action' => 'Merge'])}", // URL pour l'action Merge
                files: ".file", // Inclure les fichiers avec la classe 'file'
                errorTarget: ".site-errors",
                loading: "#loading",
                target: "#tab-site-panel-dashboard-x-list-merge-base", // Remplacer par votre cible
            });
        });

</script>

