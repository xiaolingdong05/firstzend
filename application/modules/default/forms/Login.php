<?php

class Form_Login extends Zend_Form{

	public function init()
	{

		$username= new Zend_Form_Element_Text('username');
		$username->setLabel('User Name:')
				 ->setRequired();
		$password=new Zend_Form_Element_Password('password');
		$password->setLabel('Password:')
				 ->setRequired(true);

	    $login=new Zend_Form_Element_Submit('login');
		$login->setLabel('Login');


		$this->addElements(array($username, $password, $login));
		$this->setMethod('post');
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/login');

	}
}