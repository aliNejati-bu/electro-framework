<?php

return [

    'phone' => 'required',
    'name' => 'required|max:25',
    'amount' => 'required',
    'color' => 'required|in:white,gray,black',
    'description' => 'nullable',
];