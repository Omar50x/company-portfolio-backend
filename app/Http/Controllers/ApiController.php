<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $module_name;
    protected $model;

    public function index($module_name) {
        try{
            $this->setModuleName($module_name);
            $check = $this->initModel();
            if ($check === false) {
                return response()->json(data: "You can not access this module");
            }
            $data = $this->model->paginate(10);
            return response()->json($data);
        }catch(\Exception $e) {
            dd($e);
        }
    }

    public function getById($module_name, $id) {
        try{
            $this->setModuleName($module_name);
            $check = $this->initModel();
            if ($check === false) {
                return response()->json();
            }
            $data = $this->model->find($id);
            if ($data) {
                return response()->json($data);
            }
            return response()->json();
        }catch(\Exception $e) {
            dd($e);
        }
    }

    protected function res($data = [], $status = true) {
        $data = [
            'payload' => $data,
            'status' => $status,
            'message' => $message
        ];
        return response()->json();
    }

    protected function setModuleName($module_name) {
        $this->module_name = $module_name;
    }

    protected function initModel() {
        $module = \Str::lower($this->module_name);
        $module = \Str::singular($module);
        $module = \Str::camel($module);
        $module = \Str::ucfirst($module);
        if (in_array($module, $this->expectModules())) {
            return false;
        }
        $namespace = 'App\\'.$module;
        $this->model = new $namespace;
    }

    protected function expectModules() {
        return ['Contact'];
    }
}
