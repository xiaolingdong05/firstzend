<?php 
class Library_Model_ListBooks {
	// do not have paramter $page, end at the selectBooks part

	private $paginator = null;

	public function listBooks($page){
		$db = Zend_Db_Table::getDefaultAdapter();
		$selectBooks = new Zend_Db_Select($db);
		$selectBooks->from('books');

		$this->paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($selectBooks));
        $this->paginator->setItemCountPerPage(2)
                  ->setCurrentPageNumber($page);


        $books = array();
        foreach($this->paginator as $book)
        {
            $bookObj = new Library_Model_Book($book['book_id']);
            $bookObj->addTitle($book['title']);
            $bookObj->addAuthor($book['author']);
            $bookObj->addComments($this->getComments($book['book_id']));
            $books[$book['book_id']] = $bookObj;
        }
		return $books;
	}

	public function getPaginator(){
		return $this->paginator;
	}

	public function getComments($bookId){
		$db = Zend_Db_Table::getDefaultAdapter();
		$selectComments = $db->select()
							 ->from('book_comments')
							 ->join('users', 'users.user_id=book_comments.user_id')
							 ->where('book_id = ?', $bookId);
		$comments = $db->query($selectComments)->fetchAll();
		return $comments;
	}
}