<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function getFirstnameAttribute($value)
    {
        return \ucfirst($value);
    }

    public function getLastnameAttribute($value)
    {
        return \strtoupper($value);
    }

    public function getCity($value)
    {
        return \strtoupper($value);
    }

    public function __toString()
    {
        $identity = $this->firstname . ' ' . $this->lastname;
        $firstline = $this->street . (isset($this->street2) ? ' (' . $this->street2 . ')': null) . ', ';
        $secondline = $this->zipCode . ', ' . $this->city;

        return $identity . '<br>' . $firstline . '<br>' . $secondline;
    }
}
