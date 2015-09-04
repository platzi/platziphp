<?php
namespace PlatziPHP\Domain;

use PlatziPHP\Infrastructure\FakeDatabase;

class Imprint
{
    /**
     * @type FakeDatabase
     */
    private $db;

    public function __construct(FakeDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function listPublishedPosts()
    {
        return $this->db->posts();
    }
}