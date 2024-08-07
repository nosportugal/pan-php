<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Folder
{
    protected $folder;

    public function folderIsValid(): bool
    {
        return is_string($this->folder) && in_array($this->folder, $this->folderValues());
    }

    public function folderIsRequired(): bool
    {
        return true;
    }

    public function folderValues(): array
    {
        return [
            'All',
            'Shared',
            'Mobile Users',
            'Remote Networks',
            'Service Connections',
            'Mobile Users Container',
            'Mobile Users Explicit Proxy'
        ];
    }
}
