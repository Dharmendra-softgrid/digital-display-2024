<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Enquiries
class Admin extends Admin_controller {

    function __construct() {
        parent::__construct();

        $this->data['hear_about_options'] = array(
            '' => '',
            'google' => 'Google',
            //'google_ad' => 'Google Ad',
            'facebook' => 'Facebook',
            //'facebook_ad' => 'Facebook Ad',
            //'instagram_ad' => 'Instagram Ad',
            'instagram' => 'Instagram',
            'previous_vent' => 'Previous Event',
            'word_of_mouth' => 'Word of Mouth',
            'eventa' => 'Eventa',
            'office_christmas' => 'Office Christmas',
            'cpu' => 'CPU',
            'hosp_line' => 'Hosp Line',
        );
    }

    function index() {
        self::list_all();
    }

    function resend($id){
        $email = new Email_Log($id);

        $this->email->from($this->registry->get('email_from_email'), $this->registry->get('email_from_name'));
        $this->email->to($email->recipients);
        $this->email->subject($email->subject);
        $this->email->message($email->message);
        $this->email->mailtype = 'html';
        $this->email->activity = $email->activity;
        $this->email->party_id = $email->party_id;
        $this->email->enquiry_id = $email->enquiry_id;
        $this->email->delegate_id = $email->delegate_id;
        $this->email->send(true);

        $this->oi->add_success('The email has been resent to ' . $email->recipients);
        redirect('/admin/enquiries/email-log');
    }

    function email_log(){
     
        $conn = new mysqli('localhost', 'dcode_christmas_booking', 'la2Rbvx0i7(4', 'dcode_christmas_booking');
        $data = array();
        // if($conn)
        // {
             
            $sql = "SELECT * from email_logs order by id desc limit 5000";
            $query = $this->db->query($sql);
            $result = $query->result_array();

           // print_r($result);
            
            if (!empty($result)) {
              // output data of each row
             // while($row = $result->fetch_assoc()) {
                foreach($result as $row){
                $data_array = new stdClass();
                $data_array->id = $row['id'];
                $data_array->party_id = $row['party_id'];
                $data_array->enquiry_id = $row['enquiry_id'];
                $data_array->delegate_id = $row['delegate_id'];
                $data_array->date = $row['date'];
                $data_array->activity = $row['activity'];
                $data_array->subject = $row['subject'];
                $data_array->message = $row['message'];
                $data_array->recipients = $row['recipients'];
                $data_array->status = $row['status'];
                //echo "<pre>";print_r($data_array);exit;
                $data['emails'][] = $data_array;
              }
            }
        //     $conn->close();
        // }
        //echo "<pre>";print_r($data);exit;
        /*$emails = new Email_log();

        $this->data['emails'] = $emails->get();*/


  

        $this->template->title('Email Log')
            ->set_breadcrumb('Email Log')
            ->build('admin/email_log', $data);
    }

    function export(){
        $e = new Enquiry();
        $e->get();

        $e->csv_export($_SERVER['DOCUMENT_ROOT'] . '/downloads/exports/enquiries.csv');

        $this->load->helper('download');
        force_download('enquiries.csv', file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/downloads/exports/enquiries.csv'));
        redirect('/admin/enquiries/');
    }

    function list_all($filter = null)
    {
        $l = new Enquiry();

        if($filter){
            $this->data['filter'] = $filter;
        }

        $this->data['query_id'] = $this->session->userdata('party_query_id') ? : '0';

        if ($this->data['query_id']) {
            $this->search->load_query($this->data['query_id']);

            if ($this->input->get('status')) {
                $l->where('status', $this->input->get('status'));
            }

            $count = $l->result_count();

        } else {
            $count = $l->count();
        }

        $this->data['enquiries'] = $l->order_by('created', 'desc')->get();

        $this->template->title('Enquiries')
            ->set_breadcrumb('Enquiries')
            ->build('admin/list', $this->data);
    }

    function delete($l_id = null){
        $enquiry = new Enquiry($l_id);
        $enquiry->delete();
        redirect('/admin/enquiries/list-all');
    }

    function not_booked($enquiry_id){
        $enquiry = new Enquiry($enquiry_id);

        if($enquiry->exists()){
            $enquiry->dead = 1;
            $enquiry->save();

            $email = new Email_template();
            $email->where('key', 'enquiry_not_booked')->get();

            $data = [
                'leader' => $enquiry->leader,
                'event_date' => date('l jS F, Y', $enquiry->event->date_time),
                'size' => $enquiry->size,
                'price_std' => $enquiry->event->price_std,
                'price_vip' => $enquiry->event->price_vip,
                'venue_title' => $enquiry->event->venue->title,
                'venue_location' => $enquiry->event->venue->location,
                'venue_address_short' => $enquiry->event->venue->address_short,
                //'brochure_link' => '<a target="_blank" href="'.$enquiry->event->venue->brochure.'">here</a>'
                'brochure_link' => $enquiry->event->venue->brochure
            ];

            $email_content = $email->parse($data);

            $this->email->from($this->registry->get('email_from_email'), $this->registry->get('email_from_name'));
            $this->email->to($enquiry->email);
            $this->email->subject($email->subject);
            $this->email->message($email_content);
            $this->email->mailtype = 'html';
            $this->email->activity = $email->key;
            $this->email->enquiry_id = $enquiry->id;
            $this->email->send();

            $this->oi->add_success('The enquiry has been marked as "Not Booked"');
            redirect('/admin/enquiries');
        }else{
            $this->oi->add_error('That enquiry (ID: '.$enquiry_id.') does not exist');
            redirect('/admin/enquiries');
        }
    }

    function booked($enquiry_id){
        $enquiry = new Enquiry($enquiry_id);

        $levels = [
            'std',
            'std_ai',
            'std_ai_b',
            'vip',
            'vip_ai',
            'vip_ai_b',
            'super_vip',
            'super_vip_ai',
            'super_vip_ai_b',
        ];

        if($enquiry->exists()){

            $key = 'price_' . $levels[$enquiry->level];

            if(isset($enquiry->event->$key) && $enquiry->event->$key) {
                $cost = $enquiry->event->$key * $enquiry->size;
            } else {
                $this->oi->add_error('There is no valid price for this level at this event');
                redirect('/admin/enquiries/edit/' . $enquiry_id);
            }

            $_party = new Party();

            $_party->event_id = $enquiry->event_id;
            $_party->name = $enquiry->name;
            $_party->leader = $enquiry->leader;
            $_party->leader_email = $enquiry->email;
            $_party->leader_phone = $enquiry->phone;
            $_party->address = $enquiry->address;
            $_party->size = $enquiry->size;
            $_party->level = $enquiry->level;
            $_party->notes = $enquiry->notes;
            $_party->hear_about = $enquiry->hear_about;
            $_party->discount = $enquiry->discount;
            $_party->hotel_required = $enquiry->hotel_required;
            $_party->hotel_rooms = $enquiry->hotel_rooms;
            $_party->created = date('U');
            $_party->updated = date('U');
            $_party->converted = $enquiry->id;

            if($enquiry->reference) {
                $_party->reference = $enquiry->reference;
            }

            $_party->total_to_pay = ($cost - $enquiry->discount) * 100;
            $_party->balance = $_party->total_to_pay;
            $_party->generate_hash(true);
            $_party->save();

            if(!$enquiry->reference){
                $_party->reference = $_party->id;
                $_party->save();
            }

            $party = new Party($_party->id);

            $invoice = new Invoice();
            $invoice->party_id = $party->id;
            $invoice->description = 'Party Invoice';
            $invoice->amount = $party->total_to_pay;
            $invoice->remaining = $party->total_to_pay;
            $invoice->status = INVOICE_STATUS_UNPAID;
            $invoice->save();

            foreach($enquiry->email_logs as $log){
                $log->enquiry_id = 0;
                $log->party_id = $party->id;
                $log->save();
            }

            $enquiry->delete();

            $payment = new Payment();
            $payment->sendInitialInvoice($party, $party->event);

            $this->oi->add_success('The enquiry has been converted into a party');
            redirect('/admin/parties/edit/' . $party->id);

        }else{
            $this->oi->add_error('That enquiry (ID: '.$enquiry_id.') does not exist');
            redirect('/admin/enquiries');
        }
    }

    function enquiry($enquiry_id = null){
        $this->data['enquiry'] = new Enquiry($enquiry_id);
        $event = new Event();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if($this->form_validation->run()){
            $exists = $this->data['enquiry']->exists();
            $this->data['enquiry']->from_array($this->input->post());
            $this->data['enquiry']->save();
            $this->oi->add_success('The enquiry has been saved');

            if(!$exists) {
                $this->load->library('zoho');
                $this->zoho->insertRecordFromEnquiry($this->data['enquiry']->id);
                
                $this->send_enquiry_response_email($this->data['enquiry']->id);
                redirect('/admin/enquiries/edit/' . $this->data['enquiry']->id);
            }
        }

        $this->data['events'] = $event->dropdown();

        $this->assets->add_js('admin', 'enquiries.js', 'enquiries');

        $title = ($this->data['enquiry']->exists() ? 'View' : 'New') . ' Enquiry';

        $this->template->title('Enquiries')
           ->set_breadcrumb('Enquiries', 'enquiries/list-all')
           ->set_breadcrumb($title)
            ->build('admin/enquiry_form', $this->data);
    }

    function send_enquiry_response_email($enquiry_id){
        $enquiry = new Enquiry($enquiry_id);

        if($enquiry->exists()){

            $email = new Email_template();
            $email->where('key', 'enquiry_response_1')->get();

            $data = array(
                'enquiry_id' => $enquiry_id,
                'leader' => $enquiry->leader,
                'party_size' => $enquiry->size,
                'party_name' => $enquiry->name,
                'party_email' => $enquiry->email,
                'party_address' => $enquiry->address,
                'event_date' => date('jS F Y', $enquiry->event->date_time),
                'event_time' => date('H:i', $enquiry->event->date_time),
                'venue_title' => $enquiry->event->venue->title,
                'venue_address' => $enquiry->event->venue->address_short,
                'venue_location' => $enquiry->event->venue->location,
                '_venue_location' => strtolower($enquiry->event->venue->location),
                'venue_description' => $enquiry->event->venue->description,
                'price_std' => '&pound;'.($enquiry->event->price_std - ($enquiry->event->price_std / 6)),
                'price_vip' => '&pound;'.($enquiry->event->price_vip - ($enquiry->event->price_vip / 6)),
                'price_super_vip' => '&pound;'.($enquiry->event->price_super_vip - ($enquiry->event->price_super_vip / 6)),
                //'brochure_link' => '<a target="_blank" href="'.$enquiry->event->venue->brochure.'">here</a>',
                'brochure_link' => $enquiry->event->venue->brochure,
                'video_link' => '<a target="_blank" href="'.$enquiry->event->venue->video.'">here</a>',
            );

            if($enquiry->level >= 0 && $enquiry->level <= 2){
                $data['party_level'] = 'Standard';
            }else if($enquiry->level >= 3 && $enquiry->level <= 5){
                $data['party_level'] = 'VIP';
            }else if($enquiry->level >= 6 && $enquiry->level <= 8){
                $data['party_level'] = 'Super VIP';
            }else if($enquiry->level >= 9 && $enquiry->level <= 11){
                $data['party_level'] = 'Preferred Seating';
            }


            $email_content = $email->parse($data);
            $this->email->from($this->registry->get('email_from_email'), $this->registry->get('email_from_name'));
            $this->email->to($enquiry->email);

            //if($enquiry->event->venue_id == 2 /* Birmingham - All Inclusive */)
                //$this->email->subject('Your All Inclusive Christmas Party Enquiry');
            //else
                //$this->email->subject($email->subject);
            
            $this->email->subject($email->subject);
            $this->email->message($email_content);
            $this->email->enquiry_id = $enquiry->id;
            $this->email->activity = $email->key;
            $this->email->mailtype = 'html';

            $this->email->send();
        }
    }

}