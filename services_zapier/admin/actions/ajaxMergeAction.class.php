<?php

class services_zapier_ajaxMergeAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->form = new mfForm();
        $this->form->setValidators(['file1' => new mfValidatorFile(['required' => true,]), 'file2' => new mfValidatorFile(['required' => true,]),]);
        try {
            if ($request->isMethod('POST') && $request->getFiles('MergePDF')) {
                $this->form->bind([], $request->getFiles('MergePDF'));
                if ($this->form->isValid()) {
                    $uploadDir = mfConfig::get('mf_sites_dir') . '/temp';
                    $mergedDir = realpath(__DIR__ . "/../..") . '/frontend/view';
                    foreach ([$uploadDir, $mergedDir] as $dir) if (!is_dir($dir)) mkdir($dir, 0777, true);

                    $filePaths = [];
                    foreach (['file1', 'file2'] as $key) {
                        $file = $this->form->getValue($key);
                        $filePaths[] = $uploadDir . '/' . $file->getOriginalName();
                        $file->save($uploadDir);
                    }

                    $mergedPdf = $mergedDir . '/merged_' . time() . '.pdf';
                    $gs = '/usr/bin/gs';
                    $cmd = sprintf('"%s" -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="%s" "%s" "%s"', $gs, $mergedPdf, ...$filePaths);
                    exec($cmd . ' 2>&1', $output, $ret);

                    if ($ret || !file_exists($mergedPdf)) throw new mfException("Erreur fusion PDF : " . implode("\n", $output));
                    foreach ($filePaths as $filePath) unlink($filePath); // Suppression des fichiers d'origine

                    $this->mergedPdfFilename = basename($mergedPdf);
                    $this->mergedPdfUrl = url('web/module/services_zapier/' . $this->mergedPdfFilename, '', 'frontend', '');
                    $messages->addInfo("PDF fusionné avec succès.");
                } else $messages->addError("Fichiers non valides.");
            }
        } catch (mfException $e) {
            $messages->addError($e->getMessage());
        }
    }
}
