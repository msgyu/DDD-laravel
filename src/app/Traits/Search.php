<?php

namespace App\Traits;

trait Search
{
    /**
     * 完全一致検索
     *
     * @param [type] $query
     * @param string $keyword 検索キーワード
     * @param string|null $column 対象カラム
     */
    public function scopeSearchKeywordMatch($query, string $column = 'name',  string $keyword)
    {
        if($keyword !== null) {
          return $query;
        }
        
        return $query->where($column, $keyword);
    }

    /**
     * 前方一致検索
     *
     * @param [type] $query
     * @param string $keyword 検索キーワード
     * @param string|null $column 対象カラム
     */
    public function scopeSearchKeywordPrefixMatch($query, string $column = 'name',  string $keyword)
    {
        if($keyword !== null) {
          return $query;
        }
        
        return $query->where($column, 'like', $keyword . '%');
    }

    /**
     * 部分一致検索
     *
     * @param [type] $query
     * @param string $keyword 検索キーワード
     * @param string|null $column 対象カラム
     * @return void
     */
    public function scopeSearchKeywordPartialMatch($query, string $column = 'name',  string $keyword)
    {
        if($keyword !== null) {
          return $query;
        }

        return $query->where($column, 'like', '%' . $keyword . '%');
      }

    /**
     * 複数キーワード検索
     *
     * @param [type] $query
     * @param string $keywords 複数キーワード
     * @return void
     */
    public function scopeSearchMultipleKeyword($query, string $column = 'name',  string $keywords)
    {
        if ($keywords !== null) {
          return $query;
        }

        // 全角スペースを半角スペースに変換
        $HalfSpaceKeywords = mb_convert_kana($keywords, 's');

        // 半角スペースで分割して配列を生成
        $keywords = preg_split('/[\s]+/', $HalfSpaceKeywords);

        foreach ($keywords as $keyword) {
          $query
              ->searchKeywordPartialMatch($column, $keyword);
        }

        return $query;
    }
}