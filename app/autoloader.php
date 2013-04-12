<?php

function autoloader ( $className ) {
    $file = $className . CLASS_EXTENSION;
    if ( file_exists ( $file ) ) {
        require_once ( $file );
    }
}

spl_autoload_register ( 'autoloader' );
// spl_autoload_register ( 'autoloader2' );

function autoloader2 ( $className ) {
    $paths = [
       dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers',
       dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'models',
       dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'tools',
       dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'exceptions'
    ];
    
    foreach ( $paths as $path ) {
        @require_once ( $path . DIRECTORY_SEPARATOR . $className . CLASS_EXTENSION );
    }
}

?>