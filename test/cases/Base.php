<?php

/**
 * Base class for Conifer test cases
 *
 * @copyright 2018 SiteCrafting, Inc.
 * @author    Coby Tamayo <ctamayo@sitecrafting.com>
 */

namespace ConiferTest;

use PHPUnit\Framework\TestCase;

use WP_Mock;

/**
 * Base test class for the plugin. Declared abstract so that PHPUnit doesn't
 * complain about a lack of tests defined here.
 */
abstract class Base extends TestCase {
  public function setUp() {
    WP_Mock::setUp();
  }

  public function tearDown() {
    WP_Mock::tearDown();
  }


  /**
   * Mock a call to WordPress's get_post
   * @param array $props an array of WP_Post object properties
   * must include a valid (that is, a numeric) post ID
   */
  protected function mockPost(array $props, array $options = []) {
    if (empty($props['ID']) || !is_numeric($props['ID'])) {
      throw new \InvalidArgumentException('$props["ID"] must be numeric');
    }

    $post = new \stdClass();

    foreach ($props as $prop => $value) {
      $post->{$prop} = $value;
    }

    $options = array_merge(
      ['times' => 1, 'args' => [$props['ID']]],
      $options
    );

    WP_Mock::userFunction('get_post', [
      'times'   => 1,
      'args'    => 123,
      'return'  => $post,
    ]);

    return $post;
  }

  protected function getProtectedProperty($object, $name) {
    $reflection = new \ReflectionClass($object);
    $property = $reflection->getProperty($name);
    $property->setAccessible(true);

    return $property->getValue($object);
  }

  protected function callProtectedMethod($object, $name, $args = []) {
    $reflection = new \ReflectionClass($object);
    $method = $reflection->getMethod($name);
    $method->setAccessible(true);

    return $method->invokeArgs($object, $args);
  }
}

?>