<?php
namespace App\Future;
use App\Future\BillOfLadingResource\Form;
use App\Future\BillOfLadingResource\Table;
use Future\Core\Http\Resource\BaseResource;


class BillOfLadingResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table(),
            new Form()
        );
    }
}
