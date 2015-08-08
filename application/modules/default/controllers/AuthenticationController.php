<?php

class Default_AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $this->view->title='Login';
    	if (Zend_Auth::getInstance()->hasIdentity())
        {
            $this->_redirect('index/index');
        }

        $request = $this->getRequest();
    	$form = new Form_Login();

        if($request->isPost())
        {
            if($form->isValid($this->_request->getPost()))
            {
                $authAdapter = $this ->getAuthAdapter();
                $user = $form->getValue('username');
                $password = $form->getValue('password');

                $authAdapter -> setIdentity($user)
                             -> setCredential($password);

                $auth=Zend_Auth::getInstance();
                $result=$auth->authenticate($authAdapter);

                if ($result->isValid())
                {
                    $identity=$authAdapter->getResultRowObject();
                    $authStorage=$auth->getStorage();
                    $authStorage->write($identity);
                    $this->_redirect('index/index');
                }
                else 
                {
                    echo $this->view->errorMessage = "Username and password does not match";
                }
            }
        }

        $this->view->form=$form;	
    }

    public function logoutAction()
    {
        Zend_auth::getInstance()->clearIdentity();
        $this->_redirect('index/index');
    }


    private function getAuthAdapter()
    {
    	$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
    	$authAdapter -> setTableName('users')
    	             -> setIdentityColumn('user')
    	             -> setCredentialColumn('password');
    	return $authAdapter;
    }


}





