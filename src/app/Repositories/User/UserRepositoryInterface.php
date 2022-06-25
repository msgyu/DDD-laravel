<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * 特定のレコードを取得
     *
     * @param integer $id
     * @param array|null $getColumns 指定して取得したいカラム
     * @param array|null $with
     * @return User
     */
    public function find(
        int $id, 
        ?array $getColumns = ['*'], 
        ?array $with = [], 
    ): User;


    /**
     * 一覧を取得
     *
     * @param array|null $getColumns 指定して取得したいカラム
     * @param array|null $with モデルに紐づくリレーション
     * @param string|null $orderByColumn orderBy対象カラム
     * @param string|null $sort orderByのソート方法
     * @return Collection
     */
    public function fetchAll(
        ?array $getColumns = ['*'], 
        ?array $with = [], 
        ?string $orderByColumn = 'created_at', 
        ?string $sort = 'desc'
    ): Collection;


    /**
     * 外部キーで絞り込みして一覧取得
     *
     * @param string $foreignKey 指定して取得したい外部キー
     * @param integer $id id
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