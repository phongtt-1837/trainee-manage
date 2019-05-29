<?php

namespace App\Repositories;

interface CourseRepositoryInterface
{
    /**
     * Get all collection of instance
     * @param  array  $relation
     * @return colection
     */
    public function all($relation = []);

    /**
     * Get all small sliced collection of instance
     * @param  array  $relation
     * @param  int $number
     * @return colection
     */
    public function paginate($relation = [], $number);

    /**
     * Create a new instance of the given model
     * @param  array $data
     * @return instance
     */
    public function store($data);

    /**
     * Get instance by id
     * @param  array  $relation
     * @param  int $id
     * @return instance
     */
    public function get($relation = [], $id);

    /**
     * Update instance by id
     * @param  array  $data
     * @param  int $id
     * @return instance
     */
    public function update($data, $id);

    /**
     * Delete instance by id
     * @param  int $id
     * @return int|boolean
     */
    public function delete($id);

    /**
     * filter by language
     * @param  int $array relation, int $language
     * @return colection
     */
    public function filterLanguage($relation, $language);
}
