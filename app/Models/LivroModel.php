<?php

namespace App\Models;

use CodeIgniter\Model;

class LivroModel extends Model
{
    const DISPONIVEL = 1;
    const INDISPONIVEL = 0;
    const STATUSLOCADO = [
        self::DISPONIVEL => "Disponivel",
        self::INDISPONIVEL => "Indisponivel"
    ];

    const INTEGRO = 1;
    const RASGADO = 2;
    const STATUSLIVRO = [
        self::INTEGRO => "Integro",
        self::RASGADO => "Rasgado"
    ];

    protected $table            = 'livro';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['disponivel','status','tombo','id_obra'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
