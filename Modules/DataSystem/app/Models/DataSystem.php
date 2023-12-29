<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class DataSystem extends Model
{
    protected $fillable = [
        'date', 'import_id', 'exporter_id', 'hs_code_id', 'quantity', 'unit',
        'weight', 'weight_unit', 'package_quantity', 'unit_pkg', 'country', 'company_transport_id'
    ];

    public function importer()
    {
        return $this->belongsTo(Importer::class, 'import_id');
    }

    public function exporter()
    {
        return $this->belongsTo(Exporter::class, 'exporter_id');
    }

    public function companyTransport()
    {
        return $this->belongsTo(CompanyTransport::class, 'company_transport_id');
    }

    public function descriptionProducts()
    {
        return $this->hasMany(DescriptionProduct::class);
    }

    public function totalPrice()
    {
        return $this->hasOne(TotalPrice::class);
    }

}
