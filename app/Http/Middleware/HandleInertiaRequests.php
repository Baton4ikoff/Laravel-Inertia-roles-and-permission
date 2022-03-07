<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $authUser = $request->user();

        return array_merge(parent::share($request), [

            'permission' => function () use ($authUser) {
                if (!$authUser) return;

                return [
                    'users' => [
                        'index'     => $authUser->can('user_index'),
                        'create'    => $authUser->can('user_create'),
                        'show'      => $authUser->can('user_show'),
                        'edit'      => $authUser->can('user_edit'),
                        'destroy'   => $authUser->can('user_destroy'),
                    ],
                ];
            },

            'auth' => function() {
                $user = auth()->user();
                return $user ? [
                    'hasRole' => [
                        'admin' => $user->hasRole('Администратор'),
                        'user' => $user->hasRole('Пользователь'),
                    ]
                ] : null;
            },

            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },

        ]);
    }
}
