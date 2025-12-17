<?php
namespace App\Interface;

interface CRUD
{
    public function create(array $data): void;
    public function read(int $id): ?array;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
}
