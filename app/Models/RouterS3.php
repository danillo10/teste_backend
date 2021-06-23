<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouterS3 extends Model
{
    const REALESTATE_CRECI = 'realestate/creci';
    const PARTNER_CRECI = 'partner/creci';
    const REALTY_MEDIA= 'realty/media';
    const REALTY_ATTACHMENT = 'realty/attachment';
    const ADMINISTRATIVES_DOCUMENTS = 'administratives/documents';
}
