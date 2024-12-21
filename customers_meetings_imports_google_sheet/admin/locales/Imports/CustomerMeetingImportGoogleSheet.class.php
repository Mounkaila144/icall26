<?php
require_once dirname(__FILE__) . "/Forms/CustomerMeetingImportGoogleSheetForm.class.php";

class CustomerMeetingImportGoogleSheet extends ImportCore
{
    const limit = 500;
    protected $format, $info = [], $user, $completed = false, $processedRows = 0, $successCount = 0, $errorCount = 0, $api, $offset, $nextOffset;

    function __construct($format_id, $options = [])
    {
        $this->setForm(new CustomerMeetingImportGoogleSheetForm());
        $this->format = new CustomerMeetingImportGoogleSheetFormat($format_id);
        $this->offset = isset($options['offset']) ? $options['offset'] : ($this->format->get('last_offset') ? $this->format->get('last_offset') : 0);
        if (!$this->format->isLoaded()) throw new mfException(__("The format could not be loaded"));
    }

    function execute()
    {
        try {
           // $time_api = microtime(true);
            $leaf = $this->getApi()->getSheetDataByDataFilter($this->format->file_id, $this->format->leaf_id, $this->offset, self::limit);
            //$this->tempApi = microtime(true) - $time_api;


            if (empty($leaf)) {
                $this->completed = true;
                $this->info[] = __("No more data to process.");
            } else {
                $validDataCollection = new CustomerMeetingCollection();
                $errorDataCollection = new CustomerMeetingImportGoogleSheetLogCollection();
                $this->getForm()->reconfigure();

                // Prétraitement des mappings de colonnes
                $columnMappings = [];
                foreach ($this->format->getNamesValues() as $format)
                    if (!empty($format['value']) && isset($format['name']))
                        $columnMappings[(int)explode('|', $format['name'])[1]] = $format['value'];

                foreach ($leaf as $line => $row) {
                    $data = [];
                    foreach ($columnMappings as $columnIndex => $dataKey)
                        $data[$dataKey] = isset($row[$columnIndex]) ? $row[$columnIndex] : '';

                    $this->getForm()->bind($data);
                    if ($this->getForm()->isValid()) {
                       // $validDataCollection[] = (new CustomerMeeting())->add($data);
                        $validDataCollection[] = $this->getForm()->getCustomerMeeting();
                        $this->successCount++;
                    } else {
                        $errors = $this->getForm()->getErrorSchema()->getErrorsMessage();
                        $error = __("Line") . ' ' . ($line + $this->offset + 2) . ' ' . implode('; ', array_map(function($field, $message) { return __($field) . " -> " . $message; }, array_keys($errors), $errors));
                        $this->info[] = $error;
                        $errorDataCollection[] = (new CustomerMeetingImportGoogleSheetLog())->add(['format_id' => $this->format->get('id'), 'log' => $error]);

                        $this->errorCount++;
                    }
                    $this->processedRows++;
                }

                //$time_insert = microtime(true);
                !$validDataCollection->isEmpty() ? $validDataCollection->save() : null;
                !$errorDataCollection->isEmpty() ? $errorDataCollection->save() : null;
                //$this->tempInsertion = microtime(true) - $time_insert;
                $this->nextOffset = $this->offset + $this->processedRows;
                $this->format->add([
                    'status' => 1,
                    'last_offset' => $this->nextOffset,
                    'processed_rows' => $this->format->get('processed_rows') + $this->processedRows,
                    'success_count' => $this->format->get('success_count') + $this->successCount,
                    'error_count' => $this->format->get('error_count') + $this->errorCount,
                ])->save();
var_dump($this->format);
                $this->completed = $this->nextOffset >= $this->format->number_of_lines ? true : false;
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    function getApi()
    {
        return $this->api ? $this->api : $this->api = new UtilsGoogleSheetApi();
    }

    public function isCompleted()
    {
        return $this->completed;
    }

    public function __call($name, $arguments)
    {
        if (preg_match('/^(get|set)([A-Z].*)$/', $name, $m) && property_exists($this, $p = lcfirst($m[2])))
            return $m[1] === 'get' ? $this->$p : $this->$p = $arguments[0];
        throw new mfException("Method $name does not exist");
    }
}
