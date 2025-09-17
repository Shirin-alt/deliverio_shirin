<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: StudentsController
 * 
 * Automatically generated via CLI.
 */
class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
                $this->call->database();
        $this->call->model("StudentsModel");

    }

    public function index(): void
    {
        redirect("students");
    }

    public function get_all(): void
    {
        var_dump(value: $this-> StudentsModel->all()); 
    }

    function create(): void
    {
        $data= array(
            'last_name'=> 'Deliveio',
            'first_name' => 'Shirin',
            'email' => 'deliverio@gmail.com'
        );
        if($this->StudentsModel->insert($data)){
            echo 'Inserted';
        }
       
    }

    function update(): void
    {
        $data = $this->StudentsModel->update(1, [
            'last_name'=> 'maranan',
            'first_name' => 'Chisty'

        ]);

        if($data){
            echo 'Updated';
        }
    }

    function delete(): void 
    {
        
        if($this->StudentsModel->delete(1)){
            echo 'Deleted';
        }

       
    }

    public function read()
    {

        $data['students'] = $this->StudentsModel->all();
        $this->call->view('students_page', $data);
    }

     public function update_student()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $last_name = $_POST['last_name'] ?? '';
        $first_name = $_POST['first_name'] ?? '';
        $email = $_POST['email'] ?? '';

        $conn = new mysqli("sql12.freesqldatabase.com", "sql12798929", "akhlCbceII", "sql12798929");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE students SET last_name = ?, first_name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $last_name, $first_name, $email, $id);

        if ($stmt->execute()) {
            header("Location: /students"); 
            exit;
        } else {
            echo "Failed to update student.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid Request";
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

        $conn = new mysqli("sql12.freesqldatabase.com", "sql12798929", "akhlCbceII", "sql12798929");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: /students");
            exit;
        } else {
            echo "❌ Failed to delete student: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid Request (delete only accepts POST).";
    }
    }

}