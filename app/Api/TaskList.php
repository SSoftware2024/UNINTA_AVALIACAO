<?php

namespace App\Api;

use App\Interface\CRUD;
use Illuminate\Http\Request;
use App\Models\TaskList as ModelsTaskList;
use Illuminate\Support\Facades\Validator;

final class TaskList
{
    public function create(Request $request)
    {
        ds('here');
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        if (!$validator->fails()) {
            ModelsTaskList::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário cadastrado com sucesso',
            ], 201);
        } else {

            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

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
