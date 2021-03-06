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
    {
        try {
            if($id == null)
               return $this->failValidationError('No se ha pasado un ID Valido');
            $estudiante = $this->model->find($id);
            if($estudiante == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);
            //$gradoModel = new gradoModel();
            //$estudiante["grado"]=$gradoModel->where('estudiante_id',$estudiante['id'])->findAll();
            return $this->respond($estudiante);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
    public function update($id = null)
    {
        try {
            if($id == null)
               return $this->failValidationError('No se ha pasado un ID Valido');
            $estudianteVerificado = $this->model->find($id);
            if($estudianteVerificado == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);
            $estudiante = $this->request->getJSON();

            if($this->model->update($id, $estudiante)):
                $estudiante->id = $id;
                //$estudiante->id = $this->model->insertID();           
                return $this->respondUpdate($estudiante);
               else:
                   return $this->failValidationError($this->model->validation->listErrors());
               endif;
            //return $this->respond($estudiante);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
    public function delete($id = null)
    {
        try {
            if($id == null)
               return $this->failValidationError('No se ha pasado un ID Valido');
            $estudianteVerificado = $this->model->find($id);
            if($estudianteVerificado == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);
           // $estudiante = $this->request->getJSON();

            if($this->model->delete($id)):
                //$estudiante->id = $id;
                //$estudiante->id = $this->model->insertID();           
                return $this->respondDeleted($estudianteVerificado);
               else:
                return $this->failServerError('no se ha podido eliminar el Registro');
               endif;
            //return $this->respond($estudiante);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

	

}