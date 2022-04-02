<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celebrity extends Model
{
    use HasFactory;

    public function getCelebrities () {
        foreach (Celebrity::all() as $celebrity) {
            echo $celebrity->firstname;
        }
    }
}
