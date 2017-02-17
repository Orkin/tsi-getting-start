<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:08
 */
declare(strict_types = 1);


namespace Blog\Form;


use Blog\Form\Fieldset\BlogFieldset;
use Zend\Form\Element;
use Zend\Form\Form;

class AddBlogForm extends Form
{

    public function init()
    {
        $this->add(
            [
                'name'    => 'blog',
                'type'    => BlogFieldset::class,
                'options' => [
                    'use_as_base_fieldset' => true,
                ],
            ]
        );

        $this->setValidationGroup(
            [
                'blog' => [
                    'id',
                    'title',
                    'text',
                    'album',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'submit',
                'type'       => Element\Submit::class,
                'attributes' => [
                    'value' => 'Add',
                    'id'    => 'submitbutton',
                ],
            ]
        );
    }
}
