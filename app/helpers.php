<?php 

function test() {
    echo 'durair';
}

function setting($type,$field_key) {
    $info = \DB::table('site_config')->where('type', $type)->where('field_key', $field_key)->first();
    return $info->field_value ?? '';
}