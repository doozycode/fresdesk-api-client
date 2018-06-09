<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * These APIs help you track exactly how much time you've spent on each ticket*,
 * start/stop timers and perform a whole other lot of time tracking and monitoring tasks
 * to ensure that your support team is always performing at peak efficiency.
 *
 * Class TimeEntries
 * @package Doozycode\Freshservice\Endpoints
 */
class TimeEntries extends Endpoint
{
    /**
     * This API helps you create a Time Entry.
     * @param string $module_name
     * @param integer|string $module_id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($module_name, $module_id, $properties)
    {
        $options['json'] = ['time_entry'=>$properties];
        return $this->_client->request("post", "/itil/{$module_name}/{$module_id}/time_sheets.json", $options);
    }

    /**
     * To view existing Time Entries, use this API.
     * @param string $module_name
     * @param integer|string $module_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($module_name, $module_id)
    {
        return $this->_client->request("get", "/itil/{$module_name}/{$module_id}/time_sheets.json");
    }

    /**
     * You can use this API to update/modify existing time entries.
     * @param string $module_name
     * @param integer|string $module_id
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($module_name, $module_id, $id, $properties)
    {
        $options['json'] = ['time_entry'=>$properties];
        return $this->_client->request("put", "/itil/{$module_name}/{$module_id}/time_sheets/{$id}.json", $options);
    }


    /**
     * You can use this API to delete an existing Time Entry.
     * You cannot restore deleted time entries
     * @param string $module_name
     * @param integer|string $module_id
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($module_name, $module_id, $id)
    {
        return $this->_client->request("delete", "/itil/{$module_name}/{$module_id}/time_sheets/{$id}.json");
    }

    /**
     * This API helps you start or stop the timer.
     * @param string $module_name
     * @param integer|string $module_id
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function updateTimer($module_name, $module_id, $id, $properties)
    {
        $options['json'] = ['time_entry'=>$properties];
        return $this->_client->request("put", "/itil/{$module_name}/{$module_id}/time_sheets/{$id}/toggle_timer.json", $options);
    }
}
