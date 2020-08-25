<?php

namespace Capitalc\Checkbox;

use Laravel\Nova\Fields\Field;

class Checkbox extends Field
{
    // public $component = 'boolean-field';
    public $component = 'checkbox';

    public $trueValue = true;
    public $falseValue = false;
    public $textAlign = 'center';

    protected function resolveAttribute($resource, $attribute)
    {
        return parent::resolveAttribute($resource, $attribute) == $this->trueValue ? true : false;
    }

    protected function fillAttributeFromRequest(\Laravel\Nova\Http\Requests\NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (isset($request[$requestAttribute])) {
            $model->{$attribute} = $request[$requestAttribute] == 1
                    ? $this->trueValue : $this->falseValue;
        }
    }

    public function values($trueValue, $falseValue)
    {
        return $this->trueValue($trueValue)->falseValue($falseValue);
    }

    public function trueValue($value)
    {
        $this->trueValue = $value;

        return $this;
    }

    public function falseValue($value)
    {
        $this->falseValue = $value;

        return $this;
    }
}
