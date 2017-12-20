<?php

namespace ngp\services\services;

use ngp\services\models\IpContact;
use ngp\services\repositories\IpContactRepository;
use domain\services\Service;
use ngp\services\forms\IpContactForm;

class IpContactService extends Service
{
    private $ipContacts;

    public function __construct(
        IpContactRepository $ipContacts
    )
    {
        $this->ipContacts = $ipContacts;
    }

    public function find($id)
    {
        return $this->ipContacts->find($id);
    }

    public function create(IpContactForm $form)
    {
        $ipContact = IpContact::create($form);
        if (!$this->validateModels($ipContact, $form)) {
            throw new \DomainException();
        }

        $this->ipContacts->add($ipContact);
    }

    public function update($id, IpContactForm $form)
    {
        $ipContact = $this->ipContacts->find($id);
        $ipContact->edit($form);
        if (!$this->validateModels($ipContact, $form)) {
            throw new \DomainException();
        }

        $this->ipContacts->save($ipContact);
    }

    public function delete($id)
    {
        $ipContact = $this->ipContacts->find($id);
        $this->ipContacts->delete($ipContact);
    }
}