<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * With these APIs, create new solution articles, update existing ones, and more.
 *
 * Class SolutionArticles
 * @package Doozycode\Freshservice\Endpoints
 */
class SolutionArticles extends Endpoint
{
    /**
     * To write a new solution in a category, use this API.
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @param array $properties
     * @param array $tags
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($category_id, $folder_id, $properties, $tags=[])
    {
        $options['json'] = ['solution_article'=>$properties];
        if ($tags)
        {
            $options['json']['tags'] = ["name"=>implode($tags)];
        }
        return $this->_client->request("post", "/solution/categories/{$category_id}/folders/{$folder_id}/articles.json", $options);
    }

    /**
     * To update an article, use this API
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @param integer|string $article_id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($category_id, $folder_id, $article_id, $properties)
    {
        $options['json'] = ['solution_article'=>$properties];
        return $this->_client->request("put", "/solution/categories/{$category_id}/folders/{$folder_id}/articles/{$article_id}.json", $options);
    }

    /**
     * If there is a specific article which you wish to view, use this API.
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @param integer|string $article_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($category_id, $folder_id, $article_id)
    {
        return $this->_client->request("get", "/solution/categories/{$category_id}/folders/{$folder_id}/articles/{$article_id}.json");
    }

    /**
     * To view all the articles, use this API.
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($category_id, $folder_id)
    {
        return $this->_client->request("get", "/solution/categories/{$category_id}/folders/{$folder_id}.json");
    }

    /**
     * To delete an article, use this API
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @param integer|string $article_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($category_id, $folder_id, $article_id)
    {
        return $this->_client->request("delete", "/solution/categories/{$category_id}/folders/{$folder_id}/articles/{$article_id}.json");
    }
}
