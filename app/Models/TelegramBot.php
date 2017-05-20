<?php
namespace App\Models;
use App\Models\Menu;
use App\Models\MenuDetalle;
use App\Models\Producto;

class TelegramBot{

  public static function hoy(){
    return self::traerMenu(date('Y-m-d'));
  }

  public static function mañana(){
    $datetime = new DateTime('tomorrow');
    $maniana= $datetime->format('Y-m-d');
    return self::traerMenu($maniana);
  }

  /*
  ** Reimplementado
  */
  public static function traerMenu($fecha){
    $productosDia = Menu::traerProductos($fecha);//reimp
    if (! $productosDia->isEmpty() ){
      $productosDiaString = "";
      foreach ($productosDia as $prod){
        $nombre= $prod->nombre;
        $productosDiaString = $productosDiaString . $nombre . PHP_EOL;
      }
    } else $productosDiaString = "Todavía no se ha elegido el menú del día";
    return $productosDiaString;
  }

  public static function menuDelDiaBroadcast(){
      $suscriptores = Suscripcion::all();
      $menu_txt = TelegramBot::hoy();
      foreach ($suscriptores as $sus){
        TelegramBot::enviarMensaje($sus->chat_id,$menu_txt);
      }
  }

  public static function enviarMensaje($chatID, $texto_mensaje){
        $msg = array();
        $msg['chat_id'] = $chatID;
        $msg['text'] = null;
        $msg['reply_markup'] = null;

        $msg['text'] = $texto_mensaje;

        $url = 'https://api.telegram.org/bot239007891:AAEMiSsMgGNRSOFojuYdgjYDnDCf041Ptcs/sendMessage';

        $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($msg)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        //exit(0);
  }

}