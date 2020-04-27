<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasRead extends Model
{
    protected $table = 'HasRead';
    protected $primaryKey = 'id';
    protected $dateFormat = 'U';

    public function getDateFormat() {
        return 'Y-m-d H:i:s';
    }
}

