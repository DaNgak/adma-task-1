<?php

namespace App\Commons\Enums;

enum StatusEnum: string
{
    case DEFAULT = 'PENDING';
    case ADMINISTRATIF = 'PROSES ADMINISTRATIF';
    case PROCESSED = 'PROSES PENANGANAN'; 
    case APPROVED = 'SELESAI DITANGANI';  
    case REJECTED = 'LAPORAN DITOLAK';
}
