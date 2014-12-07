<?php

require('dataClass.php');

if (isset($_GET['c'])) {
    $country = $_GET['c'];
} else {
    return FALSE;
}

$data_handler = new Data();
$data_container = $data_handler->getCountryData($country);

foreach ($data_container as $theme_name => $theme_properties) {
    echo "<pre>";
    var_dump ($theme_properties->column_names);
    echo "</pre>";
    foreach ($theme_properties->column_names as $column_titles_key => $column_titles_value) {
        if ($column_titles_value === 'Value') {
            $theme_value_key = $column_titles_key;
        }
        if ($column_titles_value === 'Date') {
            $theme_date_key = $column_titles_key;
        }
    }
    foreach ($theme_properties->data as $data_property) {
        $date_value = strtotime($data_property[$theme_date_key]);
        $year_value = date('Y', $date_value);
        if ($data_property[$theme_value_key] === 0) {
            $country_data[$theme_name][$year_value] = FALSE;
        } else {
            $country_data[$theme_name][$year_value] = $data_property[$theme_value_key];
        }
    }
}

var_dump($country_data);

?>
