<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyTransport extends Model
{
    protected $fillable = ['name', 'code_of_loading_port', 'import_port_code', 'invoice_number'];

    // Assuming you have data_systems that relate to company transport
    public function dataSystems()
    {
        return $this->hasMany(DataSystem::class, 'company_transport_id');
    }
}
