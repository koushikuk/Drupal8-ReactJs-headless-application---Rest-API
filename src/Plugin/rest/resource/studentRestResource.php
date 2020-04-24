<?php
namespace Drupal\studentapi\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Connection;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;



/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "student_api",
 *   label = @Translation("Custom rest resource"),
 *   uri_paths = {
 *     "canonical" = "/api/student_add",
 *     "https://www.drupal.org/link-relations/create" = "/api/student_add"
 *   }
 * )
 */

class studentRestResource extends ResourceBase {
    /**
     * A current user instance.
     *
     * @var \Drupal\Core\Session\AccountProxyInterface
     */
    protected $currentUser;
    protected  $connection;

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
            $container->get('logger.factory')->get('ccms_rest'),
            $container->get('current_user')
        );
    }

    /**
     * Responds to POST requests.
     *
     * Returns a list of bundles for specified entity.
     * @param $data
     * @return \Drupal\rest\ResourceResponse Throws exception expected.
     * Throws exception expected.
     */
    public function post(array $data) {
       // Now insert data in database
       //  print_r($data);

        $database = \Drupal::service('database');
       foreach ($data as $row){
            //print_r($row);
           $result = $database->insert('studentapi')
               ->fields(['std_first_name',
                   'std_last_name',
                   'std_mail',
                    'program',
                    'active',
                   'created'])
               ->values([
                 'std_first_name' => $row['std_first_name'],
                 'std_last_name' => $row['std_last_name'],
                 'std_mail'  => $row['std_mail'],
                 'program' => $row['program'],
                 'active' => $row['active'],
                 'created' => \Drupal::time()->getRequestTime()
              ])
               ->execute();
           $response = [
               'message' => $this->t('Student data added successfully')
           ];
       }

      return new ResourceResponse($response);

    }

}