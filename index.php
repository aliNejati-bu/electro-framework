<?php


set_error_handler(function ($e)
{
    echo "no";

});
set_exception_handler(function ($e)
{
    return "yes";

});


$a = 10 /0;