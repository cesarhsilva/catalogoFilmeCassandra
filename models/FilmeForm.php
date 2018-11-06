<?php
namespace app\models;

use Yii;
use yii\base\Model;

class FilmeForm extends Model
{
    public $nome;
    public $ano;
    public $copias;
    
    public function rules()
    {
        return [
            [['nome', 'ano', 'copias'], 'required'],
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'nome' => 'Nome do filme',
            'ano' => 'Ano de lançamento',
            'copias' => 'Quantidade de cópias do filme',
        ];
    }

    public static function criarFilme($nomeFilme, $anoFilme, $copiasFilme)
    {
        $filme_obj = new FilmeForm();
  
        if($nomeFilme == "" || $anoFilme == "")
        {  
            throw Exception;
        }
        
        $filme_obj->nome = $nomeFilme;
        $filme_obj->ano = $anoFilme;
        $filme_obj->copias = $copiasFilme;

        return $filme_obj;
     }
}