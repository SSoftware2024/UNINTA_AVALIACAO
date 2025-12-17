<?php
namespace App\Api;

use App\Interface\CRUD;
use Illuminate\Http\Request;
use App\Models\TaskList as ModelsTaskList;

final class TaskList
{
    public function create(Request $request): void
    {
        ds('here');
        ModelsTaskList::create($request->title);
    }

    public function read(int $id): ?array
    {
        // Implementation for reading a task list
        return null;
    }

    public function update(int $id, array $data): void
    {
        // Implementation for updating a task list
    }

    public function delete(int $id): void
    {
        // Implementation for deleting a task list
    }
}
