<?php

namespace App\Api;

use App\Enum\ListItemStatus;
use App\Interface\CRUD;
use App\Models\ListItem as ModelsListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

final class ListItem implements CRUD
{

    public function create(Request $request)
    {
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

    public function read(Request $request)
    {
        $user = $request->user();
        $taskList = $user->taskList()->find($request->task_list_id);

        if (!$taskList) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lista não encontrada ou não pertence ao usuário',
            ], 404);
        }

        $query = $taskList->listItems()->orderBy('id', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->get();

        return $items->toArray();
    }

    public function update(int $id, Request $request): void
    {
        ModelsListItem::where('id', $id)->update(['title' => $request->title]);
    }
    public function changeStatus(int $id, Request $request): void
    {
        $item = ModelsListItem::find($id);
        $item->status = $item->status == ListItemStatus::COMPLETED->value ? ListItemStatus::PENDING->value : ListItemStatus::COMPLETED->value;
        $item->save();
    }

    public function delete(int $id, Request $request)
    {
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
