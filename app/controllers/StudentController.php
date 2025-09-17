<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Controller: StudentsController
 *
 * Automatically generated via CLI.
 */
class StudentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model("StudentsModel");

    }

    public function index(): void
    {
        $data['students'] = $this->StudentsModel->all();
        $this->call->view('students_page');
    }

    public function read()
    {
        $data['students'] = $this->StudentsModel->all();
        $this->call->view('students_page', $data);
    }

    public function insert()
    {
        // Handle insert
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $last_name  = $_POST['last_name'] ?? '';
            $first_name = $_POST['first_name'] ?? '';
            $email      = $_POST['email'] ?? '';

            $this->UserModel->insert($last_name, $first_name, $email);
        }

        return redirect('students');
    }

    public function update_student()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id         = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $last_name  = $_POST['last_name'] ?? '';
            $first_name = $_POST['first_name'] ?? '';
            $email      = $_POST['email'] ?? '';

            $this->StudentsModel->filter(['id' => $id])->update($last_name, $first_name, $email);

            return redirect('students');
        } else {
            return redirect('students');
        }
    }

    public function delete_student()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

            if ($id <= 0) {
                echo "❌ Invalid student ID.";
                exit;
            }

            $this->StudentsModel->filter(['id' => $id])->delete();

            return redirect('students');

        } else {
            echo "Invalid Request (delete only accepts POST).";
        }
    }
}
