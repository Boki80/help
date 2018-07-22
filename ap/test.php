<?php

$date = date_create(date('Y-m-d'));
date_add($date,date_interval_create_from_date_string("5 days"));
echo date_format($date, 'Y-m-d');

?>