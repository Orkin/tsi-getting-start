<?php
/**
 * User: orkin
 * Date: 13/02/2017
 * Time: 17:00
 */
declare(strict_types = 1);


namespace Album\Controller;


use Album\Form\AlbumForm;
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{
    /**
     * @var AlbumTable
     */
    private $table;

    /**
     * @var AlbumForm
     */
    private $albumForm;

    /**
     * AlbumController constructor.
     *
     * @param AlbumTable $table
     * @param AlbumForm  $albumForm
     */
    public function __construct(AlbumTable $table, AlbumForm $albumForm)
    {
        $this->table     = $table;
        $this->albumForm = $albumForm;
    }

    public function indexAction()
    {
        return new ViewModel(
            [
                'albums' => $this->table->fetchAll(),
            ]
        );
    }

    public function addAction()
    {
        $this->albumForm->get('submit')->setValue('Add');

        /** @var Request $request */
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $this->albumForm];
        }

        $album = new Album();
        $this->albumForm->setData($request->getPost());

        if (!$this->albumForm->isValid()) {
            return ['form' => $this->albumForm];
        }

        $album->exchangeArray($this->albumForm->getData());
        $this->table->saveAlbum($album);

        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $this->albumForm->bind($album);
        $this->albumForm->get('submit')->setAttribute('value', 'Edit');

        /** @var Request $request */
        $request  = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $this->albumForm];

        if (!$request->isPost()) {
            return $viewData;
        }

        $this->albumForm->setData($request->getPost());

        if (!$this->albumForm->isValid()) {
            return $viewData;
        }

        $this->table->saveAlbum($album);

        // Redirect to album list
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('album');
        }

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int)$request->getPost('id');
                $this->table->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return [
            'id'    => $id,
            'album' => $this->table->getAlbum($id),
        ];
    }
}
