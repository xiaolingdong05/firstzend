<?php
class Model_LibraryAcl extends Zend_Acl
{
	public function __construct()
	{
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('users'), 'guest');
		$this->addRole(new Zend_Acl_Role('admins'), 'users');

		$this->add(new Zend_Acl_Resource('library'))
			 ->add(new Zend_Acl_Resource('library:books'), 'library');
	    $this->add(new Zend_Acl_Resource('admin'))
			 ->add(new Zend_Acl_Resource('admin:book'), 'admin');
		$this->add(new Zend_Acl_Resource('default'))
			 ->add(new Zend_Acl_Resource('default:authentication'), 'default')
			 ->add(new Zend_Acl_Resource('default:index'), 'default')
			 ->add(new Zend_Acl_Resource('default:error'), 'default');

	    $this->allow('guest', 'default:authentication', 'login');
	    $this->allow('guest', 'default:error', 'error');
	    $this->deny('users', 'default:authentication', 'login');
	    $this->allow('users', 'default:index', 'index');
	    $this->allow('users', 'default:authentication', 'logout');
	    $this->allow('users', 'library:books', array('index', 'list'));

	    $this->allow('admins', 'admin:book', array('index', 'add', 'delete'));











        /*$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('error'));

                                          
        $this->add(new Zend_Acl_Resource('authentication'));
        $this->add(new Zend_Acl_Resource('login'), 'authentication');
         $this->add(new Zend_Acl_Resource('logout'), 'authentication');

		$this->add(new Zend_Acl_Resource('book'));
		$this->add(new Zend_Acl_Resource('edit'), 'book');
		$this->add(new Zend_Acl_Resource('add'), 'book');

		$this->add(new Zend_Acl_Resource('books'));
		$this->add(new Zend_Acl_Resource('list'), 'books');

		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('user'), 'guest');
		$this->addRole(new Zend_Acl_Role('admin'), 'user');

		$this->allow('guest', 'login');
		$this->deny('user', 'login');

        $this->allow('user', array('index', 'authentication', 'books'));
        $this->allow('admin', 'book');*/



        //$this->allow('user', 'index');
        //$this->allow('user', 'error');
        //$this->allow('user', 'authentication', 'login');
        //$this->allow('user', 'authentication', 'logout');

		//$this->allow('user', 'books', 'list');
		//$this->allow('admin', 'book', 'add');
		//$this->allow('admin', 'book', 'delete');
		

	}
}