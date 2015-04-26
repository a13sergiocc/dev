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
                        $data[$field] = trim($data[$field]);
                    break;
                    case 'StripTags':
                        $data[$field] = strip_tags($data[$field]);
                    break;
                    case 'Escape':
                        $data[$field] = htmlentities($data[$field], ENT_COMPAT);
                    break;
                    case 'SpecialChar':
                        $data[$field] = htmlspecialchars($data[$field]);
                    break;
                }
            }
        }
    }
    return $data;
}
