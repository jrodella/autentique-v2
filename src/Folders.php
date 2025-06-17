<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Utils\Query;

/**
 * Class Folders
 * @package vinicinbgs\Autentique
 * @see https://beadev.net/autentique-v2/folders
 */
class Folders extends BaseResource
{
    const DEFAULT = 'DEFAULT';
    const GROUP = 'GROUP';
    const ORGANIZATION = 'ORGANIZATION';

    /**
     * @var Query
     */
    private $query;

    /**
     * Documents constructor.
     *
     * @param string|null $token Autentique API Token
     * @param int $timeout=60 Request Timeout in seconds
     */
    public function __construct(string $token = null, int $timeout = 60)
    {
        parent::__construct($token, $timeout);

        $this->query = new Query($this->resourcesEnum::FOLDERS);
    }

    /**
     * List all folders
     *
     * @param int $page
     * @return array
     */
    public function listAll(int $page = 1, string $type = self::DEFAULT): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(["page", "type"], [$page, $type], $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * List folder by id
     *
     * @param string $folderId
     *
     * @return array
     */
    public function listById(string $folderId): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("folderId", $folderId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * List folder by id
     *
     * @param string $folderId
     *
     * @return array
     */
    public function listContentsById(string $folderId, int $page = 1): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            ["folderId", "page", "sandbox"],
            [$folderId, $page, $this->sandbox],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Create folder
     *
     * @param array $variables
     * @return array
     */
    public function create(array $variables): array
    {
        $graphMutation = $this->query->query(__FUNCTION__);
        $graphMutation = $this->query->setVariables(
            ["variables", "sandbox"],
            [json_encode($variables), $this->sandbox],
            $graphMutation
        );

        return $this->api->request($this->token, $graphMutation, "json");
    }

    /**
     * Delete folder by id
     *
     * @param string $folderId
     *
     * @return array
     */
    public function deleteById(string $folderId): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("folderId", $folderId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }
}
