<?php

class marketing_leads_processLeadsRecoveryAction extends cronAction
{

    function execute()
    {
        foreach (SitesAdmin::getlistSitesByName() as $site) {
            if ($site->get("site_host") == 'theme32minidev.net') {
                {
                    try {
                        if (!mfModule::isModuleInstalled('marketing_leads', $site))
                            continue;
                        $sites = MarketingLeadsWpLandingPageSite::getSitesForEngine($site);
                        $sites->process();
                        $this->getCron()->getReport()->addMessage(sprintf("Site %s Number of sites processed %s \n%s", $site->get('site_db_name'), $sites->count(), $sites->getMessagesForCronProcess()->implode("\n")));
                    } catch (Exception $e) {
                        //  trigger_error(mfSiteDatabase::getInstance()->getDatabase()->getError());
                        $this->getCron()->getReport()->addMessage(sprintf("site [%s] : %s.", $site->getHost(), $e->getMessage()));
                    }
                }
            }
        }
    }
    }
