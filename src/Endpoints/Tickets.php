<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * This section lists all API that can be used to create, edit or otherwise manipulate tickets.
 *
 * Class Tickets
 * @package Doozycode\Freshservice\Endpoints
 */
class Tickets extends Endpoint
{
    /**
     * @var string
     */
    private $_path = '/helpdesk/tickets';

    /**
     * This API helps you to create a new ticket in your service desk.
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($properties)
    {
        $options['json'] = ['helpdesk_ticket'=>$properties];
        return $this->_client->request("post", $this->_path.".json", $options);
    }

    /**
     * This API lets you make changes to the parameters of a ticket from updating statuses to changing ticket type.
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($id, $properties)
    {
        $options['json'] = ['helpdesk_ticket'=>$properties];
        return $this->_client->request("put", $this->_path."/{$id}.json", $options);
    }

    /**
     * This API helps you delete a ticket.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->_client->request("delete", $this->_path."/{$id}.json");
    }

    /**
     * This API lets you retrieve and view a specific ticket and all conversations related to it in your service desk.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request("get", $this->_path."/{$id}.json");
    }

    /**
     * This API helps you to view the tickets in your service desk.
     * @param integer $page
     * @param array $filters
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($page=1, $filters)
    {
        $parameters = array('filter_name'=>'all_tickets','page'=>$page);

        if (isset($filters['status'])) // all_tickets, new_my_open, monitored_by, spam, deleted
        {
            $parameters['filter_name'] = $filters['status'];
        }
        if (isset($filters['requester_email']))
        {
            $parameters['email'] = $filters['requester_email'];
        }

        if (isset($filters['requester_id']))
        {
            $parameters['format'] = 'json';
            return $this->_client->request("get", "/helpdesk/tickets/filter/requester/{$filters['requester_id']}?".http_build_query($parameters));
        }
        elseif (isset($filters['view_id']))
        {
            $parameters['format'] = 'json';
            return $this->_client->request("get", "/helpdesk/tickets/view/{$filters['view_id']}?".http_build_query($parameters));
        }
        else
        {
            return $this->_client->request("get", $this->_path.".json?".http_build_query($parameters));
        }

    }

    /**
     * This API lets you view the fields in a ticket.
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function fields()
    {
        return $this->_client->request("get", "/ticket_fields.json");
    }

    /**
     * This API helps you to create a new ticket in your help desk with attachments.
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function attachments($id, $properties)
    {
        /**
         * The API request must be sent as multipart/form-data content-type.
         */
        $options['headers'] = ["Content-Type"=> "multipart/form-data"];
        return $this->_client->request("post", $this->_path."/{$id}.json", $options);
    }

    /**
     * If you wish to add notes to a ticket - private or public - this API lets you do so.
     * Any note that you add using this API, by default, is Private.
     * If you wish a public note, set the parameter to false.
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function note($id, $properties)
    {
        $options['json'] = ['helpdesk_note'=>$properties];
        return $this->_client->request("post",  $this->_path."/{$id}/conversations/note.json", $options);
    }

    /**
     * Use this API to create notes with attachment.
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function note_attachments($id, $properties)
    {
        /**
         * The API request must be sent as multipart/form-data content-type.
         */
        $options['headers'] = ["Content-Type"=> "multipart/form-data"];
        return $this->_client->request("post", $this->_path."/{$id}.json", $options);
    }

    /**
     *
     * This API helps you associate an asset to a ticket in your service desk.
     * @param array $properties
     * @param array $associations
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function assets($properties, $associations)
    {
        $options['json'] = $associations;
        $options['json']['helpdesk_ticket'] = $properties;

        return $this->_client->request("post", $this->_path.".json", $options);
    }
}