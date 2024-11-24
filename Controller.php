<?php
require_once __DIR__ . '/../model/ContactModel.php';

class Controller {
    private $model;

    public function __construct() {
        $this->model = new ContactModel();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'form';

        switch ($action) {
            case 'create':
                $this->createContact();
                break;
            case 'list':
                $this->manageMessages();
                break;
            case 'edit':
                $this->editContact();
                break;
            case 'delete':
                $this->deleteContact();
                break;
            default:
                $this->showForm();
        }
    }

    private function showForm() {
        include __DIR__ . '/../view/contact_form.php';
    }

    private function createContact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'type' => $_POST['type'],
                'message' => $_POST['message']
            ];
            if ($this->model->create($data)) {
                header("Location: ?action=list");
                exit;
            } else {
                echo "Failed to save the contact message!";
            }
        }
    }

    private function manageMessages() {
        $contacts = $this->model->getAll();
        include __DIR__ . '/../view/contact_list.php';
    }

    private function editContact() {
        $id = $_GET['id'] ?? null;
        if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'type' => $_POST['type'],
                'message' => $_POST['message']
            ];
            if ($this->model->update($id, $data)) {
                header("Location: ?action=list");
                exit;
            } else {
                echo "Failed to update the message.";
            }
        } else {
            $contact = $this->model->getById($id);
            include __DIR__ . '/../view/edit_contact.php';
        }
    }

    private function deleteContact() {
        $id = $_GET['id'] ?? null;
        if ($id && $this->model->delete($id)) {
            header("Location: ?action=list");
            exit;
        } else {
            echo "Failed to delete the message.";
        }
    }
}
?>
