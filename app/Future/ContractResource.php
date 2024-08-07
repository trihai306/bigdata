<?php
namespace App\Future;
use Adminftr\Core\Http\Resource\BaseResource;
use App\Future\ContractResource\Form;
use App\Future\ContractResource\Table;


class ContractResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table()
        );
    }
}
