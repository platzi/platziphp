<?php
namespace PlatziPHP\Domain;

use PlatziPHP\Infrastructure\AuthorRepository;

class Post
{
    private $id;

    private $author;

    private $title;

    private $body;

    public function __construct($authorId, $title, $body, $id = null)
    {
        $this->setAuthor($authorId);
        $this->title = $title;
        $this->body = $body;
        $this->id = $id;
    }

    public static function create(Author $author, $title, $body)
    {
        $post = new Post($author, $title, $body);

        return $post;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getAuthor()
    {
        return 'by ' . $this->author->getFirstName();
    }

    private function setAuthor($author)
    {
        if ($author instanceof Author) {
            $this->author = $author;
        } else {
            $repository = new AuthorRepository();
            $this->author = $repository->find($author);
        }
    }
}