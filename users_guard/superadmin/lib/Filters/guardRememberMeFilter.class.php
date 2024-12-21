<?php


class guardRememberMeFilter extends mfFilter
{
  
  public function execute($filterChain)
  {
      
    if (
      $this->isFirstCall()
      &&
      $this->context->getUser()->isAnonymous()
      &&
      $cookie = $this->context->getRequest()->getCookie(md5('Remember'.mfConfig::get('mf_app')))
    )
    {
        if ($q = userRememberUtils::getUserRemember($cookie))
           $this->context->getUser()->signIn(new User($q->getUserId()));
    }

    $filterChain->execute();
  }
}
