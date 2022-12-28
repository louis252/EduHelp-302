<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqList extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'requestID',
       'requestDate',
       'requestStatus',
       'description',
       'requestType',
       'proposedDate',
       'proposedTime',
       'studentLevel',
       'numStudent',
       'resourceType',
       'numRequired',
       'schoolID',
       'offerID',
   ];
}
