<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

class RemoveComposerPackages
{
    /**
     * @var mixed
     */
    public $packages;

    /**
     * @param $packages
     */
    public function __construct($packages)
    {
        $this->packages = $packages;
    }

    public function __invoke()
    {
        $path_to_file = base_path('composer.json');

        $block_of_lines = file_get_contents($path_to_file);

        $rm_packages = $this->packages;

        $rm_packages_match = '(?:'.join('|', array_map(function ($word) {
            return preg_quote($word, '/');
        }, $rm_packages)).')';

        $replace_match = '/^.*'.$rm_packages_match.'.*$(?:\r\n|\n)?/m';

        $result = preg_replace($replace_match, '', $block_of_lines);

        file_put_contents($path_to_file, $result);

    }
}
