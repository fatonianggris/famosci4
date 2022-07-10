<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\HomepageModel;

class Homepage extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->HomepageModel = new HomepageModel();
        helper(['form']);
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = 1)
    {
        $data = $this->HomepageModel->getWhere(['id_contact' => $id])->getResult();
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
        //
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
            'title' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'sub_title' => [
                'label' => 'Sub Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'company' => [
                'label' => 'Perusahaan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
            'phone_number' => [
                'label' => 'Nomor Handphone',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'All inputs must have {field} provided.',
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
            'desc' => [
                'label' => 'Deskripsi Perusahaan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All input must have {field} provided.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => $this->request->getVar('title'),
                'sub_title' => $this->request->getVar('sub_title'),
                'company' => $this->request->getVar('company'),
                'phone_number' => $this->request->getVar('phone_number'),
                'email' => $this->request->getVar('email'),
                'desc' => $this->request->getVar('desc'),
            ];

            $this->HomepageModel->update($id, $data);
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
        //
    }
}
