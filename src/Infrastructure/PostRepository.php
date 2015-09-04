<?php
namespace PlatziPHP\Infrastructure;

use Illuminate\Support\Collection;
use PlatziPHP\Domain\Post;

class PostRepository
{
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

    public function find($id)
    {
        $pdo = $this->getPDO();

        $statement = $pdo->prepare(
            'SELECT * FROM posts WHERE id = :id'
        );

        $statement->bindParam(':id', $id, \PDO::PARAM_INT);

        $statement->execute();
        $result = $statement->fetch();

        if ($result === false) {
            throw new \OutOfBoundsException("Post $id does not exist.");
        }

        return $this->mapPost($result);
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

    /**
     * @return \PDO
     */
    private function getPDO()
    {
        return new \PDO(
            'mysql:host=127.0.0.1;dbname=platziphp',
            'guiwoda',
            'guiwoda'
        );
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

    private function mapPost(array $result)
    {
        return new Post(
            $result['author_id'],
            $result['title'],
            $result['body'],
            $result['id']
        );
    }
}