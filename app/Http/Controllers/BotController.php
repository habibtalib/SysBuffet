<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramBot;
use App\Models\Suscriptor;

class BotController extends Controller
{

    /*
    ** Dado por la cátedra, no se si hacer todavía más refactoring o no
    */
    public function solicitud(){

	    $returnArray = true;
	    $rawData = file_get_contents('php://input');
	    $response = json_decode($rawData, $returnArray);
	    $id_del_chat = $response['message']['chat']['id'];
	    $regExp = '#^(\/[a-zA-Z0-9\/]+?)(\ .*?)$#i';
	    $tmp = preg_match($regExp, $response['message']['text'], $aResults);
	    if (isset($aResults[1])) {
	        $cmd = trim($aResults[1]);
	        $cmd_params = trim($aResults[2]);
	    } else {
	        $cmd = trim($response['message']['text']);
	        $cmd_params = '';
	    }
	    switch ($cmd) {
	    case '/start':
	        $msg['text']  = 'Hola ' . $response['message']['from']['first_name'] . PHP_EOL;
	        $msg['text'] .= '¿Como puedo ayudarte? Puedes utilizar el comando /help';
	        $msg['reply_to_message_id'] = null;
	        break;
	    case '/help':
	        $msg['text']  = 'Los comandos disponibles son estos:' . PHP_EOL;
	        $msg['text'] .= '/start Inicializa el bot';
	        $msg['text'] .= '/menú Muestra el menú del día';
	        $msg['text'] .= '/help Muestra esta ayuda';
	        $msg['reply_to_message_id'] = null;
	        break;
	    case '/menú':
	        $msg['text']  = 'El menú del día es ensalada tropical';
	        break;
	    case '/hoy':
	        $msg['text'] = 'El menú de hoy es: ' . PHP_EOL;
	        $msg['text'] .= TelegramBot::hoy();
	        $msg['reply_to_message_id'] = null;
	        break;
	    case '/mañana':
	       $msg['text'] = 'El menú de mañana será: ' . PHP_EOL;
	       $msg['text'] .=TelegramBot::mañana();
	       $msg['reply_to_message_id'] = null;
	        break;
	    case '/suscribirse':
	       $msg['text']=Suscriptor::añadirSuscriptor($response['message']['chat']['id']);
	        break;
	    case '/desuscribirse':
	       $msg['text']=Suscriptor::quitarSuscriptor($response['message']['chat']['id']);
	        break;
	    default:
	        $msg['text']  = 'Lo siento, no es un comando válido.' . PHP_EOL;
	        $msg['text'] .= 'Prueba /help para ver la lista de comandos disponibles';
	        break;
	    }
	    TelegramBot::enviarMensaje($id_del_chat, $msg['text']);
    }
    
    public function menuBroadcast(){
    	TelegramBot::menuDelDiaBroadcast();
   	return view('menus.menu-enviado');
    }

}
