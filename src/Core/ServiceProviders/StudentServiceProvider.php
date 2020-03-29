<?php

namespace App\Core\ServiceProviders;

use App\Models\Student\StudentModelInterface;
use App\Models\Student\StudentModel;

/**
 * Class StudentServiceProvider
 *
 * @package App\Core\ServiceProviders
 */
class StudentServiceProvider extends AbstractServiceProvider
{
    /**
     * @return mixed|void
     */
    public function register()
    {
        $this->container->set(
            StudentModelInterface::class,
            StudentModel::class
        );
    }
}
