<?php
require_once("/home/coding/public_html/dokuwiki/lib/plugins/bopm/syntax.php");

class IRCClient
{
    var $irc_nick;
    var $irc_user;
    var $irc_name;
	var $irc_host;
    var $irc_server;
    var $irc_port;
    var $irc_password;
    var $timeout_length = 20;

    var $socket;
    var $error;
	var $errno;	
	var $callback_handlers;
	var $fp;

    function IRCClient ($nick, $user, $name, $host)
    {   
        $this->irc_nick = $nick;
        $this->irc_user = $user;
        $this->irc_name = $name;
        $this->irc_host = $host;
        $this->socket   = NULL;
        $this->error    = NULL;
        $this->errno    = NULL;	
        $this->callback_handlers = array();
    }

    function irc_connect ($server, $pass=NULL)
    {
        $this->fp = fopen ('/tmp/irclog.log', 'a');

        list ($server, $port) = explode(':', $server);
        $this->irc_server = $server;
        $this->irc_port = ($port)? $port: '6667';
        $this->irc_pass = ($pass)? $pass: NULL;

        fwrite($this->fp, sprintf( "[%s] Connecting to %s (%s) port %s\n",
		                          date("YmdHis"), $this->irc_server,
					  gethostbyname($this->irc_server), $this->irc_port ) );
								  
        $this->socket = fsockopen ($this->irc_server, $this->irc_port,
            $this->errno, $this->error, 10);

        set_socket_blocking($this->socket, FALSE);
        if ( !empty ($this->irc_password) ) {
            $this->irc_send_msg (sprintf ("PASS %s", $this->irc_password));
        }

        $this->irc_send_msg (sprintf ("USER %s %s %s :%s", $this->irc_user, $this->irc_user, $this->irc_user, $this->irc_name));
        $this->irc_send_msg (sprintf ("NICK %s", $this->irc_nick));

		
	$this->irc_do_loop();
    }

    function irc_disconnect ()
    {
        $this->irc_send_msg (sprintf ("QUIT"));
		fclose ($this->socket);
		$this->socket = NULL;
		
		fwrite($this->fp, sprintf( "[%s] Disconnected from %s (%s) port %s\n",
		                          date("YmdHis"), $this->irc_server,
								  gethostbyname($this->irc_server), $this->irc_port ) );
		fclose ($this->fp);
    }

    function irc_do_loop ()
    {
        $begin_time = time();
        $bigbuf = '';
        while (1)
        {
            $bufr = fgets ($this->socket, 1024);
            /* If this big has a end of line feed in it, we want to process it.
             * if not, its just a partial, save it and try again */
            if(preg_match('/[\n]$/', $bufr))
            {
                $bufr = $bigbuf . $bufr;
                $bigbuf = '';
		fwrite($this->fp, sprintf( "[%s] %s", date("YmdHis"), $bufr));

                $data = explode (' ', rtrim ($bufr), 4);
		for ($i = 0; $i < count ($data); $i++)
		{
            	    $data[$i] = ltrim ($data[$i], ':');
		}
            
                if ( $data[0] == 'PING' ) {
                    $this->irc_send_msg (sprintf ("PONG %s", $data[1]), FALSE);
                    continue;
                }

		if ( array_key_exists ($data[1], $this->callback_handlers) )
		{
//die($this->callback_handlers[$data[1]]);
		    if($this->callback_handlers[$this->data[1]] ( $data, $this ) == FALSE)
                    {
                        break;
                    }
		}
            }
            else
            {
                $bigbuf = $bufr;
		fwrite($this->fp, sprintf( "[%s] %s\n", date("YmdHis"), "No data yet, sleeping.."));
                fflush($this->fp);
                sleep(2);
            }
            if(time() - $begin_time > $this->timeout_length)
            {
                if(array_key_exists('timeout', $this->callback_handlers))
                {
                    set_time_limit(30); // dont time out php
                    $begin_time = time();
                    if($this->callback_handlers['timeout'] (null, $this) == FALSE)
                    {
                        break;
                    }
                }
            }
        }
    }
	
    function irc_register_callback ($event, $callback, $array)
    {
        $this->callback_handlers[$event] = $callback;
    }	
	
    function irc_unregister_callback ($event)
    {
        $this->callback_handlers[$event] = NULL;
    }	
	
    function irc_send_msg ($msg)
    {
        set_socket_blocking($this->socket, TRUE);
	fwrite($this->fp, sprintf( "[%s] %s\n", date("YmdHis"), $msg));
        fputs ($this->socket, sprintf ("%s\n", $msg));
        set_socket_blocking($this->socket, FALSE);

    }

}
?>
