<?php

class marketing_leads_transferNewProcessAction extends cronAction
{

    function execute()
    {


        foreach (SitesAdmin::getlistSitesByName() as $site) {
            $successCount = $errorCount = 0;

            try {
                if (!mfModule::isModuleInstalled('marketing_leads', $site))
                    continue;
                $collection = new MarketingLeadsWpFormsCollection(null, $site);
                $collection->fillByStatus($site);
                $collection->loaded();
                $collection->processTransfer($site);
                $successCount = $collection->count();
                $this->getCron()->getReport()->addMessage(sprintf("Site %s : %d entrées OK", $site->get('site_host'), $successCount));
            } catch (Exception $e) {
                $errorCount = 1;
                $this->getCron()->getReport()->addMessage(sprintf("Site %s : ERREUR - %s", $site->get('site_host'), $e->getMessage()));
            }
            $this->getCron()->getReport()->addMessage(sprintf("%s - Succès:%d, Échecs:%d", $site->get('site_host'), $successCount, $errorCount));
        }

    }
}