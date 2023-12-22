<?php

	namespace App\Restify;


	use Binaryk\LaravelRestify\Fields\HasMany;
	use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
    use Modules\Field\app\Models\Field;

    class FieldRepository extends Repository
	{
		public static string $model = Field::class;

		public function fields(RestifyRequest $request): array
		{
			return [
				id(),
				field('name')->required()->messages([
					'required' => 'Tên không được để trống',
				]),
				field('icon'),
				field('status')->required()->storingRules( 'in:active,inactive')->messages([
					'required' => 'Trạng thái không được để trống',
					'in' => 'Trạng thái không hợp lệ',
				]),
			];
		}

		public static function related(): array
		{
			return [
				'posts' => HasMany::make('posts', PostRepository::class)
			];
		}
	}
