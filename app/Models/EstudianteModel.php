<?php namespace App\models;

use CodeIgniter\Model;

class EstudianteModel extends Model
{
    protected $table           = 'estudiante';
    protected $primaryKey      = 'id';

    protected $returnType      = 'array';
    protected $allowedFields   = ['nombre','apellido','carnet'];

    protected $useTimestamps   = true;
    protected $createField     = 'created_at';
    protected $updateField     = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[50]',
        'apellido' => 'required|alpha_space|min_length[3]|max_length[50]',
        //'carnet' => 'required|alpha_numeric_space|min_length[8]|max_length[8]'
    ];
    /*protected $validationMessages = [
        'carnet'      =>  [
            'valid_carnet' => 'Estimado usuario, debe ingresar un email valido.'
        ]
    ];*/
        protected $skipValidation = false;
}