<?php

namespace Modules\Hub\App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Modules\Hub\App\Repositories\Contracts\Repository;
use Spatie\LaravelData\Data;
use Throwable;

abstract class BaseRepositoryEloquent implements Repository
{
    /**
     * @var Model|Builder
     */
    protected Model|Builder $model;

    /**
     * @var Data|string|null
     */
    protected Data|string|null $data = null;

    /**
     * @var Application
     */
    private Application $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
        $this->boot();
    }

    /**
     * @return Model
     */
    public function makeModel(): Model
    {
        return $this->model = $this->app->make($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Update or Create an entity in repository
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []): mixed
    {
        $model = $this->model->updateOrCreate($attributes, $values);

        $this->resetModel();

        return $model;
    }

    /**
     * @return void
     */
    public function resetModel(): void
    {
        $this->makeModel();
    }

    /**
     * Find first data by field and value or fail
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findFirstByFieldOrFail($field, $value, array $columns = ['*']): mixed
    {
        $result = $this->model->where($field, '=', $value)->firstOrFail($columns);

        $this->resetModel();

        return $this->parserResult($result);
    }

    /**
     * Wrapper result data
     *
     * @param mixed $result
     *
     * @return mixed
     */
    private function parserResult(mixed $result): mixed
    {
        if (is_null($this->data)) {
            return $result;
        }

        return $result instanceof Collection ? $this->data::collection($result->all()) : $this->data::from($result);
    }

    /**
     * Update a entity in repository by id or fail
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     *
     * @throws Throwable
     */
    public function updateOrFail(array $attributes, $id): mixed
    {
        $model = $this->model->findOrFail($id);

        $model->updateOrFail($attributes);

        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, array $columns = ['*']): mixed
    {
        $model = $this->model->findOrFail($id, $columns);

        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Find data by field and value
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value, array $columns = ['*']): mixed
    {
        $model = $this->model
            ->where($field, '=', $value)
            ->get($columns);

        $this->resetModel();

        return $this->parserResult($model);
    }
}
