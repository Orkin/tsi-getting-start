<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 15:49
 */
declare(strict_types = 1);


namespace Blog\Form\Fieldset;

use Album\Model\Album;
use Blog\Model\Blog;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Filter\StringToUpper;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Element;
use Zend\Validator\StringLength;

class BlogFieldset extends Fieldset implements InputFilterProviderInterface
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
             ->setObject(new Blog());

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
                'name'    => 'text',
                'type'    => Element\Textarea::class,
                'options' => [
                    'label' => 'Artist',
                ],
            ]
        );

        $this->add(
            [
                'name'    => 'album',
                'type'    => ObjectSelect::class,
                'options' => [
                    'label'              => 'Album',
                    'object_manager'     => $this->objectManager,
                    'target_class'       => Album::class,
                    'is_method'          => true,
                    'find_method'        => [
                        'name' => 'getAllAlbums',
                    ],
                    'property'           => 'title',
                    'display_empty_item' => true,
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

            'title' => [
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

            'text' => [
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
                        ],
                    ],
                ],
            ],

            'album' => [
                'required' => false,
            ],
        ];
    }
}

