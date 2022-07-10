<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProjectModel;

class Project extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->ProjectModel = new ProjectModel();
        helper(['form']);
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data =  $this->ProjectModel->orderBy('id_contact', 'DESC')->findAll();
        if ($data) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => 'Data Found',
                'data' => $data
            ];
            return $this->respondCreated($data);
        } else {
            $response = [
                'status'   => 400,
                'error' => 'Data Not Found',
                'message' => 'Data Empty'
            ];
            return $this->fail($response, 400);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->ProjectModel->getWhere(['id_contact' => $id])->getResult();
        if ($data) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => 'Data Found',
                'data' => $data
            ];
            return $this->respondCreated($data);
        } else {
            $response = [
                'status'   => 400,
                'error' => 'Data Not Found',
                'message' => 'Invalid Inputs ID'
            ];
            return $this->fail($response, 400);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'id_user_talent' => [
                'label' => 'Nama Talenta',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'name_project' => [
                'label' => 'Nama Project',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'desc_project' => [
                'label' => 'Deskripsi Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'start_project' => [
                'label' => 'Mulai Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                ]
            ],
            'deadline_project' => [
                'label' => 'Deadline Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                ]
            ],
            'price_project' => [
                'label' => 'Harga Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'id_user_talent' => $this->request->getVar('id_user_talent'),
                'name_project' => $this->request->getVar('name_project'),
                'desc_project' => $this->request->getVar('desc_project'),
                'start_project' => $this->request->getVar('start_project'),
                'deadline_project' => $this->request->getVar('deadline_project'),
                'price_project' => $this->request->getVar('price_project'),
            ];
            $this->ProjectModel->insert($data);

            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => 'Data Saved'
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status'   => 400,
                'error' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 400);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules = [
            'id_user_talent' => [
                'label' => 'Nama Talenta',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'name_project' => [
                'label' => 'Nama Project',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'desc_project' => [
                'label' => 'Deskripsi Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'start_project' => [
                'label' => 'Mulai Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                ]
            ],
            'deadline_project' => [
                'label' => 'Deadline Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                ]
            ],
            'price_project' => [
                'label' => 'Harga Projek',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'id_user_talent' => $this->request->getVar('id_user_talent'),
                'name_project' => $this->request->getVar('name_project'),
                'desc_project' => $this->request->getVar('desc_project'),
                'start_project' => $this->request->getVar('start_project'),
                'deadline_project' => $this->request->getVar('deadline_project'),
                'price_project' => $this->request->getVar('price_project'),
            ];

            $this->ProjectModel->update($id, $data);
            $response = [
                'status' => 201,
                'error' => null,
                'message' => "Data Updated"
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status'   => 400,
                'error' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 400);
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data = $this->ProjectModel->find($id);
        if ($data) {
            $this->ProjectModel->delete($id);
            $response = [
                'status'   => 202,
                'error'    => null,
                'messages' => 'Data Deleted'
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status'   => 400,
                'error' => 'Data Not Found',
                'message' => 'Invalid Inputs ID'
            ];
            return $this->fail($response);
        }
    }
}
