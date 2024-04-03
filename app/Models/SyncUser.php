<?php

namespace App\Models;
use App\Models\User;

class User extends User
{
    
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable([
            'online',
            'offline',
        ]);
    }
}
