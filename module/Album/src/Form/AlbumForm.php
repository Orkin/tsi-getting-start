<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:08
 */
declare(strict_types = 1);


namespace Album\Form;


use Album\Model\Album;
use Zend\Filter\StringToUpper;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class AlbumForm extends Form implements InputFilterProviderInterface
{

    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album');
    }

    public function init()
    {
        $this->add(
            [
                'name' => 'id',
                'type' => Element\Hidden::class,
            ]
        );
        $this->add(
            [
                'name'    => 'title',
                'type'    => Element\Text::class,
                'options' => [
                    'label' => 'Title',
                ],
            ]
        );
        $this->add(
            [
                'name'    => 'artist',
                'type'    => Element\Text::class,
                'options' => [
                    'label' => 'Artist',
                ],
            ]
        );
        $this->add(
            [
                'name'       => 'submit',
                'type'       => Element\Submit::class,
                'attributes' => [
                    'value' => 'Go',
                    'id'    => 'submitbutton',
                ],
            ]
        );
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'id' => [
                'required' => true,
                'filters'  => [
                    [
                        'name' => ToInt::class,
                    ],
                ],
            ],

            'artist' => [
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                    ['name' => StringToUpper::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],

            'title' => [
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
        ];
    }
}
