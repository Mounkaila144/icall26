<?php

class mfBasicSecurityFilter { 

	public function execute($filterChain);
	protected function forwardToLoginAction();
	protected function forwardTo401Action();
	protected function getUserCredential();
}
