<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUser;
use App\Models\Post;
use App\Models\Seguidor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Components\Form\Select;

class UserController extends Controller
{
    private $totalPage = 15;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::check()){
            $oi = auth()->user()->id;
            $tweets = Post::where('user_id', '=', auth()->user()->id)
                            ->orWhereIn('tweets.user_id', function ($query) use ($oi) {
                                $query->select('user_id_seguindo')
                                    ->from('seguidores')
                                    ->where('user_id', $oi);
                            })
                            ->join('users', 'tweets.user_id', '=', 'users.id')
                            ->orderBy('created_at', 'desc')
                            ->select('tweets.*', 'users.usuario')
                            ->get();
            
            $seguidores = count(Seguidor::where('user_id_seguindo', auth()->user()->id)->get());
            return view('home',
                    compact('tweets', 'seguidores'));
        }
        return redirect()->route('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $dados = $request->all();
        
        $inserir = $this->user->inserir($dados);
        if($inserir['status']) {
            return redirect()->route('welcome');
        }
        return redirect()
                ->back()
                ->withErrors($inserir['message']);
    }

    public function login(Request $request) {
        $dados = $request->all();
        $login = $this->user->login($dados);
        if(!$login) {
            return back()
                    ->withInput()
                    ->withErrors([
                        'As credenciais fornecidas não correspondem aos nossos registros.'
                    ]);
        }
        return redirect()->intended(route('user.index'));
    }

    public function logout() {
        $this->user->logout();
        return redirect()->route('welcome');
    }

    public function procurar()
    {   
        if(Auth::check()){
            $pessoas = null;

            return view('procurar', compact('pessoas'));
        }
        return redirect()->route('welcome');
    }

    public function search(Request $request, User $userFiltro)
    {
        if(Auth::check()){
            //$autenticar = auth()->user()->id;
            $dados = $request->all();
            $pessoas = $userFiltro->searchUser($dados, $this->totalPage);
            //$pessoas->each(function ($pessoas) use ($autenticar) {
                //$pessoas->segue = $autenticar->segue($pessoas->id);
            //});
            //dd($pessoas);

            //$seguindo = Seguidor::rightJoin('users', 'users.id', '=', 'seguidores.user_id')
            //                        ->where('seguidores.user_id', '=', auth()->user()->id)->get();
            //$pessoas->first()->id
            //if(!isset($seguindo['id'])){
            //    return view('procurar', 
            //                compact('pessoas', 'seguindo'));
            //} else {
            //    dd($seguindo);
            //}
            return view('procurar', 
                            compact('pessoas'));
        }
        return redirect()->route('welcome');
    }

    public function seguir(Request $request, Seguidor $seguir)
    {
        $dados = $request->all();
        
        $inserir = $seguir->seguir($dados);
        if($inserir['status']) {
            return redirect()->route('user.procurar');
        }
        return redirect()
                ->back()
                ->withErrors($inserir['message']);
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
