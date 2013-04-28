<?php

function autoloader ( $className ) {
    $file = $className . CLASS_EXTENSION;
    if ( file_exists ( $file ) ) {
        require_once ( $file );
    }
}

spl_autoload_register ( 'autoloader' );

?>