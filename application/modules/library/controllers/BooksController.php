<?php

class Library_BooksController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('list', 'json')->initContext();
        // action name, and only two types json and xml, they should be stored in books view
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        //$this->_helper->layout()->disableLayout(); 
        //$this->_helper->viewRenderer->setNoRender(true);
        //$booksTBL = new Library_Model_DbTables_Books();
        //$this->view->books = $booksTBL->fetchAll();
        
        $bookList = new Library_Model_ListBooks();
        //$booksList = $bookList->listBooks();
        $books = $bookList->listBooks($this->_getParam('page', 1));

        /*$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($bookList));
        $paginator->setItemCountPerPage(2)
                  ->setCurrentPageNumber($this->getParam('page', 1));


        $books = array();
        foreach($paginator as $book)
        {
            $books[] = $book;
        }*/
        //$books = json_decode(json_encode($books), true);
        $this->view->books = $books;

        if(!$this->_request->isXmlHttpRequest())
        {
            $this->view->paginator = $bookList->getPaginator();
        }
        else{
            $this->view->currentPage = $bookList->getPaginator()->getCurrentPageNumber();
        }
    }


}



