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
                        $data[$field] = trim(preg_replace('/\s+/', '', $value));
                    break;
                    case 'StripTags':
                        $data[$field] = strip_tags($value);
                    break;
                    case 'Escape':
                        $data[$field] = htmlentities($value, ENT_COMPAT);
                    break;
                    case 'SpecialChar':
                        $data[$field] = htmlspecialchars($value);
                    break;
                }
            }
        }
    }
    return $data;
}
