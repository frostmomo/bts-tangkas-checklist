<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::all();
        return response()->json(['checklists' => $checklists]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $checklist = Checklist::create($request->all());
        return response()->json(['message' => 'Checklist created', 'checklist' => $checklist]);
    }

    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return response()->json(['message' => 'Checklist deleted']);
    }
}
