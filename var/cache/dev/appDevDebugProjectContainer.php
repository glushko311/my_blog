<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKgxb3ok\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKgxb3ok/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerKgxb3ok.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerKgxb3ok\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerKgxb3ok\appDevDebugProjectContainer(array(
    'container.build_hash' => 'Kgxb3ok',
    'container.build_id' => '3c7b83ad',
    'container.build_time' => 1522772636,
));
