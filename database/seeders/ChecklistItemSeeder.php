<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Checklist;
use App\Models\ChecklistItem;

class ChecklistItemSeeder extends Seeder
{
    public function run()
    {
        Checklist::all()->each(function ($checklist) {
            ChecklistItem::factory(3)->create([
                'checklist_id' => $checklist->id,
            ]);
        });
    }
}
