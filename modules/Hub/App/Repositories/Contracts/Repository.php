<?php

namespace Modules\Hub\App\Repositories\Contracts;

use Throwable;

interface Repository
{
    /**
     * Update or Create an entity in repository
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []): mixed;

    /**
     * Find first data by field and value or fail
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findFirstByFieldOrFail($field, $value, array $columns = ['*']): mixed;

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
    public function updateOrFail(array $attributes, $id): mixed;

    /**
     * Find data by field and value
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value, array $columns = ['*']): mixed;

    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, array $columns = ['*']): mixed;
}
