<?php

return array(
    'library'     => 'gd',
    'upload_dir'  => 'uploads',
    'upload_path' => public_path() . '/uploads/',
    'quality'     => 100,
    'bodysize'    => '550x500',
    'featuredsize'    => '200x150',
    'dimensions' => array(
        'thumb'  => array(100, 100, true, 100),
        'thumb1'  => array(170, 100, true, 100),
        'thumb2'  => array(228, 182, true, 100),
        'thumb3'  => array(270, 190, true, 100),
        'thumb4'  => array(370, 245, true, 100),
        'thumb5'  => array(370, 252, true, 100),
        'thumb6'  => array(368, 239, true, 100),
        'thumb7'  => array(550, 500, false, 100),
        'thumb8'  => array(770, 436, true, 100, true),
        'thumb9'  => array(200, 150, false, 100),
    ),
    'avatar_dimensions' => array(
        'thumb'  => array(100, 100, true, 100),
    ),
);