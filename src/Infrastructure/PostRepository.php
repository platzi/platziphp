<?php
namespace PlatziPHP\Infrastructure;

use Illuminate\Support\Collection;
use PlatziPHP\Domain\EntityNotFound;
use PlatziPHP\Domain\Post;

class PostRepository extends BaseRepository
{
    protected function table()
    {
        return 'posts';
    }

    public function all()
    {
        $pdo = $this->getPDO();

        $statement = $pdo->prepare(
            'SELECT * FROM posts'
        );

        return $this->mapToPosts(
            $statement->fetchAll()
        );
    }

    public function search($query)
    {
        $pdo = $this->getPDO();

        $statement = $pdo->prepare(
            'SELECT * FROM posts WHERE title LIKE :query OR body LIKE :query'
        );

        $query = "%$query%";
        $statement->bindParam(':query', $query, \PDO::PARAM_STR);

        return $this->mapToPosts($statement->fetchAll());
    }

    private function mapToPosts(array $results)
    {
        $posts = new Collection();

        foreach ($results as $result) {
            $post = $this->mapPost($result);

            $posts->push($post);
        }

        return $posts;
    }

    protected function mapEntity(array $result)
    {
        return new Post(
            $result['author_id'],
            $result['title'],
            $result['body'],
            $result['id']
        );
    }
}