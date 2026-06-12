<?php
require_once 'models/User.php';
require_once 'Controller.php';

class UserController extends Controller{
    private PDO $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    public function create() {
        User::create([
            'id' => null,
            'password' => 'password',
            'user' => 'Random2',
            'NoExiste' => 'EnFillables'
        ]);
        view('./views/index.php');
    }

    public function mostrarLista() {
        //
        $data = [];
        $users = User::all();
        foreach ($users as $user) {
            array_push($data,$user->user);
        }
        httpResponse()->json($data,200);
    }

    public function getById($id) {
        httpResponse()->json(User::find($id));
    }

    public function mostrarFormulario($id = null) {
        //
    }

    public function update(int $id) {
        $user = User::find($id);
        if ($user != null) {
            $old_user = $user;
            User::update([
                'password'=>'Jeremy123'
            ],$id);

            $new_user = User::find($id);
            return httpResponse()->json([
                'Old_user' => $old_user,
                'New_user_2' => [
                    'id' => $new_user->id,
                    'user' => $new_user->user,
                    'password' => $new_user->password
                ]
            ]);
        }else{
            return httpResponse()->json(['message'=>'Hello']);
        }
    }

    public function borrar(int $id) {
        //
        if(User::destroy($id)){
            return httpResponse()->json(['message'=>'deleted']);
        }

        return httpResponse()->json(['message'=>'The element requested doesn\'t exist']);
    }
}