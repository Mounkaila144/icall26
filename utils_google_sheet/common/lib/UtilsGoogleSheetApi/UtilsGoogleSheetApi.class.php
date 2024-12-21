<?php

class UtilsGoogleSheetApi {
    public $client;
    public $driveService;
    public $sheetsService;
    public $settings;

    public function __construct() {
        $this->settings = new UtilsGoogleSheetSettings();
        $this->client = new GoogleClient();
        $this->initializeGoogleClient();
    }

    // Initialiser le client Google et rafraîchir le token si nécessaire
    public function initializeGoogleClient() {
        $tokens = $this->getTokens();

        if (!$tokens['access_token']) {
            throw new mfException(__("Access token is missing. Please authenticate first."));
        }

        $this->client->setAccessToken($tokens);
        if ($this->client->isAccessTokenExpired()) {
            $this->refreshAccessToken($tokens['refresh_token']);
        }

        // Initialiser les services Google Drive et Sheets
        $this->driveService = new Google_Service_Drive($this->client);
        $this->sheetsService = new Google_Service_Sheets($this->client);
    }

    // Récupérer les tokens depuis les settings
    public function getTokens() {
        return [
            'access_token' => $this->settings->get('access_token'),
            'refresh_token' => $this->settings->get('refresh_token'),
            'expires_in' => $this->settings->get('expires_in'),
            'created' => $this->settings->get('created_at')
        ];
    }

    // Rafraîchir le token si nécessaire
    public function refreshAccessToken($refreshToken) {
        $this->client->setClientId($this->settings->getClientId());
        $this->client->setClientSecret($this->settings->getClientSecret());
        if (!$refreshToken) {
            throw new mfException(__("Refresh token is missing. Unable to refresh access token."));
        }

        $newAccessToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
        $this->updateTokens($newAccessToken);
    }

    // Mettre à jour les tokens dans les settings
    public function updateTokens($newAccessToken) {
        $this->settings->set('access_token', $newAccessToken['access_token']);
        if (isset($newAccessToken['refresh_token'])) {
            $this->settings->set('refresh_token', $newAccessToken['refresh_token']);
        }
        $this->settings->set('expires_in', $newAccessToken['expires_in']);
        $this->settings->set('created_at', $newAccessToken['created']);
        $this->settings->save();
    }

    // Méthode pour lister tous les fichiers Google Sheets
    public function listAllFiles($pageSize=1000) {
        try {
            $files = array_map(function($file) {
                return ['id' => $file->getId(), 'name' => $file->getName()];
            }, $this->driveService->files->listFiles([
                'q' => "mimeType='application/vnd.google-apps.spreadsheet'",
                'fields' => 'files(id, name)',
                'pageSize' => $pageSize
            ])->getFiles());

            usort($files, function($a, $b) {
                return strcasecmp($a['name'], $b['name']);
            });

            return $files;
        } catch (Exception $e) {
            throw new mfException(__("Error while listing files: ") . $e->getMessage());
        }
    }


    // Méthode pour obtenir les métadonnées d'une feuille de calcul
    public function getSheetMetadata($spreadsheetId) {
        try {
            $sheets = array_map(function($sheet) {
                return ['id' => $sheet->getProperties()->getSheetId(), 'name' => $sheet->getProperties()->getTitle()];
            }, $this->sheetsService->spreadsheets->get($spreadsheetId, ['fields' => 'sheets.properties'])->getSheets());

            usort($sheets, function($a, $b) {
                return strcasecmp($a['name'], $b['name']);
            });

            return $sheets;
        } catch (Exception $e) {
            throw new mfException(__("Error while retrieving sheet metadata: ") . $e->getMessage());
        }
    }




    public function getTotalRows($spreadsheetId, $sheetName)
    {
        try {
            // Définir la plage à la colonne A (ou toute autre colonne clé)
            $range = $sheetName . '!A:A'; // Supposons que la colonne A est toujours remplie

            // Récupérer les valeurs de la plage spécifiée
            $response = $this->sheetsService->spreadsheets_values->get($spreadsheetId, $range);

            // Obtenir les valeurs
            $values = $response->getValues();

            // Compter le nombre de lignes non vides
            $totalRows = count($values);

            // Soustraire 1 si la première ligne est l'en-tête
            return $totalRows > 0 ? $totalRows - 1 : 0;

        } catch (Exception $e) {
            throw new Exception("Unable to get total rows: " . $e->getMessage());
        }
    }


    public function getSheetHeaders($spreadsheetId, $range) {
        try {
            $values = $this->sheetsService->spreadsheets_values->get($spreadsheetId, $range);
            if (!empty($values)) {
                return  $values[0];
            }
            return [];
        } catch (Exception $e) {
            throw new mfException(__("Error while retrieving sheet data: ") . $e->getMessage());
        }
    }

// Méthode pour obtenir les données d'une feuille avec pagination
    public function getSheet($spreadsheetId, $range, $offset = 0, $limit = 100) {
        return $this->getSheetData($spreadsheetId, $range, $offset, $limit, false);
    }


    public function getSheetData($spreadsheetId, $range, $offset = 0, $limit = 100, $headersOnly = false) {
        try {
            // Calcul du range étendu pour pagination
            $startRow = $offset + 2; // +2 pour sauter les en-têtes (ligne 1)
            $endRow = $startRow + $limit - 1;
            $fullRange = sprintf('%s!A%d:Z%d', $range, $startRow, $endRow);

            $response = $this->sheetsService->spreadsheets_values->get($spreadsheetId, $fullRange);
            $values = $response->getValues();

            if (!empty($values)) {
                return $headersOnly ? $values[0] : $values;
            }
            return [];
        } catch (Exception $e) {
            throw new mfException(__("Error while retrieving sheet data: ") . $e->getMessage());
        }
    }

    public function getSheetDataByDataFilter($spreadsheetId, $sheetId, $offset = 0, $limit = 100) {
        try {
            // Configurer le filtre de données
            $dataFilter = new Google_Service_Sheets_DataFilter();
            $gridRange = new Google_Service_Sheets_GridRange();
            $gridRange->setSheetId($sheetId);
            $gridRange->setStartRowIndex($offset + 1); // +1 pour sauter les en-têtes
            $gridRange->setEndRowIndex($offset + 1 + $limit);

            $dataFilter->setGridRange($gridRange);

            // Créer la requête
            $request = new Google_Service_Sheets_BatchGetValuesByDataFilterRequest();
            $request->setDataFilters([$dataFilter]);
            $request->setMajorDimension('ROWS');

            // Exécuter la requête
            $response = $this->sheetsService->spreadsheets_values->batchGetByDataFilter($spreadsheetId, $request);
            $valueRanges = $response->getValueRanges();

            if (!empty($valueRanges)) {
                $matchedValueRange = $valueRanges[0];
                $valueRange = $matchedValueRange->getValueRange();
                $values = $valueRange->getValues();
                return $values;
            }
            return [];
        } catch (Exception $e) {
            throw new Exception("Error while retrieving sheet data with data filter: " . $e->getMessage());
        }
    }
    public function getSheetIdByName($spreadsheetId, $sheetName) {
        try {
            $spreadsheet = $this->sheetsService->spreadsheets->get($spreadsheetId);
            foreach ($spreadsheet->getSheets() as $sheet) {
                $properties = $sheet->getProperties();
                if ($properties->getTitle() == $sheetName) {
                    return $properties->getSheetId();
                }
            }
            throw new Exception("Sheet name not found: " . $sheetName);
        } catch (Exception $e) {
            throw new Exception("Error while getting sheet ID: " . $e->getMessage());
        }
    }

}