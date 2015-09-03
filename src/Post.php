<?php
namespace PlatziPHP;

class Post
{
    private $author;

    private $title;

    private $body;

    public function __construct(Author $author, $title, $body)
    {
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
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
}