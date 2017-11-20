<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 20/11/2017
 * Time: 21:41
 */

namespace MediaBox\Form;


use Zend\Form\Form;

class VideoForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('Video');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
                ],
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Video Title',
            ],
        ]);

        $this->add([
            'name' => 'url',
            'type' => 'text',
            'options' => [
                'label' => 'Url',
            ],
        ]);

        $this->add([
            'name' => 'format',
            'type' => 'text',
            'options' => [
                'label' => 'Source',
            ],
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'options' => [
                'label' => 'Video Description',
            ],
        ]);
    }
}