<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );


}
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Association',
		'id' => 'asso',
		'description' => 'pour associer les contenus',
        'before_widget' => '<div id="header">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    
}

/* Autoriser l'upload de format zip dans les médias */

// GESTION DES FORMATS DE FICHIERS DE LA MÉDIATHÈQUE
 
// Appel de Extend_Upload_Mimes sur le tableau des mimes
// supportés :
add_filter('upload_mimes', 'Extend_Upload_Mimes');
 
/* 
 * Fonction Extend_Upload_Mimes :
 * Prend en argument le tableau associatif des types mimes
 * supportés le modifie et le retourne modifié.
 */
function Extend_Upload_Mimes ( $CurrentMimes=array() ) {
//	Ajout de nouveaux types :
		$CurrentMimes['zip'] = 'application/zip';
 
//	Suppression de types non souhaités :
	unset( $CurrentMimes['exe'] );
 
	return $CurrentMimes;
}