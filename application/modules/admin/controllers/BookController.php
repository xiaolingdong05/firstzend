<?php

class Admin_BookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $booksTBL = new Library_Model_DbTables_Books();
        $data = array(
            'id' => '4',
            'title' => 'bibi',
            'author' => 'user'
            );
        $booksTBL->insert($data);
        $this->view->books = $booksTBL->fetchAll();
    }

    public function deleteAction()
    {
        $booksTBL = new Library_Model_DbTables_Books();
        $row = $booksTBL->fetchRow($booksTBL->select()->where('title = ?', 'bibi'));
        if (empty($row)) $this->view->errorMessage = 'not find!';
        else {
            $row->delete();
            $this->view->books = $booksTBL->fetchAll();
            }
    }


}





