<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use App\Models\AuthorizationType;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function data()
    {
        return view('authorization.data', [
            'name' => 'authorization',
            'menu' => 'data',
            'title' => 'Table Authorization User',
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request)
    {
        $role = $request->role;
        $menu = $request->menu;
        $view = $request->viewMenu;
        $add = $request->addMenu;
        $edit = $request->editMenu;
        $delete = $request->deleteMenu;

        $len = Menu::all()->count();
        for ($i = 0; $i < $len; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                if ($j === 1) {
                    $type = ($view[$i] === "1" ? 1 : 0);
                } else if ($j === 2) {
                    $type = ($add[$i] === "1" ? 1 : 0);
                } else if ($j === 3) {
                    $type = ($edit[$i] === "1" ? 1 : 0);
                } else if ($j === 4) {
                    $type = ($delete[$i] === "1" ? 1 : 0);
                }

                $authorization = Authorization::where('role_id', $role[$i])
                    ->where('menu_id', $menu[$i])
                    ->where('authorization_type_id', $j)->get();

                if (count($authorization) === 0) {
                    if ($type === 1) {
                        Authorization::create([
                            'role_id' => (int)$role[$i],
                            'menu_id' => (int)$menu[$i],
                            'authorization_type_id' => $j,
                        ]);
                    } else {
                        Authorization::create([
                            'role_id' => (int)$role[$i],
                            'menu_id' => (int)$menu[$i],
                            'authorization_type_id' => 0,
                        ]);
                    }
                } else {
                    if ($type === 1) {
                        Authorization::where('role_id', $role[$i])
                            ->where('menu_id', $menu[$i])
                            ->where('authorization_type_id', $j)
                            ->update([
                                'role_id' => (int)$role[$i],
                                'menu_id' => (int)$menu[$i],
                                'authorization_type_id' => $j,
                            ]);
                    } else {
                        Authorization::where('role_id', $role[$i])
                            ->where('menu_id', $menu[$i])
                            ->where('authorization_type_id', $j)
                            ->update([
                                'role_id' => (int)$role[$i],
                                'menu_id' => (int)$menu[$i],
                                'authorization_type_id' => 0,
                            ]);
                    }
                }
            }
        }

        return response()->json('ok');
    }
}
