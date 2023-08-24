<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        $checklistItems = $checklist->items;
        return response()->json(['checklist_items' => $checklistItems]);
    }

    public function store(Request $request, Checklist $checklist)
    {
        $request->validate([
            'itemName' => 'required|string',
        ]);

        $checklistItem = $checklist->items()->create([
            'name' => $request->itemName,
        ]);

        return response()->json(['message' => 'Checklist item created', 'checklist_item' => $checklistItem]);
    }

    public function show(Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json(['message' => 'There are no checklist item  in this checklist'], 404);
        }

        return response()->json(['checklist_item' => $item]);
    }

    public function destroy(Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json(['message' => 'There are no checklist item in this checklist'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Checklist item deleted']);
    }

    public function updateStatus(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json(['message' => 'Checklist item not found in this checklist'], 404);
        }

        $request->validate([
            'status' => 'required|boolean',
        ]);

        $item->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Checklist item status updated', 'checklist_item' => $item]);
    }

    public function rename(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json(['message' => 'There are no checklist item in this checklist'], 404);
        }

        $request->validate([
            'itemName' => 'required|string',
        ]);

        $item->update([
            'name' => $request->itemName,
        ]);

        return response()->json(['message' => 'Checklist item renamed', 'checklist_item' => $item]);
    }
}
