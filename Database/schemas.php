<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('users', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string('phone')->unique();
    $blueprint->string('name');
    $blueprint->string('password');
    $blueprint->integer('user_type')->default(0);
    $blueprint->string('picture')->default('/uploads/pic.webp');
    $blueprint->string('postal_data')->nullable();
    $blueprint->text('description')->nullable();
    $blueprint->string('postal_code')->nullable();
    $blueprint->string('city')->nullable();
    $blueprint->text('address')->nullable();
    $blueprint->string('province')->nullable();
    $blueprint->timestamps();
});


Capsule::schema()->create('phone_codes', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("code");
    $blueprint->dateTime("expire_at");
    $blueprint->boolean("is_usesd");
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->boolean("is_available")->default(true);
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});

Capsule::schema()->create('email_links', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("slug")->unique();
    $blueprint->dateTime('expire_at');
    $blueprint->boolean('is_used');
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});


Capsule::schema()->create("user_session_activities", function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->text("token");
    $blueprint->timestamps();

    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});
