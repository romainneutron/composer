<?php
/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer\Test\Mock;

use Composer\Installer\InstallationManager;
use Composer\Repository\RepositoryInterface;
use Composer\DependencyResolver\Operation\OperationInterface;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\DependencyResolver\Operation\UninstallOperation;

class InstallationManagerMock extends InstallationManager
{
    private $installed = array();
    private $updated = array();
    private $uninstalled = array();

    public function install(RepositoryInterface $repo, InstallOperation $operation)
    {
        $this->installed[] = $operation->getPackage();
    }

    public function update(RepositoryInterface $repo, UpdateOperation $operation)
    {
        $this->updated[] = array($operation->getInitialPackage(), $operation->getTargetPackage());
    }

    public function uninstall(RepositoryInterface $repo, UninstallOperation $operation)
    {
        $this->uninstalled[] = $operation->getPackage();
    }

    public function getInstalledPackages()
    {
        return $this->installed;
    }

    public function getUpdatedPackages()
    {
        return $this->updated;
    }

    public function getUninstalledPackages()
    {
        return $this->uninstalled;
    }
}