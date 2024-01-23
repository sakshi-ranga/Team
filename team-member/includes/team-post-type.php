<?php
// Register Custom Post Type 'Team'
function create_team_post_type() {
    $labels = array(
        'name'               => 'Team',
        'singular_name'      => 'Team',
        'menu_name'          => 'Team',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Team Member',
        'edit_item'          => 'Edit Team Member',
        'new_item'           => 'New Team Member',
        'view_item'          => 'View Team Member',
        'search_items'       => 'Search Team Members',
        'not_found'          => 'No team members found',
        'not_found_in_trash' => 'No team members found in trash',
        'parent_item_colon'  => 'Parent Team Member:',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'team'),
        'capability_type'     => 'post',
        'menu_icon'           => 'dashicons-groups', // You can change the icon
        'supports'            => array('title', 'thumbnail'),
    );

    register_post_type('team', $args);
}
add_action('init', 'create_team_post_type');