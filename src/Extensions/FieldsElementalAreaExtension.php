<?php

namespace Fromholdio\ElementalMultiArea\Extensions;

use DNADesign\Elemental\Forms\ElementalAreaField;
use Fromholdio\HasOneEdit\HasOneEdit;
use SilverStripe\Core\Extension;

class FieldsElementalAreaExtension extends Extension
{
    public function provideElementalAreaFields($relationName, $types)
    {
        if ($this->getOwner()->hasMethod('getElementalCMSFields')) {
            $fields = $this->getOwner()->getElementalCMSFields($relationName, $types);
        } else {
            $fields = $this->getOwner()->getCMSFields();

            $editorField = ElementalAreaField::create(
                $relationName,
                $this->getOwner(),
                $types
            );
            $replaced = $fields->replaceField('Elements', $editorField);
            if (!$replaced) {
                $fields->push($editorField);
            }
        }

        foreach ($fields->dataFields() as $name => $field) {
            if ($name !=='Elements' && $name !== $relationName) {
                $field = $fields->dataFieldByName($name);
                $field->setName($relationName . HasOneEdit::FIELD_SEPARATOR . $field->getName());
            }
        }

        $this->getOwner()->invokeWithExtensions('updateProvideElementalAreaFields', $fields, $relationName, $types);

        return $fields;
    }
}
