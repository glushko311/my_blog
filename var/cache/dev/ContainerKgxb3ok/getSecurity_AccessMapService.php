<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.access_map' shared service.

$this->services['security.access_map'] = $instance = new \Symfony\Component\Security\Http\AccessMap();

$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/login'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/register'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/cat/new', NULL, array(0 => 'GET', 1 => 'POST')), array(0 => 'ROLE_ADMIN'), NULL);
$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/cat/delete/(.+)', NULL, array(0 => 'GET')), array(0 => 'ROLE_ADMIN'), NULL);
$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/articles/edit/', NULL, array(0 => 'GET', 1 => 'POST')), array(0 => 'ROLE_USER'), NULL);
$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/article/new', NULL, array(0 => 'GET', 1 => 'POST')), array(0 => 'ROLE_ADMIN'), NULL);
$instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/article/delete/(.+)', NULL, array(0 => 'GET')), array(0 => 'ROLE_ADMIN'), NULL);

return $instance;
