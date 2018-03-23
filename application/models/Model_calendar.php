<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_calendar extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function genera_calendario($year, $month)
    {

    	$prefs = array (
            'start_day'    => 'monday',
            'month_type'   => 'long',
            'day_type'     => 'short'
        );

        $this->load->library('calendar', $prefs);

        //en data obtenemos el resultado del método get_datos_calendario
        //y le pasamos para que funcione el año y el mes que realmente lo
        //recoge en la función cal del controlador como hemos visto antes

       	$data = array(
   	  		$this->_randNumbers($month) => 'http://your-site.com/news/article/2006/03/',
           	$this->_randNumbers($month) => 'http://your-site.com/news/article/2006/07/',
            $this->_randNumbers($month) => 'http://your-site.com/news/article/2006/13/',
            $this->_randNumbers($month) => 'http://your-site.com/news/article/2006/26/'
        );
 
        //devolvemos nuestro calendario en funcionamiento
        return $this->calendar->generate($year, $month, $data);
    }

    private function _randNumbers($month)
    {
    	return $month == 2 ? rand(1, 28) : rand(1, 30);
    }
}

/* End of file calendario_model.php */
/* Location: ./application/models/calendario_model.php */
