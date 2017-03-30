<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Response;

/**
 * Class ResponseServiceProvider
 * @package App\Providers
 */
class ResponseServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        Response::macro('success', function ($data, array $meta = null, int $code = JsonResponse::HTTP_OK) {
            return Response::json([
                'success' => true,
                'data' => $data,
                'errors' => null,
                'meta' => $meta
            ], $code);
        });

        Response::macro('created', function ($data, array $meta = null, int $code = JsonResponse::HTTP_CREATED) {
            return Response::json([
                'success' => true,
                'data' => $data,
                'errors' => null,
                'meta' => $meta
            ], $code);
        });

        Response::macro('successRemove', function (int $code = JsonResponse::HTTP_NO_CONTENT) {
            return Response::json(null, $code);
        });

        Response::macro('notFound', function (string $message = 'Resource could not be found', int $code = JsonResponse::HTTP_NOT_FOUND) {
            return Response::json([
                'success' => false,
                'data' => null,
                'errors' => ['message' => $message],
                'meta' => null
            ], $code);
        });

        Response::macro('badRequest', function (array $errors, array $meta = null,  int $code = JsonResponse::HTTP_BAD_REQUEST) {
            return Response::json([
                'success' => false,
                'data' => null,
                'errors' => $errors,
                'meta' => $meta
            ], $code);
        });

        Response::macro('error', function (string $error, int $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR) {
            return Response::json([
                'success' => false,
                'data' => null,
                'errors' => ['message' => $error],
                'meta' => null
            ], $code);
        });
    }
}