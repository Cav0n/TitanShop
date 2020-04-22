<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get formatted size
     *
     * @return string
     */
    public function getSizeFormattedAttribute()
    {
        if (0 === $this->size) {
            return "Taille de l'image inconnue.";
        }

        if (1000 > $this->size) {
            return $this->size . ' o';
        }

        if (1000000 > $this->size) {
            return \number_format($this->size / 1000, 2, '.', ' ') . ' Ko';
        }

        if (1000000000 > $this->size) {
            return \number_format($this->size / 1000000, 2, '.', ' ') . ' Mo';
        }

        return \number_format($this->size / 1000000000, 2, '.', ' ') . ' Go';
    }
}
