<?php declare(strict_types=1);

/**
 * @author basteyy <sebastian@xzit.online>
 */

namespace basteyy\FileRegistry\Driver;

use basteyy\FileRegistry\Interface\FileRegistryDriverInterface;
use Exception;
use Jajo\JSONDB;

/**
 * A driver based on the JSONDB from donjajo
 * @see https://github.com/donjajo/php-jsondb
 */
class JSONDBFileDriver implements FileRegistryDriverInterface {

    const DEFAULT_SCOPE = '_default_scope';

    private JSONDB $json_db;

    private string $db_file_name;

    /**
     * @throws Exception
     */
    public function __construct(string $json_db_folder) {
        $this->db_file_name = basename($json_db_folder);
        $this->json_db = new JSONDB(substr($json_db_folder, 0, -strlen($this->db_file_name) ));
    }


    public function add(string $filename, string $location, ?string $scope): bool
    {
        $this->json_db->insert($this->db_file_name,
            [
                'scope' => $scope ?? self::DEFAULT_SCOPE,
                'filename' => $filename,
                'location' => $location
            ]
        );

        return true;
    }

    public function get(string $filename, ?string $location, ?string $scope): array|null
    {
        $query = [
            'filename' => $filename,
            'scope' => $scope ?? self::DEFAULT_SCOPE
        ];

        if(isset($location)) {
            $query['location'] = $location;
        }

        return $this->json_db->select()
            ->from($this->db_file_name)
            ->where($query)
            ->get();
    }

    public function getAll(?string $scope): array
    {
        if(isset($scope)) {
            return $this->json_db->select()
                ->from($this->db_file_name)
                ->where(['scope' => $scope])
                ->get();
        } else {
            return $this->json_db->select()
                ->from($this->db_file_name)
                ->get();

        }
    }

    public function delete(?string $filename = null, ?string $location = null, ?string $scope = null): bool
    {
        $query = [
            'scope' => $scope ?? self::DEFAULT_SCOPE
        ];

        if(isset($location)) {
            $query['location'] = $location;
        }

        if(isset($filename)) {
            $query['filename'] = $filename;
        }

        $this->json_db->delete()
            ->from($this->db_file_name)
            ->where($query)
            ->trigger();

        return true;
    }
}