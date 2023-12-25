<?php
namespace Modules\Field\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Field\app\Models\Field;

class FieldFactory extends Factory
{
    protected $model = Field::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([
                'active',
                'block',
                'pending',
            ]),
        ];
    }
}
