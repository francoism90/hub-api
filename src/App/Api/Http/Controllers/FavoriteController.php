<?php

namespace App\Api\Http\Controllers;

use Domain\Users\Actions\MarkModelAsFavorite;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(Video $model, Request $request): JsonResponse
    {
        $this->authorize('view', $model);

        app(MarkModelAsFavorite::class)->execute($model, $request->user());

        return response()->json(['success' => true]);
    }
}
