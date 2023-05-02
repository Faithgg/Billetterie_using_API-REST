<?php
    function session_start_prim () {
        ini_set('session.use_cookies',  true);
        ini_set('session.use_only_cookies', true);
        ini_set('session.cookie_lifetime', 10*60); // Valable Pour 10 min puisqu'une minute est 60 secondes
        session_start();
    }
