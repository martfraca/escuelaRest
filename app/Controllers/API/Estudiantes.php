<?php namespace App\Controllers\API;

use App\Models\EstudianteModel;
use CodeIgniter\RESTful\ResourceController;

class Estudiantes extends ResourceController

{
    public function __construct() {
        $this->model = $this->setModel(new EstudianteModel());
    }
    public function index()
    
	{
        $estudiantes = $this->model->findAll();
        return $this->respond($estudiantes);
    }
    public function create()
    {
        try {
            $estudiante = $this->request->getJSON();
            if($this->model->insert($estudiante)):
             //$estudiante->id = $this->model->insertID();           
             return $this->respondCreated($estudiante);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
    public function edit($id = null)
        try {
            if($id == null)
               return $this->failValidationError('No se ha pasado un ID Valido');
            $estudiante = $this->model->find($id);
            if($estudiante == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);
            return $this->respond($estudiante);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

	

}