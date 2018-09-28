<?php

use Conifer\Post\Post;
use Conifer\Site;

$site = new Site();
$site->configure(function () {
  register_post_type('thing');

  Post::configure_advanced_search([
    [
      'post_type' => ['post', 'page'],
      'meta_fields' => [
        'hello',
        ['key' => '%bye', 'key_compare' => 'LIKE'],
      ],
    ],
    [
      'post_type' => ['thing'],
      'meta_fields' => ['meh', 'meep'],
    ],
  ]);
});
