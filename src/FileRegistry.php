<?php declare(strict_types=1);

/**
 * @author basteyy <sebastian@xzit.online>
 */

namespace basteyy\FileRegistry;

use basteyy\FileRegistry\Interface\FileRegistryDriverInterface;
use basteyy\FileRegistry\Interface\FileRegistryInterface;

class FileRegistry implements  FileRegistryInterface {

    private FileRegistryDriverInterface $fileRegistryDriver;

    public function setRegistryDriver(FileRegistryDriverInterface $fileRegistryDriver): void
    {
        $this->fileRegistryDriver = $fileRegistryDriver;
    }

    public function add(string $filename, string $location, ?string $scope): bool
    {
        return $this->fileRegistryDriver->add(filename: $filename, location: $location, scope: $scope);
    }

    public function get(string $filename, ?string $location = null, ?string $scope = null): array|null
    {
        return $this->fileRegistryDriver->get(filename: $filename, location: $location ?? null, scope: $scope ?? null);
    }

    public function getAll(?string $scope): array
    {
        return $this->fileRegistryDriver->getAll(scope: $scope ?? null);
    }

    public function delete(?string $filename = null, ?string $location = null, ?string $scope = null): bool
    {
        return $this->fileRegistryDriver->delete(filename: $filename, location: $location, scope: $scope);
    }
}