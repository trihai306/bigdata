<?php

namespace App\Restify;

use App\Restify\Actions\UploadImagesPostAction;
use Binaryk\LaravelRestify\Fields\BelongsTo;
use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Modules\Post\app\Models\Post;

class PostRepository extends Repository
{
    public static string $model = Post::class;
	public static array $search = ['title','content','created_at','updated_at'];
    public static array $sort = ['id','title','content','created_at','updated_at'];
	public static int $globalSearchResults = 10;
	public static array $match = [
		'title'=>'string',
		'content'=>'string',
		'user_id'=>'string',
		'field_id'=>'string',
		'type'=>'string',
		'status'=>'string',
		'created_at'=>'between',

	];

	public static function indexQuery(RestifyRequest $request, Relation|Builder $query)

    {
//         $query->where('status', 'published');
        return parent::indexQuery($request, $query);
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('title')->rules('max:255','min:6')
            ->messages([
                'max' => 'Tiêu đề không được quá 255 ký tự',
                'min' => 'Tiêu đề không được ít hơn 6 ký tự',
            ]),
            field('content')->rules('required')->messages([
                'required' => 'Nội dung không được để trống',
            ]),
            field('user_id')->storeCallback(function ($value) {
                return auth()->user()->id;
            })->updateCallback(function ($value) {
                return auth()->user()->id;
            }),
            field('field_id')->rules('required','exists:fields,id')->messages([
                'required' => 'Lĩnh vực không được để trống',
                'exists' => 'Lĩnh vực không tồn tại',
            ]),
            field('type')->rules('required','in:seeking_manufacturer,contract_created')->messages([
                'required' => 'Loại không được để trống',
                'in' => 'Loại không hợp lệ',
            ]),
            field('status')->rules('required','in:draft,published,waiting')->messages([
                'required' => 'Trạng thái không được để trống',
                'in' => 'Trạng thái không hợp lệ',
            ]),
	        field('is_like', fn() => $this->model()->likes()->where('user_id',auth()->user()->id)->exists())->canStore(fn() => false)->canUpdate(fn() => false),
	        field('likes', fn() => $this->model()->likes()->count())->canStore(fn() => false)->canUpdate(fn() => false),
	        field('shares', fn() => $this->model()->shares()->count())->canStore(fn() => false)->canUpdate(fn() => false),
	        field('comments', fn() => $this->model()->comments()->count())->canStore(fn() => false)->canUpdate(fn() => false),
	        field('comment_by_user', fn() => $this->model()->comments()->where('user_id',auth()->user()->id)->get())->canStore(fn() => false)->canUpdate(fn() => false),
            field('images',fn()=> $this->model()->images())->canSee(fn() => false)->file()
            ->action(new UploadImagesPostAction)->canSee(fn() => false),
	        field('created_at'),
        ];
    }

    public static function related(): array
    {
        return [
	        'user' => BelongsTo::make('user', UserRepository::class),
	        'field' => BelongsTo::make('field', FieldRepository::class),
	        'comments'=> HasMany::make('comments', CommentRepository::class),
            'listComments'=> HasMany::make('listComments', CommentRepository::class),
	        'images' => HasMany::make('images', PostImagesRepository::class),
        ];
    }

}
