<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	private $_acl = null;
	//private $_auth = null;

	protected function _initAutoload(){
		$modelLoader = new Zend_Application_Module_Autoloader(array(
					'namespace' =>  '',
					'basePath' => APPLICATION_PATH.'/modules/default'));

		if (Zend_auth::getInstance()->hasIdentity())
			Zend_Registry::set('role', Zend_Auth::getInstance()->getStorage()->read()->role);
		else
			Zend_Registry::set('role', 'guest');

		$this->_acl = new Model_LibraryAcl();
		//$this->_auth = Zend_Auth::getInstance();

		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Plugin_AccessCheck($this->_acl));//, $this->_auth));
		return $modelLoader;

	}

	function _initViewHelpers()
	{
		$this->bootstrap('layout');
		$layout=$this->getResource('layout');
		$view=$layout->getView();

		$view->setHelperPath(APPLICATION_PATH.'/helpers', '');
		//Zend_Dojo::enableView($view);
		// cannot use both of them at the same time
		ZendX_JQuery::enableView($view);

		$view->doctype('HTML5');
        $view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8')
                         ->appendName('description', 'Using zend view helper');
        $view->headTitle()->setSeparator(' - ');
        $view->headTitle('Zend Framework');

        $navContainerConfig=new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml', 'nav');
        $navContainer = new Zend_Navigation($navContainerConfig, '');

        $view->navigation($navContainer)->setAcl($this->_acl)->setRole(Zend_Registry::get('role'));
        
        /*$role=null;
        if ($this->_auth->hasIdentity())
		{
			$identity = $this->_auth->getStorage()->read();
			$role = $identity->role;
		}
        $view->navigation($navContainer)->setAcl($this->_acl)->setRole($role);*/

	}

	/*protected function _initDbAdapter() { 

      $db = Zend_Db::factory('PDO_MYSQL', array( 
                  'host' => 'localhost', 
                  'username' => 'root', 
                  'password' => '', 
                  'dbname' => 'test' 
              )); 

       Zend_Db_Table_Abstract::setDefaultAdapter($db); 
	}*/

}

