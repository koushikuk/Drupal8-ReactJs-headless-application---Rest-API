<?php
namespace Drupal\studentapi\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;



/**
* Provides a resource to get view modes by entity and bundle.
*
* @RestResource(
*   id = "student_api",
*   label = @Translation("Student rest resource"),
*   serialization_class = "Drupal\node\Entity\Node",
*   uri_paths = {
*     "canonical" = "/student-api",
*     "https://www.drupal.org/link-relations/create" = "/student-api"
*   }
* )
*/


class StudentRestResource extends ResourceBase{

/**
* A current user instance.
*
* @var \Drupal\Core\Session\AccountProxyInterface
*/

/**
* Constructs a Drupal\rest\Plugin\ResourceBase object.
*
* @param array $configuration
*   A configuration array containing information about the plugin instance.
* @param string $plugin_id
*   The plugin_id for the plugin instance.
* @param mixed $plugin_definition
*   The plugin implementation definition.
* @param array $serializer_formats
*   The available serialization formats.
* @param \Psr\Log\LoggerInterface $logger
*   A logger instance.
* @param \Drupal\Core\Session\AccountProxyInterface $current_user
*   A current user instance.
*/
public function __construct(
array $configuration,
$plugin_id,
$plugin_definition,
array $serializer_formats,
LoggerInterface $logger,
AccountProxyInterface $current_user) {
parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
$this->currentUser = $current_user;
}

/**
* {@inheritdoc}
*/

public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
return new static(
$configuration,
$plugin_id,
$plugin_definition,
$container->getParameter('serializer.formats'),
$container->get('logger.factory')->get('exp_fs'),
$container->get('current_user')
);
}

/**
* Responds to POST requests.
*
* @param \Drupal\Core\Entity\EntityInterface $entity
*   The entity object.
*
* @return \Drupal\rest\ModifiedResourceResponse
*   The HTTP response object.
*
* @throws \Symfony\Component\HttpKernel\Exception\HttpException
*   Throws exception expected.
*/
public function post($data) {
print_r($data);
die("this is a test");
// You must to implement the logic of your REST Resource here.
// Use current user after pass authentication to validate access.

return new ResourceResponse("test data");
}
}