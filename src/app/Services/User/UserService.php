<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * @inheritDoc
     */
    public function find(int $id, ?array $getColumns = ['*'], ?array $with = []): User
    {
        return $this->userRepository->find(
                                        id: $id, 
                                        getColumns: $getColumns, 
                                        with: $with
                                      );
    }

    /**
     * @inheritDoc
     */
    public function fetch(
        ?array $getColumns = ['*'], 
        ?array $with = [], 
        ?string $orderByColumn = 'created_at', 
        ?string $sort = 'desc'
    ): Collection
    {
        return $this->userRepository->fetchAll(
                                        getColumns: $getColumns, 
                                        with: $with, 
                                        orderByColumn: $orderByColumn, 
                                        sort: $sort
                                      );
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
          return $this->userRepository->fetchWhereForeignKey(
                                          foreignKey: $foreignKey, 
                                          id: $id, 
                                          getColumns: $getColumns, 
                                          with: $with, 
                                          orderByColumn: $orderByColumn, 
                                          sort: $sort
                                        );
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
          return $this->userRepository->delete(id: $id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $column, string $keyword, ?array $getColumns = ['*']): Collection
    {
        return $this->userRepository->search(
                                          column: $column, 
                                          keyword: $keyword, 
                                          getColumns: $getColumns
                                      );
    }
}

