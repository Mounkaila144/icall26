<?php


class users_guard_signinByCodeAction extends mfAction
{


    function execute(mfWebRequest $request)
    {
        // If AJAX or File requested
        if ($request->isXmlHttpRequest() || $request->getURIExtension()) {
            $this->getResponse()->setStatusCode(403);
            return mfView::HEADER_ONLY;
        }
        $messages = mfMessages::getInstance();
        $this->form = new UserGuardForm();
        $this->time_out = $this->getUser()->getSessionExpired() ? $this->getUser()->getOption('timeout') : false;
        try {
            if ($request->isMethod('post')) {
                $this->form->bind($request->getPostParameter('signin'));
                if ($this->form->isValid()) {
                    $values = $this->form->getValues();

                    if ($values['user']->isSecureByCode()/* && mfConfig::get('mf_env')!='dev'*/) {
                        $this->getUser()->getStorage()->remove('user');
                        $request->addRequestParameter('user', $values['user']);
                        $this->forward($this->getModuleName(), 'authentificationByCode');
                    }
                    $this->getUser()->signin($values['user'], (isset($values['remember']) ? $values['remember'] : false));
                    $this->userAuthentified(); // On fait le reste au shutdown
                    // Go to the page requested
                    $this->getEventDispather()->notify(new mfEvent($values['user'], 'user.connected'));
                    // Récupérer les paramètres OAuth de la session PHP
                    $params=$this->getUser()->getStorage()->read('oauth2_server_request');
                    if ($params) {

                        $authorize_url = sprintf(
                            '/authorize?response_type=%s&client_id=%s&redirect_uri=%s&s&state=%s',
                            urlencode($params['response_type']),
                            urlencode($params['client_id']),
                            urlencode($params['redirect_uri']),
                            urlencode($params['state'])
                        );
                        $this->getUser()->getStorage()->remove('oauth2_server_request');
                        $this->redirect(url($authorize_url));
                    }else{
                        $this->redirect($request->getReferer());
                    }


                } else {
                    $this->getEventDispather()->notify(new mfEvent($this, 'user.failed.login', array_merge($request->getPostParameter('signin'), array('ip' => $request->getIp()))));
                }
            }

        } catch (mfException $e) {

            $messages->addError($e);
        }
    }

    protected function userAuthentified()
    {
        register_shutdown_function(array("users_guard_signinAction", "shutdown"), $this->form->getValue('user'));
    }

    static function shutdown($user)
    {
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($user, 'user.signin'));
    }
}


