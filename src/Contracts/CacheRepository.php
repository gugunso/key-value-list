<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * CacheRepository
 *
 * @package Gugunso\KeyValueList\Contracts
 */
interface CacheRepository
{
    /**
     * get
     * キャッシュからデータを取得
     *
     * @return array
     */
    public function get(): array;

    /**
     * store
     * キャッシュへの保存
     *
     * @param  array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * remove
     * キャッシュの削除。
     * データ更新時等のキャッシュを削除処理は各アプリケーション側の責任において実装すること。
     *
     * @return mixed
     */
    public function remove();
}
