<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 14:25
 */
declare(strict_types = 1);


namespace Blog\Service;


use Blog\Model\Blog;
use Blog\Repository\BlogRepository;
use Doctrine\ORM\EntityManager;

class BlogService implements BlogServiceInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogService constructor.
     *
     * @param EntityManager  $entityManager
     * @param BlogRepository $blogRepository
     */
    public function __construct(EntityManager $entityManager, BlogRepository $blogRepository)
    {
        $this->entityManager  = $entityManager;
        $this->blogRepository = $blogRepository;
    }

    /**
     * @return Blog[]
     */
    public function getAllBlogs()
    {
        return $this->blogRepository->findAll();
    }

    public function create(Blog $blog): Blog
    {
        $blog->setCreationDate(new \DateTime());

        $this->entityManager->persist($blog);
        $this->entityManager->flush($blog);

        return $blog;
    }

    public function edit(Blog $blog): Blog
    {
        $blog->setModificationDate(new \DateTime());

        $this->entityManager->flush($blog);

        return $blog;
    }

    public function delete(Blog $blog): bool
    {
        try {
            $this->entityManager->remove($blog);
            $this->entityManager->flush($blog);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param int $id
     *
     * @return Blog|null
     */
    public function getBlogById(int $id)
    {
        return $this->blogRepository->findOneById($id);
    }
}
