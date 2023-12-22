<?php

namespace App\Restify;

use App\Models\User;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class UserRepository extends Repository
{
    public static string $model = User::class;
	
	public static array $search = ['name','email','phone','address'];
	public static int $globalSearchResults = 10;
	public static array $match = [
		'name'=>'string',
		'email'=>'string',
		'phone'=>'string',
		'address'=>'string',
		'birthday'=>'date',
		'gender'=>'string',
		'status'=>'string',
		'created_at'=>'between',
	];
	
	public static function indexQuery(RestifyRequest $request, \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation $query)
	{
		$query->where('status', 'active');
		return parent::indexQuery($request, $query);
	}

    public function fields(RestifyRequest $request): array
    {
        return [
            field('name')->rules('required'),

            field('email')->storingRules('required', 'unique:users')->messages([
                'required' => 'This field is required.',
            ]),

//            field('password')->storingRules('required')->messages([
//                'required' => 'This field is required.',
//            ]),
//
//            field('password_confirmation')->storingRules('required', 'same:password')->messages([
//                'required' => 'This field is required.',
//            ]),

            field('avatar')->image()->disk('public')->storingRules('required')->messages([
                'required' => 'This field is required.',
            ]),

            field('phone')->rules('required', 'unique:users', 'phone')->messages([
                'required' => 'This field is required.',
                'unique' => 'This field is unique.',
                'phone' => 'This field is phone.',
            ]),

            field('address')->rules('required')->messages([
                'required' => 'This field is required.',
            ]),

            field('birthday')->rules('required', 'date')->messages([
                'required' => 'This field is required.',
                'date' => 'This field is date.',
            ]),

            field('gender')->rules('required', 'in:male,female,non-binary,genderqueer,transgender,genderfluid,agender')->messages([
                'required' => 'This field is required.',
                'in' => 'This field is in.',
            ]),

            field('status')->rules('required', 'in:active,inactive,blocked')->messages([
                'required' => 'This field is required.',
                'in' => 'This field is in.',
            ]),
        ];
    }
}
