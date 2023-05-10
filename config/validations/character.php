<?php
return [
    "registration" => [
        "name" => "required|max:50",
        "content" => "required|max:1000",
        "height" => "numeric|nullable",
        "weight" => "numeric|nullable",
        "number" => "numeric|nullable",
        "tribe_id" => "required|numeric",
        "season_id" => "required|numeric",
        "attack" => "required|numeric|max:10",
        "defense" => "required|numeric|max:10",
        "ability" => "required|numeric|max:10",
        "popularity" => "required|numeric|max:10",
    ],
    "update" => [
        "id" => "required|numeric",
        "name" => "required|max:50",
        "content" => "required|max:1000",
        "height" => "numeric|nullable",
        "weight" => "numeric|nullable",
        "number" => "numeric|nullable",
        "tribe_id" => "required|numeric",
        "season_id" => "required|numeric",
        "attack" => "required|numeric|max:10",
        "defense" => "required|numeric|max:10",
        "ability" => "required|numeric|max:10",
        "popularity" => "required|numeric|max:10",
    ]
];
