<?php
namespace App\Future;

use App\Future\PaymentManagementResource\Form;
use App\Future\PaymentManagementResource\Table;
use Future\Core\Http\Resource\BaseResource;

class PaymentManagementResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table(),
            new Form()
        );
    }
}
