<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 15:54
 */
declare(strict_types = 1);


namespace Legal\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/* @method \Zend\View\Model\ModelInterface acceptableViewModelSelector(array $matchAgainst = null, bool $returnDefault = true, \Zend\Http\Header\Accept\FieldValuePart\AbstractFieldValuePart $resultReference = null)
 * @method \Zend\Mvc\Controller\Plugin\Forward forward()
 * @method \Zend\Mvc\Controller\Plugin\Layout|\Zend\View\Model\ModelInterface layout(string $template = null)
 * @method \Zend\Mvc\Controller\Plugin\Params|mixed params(string $param = null, mixed $default = null)
 * @method \Zend\Mvc\Controller\Plugin\Redirect redirect()
 * @method \Zend\Mvc\Controller\Plugin\Url url()
 * @method \Zend\View\Model\ViewModel createHttpNotFoundModel(Response $response)
 */
class LegalController extends AbstractActionController
{

    public function legalAction()
    {
        $lang = $this->params()->fromRoute('lang');
        
        return new ViewModel();
    }

    public function cguAction()
    {
        $lang = $this->params()->fromRoute('lang');

        return new ViewModel();
    }

}
