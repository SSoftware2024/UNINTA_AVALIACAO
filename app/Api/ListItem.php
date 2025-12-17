<?php

namespace App\Api;

use App\Enum\ListItemStatus;
use App\Models\ListItem as ModelsListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

final class ListItem
{

    public function create(Request $request)
    {
        ds('here');
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'task_list_id' => ['required', 'integer', 'exists:task_lists,id'],
        ]);

        if (!$validator->fails()) {
            ModelsListItem::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Item cadastrado com sucesso',
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
        $taskLists = ModelsListItem::where('task_list_id', $request->task_list_id)
            ->where('status', $request->status)
            ->orderBy('id', 'desc')->get();
        return $taskLists ? $taskLists->toArray() : null;
    }

    public function update(int $id, Request $request): void
    {
        ModelsListItem::where('id', $id)->update(['title' => $request->title]);
    }
    public function changeStatus(int $id, Request $request): void
    {
        $status = $request->status == ListItemStatus::COMPLETED->value ? ListItemStatus::COMPLETED->value : ListItemStatus::PENDING->value;
        ModelsListItem::where('id', $id)->update(['status' => $status]);
    }

    public function delete(int $id, Request $request)
    {
        // Pega o usuário autenticado
        $user = $request->user();

        // Busca o item garantindo que ele pertença a uma lista do usuário
        $item = ModelsListItem::where('id', $id)
            ->whereHas('taskList', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->first();

        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Item não encontrado ou você não tem permissão para deletar.'
            ], 404);
        }

        $item->delete();
    }
}
