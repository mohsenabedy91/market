<?php

namespace App\Repositories;

use Closure;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RuntimeException;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Application
     */
    protected Application $app;

    /**
     * @var mixed
     */
    protected mixed $model;

    /**
     * @var array
     */
    protected array $fieldSearchable = [];

    /**
     * @var int
     */
    protected int $defaultPaginate = 10;

    /**
     * @var int
     */
    protected int $minPaginate = 10;

    /**
     * @var int
     */
    protected int $maxPaginate = 100;

    /**
     * @var string
     */
    protected string $defaultOrderBy;

    /**
     * @var string
     */
    protected string $defaultTableName;

    /**
     * @param Application $app
     * @throws BindingResolutionException
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
        $this->defaultOrderBy = empty($this->defaultOrderBy) ? $this->getModel()->getQualifiedKeyName() . ':asc' : $this->defaultOrderBy;
        $this->defaultTableName = empty($this->defaultTableName) ? $this->getModel()->getTable() : $this->defaultTableName;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @return string
     */
    abstract public function model(): string;

    /**
     * @return Model
     * @throws BindingResolutionException
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RuntimeException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @param $column
     * @param $key
     * @return mixed
     */
    public function pluck($column, $key = null): mixed
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * @param $id
     * @param $relation
     * @param $attributes
     * @param $detaching
     * @return mixed
     */
    public function sync($id, $relation, $attributes, $detaching = true): mixed
    {
        return $this->find($id)->{$relation}()->sync($attributes, $detaching);
    }

    /**
     * @param $id
     * @param $relation
     * @param $attributes
     * @return mixed
     */
    public function syncWithoutDetaching($id, $relation, $attributes): mixed
    {
        return $this->sync($id, $relation, $attributes, false);
    }

    /**
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function all(array $columns = ['*']): Collection|array
    {
        if ($this->model instanceof Builder) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }

        return $results;
    }

    /**
     * @param array $where
     * @param string $columns
     * @return mixed
     */
    public function count(array $where = [], string $columns = '*'): mixed
    {
        $this->applyConditions($where);
        return $this->model->count($columns);
    }

    /**
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function get(array $columns = ['*']): Collection|array
    {
        return $this->all($columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first(array $columns = ['*']): mixed
    {
        return $this->model->first($columns);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrNew(array $attributes = []): mixed
    {
        return $this->model->firstOrNew($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $attributes = []): mixed
    {
        return $this->model->firstOrCreate($attributes);
    }

    /**
     * @param $limit
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function limit($limit, array $columns = ['*']): Collection|array
    {
        $this->take($limit);

        return $this->all($columns);
    }

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
        bool   $sortableByRequest = false,
        bool   $searchableByRequest = false,
        array  $fieldSearchable = []
    ): mixed
    {
        $limit = request()?->input('perPage', $this->defaultPaginate);
        $limit = $limit > 100 ? $this->maxPaginate : $limit;
        $limit = $limit < 10 ? $this->minPaginate : $limit;

        if ($searchableByRequest === true) {
            $this->fieldSearchable = !empty($fieldSearchable) ? $fieldSearchable : $this->fieldSearchable;
            $this->search(columns: $columns);
        }

        $orderBy = $this->defaultOrderBy;
        if ($sortableByRequest === true) {
            $orderBy = request()?->input('sortBy', $this->defaultOrderBy);
        }

        $orderBy = preg_replace('/\s+/', '', $orderBy);
        $orderBy = preg_replace('/\;+/', ';', $orderBy);
        $orderBy = trim($orderBy, ';');
        $orderBy = Str::snake($orderBy);
        $orderBy = explode(';', $orderBy);
        $orderByFields = array_map(static function ($value) {
            $value = trim($value, '_');
            return explode(':', $value);
        }, $orderBy);

        foreach ($orderByFields as $orderByField) {
            if (count($orderByField) !== 2) {
                continue;
            }

            [$column, $direction] = $orderByField;

            if (!str_contains($column, '.')) {
                $column = $this->model->getModel()->getTable() . '.' . $column;
            }

            $this->orderBy($column, $direction);
        }

        $results = $this->model->{$method}($limit, $columns);
        $results->appends(app('request')->query());

        return $results;
    }

    /**
     * @param $query
     * @return string
     */
    public function getQueryWithBindings($query): string
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            $binding = addslashes($binding);
            return is_numeric($binding) ? $binding : "'$binding'";
        })->toArray());
    }

    /**
     * @param $id
     * @param $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']): mixed
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param array $where
     * @param $columns
     * @return $this
     */
    public function findWhere(array $where, $columns = ['*']): static
    {
        $this->applyConditions($where);
        $this->model = $this->model->select($columns);
        return $this;
    }

    /**
     * @param $field
     * @param array $values
     * @param $columns
     * @return $this
     */
    public function findWhereIn($field, array $values, $columns = ['*']): static
    {
        $this->model = $this->model->whereIn($field, $values)->select($columns);

        return $this;
    }

    /**
     * @param $field
     * @param array $values
     * @param $columns
     * @return $this
     */
    public function findWhereNotIn($field, array $values, $columns = ['*']): static
    {
        $this->model = $this->model->whereNotIn($field, $values)->select($columns);

        return $this;
    }

    /**
     * @param $field
     * @param array $values
     * @param $columns
     * @return $this
     */
    public function findWhereBetween($field, array $values, $columns = ['*']): static
    {
        $this->model->whereBetween($field, $values)->select($columns);

        return $this;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        $model = $this->model->newInstance()->forceFill($attributes);
        $model->makeVisible($this->model->getHidden());
        $attributes = $model->toArray();
        $model = $this->model->newInstance($attributes);
        $model->save();

        return $model;
    }

    /**
     * @param array $attributes
     * @param array $conditions
     * @return array|Builder|Collection
     */
    public function update(array $attributes, array $conditions): array|Builder|Collection
    {
        $model = $this->model->newInstance();
        $model->setRawAttributes([]);
        $model->setAppends([]);
        $model->forceFill($attributes);
        $model->makeVisible($this->model->getHidden());
        $attributes = $model->toArray();
        $model = $this->model->where($conditions);
        $model->update($attributes);

        return $this->findWhere($attributes)->all();
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []): mixed
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        return $this->find($id)->delete();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function deleteWhere(array $where): mixed
    {
        $this->applyConditions($where);
        return $this->model->delete();
    }

    /**
     * @param $relation
     * @return $this
     */
    public function has($relation): static
    {
        $this->model = $this->model->has($relation);

        return $this;
    }

    /**
     * @param $relations
     * @return $this
     */
    public function with($relations): static
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    /**
     * @param $relations
     * @return $this
     */
    public function withCount($relations): static
    {
        $this->model = $this->model->withCount($relations);

        return $this;
    }

    /**
     * @param $relation
     * @param $closure
     * @return $this
     */
    public function whereHas($relation, $closure): static
    {
        $this->model = $this->model->whereHas($relation, $closure);

        return $this;
    }

    /**
     * @param $column
     * @param $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc'): static
    {
        $this->model = $this->model->orderBy($column, $direction);

        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function take($limit): static
    {
        $this->model = $this->model->limit($limit);

        return $this;
    }

    /**
     * @param array $where
     * @param bool $orWhere
     * @return $this
     */
    public function applyConditions(array $where, bool $orWhere = false): static
    {
        $whereMethod = $orWhere === true ? 'orWhere' : 'where';
        $this->model->{$whereMethod}(function ($q) use ($where) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {
                    [$field, $condition, $val] = $value;
                    dump($field, $condition, $val);
                    //smooth input
                    $condition = preg_replace('/\s\s+/', ' ', trim($condition));

                    //split to get operator, syntax: "DATE >", "DATE =", "DAY <"
                    $operator = explode(' ', $condition);
                    if (count($operator) > 1) {
                        $condition = $operator[0];
                        $operator = $operator[1];
                    } else {
                        $operator = null;
                    }

                    switch (strtoupper($condition)) {
                        case 'IN':
                            if (!is_array($val)) {
                                throw new RuntimeException("Input $val mus be an array");
                            }
                            $this->model = $q->whereIn($field, $val);
                            break;
                        case 'NOTIN':
                            if (!is_array($val)) {
                                throw new RuntimeException("Input $val mus be an array");
                            }
                            $this->model = $q->whereNotIn($field, $val);
                            break;
                        case 'DATE':
                            if (!$operator) {
                                $operator = '=';
                            }
                            $this->model = $q->whereDate($field, $operator, $val);
                            break;
                        case 'DAY':
                            if (!$operator) {
                                $operator = '=';
                            }
                            $this->model = $q->whereDay($field, $operator, $val);
                            break;
                        case 'MONTH':
                            if (!$operator) {
                                $operator = '=';
                            }
                            $this->model = $q->whereMonth($field, $operator, $val);
                            break;
                        case 'YEAR':
                            if (!$operator) {
                                $operator = '=';
                            }
                            $this->model = $q->whereYear($field, $operator, $val);
                            break;
                        case 'EXISTS':
                            if (!($val instanceof Closure)) {
                                throw new RuntimeException("Input $val must be closure function");
                            }
                            $this->model = $q->whereExists($val);
                            break;
                        case 'HAS':
                            if (!($val instanceof Closure)) {
                                throw new RuntimeException("Input $val must be closure function");
                            }
                            $this->model = $q->whereHas($field, $val);
                            break;
                        case 'HASMORPH':
                            if (!($val instanceof Closure)) {
                                throw new RuntimeException("Input $val must be closure function");
                            }
                            $this->model = $q->whereHasMorph($field, $val);
                            break;
                        case 'DOESNTHAVE':
                            if (!($val instanceof Closure)) {
                                throw new RuntimeException("Input $val must be closure function");
                            }
                            $this->model = $q->whereDoesntHave($field, $val);
                            break;
                        case 'DOESNTHAVEMORPH':
                            if (!($val instanceof Closure)) {
                                throw new RuntimeException("Input $val must be closure function");
                            }
                            $this->model = $q->whereDoesntHaveMorph($field, $val);
                            break;
                        case 'BETWEEN':
                            if (!is_array($val)) {
                                throw new RuntimeException("Input $val mus be an array");
                            }
                            $this->model = $q->whereBetween($field, $val);
                            break;
                        case 'BETWEENCOLUMNS':
                            if (!is_array($val)) {
                                throw new RuntimeException("Input $val mus be an array");
                            }
                            $this->model = $q->whereBetweenColumns($field, $val);
                            break;
                        case 'NOTBETWEEN':
                            if (!is_array($val)) {
                                throw new RuntimeException("Input $val mus be an array");
                            }
                            $this->model = $q->whereNotBetween($field, $val);
                            break;
                        case 'NOTBETWEENCOLUMNS':
                            if (!is_array($val)) {
                                throw new RuntimeException("Input $val mus be an array");
                            }
                            $this->model = $q->whereNotBetweenColumns($field, $val);
                            break;
                        case 'RAW':
                            $this->model = $q->whereRaw($val);
                            break;
                        default:
                            $this->model = $q->where($field, $condition, $val);
                    }
                } else {
                    $this->model = $q->where($field, '=', $value);
                }
            }
        });

        return $this;
    }

    /**
     * @param array $fieldSearchable
     * @param array $columns
     * @return $this
     */
    public function search(array $fieldSearchable = [], array $columns = []): static
    {
        $fieldSearchable = empty($fieldSearchable) ? $this->fieldSearchable : $fieldSearchable;

        if (empty($fieldSearchable)) {
            throw new RuntimeException("Please define protected array fieldSearchable = [] and define your searchable columns via that in you repository");
        }

        $searchPhrase = request()?->input('search');

        if (!empty($searchPhrase)) {
            $model = $this->model;

            $relatedTableColumn[$this->defaultTableName . '.*'] = $this->defaultTableName . '.*';
            foreach ($columns as $field) {
                $parseField = explode('.', $field);
                if (count($parseField) === 1) {
                    $relatedTableColumn[$this->defaultTableName . '.' . $parseField[0]] = $this->defaultTableName . '.' . $parseField[0];
                } else {
                    $relatedTableColumn[$parseField[0] . '.' . $parseField[1]] = $parseField[0] . '.' . $parseField[1];
                }
            }

            foreach ($fieldSearchable as $fieldsKey => $fieldsValue) {
                if ($fieldsKey === 'relations') {
                    foreach ($fieldsValue as $relation) {
                        [$tableName, $key] = explode('.', $relation['relatedTable']);
                        $this->model->{$relation['joinMethod']}($tableName, $relation['foreignKey'], '=', $relation['relatedTable']);
                    }
                }
            }

            $this->model->where(function ($q) use ($fieldSearchable, $searchPhrase, &$relatedTableColumn) {
                foreach ($fieldSearchable as $fieldsKey => $fieldsValue) {
                    if ($fieldsKey === 'conditions') {
                        foreach ($fieldsValue as $field) {
                            if ($field['type'] === "number" && !preg_match("/^[0-9]+$/", $searchPhrase)) {
                                continue;
                            }

                            if (in_array($field['operator'], ['like', 'ilike'])) {
                                $q->orWhere($field['column'], $field['operator'], '%' . $searchPhrase . '%');
                            } else {
                                $q->orWhere($field['column'], $field['operator'], $searchPhrase);
                            }
                        }
                    }

                    if ($fieldsKey === 'relations') {
                        foreach ($fieldsValue as $relation) {
                            foreach ($relation['conditions'] as $field) {
                                if ($field['type'] === 'number' && !preg_match("/^[0-9]+$/", $searchPhrase)) {
                                    continue;
                                }

                                if (in_array($field['operator'], ['like', 'ilike'])) {
                                    $q->orWhere($field['column'], $field['operator'], '%' . $searchPhrase . '%');
                                } else {
                                    $q->orWhere($field['column'], $field['operator'], $searchPhrase);
                                }

                                $relatedTableColumn[$field['column'] . ' as ' . $field['column'] . 'Searched'] = $field['column'] . ' as ' . $field['column'] . 'Searched';
                            }
                        }
                    }
                }
            });

            if (!empty($relatedTableColumn)) {
                $this->model->select(array_values($relatedTableColumn));
            }

            $this->model = $model;
        }

        return $this;
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }
}
