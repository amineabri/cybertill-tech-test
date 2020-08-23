<?php

namespace Domain\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class LogModel extends Model
{
    /**
     * Defines the column name for createdAt.
     */
    const CREATED_AT = 'createdAt';

    /**
     * Defines the column name for updatedAt.
     */
    const UPDATED_AT = 'updatedAt';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'uuid',
        'ipAddress',
        'responseType',
        'responseTime',
        'countryOfOrigin',
        'path',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid'              => 'string',
        'ipAddress'         => 'string',
        'responseType'      => 'integer',
        'responseTime'      => 'integer',
        'countryOfOrigin'   => 'string',
        'path'              => 'string',
    ];
}
