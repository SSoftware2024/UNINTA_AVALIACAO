<?php

namespace App\Api;

use App\Interface\CRUD;
use App\Models\ListItem;
use Illuminate\Http\Request;
use App\Models\TaskList as ModelsTaskList;
use Illuminate\Support\Facades\Validator;

final class TaskList implements CRUD
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

    public function update(int $id, Request $request): void
    {

         ModelsTaskList::where('id', $id)->update(['title' => $request->title]);
    }

    public function delete(int $id, Request $request): void
    {
        ListItem::where('task_list_id', $id)->delete();
        ModelsTaskList::where('id', $id)->delete();
    }
}
