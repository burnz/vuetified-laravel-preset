<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Support\Arr;
use Nadar\PhpComposerReader\ComposerReader;
use Nadar\PhpComposerReader\RequireSection;

class AddComposerPackages
{
    /**
     * @var mixed
     */
    public $packages;

    /**
     * @var mixed
     */
    public $reader;

    /**
     * @var mixed
     */
    public $section;

    /**
     * @param ComposerReader $reader
     * @param RequireSection $section
     * @param $packages
     */
    public function __construct(ComposerReader $reader, RequireSection $section, $packages)
    {
        $this->reader   = $reader;
        $this->section  = $section;
        $this->packages = $packages;
    }

    /**
     * @param  $packages
     * @return mixed
     */
    public function addPackages($packages)
    {
        return $this->packages = array_merge($this->packages, $packages);
    }

    /**
     * @return mixed
     */
    public function getPackakges()
    {
        return $this->packages;
    }

    public function save()
    {
        $this->reader->save();
    }

    public function updateSection()
    {
        $this->reader->updateSection('require', $this->packages);
    }
}
