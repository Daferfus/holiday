<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */

        $this->load->library('email');
        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        //  $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('calendar');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');

        $this->load->model('Model_calendar');
    }

//    public function index() {
//        $this->load->view('webapp/index.php');
//    }


    public function index() {

        $data = array(
            3 => 'http://example.com/news/article/2006/06/03/',
            7 => 'http://example.com/news/article/2006/06/07/',
            13 => 'http://example.com/news/article/2006/06/13/',
            26 => 'http://example.com/news/article/2006/06/26/'
        );

        $prefs = array(
            'start_day' => 'monday',
            'month_type' => 'long',
            'day_type' => 'short'
        );

        $prefs['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';


        $this->load->library('calendar', $prefs);

     //   echo $this->calendar->generate();
        $year=2016;
        $this->cal($year);
    }

    private function _buildCalendar($year, $month, $totalMonths = 6) {
        $calData = array();

        //como vemos en genera calendario le pasamos el año y el mes para que sepa que debe mostrar
        for ($i = 1; $i <= $totalMonths; $i++) {
            $data = array('calendario' => $this->Model_calendar->genera_calendario($year, $month));
            $calData[] = $this->load->view('cal', $data, TRUE);
            if ($month == 12) {
                $year++;
                $month = 1;
            } else {
                $month++;
            }
        }
        return $calData;
    }

    public function cal($year = null, $month = null) {
        $this->_defaultYearMonth($year, $month);
        $cal = $this->_buildCalendar($year, $month, 10);
        $this->load->view("calShow", array("calendar" => $cal));
    }

    private function _defaultYearMonth($year, $month) {
        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }
    }

    /* End of file home.php */
    /* Location: ./application/controllers/home.php */
}
