<?php
namespace PlatziPHP\Infrastructure;

use Illuminate\Support\Collection;
use PlatziPHP\Domain\Author;
use PlatziPHP\Domain\Post;

class FakeDatabase
{
    /**
     * @return Collection
     */
    public function posts()
    {
        $author = new Author(
            'guiwoda@gmail.com',
            '12345678',
            'AUTOR_DE_PLATZI'
        );
        $author->setName('Guido', 'Woda');

        return new Collection([
            1 => new Post($author, 'Post #1', 'This is the first post'),
            2 => new Post($author, 'Post #2', 'This is the second post'),
            3 => new Post($author, 'Post #3', 'This is the third post'),
            4 => new Post($author, 'Post #4', 'This is the fourth post'),
            5 => new Post($author, 'Post #5', 'This is the fifth post'),
        ]);
    }
}