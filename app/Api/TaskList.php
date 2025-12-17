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

    public function read(Request $request): ?array
    {
        $taskLists = ModelsTaskList::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
        return $taskLists ? $taskLists->toArray() : null;
    }

    public function update(Request $request): void
    {
        ds($request->all());
         ModelsTaskList::where('id', $request->id)->update(['title' => $request->title]);
    }

    public function delete(int $id): void
    {
        // Implementation for deleting a task list
    }
}
