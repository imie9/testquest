<?php
/**
 * Created by PhpStorm.
 * User: imie
 * Date: 31.10.18
 * Time: 16:41
 */

namespace App\Repositories;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Repositories
 */
interface CategoryRepositoryInterface
{
    /**
     * @return object
     */
    public function all(): object;

    /**
     * @return object
     */
    public function allWithHierarchy(): object;

    /**
     * @param int $id
     * @return object
     */
    public function items(int $id): object;

    /**
     * @param array $data
     * @return object
     */
    public function getById(array $data): object;
    
    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object;
}