<?php

namespace Icinga\Module\Kubernetes\Controllers;

use Icinga\Module\Kubernetes\Common\Database;
use Icinga\Module\Kubernetes\Model\Event;
use Icinga\Module\Kubernetes\Web\EventDetail;
use ipl\Stdlib\Filter;
use ipl\Web\Compat\CompatController;

class EventController extends CompatController
{
    public function indexAction(): void
    {
        $namespace = $this->params->getRequired('namespace');
        $name = $this->params->getRequired('name');
        $this->addTitleTab("Event $namespace/$name");

        $event = Event::on(Database::connection())
            ->filter(Filter::equal('namespace', $namespace))
            ->filter(Filter::equal('name', $name))
            ->first();

        $this->addContent(new EventDetail($event));
    }
}
