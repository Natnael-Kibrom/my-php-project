<?php
function validate_input_text($textValue)
{
    if (!empty($textValue)) {
        //removing any space characters
        $trim_text = trim($textValue);
        $trim_text = stripslashes($trim_text);
        $trim_text = htmlspecialchars($trim_text);
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
};
?>