<?php
/**
 * Created by PhpStorm.
 * Author: Misha Serenkov
 * Email: mi.serenkov@gmail.com
 * Date: 23.05.2022 21:09
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PER-CS2.0' => true,
    '@PER-CS2.0:risky' => true,
    'function_declaration' => [
        'closure_fn_spacing' => 'one',
    ],
];


$finder = Finder::create()
    ->in([
        'src',
        'examples',
        'tests'
    ])
    ->name('*.php')
    ->notName('**/*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
