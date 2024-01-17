<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'tweets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tweet',
    ];

    public function inserir($dados) {
        $cadastrar = $this->create([
            'user_id'    => auth()->user()->id,
            'tweet'      => $dados['tweet'],
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao cadastrar o tweet!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao cadastrar o tweet!',
            ];
        }
    }
}
