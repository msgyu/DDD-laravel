<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    /**
     * 特定のレコードを取得
     *
     * @param integer $id ユーザーId
     * @param array|null $getColumns 指定して取得したいカラム
     * @param array|null $with モデルに紐づくリレーション
     * @return User
     */
    public function find(int $id, ?array $getColumns = ['*'], ?array $with = []): User;

    /**
     * 一覧取得
     *
     * @param array|null $getColumns 指定して取得したいカラム
     * @param array|null $with モデルに紐づくリレーション
     * @param string|null $orderByColumn orderBy対象カラム
     * @param string|null $sort orderByのソート方法
     * @return Collection
     */
    public function fetch(
                        ?array $getColumns = ['*'],
                        ?array $with = [], 
                        ?string $orderByColumn = 'created_at', 
                        ?string $sort = 'desc'
                    ): Collection;


    /**
     * 外部キーで絞り込みして一覧取得
     *
     * @param string $foreignKey
     * @param integer $id ユーザーId
     * @param array|null $getColumns 指定して取得したいカラム
     * @param array|null $with モデルに紐づくリレーション
     * @param string|null $orderByColumn orderBy対象カラム
     * @param string|null $sort orderByのソート方法
     * @return Collection
     */
    public function fetchWhereForeignKey(
                        string $foreignKey, 
                        int $id, 
                        ?array $getColumns = ['*'],
                        ?array $with = [], 
                        ?string $orderByColumn = 'created_at', 
                        ?string $sort = 'desc'
                    ): Collection;

    /**
     * 対象のレコードを削除
     *
     * @param integer $id
     * @return integer 削除レコード数
     */
    public function delete(int $id): int;


    /**
     * 検索処理
     *
     * @param string $column 対象のカラム
     * @param string $keyword 検索キーワード
     * @param string $getColumns 指定して取得したいカラム
     * @return Collection
     */
    public function search(
        string $column, 
        string $keyword, 
        ?array $getColumns = ['*']
    ): Collection;
}