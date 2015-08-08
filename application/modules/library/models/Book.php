<?php
class Library_Model_Book{
	private $id = null;
	private $title = null;
	private $author = null;
	private $comments = null;

	public function __construct($id){
		$this->id = $id;
	}
	public function addTitle($title){
		$this->title = $title;
	}
	public function addAuthor($author){
		$this->author = $author;
	}
	public function addComments($comments){
		$this->comments = $comments;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getAuthor(){
		return $this->author;
	}
	public function getComments($url){
		foreach($this->comments as $id=>$comment){
			$this->comments[$id]['comment'].= '<a href="'.$url.'/id/'.$comment['comment_id'].'">Edit</a>';
		}
		return $this->comments;
	}

}