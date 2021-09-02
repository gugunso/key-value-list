[![Build Status](https://travis-ci.com/gugunso/key-value-list.svg?branch=master)](https://travis-ci.com/gugunso/key-value-list)

[![Maintainability](https://api.codeclimate.com/v1/badges/cb0d3898119e8ca7d483/maintainability)](https://codeclimate.com/github/gugunso/key-value-list/maintainability)

<a href="https://codeclimate.com/github/gugunso/key-value-list/test_coverage"><img src="https://api.codeclimate.com/v1/badges/cb0d3898119e8ca7d483/test_coverage" /></a>

# key-value-list
## このパッケージが提供する機能

- 一次元配列様のKey-Valueの対応をクラスとして定義する際の雛形となる抽象クラス KeyValueList
- Row-Coluｍn様の二次元配列データ構造を格納する際の雛形となる抽象クラス Classification
- 各実装クラスのデータをキャッシュする機能（対応フレームワーク：Laravel）

## 想定している用途

- DBに格納されているマスタテーブルの情報をキャッシュし、エイリアスとして利用（KeyValueList / Classification）
- DBにテーブルを作成するほどでもない規模の、アプリケーション内共通で利用される選択肢の定義（KeyValueList）
- 区分値IDに対応して分岐する処理内容をポリモフィズム的に実装する際にIDとfactoryの対応関係を記述しておく場所として（Classification）



# Classification

抽象クラスClassificationは、主に区分値として機能する類のマスタデータをアプリケーション上に表現することを意図したクラスです。Classificationクラスのメソッドを利用して、様々なアプリケーションの仕様を実装することができます。

Classificationクラスを継承した具象クラスでは、getIdentityIndex() メソッドを実装しなければなりません。このメソッドは、データ構造中で識別子を保持している項目の名称を返却するよう実装してください。

以下に、具体的な例を示します。

``` php SampleClassification.php
<?php

namespace App\Samples;

use Gugunso\KeyValueList\Classification;
use Gugunso\KeyValueList\Contracts\ArrayFilterInterface;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Contracts\KeyValueListable;
use Gugunso\KeyValueList\Definer\ArrayDefiner;

/**
 * Class SampleClassification
 * Classificationの利用例
 */
class SampleClassification extends Classification
{
    /**
     * 識別子を示す情報が格納されているColumnの名称を定義する。
     * このサンプルでは、識別子が各Rowの 'id' に格納されている。
     * @return int|string
     */
    protected function getIdentityIndex()
    {
        return 'id';
    }
    
    /**
     * データの内容を定義し、Definerを返却する。
     * この例では、マスタデータ様のデータ構造を配列として表現したサンプルとなっている。
     *
     * Classificationクラスは、すべての行が同じ列構造を持つことを前提として設計されているので、
     * 行ごとに構造に差異がある複雑なデータ構造を返却した場合には想定通り動作しない可能性があるため、注意すること。
     * @return Definer
     */
    public function getDefiner(): Definer
    {
        return new ArrayDefiner(
            [
                ['id' => 1, 'name' => 'Yoshiki', 'item' => 'passion', 'alive' => true, 'handleClass' => 'YoshikiLogic'],
                ['id' => 2, 'name' => 'Toshi', 'item' => 'voice', 'alive' => true, 'handleClass' => 'ToshiLogic'],
                ['id' => 3, 'name' => 'Pata', 'item' => 'guitar', 'alive' => true, 'handleClass' => 'PataLogic'],
                ['id' => 4, 'name' => 'Hide', 'item' => 'guitar', 'alive' => false, 'handleClass' => 'HideLogic'],
                ['id' => 5, 'name' => 'Taiji', 'item' => 'bass', 'alive' => false, 'handleClass' => 'TaijiLogic'],
            ]
        );
    }

    /**
     * Classification::listOf() の利用例1。
     * 'id'と 'item' の対応を持つInstantKeyValueListを返却している。
     * @return KeyValueListable
     */
    public function listOfItem(): KeyValueListable
    {
        return $this->listOf('item');
    }

    /**
     * Classification::listOf() の利用例2。
     * 'id'と 'name' の対応を持つInstantKeyValueListを返却している。
     * @return KeyValueListable
     */
    public function listOfName(): KeyValueListable
    {
        return $this->listOf('name');
    }

    /**
     * filteredListOf() の利用例。
     * ArrayFilterInterfaceを実装したクラスのインスタンスを引数として渡し、条件にマッチする行のみにフィルタリングした上で、
     * 'name' の値をInstantKeyValueListとして返却している。
     * @return KeyValueListable
     */
    public function listOfNameHasGuitar(): KeyValueListable
    {
        return $this->filteredListOf('name', $this->guitar());
    }

    /**
     * listOfNameHasGuitar() の実装例から呼び出されている、フィルタリング条件を生成するprivateメソッド。
     * ここでは簡便に利用例を示すために無名クラスを使用しているが、本来は別途クラス定義しておく方がよい。
     * @return ArrayFilterInterface
     */
    private function guitar(): ArrayFilterInterface
    {
        return new class() implements ArrayFilterInterface {
            public function arrayFilter(array $row): bool
            {
                return ($row['item'] === 'guitar');
            }
        };
    }

    /**
     * valueOf() の実践的な利用例。
     * IDを受け取り、IDに対応するロジックを実装したオブジェクトを返却する状況を想定した内容となっている。
     * インスタンス生成前にクラスの存在、特定のインターフェースを実装していることを検査する処理など。
     * @param int $id
     * @param mixed ...$args
     * @return mixed
     */
    public function createHandleClass(int $id, ...$args)
    {
        $className = $this->valueOf('handleClass', $id);

        if (!class_exists($className)) {
            throw new \LogicException($className . " doesnt exist.");
        }
        if (!is_subclass_of($className, SomeInterface::class)) {
            throw new \LogicException($className . " must implement " . SomeInterface::class . " .");
        }
        return new $className($args);
    }
}
```

