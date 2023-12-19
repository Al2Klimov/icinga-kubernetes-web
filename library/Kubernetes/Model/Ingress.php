<?php

/* Icinga Kubernetes Web | (c) 2023 Icinga GmbH | GPLv2 */

namespace Icinga\Module\Kubernetes\Model;

use ipl\I18n\Translation;
use ipl\Orm\Behavior\Binary;
use ipl\Orm\Behavior\MillisecondTimestamp;
use ipl\Orm\Behaviors;
use ipl\Orm\Model;
use ipl\Orm\Relations;

class Ingress extends Model
{
    use Translation;

    public function createBehaviors(Behaviors $behaviors)
    {
        $behaviors->add(new Binary([
            'id'
        ]));

        $behaviors->add(new MillisecondTimestamp([
            'created'
        ]));
    }

    public function createRelations(Relations $relations)
    {
        $relations->hasMany('backend_resource', IngressBackendResource::class);

        $relations->hasMany('backend_service', IngressBackendService::class);

        $relations->hasMany('ingress_rule', IngressRule::class);

        $relations->hasMany('ingress_tls', IngressTls::class);
    }

    public function getColumnDefinitions()
    {
        return [
            'namespace'        => $this->translate('Namespace'),
            'name'             => $this->translate('Name'),
            'uid'              => $this->translate('UID'),
            'resource_version' => $this->translate('Resource Version'),
            'created'          => $this->translate('Created At')
        ];
    }

    public function getColumns()
    {
        return [
            'namespace',
            'name',
            'uid',
            'resource_version',
            'created'
        ];
    }

    public function getDefaultSort()
    {
        return ['created desc'];
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getSearchColumns()
    {
        return ['name'];
    }

    public function getTableName()
    {
        return 'ingress';
    }
}
