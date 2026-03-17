<?php

namespace App\Policies;

use App\Services\PermissionService;
use Illuminate\Database\Eloquent\Model;

class BasePolicy
{
    protected ?string $currentModelClass = null;

    public function __construct(
        private readonly PermissionService $permissions
    ) {}

    public function before($user, $ability, $modelOrClass = null)
    {
        if (is_string($modelOrClass)) {
            $this->currentModelClass = $modelOrClass;
        } elseif ($modelOrClass instanceof Model) {
            $this->currentModelClass = get_class($modelOrClass);
        }
        
        return null;
    }

    protected function tableFromClass(string $modelClass): string
    {
        return (new $modelClass)->getTable();
    }

    protected function tableFromModel(Model $model): string
    {
        return $model->getTable();
    }

    public function viewAny($user, string $modelClass = null): bool
    {
        $modelClass = $modelClass ?? $this->currentModelClass;
        return $this->permissions->check(
            'view',
            $this->tableFromClass($modelClass)
        );
    }

    public function view($user, Model $model): bool
    {
        return $this->permissions->check(
            'view',
            $this->tableFromModel($model)
        );
    }

    public function create($user, string $modelClass = null): bool
    {
        $modelClass = $modelClass ?? $this->currentModelClass;
        return $this->permissions->check(
            'create',
            $this->tableFromClass($modelClass)
        );
    }

    public function update($user, Model $model): bool
    {
        return $this->permissions->check(
            'update',
            $this->tableFromModel($model)
        );
    }

    public function delete($user, Model $model): bool
    {
        return $this->permissions->check(
            'delete',
            $this->tableFromModel($model)
        );
    }
}