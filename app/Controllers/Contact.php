<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ContactModel;

class Contact extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->ContactModel = new ContactModel();
        helper(['form']);
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data =  $this->ContactModel->orderBy('id_contact', 'DESC')->findAll();
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
        $data = $this->ContactModel->getWhere(['id_contact' => $id])->getResult();
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

    public function show_client($id = null)
    {
        $data = $this->ContactModel->getWhere(['id_user_client' => $id])->getResult();
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
            'name_contact' => ['label' => 'Nama Kontak', 'rules' => 'required'],
            'position' => ['label' => 'Jabatan', 'rules' => 'required'],
            'number_phone' => ['label' => 'Nomor Handphone', 'rules' => 'required|min_length[8]'],
            'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'name_contact' => $this->request->getVar('name_contact'),
                'position' => $this->request->getVar('position'),
                'number_phone' => $this->request->getVar('number_phone'),
                'email' => $this->request->getVar('email'),
            ];
            $this->ContactModel->insert($data);

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
            'name_contact' => [
                'label' => 'Nama Kontak',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'position' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'number_phone' => [
                'label' => 'Nomor Handphone',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                    'min_length' => 'Your {field} is too short.',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
                    'valid_email' => 'All input must valid email.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'name_contact' => $this->request->getVar('name_contact'),
                'position' => $this->request->getVar('position'),
                'number_phone' => $this->request->getVar('number_phone'),
                'email' => $this->request->getVar('email'),
            ];

            $this->ContactModel->update($id, $data);
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
        $data = $this->ContactModel->find($id);
        if ($data) {
            $this->ContactModel->delete($id);
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
