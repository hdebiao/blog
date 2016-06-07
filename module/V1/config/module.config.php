<?php

namespace V1;

return array(
    'router' => array(
        'routes' => array(
            'v1' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/v1',
                    'defaults' => array(
                        '__NAMESPACE__' => 'V1\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
