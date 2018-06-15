<?php

    // vars
    $this->name = 'photo_gallery';
    $this->label = __('Photo Gallery');
    $this->category = __("Content",'acf'); // Basic, Content, Choice, etc
    $this->defaults = array(
        // add default here to merge into your field.
        // This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
        'edit_modal' => 'Default',
        //'preview_size' => 'thumbnail'
    );


    // do not delete!
    parent::__construct();

    
    // Enable the option show in rest
    add_filter( 'acf/rest_api/field_settings/show_in_rest', '__return_true' );


    // settings
    $this->settings = $settings;
