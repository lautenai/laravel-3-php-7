<?php
 
class Acl {
 
    public static function is($role) {
        ! Auth::user()->is($role) ? die(View::make('error.401')->with('route', strtoupper($role))) : true;
    }

    public static function can($route) {
        ! Auth::user()->can($route) ? die(View::make('error.401')->with('route', strtoupper($route))) : true;
    }
}