<?php

/**
 */
class DropdownListSelected extends CValidator {

    protected function validateAttribute($object, $attribute) {
        if ($object->$attribute == 99) {
            $this->addError($object, $attribute, 'You need to select ' . $object->getAttributeLabel($attribute));
        }
    }

}
