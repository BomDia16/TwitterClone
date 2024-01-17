<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    use HasFactory;

    protected $table = 'seguidores';

    protected $fillable = [
        'user_id',
        'user_id_seguindo',
    ];

    public function seguir($dados) {
        $cadastrar = $this->create([
            'user_id'           => auth()->user()->id,
            'user_id_seguindo'  => $dados['user_id_seguindo'],
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
}
