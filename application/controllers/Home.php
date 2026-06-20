<?php


class Home extends CI_Controller
{
    public function index()
    {

        $data = [];

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/index', $data );
        $this->load->view( 'layout/new/footer', $data );

    }

    public function app_features()
    {
        $data = [
            'title' => 'App Features',
            'hero_img' => "backend/images/Slicing/IMG/app-features.jpg"
        ];

        $features = [
            [
                'img' => 'backend/images/Slicing/App/homework.png',
                'name' => 'HOMEWORK'
            ],
            [
                'img' => 'backend/images/Slicing/App/position.png',
                'name' => 'POSITIONS'
            ],
            [
                'img' => 'backend/images/Slicing/App/result.png',
                'name' => 'RESULTS'
            ],
            [
                'img' => 'backend/images/Slicing/App/timetable.png',
                'name' => 'TIMETABLE'
            ],
            [
                'img' => 'backend/images/Slicing/App/datesheet.png',
                'name' => 'DATESHEET'
            ],
            [
                'img' => 'backend/images/Slicing/App/pay.png',
                'name' => 'PAY'
            ],
            [
                'img' => 'backend/images/Slicing/App/assessment.png',
                'name' => 'ASSESSMENT'
            ],
            [
                'img' => 'backend/images/Slicing/App/news.png',
                'name' => 'NEWS'
            ],
            [
                'img' => 'backend/images/Slicing/App/event.png',
                'name' => 'EVENT'
            ],
            [
                'img' => 'backend/images/Slicing/App/discussion.png',
                'name' => 'DISCUSSION'
            ],
            [
                'img' => 'backend/images/Slicing/App/meeting.png',
                'name' => 'MEETING'
            ],
            [
                'img' => 'backend/images/Slicing/App/caution.png',
                'name' => 'CAUTION'
            ]
        ];

        $data['features'] = $features;

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/features', $data );
        $this->load->view( 'layout/new/footer', $data );
    }

    public function web_features()
    {
        $data = [
            'title' => 'Web Features',
            'hero_img' => 'backend/images/Slicing/IMG/web-features.jpg'
        ];

        $features = [
            [
                'img' => 'backend/images/Slicing/Web-Feature/student-management.png',
                'name' => 'STUDENT MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/attendance-management.png',
                'name' => 'ATTENDANCE MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/accounting-management.png',
                'name' => 'ACCOUNTING MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/academic-management-2.png',
                'name' => 'EXAMINATION MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/accounting-management.png',
                'name' => 'ACADEMICS MANGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/download-center.png',
                'name' => 'DOWNLOAD CENTER'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/multi-login.png',
                'name' => 'MULTI-LOGIN ENVIRONMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/report-management.png',
                'name' => 'REPORT MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/hostel-management.png',
                'name' => 'HOSTEL MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/media.png',
                'name' => 'Media'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/library-management.png',
                'name' => 'LIBRARY MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Web-Feature/transport-management.png',
                'name' => 'TRANSPORT MANAGEMENT'
            ]
        ];

        $data['features'] = $features;

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/features', $data );
        $this->load->view( 'layout/new/footer', $data );
    }

    public function benefits()
    {
        $data = [
            'title' => 'Benefits',
            'hero_img' => 'backend/images/Slicing/IMG/benifits.jpg'
        ];

        $features = [
            [
                'img' => 'backend/images/Slicing/Serv/no-unneccessary-features.png',
                'name' => 'NO UNNECESSARY FEATURES'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/paperless-environment.png',
                'name' => 'PAPERLESS ENVIRONMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/student-assessment.png',
                'name' => 'STUDENT ASSESSMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/new-branch-addition.png',
                'name' => 'NEW BRANCH ADDITION IN 5 MINUTES'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/printer-friendly.png',
                'name' => 'PRINTER FRIENDLY'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/no-hidden-charges.png',
                'name' => 'NO HIDDEN CHARGES'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/free-regular-updates.png',
                'name' => 'FREE REGULAR UPDATES'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/inventory-system.png',
                'name' => 'INVENTORY SYSTEMS'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/support.png',
                'name' => '24/7 SUPPORT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/brand-building.png',
                'name' => 'BRAND BUILDING'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/time-saving.png',
                'name' => 'TIME SAVING'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/stay-organized.png',
                'name' => 'STAY ORGANIZED'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/cost-saving.png',
                'name' => 'COST SAVING'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/user-friendly.png',
                'name' => 'USER FRIENDLY'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/increased-efficiency.png',
                'name' => 'INCREASED EFFICIENCY'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/management-to-development.png',
                'name' => 'MANAGEMENT TO DEVELOPMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/password-management.png',
                'name' => 'PASSWORD MANAGEMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/accessible-anywhere.png',
                'name' => 'ACCESSIBLE ANYWHERE'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/empowering-teachers.png',
                'name' => 'EMPOWERING TEACHERS'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/language-support.png',
                'name' => 'LANGUAGE SUPPORT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/file-attachment.png',
                'name' => 'FILE ATTACHMENT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/multi-level-user.png',
                'name' => 'MULTI-LEVEL USER AUTHORIZATION'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/courses-batches.png',
                'name' => 'COURSES AND BATCHES SUPPORT'
            ],
            [
                'img' => 'backend/images/Slicing/Serv/data-privacy.png',
                'name' => 'DATA PRIVACY'
            ]
        ];

        $data['features'] = $features;

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/features', $data );
        $this->load->view( 'layout/new/footer', $data );
    }

    public function get_started_process()
    {

        $this->form_validation->set_rules( 'first_name', '', 'trim|required' );
        $this->form_validation->set_rules( 'last_name', '', 'trim|required' );
        $this->form_validation->set_rules( 'email', '', 'trim|required|valid_email' );
        $this->form_validation->set_rules( 'phone', '', 'trim|required' );
        $this->form_validation->set_rules( 'institute_name', '', 'trim' );
        $this->form_validation->set_rules( 'branch_no', '', 'trim' );
        $this->form_validation->set_rules( 'hol', 'Head office location', 'trim' );
        $this->form_validation->set_rules( 'exam_structure', '', 'trim' );
        $this->form_validation->set_rules( 'existing_website', '', 'trim' );
        $this->form_validation->set_rules( 'website_type', '', 'trim' );
        $this->form_validation->set_rules( 'mess_query', '', 'trim' );

        if ( $this->form_validation->run() == false ) {

            $this->get_started();

        } else {

            $first_name = $this->input->post( 'first_name' );
            $last_name = $this->input->post( 'last_name' );
            $email = $this->input->post( 'email' );
            $phone = $this->input->post( 'phone' );
            $institute_name = $this->input->post( 'institute_name' );
            $branch_no = $this->input->post( 'branch_no' );
            $hol = $this->input->post( 'hol' );
            $exam_structure = $this->input->post( 'exam_structure' );
            $existing_website = $this->input->post( 'existing_website' );
            $website_type = $this->input->post( 'website_type' );
            $mess_query = $this->input->post( 'mess_query' );

            $html = "<!dotype html><html><head></head><body>";
            $html .= "<h4>Account request received</h4>";
            $html .= "<div>First name: {$first_name}<br>Last name: {$last_name}<br>Email: {$email}<br>Phone no. {$phone}<br>Institute name: {$institute_name}<br>Number of branches: {$branch_no}<br>Head Office location: {$hol}<br>Exam structure: {$exam_structure}<br>Existing website: {$existing_website}<br>Website type: {$website_type}<br>Message/Query: {$mess_query}</div>";
            $html .= "</body></html>";

            $this->load->library( 'email' );
            $config['protocol'] = 'mail';
            $config['mailtype'] = 'html';
            $this->email->initialize( $config );

            $this->email->from( 'info@pluggedin.net' );
            $this->email->to( 'urwatilwusqa@gmail.com' );

            $this->email->subject( 'New account request' );
            $this->email->message( $html );

            $this->email->send();

            $this->session->set_flashdata( 'msg', "Your request has been received and being processed. We'll contact you soon." );
            redirect( 'home/get_started' );

        }

    }

    public function get_started()
    {

        $data = [];

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/get_started', $data );
        $this->load->view( 'layout/new/footer', $data );

    }

    public function pricing()
    {
        $data = [];

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/pricing', $data );
        $this->load->view( 'layout/new/footer', $data );
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'hero_img' => 'backend/images/Slicing/IMG/contact.jpg'
        ];

        $contacts = [
            [
                'img' => "backend/images/Slicing/Contact/phone.png",
                'name' => "+92 333 3484848"
            ],
            [
                'img' => "backend/images/Slicing/Contact/envelop.png",
                'name' => "info@tecnogat.com"
            ],
            [
                'img' => "backend/images/Slicing/Contact/web.png",
                'name' => "www.tecnogat.com"
            ],
            [
                'img' => "backend/images/Slicing/Contact/location_marker.png",
                'name' => "Office no. 118-119, Second Floor Kohinoor One Plaza, Faisalabad"
            ]
        ];

        $data['contacts'] = $contacts;

        $this->load->view( 'layout/new/header', $data );
        $this->load->view( 'home/contact', $data );
        $this->load->view( 'layout/new/footer', $data );
    }

}