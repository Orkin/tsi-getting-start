<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 14:26
 */

namespace Blog\Service;


use Blog\Model\Blog;

interface BlogServiceInterface
{

    /**
     * @return Blog[]
     */
    public function getAllBlogs();

    /**
     * @param int $id
     *
     * @return Blog|null
     */
    public function getBlogById(int $id);

    public function create(Blog $blog): Blog;

    public function edit(Blog $blog): Blog;

    public function delete(Blog $blog): bool;
}
