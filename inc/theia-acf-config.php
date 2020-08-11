<?php
if( function_exists('acf_add_local_field_group') ):

// Taxonomies options
acf_add_local_field_group(array(
	'key' => 'group_5dbaa7f4d6dac',
	'title' => 'Taxonomies options',
	'fields' => array(
		array(
			'key' => 'field_5dbaa803dd45e',
			'label' => 'Layout',
			'name' => 'tax_layout',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'grid' => 'Grid',
				'list' => 'list (default)',
				'list-full' => 'list full content post',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => 'list',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
		array(
			'key' => 'field_5dbac87496cc5',
			'label' => 'Image',
			'name' => 'tax_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

//Block : Post list with layout
acf_add_local_field_group(array(
	'key' => 'group_5dd2c81d8ff6f',
	'title' => 'Block : Post list with layout',
	'fields' => array(
		array(
			'key' => 'field_5dd2c8332dce6',
			'label' => 'Title',
			'name' => 'sedoo-block-post-list-title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dd2cab92dce7',
			'label' => 'Categories',
			'name' => 'sedoo-block-post-list-categories',
			'type' => 'taxonomy',
			'instructions' => '<strong>If empty, all categories are selected !</strong>',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'category',
			'field_type' => 'radio',
			'allow_null' => 1,
			'add_term' => 0,
			'save_terms' => 0,
			'load_terms' => 0,
			'return_format' => 'object',
			'multiple' => 0,
		),
		array(
			'key' => 'field_5dd2cdab2dce8',
			'label' => 'Layout',
			'name' => 'sedoo-block-post-list-layout',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'list' => 'List',
				'grid' => 'Grid',
				'grid-noimage' => 'Grid without image',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => 'list',
			'layout' => 'horizontal',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
		array(
			'key' => 'field_5dd2ce1a2dce9',
			'label' => 'Limit',
			'name' => 'sedoo-block-post-list-limit',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 9,
			'step' => '',
		),
		array(
			'key' => 'field_5dd2ce5e2dcea',
			'label' => 'Offset',
			'name' => 'sedoo-block-post-list-offset',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 9,
			'step' => '',
		),
		array(
			'key' => 'field_5ddfed8767c61',
			'label' => '"More articles" button label',
			'name' => 'sedoo-block-post-list-showmore-button-label',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dd6a71dc219d',
			'label' => 'Show "More articles" button',
			'name' => 'sedoo-block-post-list-showmore-button',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/postlist',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

//Meta homepage
acf_add_local_field_group(array(
	'key' => 'group_5ddee2d993490',
	'title' => 'Meta homepage',
	'fields' => array(
		array(
			'key' => 'field_5ddee2d999e57',
			'label' => 'Description',
			'name' => 'dataterra_home_description',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5ddee2d999e64',
			'label' => 'bouton 1',
			'name' => 'dataterra_home_link1',
			'type' => 'link',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
		),
		array(
			'key' => 'field_5ddee33920eb4',
			'label' => 'bouton 2',
			'name' => 'dataterra_home_link2',
			'type' => 'link',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'homepage.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

// Meta poles
acf_add_local_field_group(array(
	'key' => 'group_5ddedea8135a9',
	'title' => 'Meta poles',
	'fields' => array(
		array(
			'key' => 'field_5ddedeb3e59a9',
			'label' => 'Sous titre',
			'name' => 'dataterra_pole_subtitle',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5ddededbe59aa',
			'label' => 'Lien vers le site',
			'name' => 'dataterra_pole_link',
			'type' => 'link',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
		),
		array(
			'key' => 'field_5ddedf02e59ab',
			'label' => 'Logo',
			'name' => 'dataterra_pole_logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-pole.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

//Custom block Related Content
acf_add_local_field_group(array(
	'key' => 'group_5d80ab6e372f7',
	'title' => 'Custom block Related Content',
	'fields' => array(
		array(
			'key' => 'field_5d80ab6e4602c',
			'label' => 'Titre de la zone',
			'name' => 'relatedContentTitle',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5d80ab6e46017',
			'label' => 'Type de contenu',
			'name' => 'relatedContentTypeOfContent',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'ces' => 'CES',
				'products' => 'Products',
				'art'	=>	'ART',
			),
			'default_value' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_5d80ab6e46031',
			'label' => 'Taxonomie',
			'name' => 'relatedContentTaxonomies',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'event-categories' => 'Catégories',
				'theme' => 'Thématiques',
				'cestag' => 'CES Tags',
				'typeproduct' => 'Types of products',
				'arttag'	=> 'ART Tags',
			),
			'default_value' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_5d80ab6e46036',
			'label' => 'Nombre de posts',
			'name' => 'post_number',
			'type' => 'range',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'min' => '',
			'max' => 12,
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_5d80ab6e4603c',
			'label' => 'Offset',
			'name' => 'post_offset',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5dd2cdab2dce9',
			'label' => 'Layout',
			'name' => 'post_list_layout',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'list' => 'List',
				'grid' => 'Grid',
				'grid-noimage' => 'Grid without image',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => 'list',
			'layout' => 'horizontal',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/theia-relatedblock',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
?>