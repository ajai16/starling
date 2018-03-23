<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter {
    
    public function __construct() {
        $this->add(array(
            'name' => 'firstName',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'not_empty',
                ),
                array(
                    'name' => 'string_length',
                    'options' => array(
                        'min' => 1
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name'       => 'lastName',
            'required'   => false,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            
        ));
        
        $this->add(array(
            'name'       => 'email',
            'required'   => false,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
        
        $this->add(array(
            'name'       => 'password',
            'required'   => false,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            
        ));
        $this->add(array(
            'name'       => 'confirmPassword',
            'required'   => false,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
    }
    
    
}
