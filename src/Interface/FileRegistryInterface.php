<?php declare(strict_types=1);

/**
 * @author basteyy <sebastian@xzit.online>
 */

namespace basteyy\FileRegistry\Interface;

interface FileRegistryInterface {

    /**
     * Set the driver for the database
     * @param FileRegistryDriverInterface $fileRegistryDriver
     * @return void
     */
    public function setRegistryDriver(
        FileRegistryDriverInterface $fileRegistryDriver
    ) : void;

    /**
     * Add a file
     * @param string $filename
     * @param string $location
     * @param string|null $scope
     * @return bool
     */
    public function add(
        string $filename,
        string $location,
        ?string $scope
    ) : bool;

    /**
     * Get the first file which match the conditions
     * @param string $filename
     * @param string|null $location
     * @param string|null $scope
     * @return array|null
     */
    public function get(
        string $filename,
        ?string $location,
        ?string $scope
    ) : array|null;

    /**
     * Get all files matching the conditions
     * @param string|null $scope
     * @return array
     */
    public function getAll(
        ?string $scope
    ) : array;

    /**
     * Delete a specific file
     * @param string $filename
     * @param string $location
     * @param string $scope
     * @return bool
     */
    public function delete(
        string $filename,
        string $location,
        string $scope
    ) : bool;

}