<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:08
 */
declare(strict_types = 1);


namespace Album\Form;


use Album\Form\Fieldset\AlbumFieldset;
use Zend\Form\Element;
use Zend\Form\Form;

class AddAlbumForm extends Form
{

    public function init()
    {
        $this->add(
            [
                'name'    => 'album',
                'type'    => AlbumFieldset::class,
                'options' => [
                    'use_as_base_fieldset' => true,
                ],
            ]
        );

        $this->setValidationGroup(
            [
                'album' => [
                    'id',
                    'artist',
                    'title',
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
