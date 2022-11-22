<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER' => true,
        '@Symfony' => true,
        '@PHP81Migration' => true,
        '@DoctrineAnnotation' => true,
    ])
    ->setFinder($finder)
;
