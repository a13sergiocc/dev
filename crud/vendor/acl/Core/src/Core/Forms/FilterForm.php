<?php
/**
 * Return filter data by form definition
 * Available filters: escape, StringTrim, StripTags, SpecialChar
 *
 * @param array $formDefinition
 * @param array $data
 * @return array $data
 */

function FilterForm($formDefinition, $data)
{
    foreach ($data as $field => $value)
    {
        if (array_key_exists("filters", $formDefinition[$field]))
        {
            foreach($formDefinition[$field]['filters'] as $filter)
            {
                switch ($filter)
                {
                    case 'Stringtrim':
                        $data[$field] = preg_replace('/\s+/', '', trim($value));
                    break;
                    case 'StripTags':
                        $data[$field] = strip_tags($value);
                    break;
                    case 'Escape':
                        $data[$field] = htmlspecialchars($value, ENT_QUOTES);
                    break;
                }
            }
        }
    }
    return $data;
}
