<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserTalentModel;
use \Firebase\JWT\JWT;

class UserTalent extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->UserTalentModel = new UserTalentModel();
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
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                    'valid_email' => 'All accounts must valid email.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status'   => 400,
                'error' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs ID'
            ];
            return $this->fail($response);
        }

        $user = $this->UserTalentModel->where('email', $email)->first();
        if (is_null($user)) {
            $response = [
                'status'   => 400,
                'error' => 'Invalid username or password',
                'message' => 'Invalid Inputs ID'
            ];
            return $this->fail($response);
        }

        $pwd_verify = password_verify($password, $user['password']);
        if (!$pwd_verify) {
            $response = [
                'status'   => 400,
                'error' => 'Invalid username or password',
                'message' => 'Invalid Inputs ID'
            ];
            return $this->fail($response);
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "nbf" => 1357000000,
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => 'Login Succesful',
            'token' => $token
        ];
        return $this->respond($response);
    }

    public function register()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'fullname' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'number_phone' => [
                'label' => 'Nomor Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                    'valid_email' => 'All accounts must valid email.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'confirm_password'  => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Confirm Password must same as Password.',
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $data = [
                'username' => $this->request->getVar('username'),
                'fullname' => $this->request->getVar('fullname'),
                'number_phone' => $this->request->getVar('number_phone'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT, ["cost" => 12])
            ];
            $this->UserTalentModel->save($data);
            $response = [
                'status'   => 200,
                'error' => null,
                'message' => 'Registered Successfully'
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status'   => 400,
                'error' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response);
        }
    }
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'fullname' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'number_phone' => [
                'label' => 'Nomor Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'All accounts must have {field} provided.',
                    'valid_email' => 'All accounts must valid email.',
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

            $this->UserTalentModel->update($id, $data);
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
