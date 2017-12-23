<?php

namespace ngp\services\services;

use ngp\services\models\IpContactGroups;
use ngp\services\repositories\IpContactGroupsRepository;
use domain\services\Service;
use ngp\services\forms\IpContactGroupsForm;

class IpContactGroupsService extends Service
{
    private $ipContactGroups;

    public function __construct(
        IpContactGroupsRepository $ipContactGroups
    )
    {
        $this->ipContactGroups = $ipContactGroups;
    }

    public function find($id)
    {
        return $this->ipContactGroups->find($id);
    }

    public function create(IpContactGroupsForm $form)
    {
        $ipContactGroups = IpContactGroups::create($form);
        if (!$this->validateModels($ipContactGroups, $form)) {
            throw new \DomainException();
        }

        $this->ipContactGroups->add($ipContactGroups);
    }

    public function update($id, IpContactGroupsForm $form)
    {
        $ipContactGroups = $this->ipContactGroups->find($id);
        $ipContactGroups->edit($form);
        if (!$this->validateModels($ipContactGroups, $form)) {
            throw new \DomainException();
        }

        $this->ipContactGroups->save($ipContactGroups);
    }

    public function delete($id)
    {
        $ipContactGroups = $this->ipContactGroups->find($id);
        $this->ipContactGroups->delete($ipContactGroups);
    }

    public function menu() {
        return $this->ipContactGroups->menu();
    }
}