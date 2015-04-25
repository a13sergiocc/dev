<?php

/**
 * Return html form by definition
 *
 * @param array $formDefinition
 * @param array $data
 * @param string $action
 * @param string $method
 * @return string
 *
 */

function renderForm($formDefinition, $action, $method='post', $data = array())
{
	if(!$data) {
		foreach ($formDefinition as $key => $value) {
			$data[$key] = "";
		}
	}

	$html = "<form method=\"".$method."\" class=\"col-xs-6\" action=\"".$action."\">"."\n";

    foreach ($formDefinition as $key => $value) {

		$html .= "<div class=\"form-group\">";

		if(array_key_exists('label', $value)) {
			$html .= "<label>".$value['label']."</label>";
		}

		switch($value['type'])
		{
			case 'hidden':
    	        $html .= "<input type=\"hidden\" class=\"form-control\" name=\"".$key."\" value=\"".$data[$key]."\">"."\n";
	        break;

    		case 'text':
    			$html .= "<input type=\"text\" class=\"form-control\" name=\"".$key."\" value=\"".$data[$key]."\" >"."\n";
    	    break;

    		case 'password':
        		$html .= "<input type='password' class=\"form-control\" name=\"".$key."\" value=\"".$data[$key]."\" />"."\n";
    		break;

			case 'textarea':
    			$html .= "<textarea class=\"form-control\" name=\"".$key."\" >".$data[$key]."</textarea>"."\n";
    		break;

			case 'email':
    			$html .= "<input type=\"email\" class=\"form-control\" name=\"".$key."\" value=\"".$data[$key]."\" />"."\n";
    		break;

            case 'date':
    			$html .= "<input type=\"date\" class=\"form-control\" name=\"".$key."\" value=\"".$data[$key]."\" />"."\n";
			break;

    	    case 'radio':
				foreach($value['options'] as $radio => $radioValue) {
					$html .= "<br/><input type=\"radio\" name=\"".$key."\" value=\"".$radioValue."\"";
					$html .= ($radioValue == $data[$key]) ? "checked />" : ">";
					$html .= " ".$radio."\n";
				}
	        break;

    		case 'checkbox':
				foreach($value['options'] as $checkbox => $checkboxValue) {
					$html .= "<br/><input type=\"checkbox\" name=\"".$key."\" value=\"".$checkboxValue."\"";
					$html .= ($checkboxValue == $data[$key]) ? "checked />" : ">";
					$html .= " ".$checkbox."\n";
				}
		    break;

    		case 'select':
    			$html .= "<select name=\"".$key."\" class=\"form-control\"><br />";

				foreach($value['options'] as $option => $optionValue) {
					$html .= "<option value=\"".$optionValue."\"";
					$html .= ($optionValue == $data[$key]) ? "selected=\"selected\">" : ">";
					$html .= $option;
					$html .= "</option><br/>"."\n";
				}

				$html .= "</select>";
    		break;

			case 'selectmultiple':
			 	$html .="<br/><select multiple class=\"form-control\" name=\"".$key."[]"."\"><br />";

				foreach($value['options'] as $option => $value) {
					$html .= "<option value=\"".$value."\">";
					$html .= $option."</option><br />"."\n";
				}

    			$html.="</select>";
    		break;

    		case 'submit':
    			$html .= "<br/><input type=\"submit\" name=\"".$key."\"/>"."\n";
 		 	break;
    	}

		$html .= "</div>";
    }

    $html .= "</form>";

	return $html;
}
