class PHP_Email_Form {
    private $ajax = false;
    private $to;
    private $from_name;
    private $from_email;
    private $subject;
    private $smtp = array();
    private $messages = array();

    public function __construct() {
        $this->ajax = true;
    }

    public function to($email) {
        $this->to = $email;
    }

    public function from_name($name) {
        $this->from_name = $name;
    }

    public function from_email($email) {
        $this->from_email = $email;
    }

    public function subject($subject) {
        $this->subject = $subject;
    }

    public function smtp(array $smtp_array) {
        $this->smtp = $smtp_array;
    }

    public function add_message($name, $type) {
        $this->messages[] = array('name' => $name, 'type' => $type);
    }

    public function send() {
        try {
            // Logic to send email
            $this->to($this->to);
            $this->from_name($this->from_name);
            $this->from_email($this->from_email);
            $this->subject($this->subject);

            $smtp = new PHPSmtpClient();
            $smtp->connect($this->smtp['host'], $this->smtp['port']);
            $smtp->login($this->smtp['username'], $this->smtp['password']);
            $smtp->sendMail($this->to, $this->from_name, $this->subject, $this->messages);

            $this->add_message('Email sent successfully', 'success');
        } catch (Exception $e) {
            $this->add_message('Error sending email: ' . $e->getMessage(), 'error');
        }
    }
}
