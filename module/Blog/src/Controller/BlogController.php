<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:31
 */
declare(strict_types = 1);


namespace Blog\Controller;


use Blog\Form\AddBlogForm;
use Blog\Form\EditBlogForm;
use Blog\Model\Blog;
use Blog\Service\BlogServiceInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{

    /**
     * @var BlogServiceInterface
     */
    private $blogService;
    /**
     * @var AddBlogForm
     */
    private $addBlogForm;
    /**
     * @var EditBlogForm
     */
    private $editBlogForm;

    /**
     * BlogController constructor.
     *
     * @param BlogServiceInterface $blogService
     * @param AddBlogForm          $addBlogForm
     * @param EditBlogForm         $editBlogForm
     */
    public function __construct(BlogServiceInterface $blogService, AddBlogForm $addBlogForm, EditBlogForm $editBlogForm)
    {
        $this->blogService  = $blogService;
        $this->addBlogForm  = $addBlogForm;
        $this->editBlogForm = $editBlogForm;
    }

    public function indexAction()
    {
        return new ViewModel(
            [
                'blogs' => $this->blogService->getAllBlogs(),
            ]
        );
    }

    public function addAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->addBlogForm->setData($request->getPost());

            if ($this->addBlogForm->isValid()) {
                /** @var Blog $blog */
                $blog = $this->addBlogForm->getData();
                $this->blogService->create($blog);

                return $this->redirect()->toRoute('blog');
            }
        }

        return new ViewModel(
            [
                'form' => $this->addBlogForm,
            ]
        );
    }

    public function editAction()
    {
        $blogId = (int)$this->params()->fromRoute('id');
        $blog   = $this->blogService->getBlogById($blogId);

        if (!$blog) {
            return $this->redirect()->toRoute('album');
        }

        $this->editBlogForm->bind($blog);

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->editBlogForm->setData($request->getPost());

            if ($this->editBlogForm->isValid()) {
                /** @var Blog $blog */
                $blog = $this->editBlogForm->getData();

                $this->blogService->edit($blog);

                return $this->redirect()->toRoute('blog');
            }
        }

        return new ViewModel(
            [
                'form' => $this->editBlogForm,
                'id'   => $blog->getId(),
            ]
        );
    }

    public function deleteAction()
    {
        $blogId = (int)$this->params()->fromRoute('id');
        $blog   = $this->blogService->getBlogById($blogId);

        if (!$blog) {
            return $this->redirect()->toRoute('blog');
        }

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $this->blogService->delete($blog);
            }

            return $this->redirect()->toRoute('blog');
        }

        return [
            'id'    => $blogId,
            'blog' => $blog,
        ];
    }
}
