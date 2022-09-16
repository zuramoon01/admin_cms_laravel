<?php

namespace App\Http\Middleware;

use App\Models\AuthorizationType;
use App\Models\Authorization as Authorizations;
use Closure;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routePrefix = substr($request->route()->getPrefix(), 1);
        $routeMethod = $request->method();

        if ($routeMethod === "GET") {
            $routeMethod = 'view';
        } else if ($routeMethod === "POST") {
            $routeMethod = 'add';
        } else if ($routeMethod === "PUT" || $routeMethod === "PATCH") {
            $routeMethod = 'edit';
        } else if ($routeMethod === "DELETE") {
            $routeMethod = 'delete';
        }

        $role = Role::where('id', auth()->user()->role_id)->first();
        $menu = Menu::where('route', $routePrefix)->first();
        $authorization_type = AuthorizationType::where('type_name', $routeMethod)->first();

        $authorization = Authorizations::where('role_id', $role->id)
            ->where('menu_id', $menu->id)
            ->where('authorization_type_id', $authorization_type->id)->get();


        if ($authorization->count() === 0) {
            return to_route('home');
        }

        return $next($request);
    }
}
