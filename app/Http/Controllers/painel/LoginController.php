<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use \App\Models\painel\Login;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Integer;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $login, $request;
    public $idUser = 1;

    public function __construct(Login $login, Request $request){
        $this->login = $login;
        $this->request = $request;
    }

    public function usuarios(){
        return view('painel.usuarios.usuario-painel');
    }

    public function cadastroUsuario()
    {
        return view('painel.usuarios.create');
    }

    public function validarCadUsuario()
    {
        // show the form

        $dadosForm = $this->request->all();

        $rules = [
            'nome' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('usuarios/cadastrar')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
            /*Se a validação falhar, envie-o de volta ao formulario de cadastro
            Mostre ao usuario os erros e ao voltar, mantenha os campos preenchidos
            EXCETO o campo senha
            */
        } else {

            //$senha = $dadosForm['senha'];
            //$dadosForm['senha'] = Hash::make($dadosForm['senha']);
            if ($userDB = DB::table('logins')->where('nome', '=', $dadosForm['nome'])->first()) {
                // echo 'Email ja cadastrado';

                $validator = Validator::make(Input::all(), $rules, ['Nome já cadastrado!']);
                return redirect('/usuarios/cadastrar');


                /*->withErrors($validator)
                ->withInput($input);*/
            } else {
                $dadosForm['password'] = bcrypt($dadosForm['password']);
                $insert = $this->login->create($dadosForm);
                return redirect('/login');

                //dd(Hash::check($senha, $dadosForm['senha']));
            }
        }


        //return view('painel.usuarios.create');
    }
    public function mostraEmail()
    {
        //mostra o form de verificar email
        return view('painel.recuperar-conta-email');

    }

    public function verificaEmail()
    {
        $dadosForm = $this->request->all();
        $email = $dadosForm['email'];
        $codigo = rand(1,999999);


        $userIdQuery = DB::select("select id from logins where email =?", [$email]);

        if (isset($userIdQuery[0])){

            $userId = $userIdQuery[0]->id;
            $userNomeQuery = DB::select("select nome from logins where email =?", [$email]);
            $userNome = $userNomeQuery[0]->nome;
        } else {
            return redirect('/login/recuperar-conta')
                ->withErrors(['errors' => 'Esse Email não é cadastrado']);
        }



        if ($userDB = DB::table('logins')->where('email', '=', $dadosForm['email'])->first()) {
            Mail::send('painel.usuarios.codigo', ['codigo' => $codigo], function ($mail) use ($email, $codigo, $userNome) {
                $mail->from('tudosobrerevista@gmail.com', 'LaraMusic');
                $mail->to($email, $userNome);
                $mail->subject('Recuperação de Senha - Laramusic');
            });

        }
        return view ('painel.recuperar-codigo', compact('codigo','email', 'userId'));

    }



    public function verificaCodigo()
    {

        $dadosForm = $this->request->all();
        $codigoEmail = $dadosForm['codigoHidden'];
        $codigoForm = $dadosForm['codigoForm'];
        $userId = $dadosForm['idHidden'];

        if (Hash::check($codigoForm, $codigoEmail)) {
            return view('painel.recuperar-senha', compact('userId'));
        }  else {
            return redirect('/login/recuperar-conta')
                ->withErrors(['errors' => 'Código Inválido']);
        }




    }

    public function recuperarSenha()
    {
        $dadosForm = $this->request->all();
        $newPassword = bcrypt($dadosForm{'newPassword'});
        $idUser = $dadosForm['idHidden'];

        $update = DB::table('logins')
            ->where('id', $idUser)
            ->update(['password' => $newPassword]);


        if ($update){
            return redirect('/login');
        } else {
            return 'Não Atualizou';
        }
    }


    public function showLogin()
    {
        // show the form
        return view('painel.usuarios.login-painel');

    }

    public function doLogin()
    {
// process the form
        $inputAll = $this->request->all();

        $rules = [
            'nome' => 'required',
            'password' => 'required'
        ];

        //  $validator = Validator::make($inputAll, $rules);
        $validator = Validator::make($inputAll, $rules);

        if ($validator->fails()) {
            $input = Input::get('nome');
            return redirect('/login')
                ->withErrors($validator);
            //->withInput($input);
        } else {

            //Criando o usuario para a autenticação
            $userdata = array(
                'nome' => Input::get('nome'),
                'password' => Input::get('password'),
                'tema' => Input::get('tema')
            );

            if (Auth::attempt(['nome' => $userdata['nome'], 'password' => $userdata['password']])) {
                // Authentication passed...
                    $theme = $userdata['tema'];
                //return view('painel.home.home-painel', compact('theme'));
                    \Session::put('themePainel', $theme);
                    return redirect()->intended('/painel')
                       ->with(['loginSucess' => 'Login Realizado com Sucesso']);
            } else {
                return redirect('/login')
                    ->withErrors(['errors' => 'Dados incorretos. Preencha Novamente'])
                    ->withInput(Input::except('password'));

            }
        }
    }


    public function doLogout()
    {
        // logout
        Auth::logout();
        \Session::flush();
        return redirect('login')
            ->with(['logoutSucess' => 'Logout Realizado com Sucesso']);;

    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
