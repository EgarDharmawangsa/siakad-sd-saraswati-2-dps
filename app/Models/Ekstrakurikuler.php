<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
        protected $table = 'ekstrakurikuler';

        protected $primaryKey = 'id_ekstrakurikuler';

        protected $guarded = ['id_ekstrakurikuler'];

}
