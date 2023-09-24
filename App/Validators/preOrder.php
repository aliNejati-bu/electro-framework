<?php

return [

    'phone' => ['required', \Electro\Classes\Validator\Rules::unique(\Electro\App\Model\User::class, 'phone')],
    'name' => 'required|max:25',
    'amount' => 'required',
    'color' => 'required|in:white,gray,black',
    'description' => 'nullable',
];