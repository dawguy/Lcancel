<?php

// app/http/filters.php

Route::filter('birthday', function(){
    if(date('d/m') == '3/19'){
        return View:make('birthday');
    }
});
