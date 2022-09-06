<?php

namespace App\Http\Services\File;

interface FileServiceInterface
{
    public function readFile(): array;
    public function store(array $data): bool;
}
