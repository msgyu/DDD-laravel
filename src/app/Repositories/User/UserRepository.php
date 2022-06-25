<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface 
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function find(
        int $id, 
        ?array $getColumns = ['*'], 
        ?array $with = [],
    ): User
    {
        $record = User::with($with)
                        ->findOrFail($id, $getColumns);
        return $record;
        
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(
        ?array $getColumns = ['*'], 
        ?array $with = [], 
        ?string $orderByColumn = 'created_at', 
        ?string $sort = 'desc'
    ): Collection
    {
        return User::with($with)
                    ->orderBy($orderByColumn, $sort)
                    ->get($getColumns);
    }

    /**
     * @inheritDoc
     */
    public function fetchWhereForeignKey(
        string $foreignKey, 
        int $id, 
        ?array $getColumns = ['*'], 
        ?array $with = [], 
        ?string $orderByColumn = 'created_at', 
        ?string $sort = 'desc'
    ): Collection
    {
        return User::with($with)
                           ->where($foreignKey, '=', $id)
                           ->orderBy($orderByColumn, $sort)
                           ->get($getColumns);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return User::where('id', $id)->delete();
    }


    /**
     * @inheritDoc
     */
    public function search(
        string $column, 
        string $keyword, 
        ?array $getColumns = ['*']
    ): Collection
    {
        return User::searchKeywordMatch(column: 'email', keyword: $keyword)
                              ->get($getColumns);
    }
    
}