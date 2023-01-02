<?php

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @return Model
     * @throws BindingResolutionException
     */
    public function makeModel(): Model;

    /**
     * @param $column
     * @param $key
     * @return mixed
     */
    public function pluck($column, $key = null): mixed;

    /**
     * @param $id
     * @param $relation
     * @param $attributes
     * @param bool $detaching
     * @return mixed
     */
    public function sync($id, $relation, $attributes, bool $detaching = true): mixed;

    /**
     * @param $id
     * @param $relation
     * @param $attributes
     * @return mixed
     */
    public function syncWithoutDetaching($id, $relation, $attributes): mixed;

    /**
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function all(array $columns = ['*']): Collection|array;

    /**
     * @param array $where
     * @param string $columns
     * @return mixed
     */
    public function count(array $where = [], string $columns = '*'): mixed;

    /**
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function get(array $columns = ['*']): Collection|array;

    /**
     * @param array $columns
     * @return mixed
     */
    public function first(array $columns = ['*']): mixed;

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrNew(array $attributes = []): mixed;

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $attributes = []): mixed;

    /**
     * @param $limit
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function limit($limit, array $columns = ['*']): Collection|array;

    /**
     * @param array $columns
     * @param string $method
     * @param bool $sortableByRequest
     * @param bool $searchableByRequest
     * @param array $fieldSearchable
     * @return mixed
     */
    public function paginate(
        array  $columns = ['*'],
        string $method = "paginate",
        bool   $sortableByRequest = true,
        bool   $searchableByRequest = true,
        array  $fieldSearchable = []
    ): mixed;

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, array $columns = ['*']): mixed;

    /**
     * @param array $where
     * @param array $columns
     * @return $this
     */
    public function findWhere(array $where, array $columns = ['*']): static;

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return $this
     */
    public function findWhereIn($field, array $values, array $columns = ['*']): static;

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return $this
     */
    public function findWhereNotIn($field, array $values, array $columns = ['*']): static;

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return $this
     */
    public function findWhereBetween($field, array $values, array $columns = ['*']): static;

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed;

    /**
     * @param array $attributes
     * @param array $conditions
     * @return mixed
     */
    public function update(array $attributes, array $conditions): mixed;

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * @param array $where
     * @return mixed
     */
    public function deleteWhere(array $where): mixed;

    /**
     * @param $relation
     * @return $this
     */
    public function has($relation): static;

    /**
     * @param $relations
     * @return $this
     */
    public function with($relations): static;

    /**
     * @param $relations
     * @return $this
     */
    public function withCount($relations): static;

    /**
     * @param $relation
     * @param $closure
     * @return $this
     */
    public function whereHas($relation, $closure): static;

    /**
     * @param $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, string $direction = 'asc'): static;

    /**
     * @param $limit
     * @return $this
     */
    public function take($limit): static;

    /**
     * @param array $where
     * @return $this
     */
    public function applyConditions(array $where): static;

    /**
     * @param array $fieldSearchable
     * @return $this
     */
    public function search(array $fieldSearchable = []): static;

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments);

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments);
}
