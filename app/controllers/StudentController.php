<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Students extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
    }

    // READ – list all
    public function index()
    {
        $data['students'] = $this->StudentsModel->get_all();
        $this->call->view('students_view', $data);
    }

    // CREATE – show form
    public function create()
    {
        $this->call->view('student_create');
    }

    // CREATE – save new record
    public function store()
    {
        $this->StudentsModel->insert([
            'first_name' => $this->io->post('first_name'),
            'last_name'  => $this->io->post('last_name'),
            'email'      => $this->io->post('email')
        ]);
        redirect('/students');
    }

    // UPDATE – show edit form
    public function edit($id)
    {
        $data['student'] = $this->StudentsModel->get_where(['id' => $id]);
        $this->call->view('student_edit', $data);
    }

    // UPDATE – save changes
    public function update($id)
    {
        $this->StudentsModel->update($id, [
            'first_name' => $this->io->post('first_name'),
            'last_name'  => $this->io->post('last_name'),
            'email'      => $this->io->post('email')
        ]);
        redirect('/students');
    }

    // DELETE
    public function destroy($id)
    {
        $this->StudentsModel->delete($id);
        redirect('/students');
    }
}
