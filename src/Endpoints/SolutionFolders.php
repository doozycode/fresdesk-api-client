<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * Know your way around the solution folders using these APIs
 *
 * Class SolutionFolders
 * @package Doozycode\Freshservice\Endpoints
 */
class SolutionFolders extends Endpoint
{
    /**
     * Use this API to create a new folder in your solutions.
     * @param integer|string $category_id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($category_id, $properties)
    {
        $options['json'] = ["solution_folder"=>$properties];
        return $this->_client->request("post", "/solution/categories/{$category_id}/folders.json", $options);
    }

    /**
     * To update details of your solution folder, use this API.
     * You can change the name, description and with this API
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($category_id, $folder_id, $properties)
    {
        $options['json'] = ["solution_folder"=>$properties];
        return $this->_client->request("put", "/solution/categories/{$category_id}/folders/{$folder_id}.json", $options);
    }

    /**
     * To view all folders present in a category, use this API.
     * @param integer|string $category_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($category_id)
    {
        return $this->_client->request("get", "/solution/categories/{$category_id}.json");
    }

    /**
     * This API can be used to delete solution folder. Deleted solution folders cannot be restored.
     * @param integer|string $category_id
     * @param integer|string $folder_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($category_id, $folder_id)
    {
        return $this->_client->request("get", "/solution/categories/{$category_id}/folders/{$folder_id}.json");
    }
}
