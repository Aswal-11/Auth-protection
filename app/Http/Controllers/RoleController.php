<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of roles
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')
            ->get(['id', 'name', 'slug']);

        $tables = DB::select('SHOW TABLES');

        $tableNames = collect($tables)->map(function ($table) {
            return array_values((array) $table)[0];
        });

        return view('roles.create', compact('permissions', 'tableNames'));
    }

    /**
     * Store role
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'table_names' => 'required|array',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $syncData = [];

        foreach ($request->table_names as $table) {
            foreach ($request->permissions as $permissionId) {

                $syncData[] = [
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                    'table_name' => $table,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('role_permission')->insert($syncData);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Show role
     */
    public function show(Role $role)
    {
        $role->load('permissions');

        return view('roles.show', compact('role'));
    }

    /**
     * Edit role
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();

        $tables = DB::select('SHOW TABLES');

        $tableNames = collect($tables)->map(function ($table) {
            return array_values((array) $table)[0];
        });

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        $selectedTables = $role->permissions
            ->pluck('pivot.table_name')
            ->unique()
            ->toArray();

        return view('roles.edit', compact(
            'role',
            'permissions',
            'tableNames',
            'rolePermissions',
            'selectedTables'
        ));
    }

    /**
     * Update role
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'table_names' => 'required|array',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        DB::table('role_permission')
            ->where('role_id', $role->id)
            ->delete();

        $insertData = [];

        foreach ($request->table_names as $table) {

            foreach ($request->permissions as $permissionId) {

                $insertData[] = [
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                    'table_name' => $table,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('role_permission')->insert($insertData);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Delete role
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}