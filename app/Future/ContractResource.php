<?php
namespace App\Future;
use App\Future\ContractResource\Form;
use App\Future\ContractResource\Table;
use Future\Core\Http\Resource\BaseResource;


class ContractResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table(),
            new Form()
        );
    }
}
