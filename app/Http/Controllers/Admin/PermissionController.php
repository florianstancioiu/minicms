<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\Permission\StorePermission;
use App\Http\Requests\Permission\UpdatePermission;
use App\Http\Requests\Permission\DestroyPermission;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $this->can('list-permissions');

        $keyword = $request->keyword ?? '';
        $permissions = Permission::orderBy('id', 'DESC')
            ->search($keyword)
            ->paginate()
            ->appends(request()->query());

        $auth_user = Auth::user();
        $can_edit_permissions = $auth_user->canUser('edit-permissions');
        $can_destroy_permissions = $auth_user->canUser('destroy-permissions');

        return view('admin.permissions.index', compact(
            'permissions',
            'keyword',
            'can_edit_permissions',
            'can_destroy_permissions',
        ));
    }

    public function create()
    {
        $this->can('create-permissions');

        return view('admin.permissions.create');
    }

    public function store(StorePermission $request)
    {
        $this->can('store-permissions');

        $permission = new Permission($request->validated());

        try {
            $permission->save();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.permissions.index')
                ->withErrors([
                    __('permissions.store_failure') . $e->getMessage()
                ]);
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with('message', __('permissions.store_success'));
    }

    public function edit(int $id)
    {
        $this->can('edit-permissions');

        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermission $request, int $id)
    {
        $this->can('update-permissions');

        $permission = Permission::findOrFail($id);
        $permission = $permission->fill($request->validated());

        try {
            $permission->save();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.permissions.index')
                ->withErrors([
                    __('permissions.update_failure') . $e->getMessage()
                ]);
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with('message', __('permissions.update_success'));
    }

    public function destroy(DestroyPermission $request, int $id)
    {
        $this->can('destroy-permissions');

        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.permissions.index')
                ->withErrors([
                    __('permissions.destroy_failure') . $e->getMessage()
                ]);
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with('message', __('permissions.destroy_success'));
    }
}
