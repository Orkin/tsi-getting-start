<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 15:49
 */
declare(strict_types = 1);


namespace Album\Form\Fieldset;

use Album\Model\Album;
use Doctrine\ORM\EntityManager;
use Zend\Filter\StringToUpper;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Element;
use Zend\Validator\StringLength;

class AlbumFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     * @var EntityManager
     */
    private $objectManager;

    /**
     * ClientFieldset constructor.
     *
     * @param EntityManager $objectManager
     */
    public function __construct(EntityManager $objectManager)
    {
        $this->objectManager = $objectManager;
        parent::__construct();
    }

    public function init()
    {
        $this->setHydrator(new DoctrineObject($this->objectManager))
             ->setObject(new Album());

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

