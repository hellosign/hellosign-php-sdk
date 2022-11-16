<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['bin', 'docs', 'examples', 'templates', 'legacy']);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@Symfony'                     => true,
    'concat_space'                 => ['spacing' => 'one'],
    'global_namespace_import'      => true,
    'fully_qualified_strict_types' => true,
    'increment_style'              => false,
    'phpdoc_align'                 => ['align' => 'left'],
    'phpdoc_separation'            => false,
    'phpdoc_summary'               => false,
    'phpdoc_to_param_type'         => true,
    'single_line_throw'            => false,
    'yoda_style'                   => false,
])
    ->setFinder($finder)
    ->setRiskyAllowed(true);
