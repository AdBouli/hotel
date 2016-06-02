<?php 

trait Access
{
	protected $_Authorize;

	/**
	 * @return Boolean
	 */
	public function isAuthorize()
	{
		return $this->_Authorize;
	}

	/**
	 * Set Authorize
	 * @param Boolean
	 */
	public function setAuthorize($access)
	{
		$this->_Authorize = $access;
	}
	
	/**
	 * Check if the current user avec the right to access at this action
	 * @param String action Function name
	 * @return Boolean
	 */
	public function checkAccess($action)
	{
		$right = $this->getright_session();
		// If is a superuser
		if ($right == 'all')
		{
			$access = true;
		} else
		// If is a simple user
		{
			$access = $this->checkAuthorize($right, $action);
		}
		$this->setAuthorize($access);
	}
	/**
	 * @param String right to check
	 * @return Boolean
	 */
	public function checkAuthorize($right, $action)
	{
		$return = false;
		if (method_exists($this, 'authorize'))
		{
			$authorize = $this->authorize();
			foreach ([$right, '*'] as $test) {
				if (array_key_exists($test, $authorize))
				{
					if (in_array($action, $authorize[$test]))
					{
						$return = true;
					}
				}
			}
		}
		return $return;
	}
}

?>