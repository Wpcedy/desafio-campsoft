<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../response.php';
require_once __DIR__ . '/../Model/UsersModel.php';
require_once __DIR__ . '/../Service/UsersValidator.php';

class UsersController
{
    private $model;
    private $method;
    private $id;
    private $body;

    public function __construct($method, $id, $body)
    {
        $this->model = new UsersModel();
        $this->method = $method;
        $this->id = $id;
        $this->body = $body;
    }

    public function call()
    {
        if (!$this->getId() && ($this->getMethod() == 'PUT' || $this->getMethod() == 'DELETE')) {
            echo Response::json(404, 'error - user does not exist');
        }

        try {
            switch ($this->getMethod()) {
                case 'GET':
                    $data = $this->getList();
                    echo Response::json(200, 'success', $data);
                    break;
                case 'POST':
                    $data = $this->post();
                    echo Response::json(201, 'success', $data);
                    break;
                case 'PUT':
                    $data = $this->put();
                    echo Response::json(200, 'success', $data);
                    break;
                case 'DELETE':
                    $data = $this->delete();
                    echo Response::json(204, 'success');
                    break;
            }
        } catch (PDOException $th) {
            echo Response::json(500, 'data base error', $th->getMessage());
        } catch (Exception $th) {
            echo Response::json($th->getCode(), 'error', $th->getMessage());
        }
    }

    private function getList()
    {
        if ($this->getId()) {
            return $this->getModel()->getById($this->getId());
        } else {
            return $this->getModel()->getAll();
        }
    }

    private function post()
    {
        $validator = new UsersValidator($this->getBody());
        $data = $validator->validateData();

        if ($this->getModel()->checkByCpf($data['cpf'])) {
            throw new Exception("user already exists", 422);
        }

        $this->getModel()->create($data);
    }

    private function put()
    {
        $validator = new UsersValidator($this->getBody());
        $data = $validator->validateData();

        $this->getModel()->update($this->getId(), $data);
    }

    private function delete()
    {
        $this->getModel()->delete($this->getId());
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }
}
