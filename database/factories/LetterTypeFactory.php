<?php

namespace Database\Factories;

use App\Models\LetterType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class LetterTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LetterType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $names = [
            'قرارداد',
            'گزارشی',
            'مالی',
            'درخواست',
            'اطلاع رسانی',

        ];

        return [
            'name' => $name = Arr::random($names),
            'code' => Str::substr($name,0, 1),
        ];
    }
}
