<?php

namespace App\Restify\Actions;

use Binaryk\LaravelRestify\Actions\Action;
use Binaryk\LaravelRestify\Http\Requests\ActionRequest;
use Binaryk\LaravelRestify\Http\Requests\RepositoryStoreRequest;
use Illuminate\Http\JsonResponse;
use Modules\Post\app\Models\Post;

class UploadImagesPostAction extends Action
{
    public function handle(RepositoryStoreRequest $request, Post $models): JsonResponse
    {
	    if($request->hasFile('images')){
		  foreach ($request->images as $file){

			  $models->images()->create([
				  'image' => $file->store('images', 'public'),
				  'user_id' => auth()->user()->id,
			  ]);
		  }
	    }

        return ok();
    }
}
