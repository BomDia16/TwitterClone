<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario',
        'email',
        'password',
    ];

    public function inserir($dados) {
        $cadastrar = $this->create([
            'usuario'    => $dados['usuario'],
            'email'      => $dados['email'],
            'password'      => bcrypt($dados['senha']),
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao cadastrar o usuário!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao cadastrar o usuário!',
            ];
        }
    }

    public function login($dados) {
        $credenciais = [
            'usuario' => $dados['usuario'],
            'password' => $dados['senha']
        ];
        return Auth::attempt($credenciais);
    }

    public function logout() {
        return Auth::logout();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function searchUser(Array $data, $totalPage) {
        return $this->where(function($query) use ($data) {
            if (isset($data['nome']))
                $query->where([
                                ['usuario', 'LIKE', "%{$data['nome']}%"],
                                ['id', '<>', auth()->user()->id]
                ]);
        })->paginate($totalPage);
    }
}
