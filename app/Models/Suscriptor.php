<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscriptor extends Model
{
  protected $table = 'suscriptores';
  protected $fillable = [
        'chat_id'
    ];

  public static function añadirSuscriptor($chat){
      $sus = Suscriptor::where('chat_id',$chat)->get();
      if (isset($sus[0])){
        $mensaje = "Ya estás suscripto en el sistema!";
      } else {
        $sus = new Suscriptor();
        $sus->chat_id=$chat;
        $sus->save();
        $mensaje = "Tu suscripción fue dada de alta!";
      }
      return $mensaje;
  }
  
  public static function quitarSuscriptor($chat){
      $sus = Suscriptor::where('chat_id',$chat)->get();
      if (isset($sus[0])){
        $sus[0]->delete();
        $mensaje = "Tu suscripción fue dada de baja!";
      } else {
        $mensaje = "No estás suscripto en el sistema!";
      }
      return $mensaje;
  }
}
