<?php

namespace Database\Factories;

use App\Models\ChecklistItem;
use Illuminate\Database\Eloquent\Factories\Factory;


class ChecklistItemFactory extends Factory
{
    protected $model = ChecklistItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'status' => $this->faker->boolean,
        ];
    }
}
