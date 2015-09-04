<?php
namespace PlatziPHP\Infrastructure;

use PlatziPHP\Domain\Author;

class AuthorRepository extends BaseRepository
{
    protected function table()
    {
        return 'users';
    }

    protected function mapEntity(array $result)
    {
        $author = new Author(
            $result['email'],
            $result['password'],
            'AUTOR_DE_PLATZI'
        );

        $author->setName(
            $result['first_name'],
            $result['last_name']
        );

        return $author;
    }
}