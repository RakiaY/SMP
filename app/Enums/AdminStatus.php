<?php

namespace  App\Enums ;

enum  AdminStatus: string
{
  case Active= 'Active';
  case Inactive = 'Inactive' ;
  case Pending = 'Pending';
  case Blocked= 'Blocked';
  case Deleted = 'Deleted';
}

