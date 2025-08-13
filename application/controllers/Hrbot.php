<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrbot extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'security'));
        $this->output->set_header('X-Content-Type-Options: nosniff');
    }

    public function index()
    {
        $data = array(
            'judul' => 'HR Department Bot',
            'isi'   => 'hrbot_chat'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function ask()
    {
        // Expect POST 'message'
        $message = $this->input->post('message', TRUE);
        if (!$message) {
            return $this->_json(array(
                'success' => false,
                'reply' => 'Please type a question. For example: "How do I register for BPJS?"'
            ));
        }

        $reply = $this->generate_reply($message);

        return $this->_json(array(
            'success' => true,
            'reply'   => $reply
        ));
    }

    private function generate_reply($message)
    {
        $text = mb_strtolower(trim($message));

        // Knowledge base grouped by topics and keyword triggers
        $responses = $this->get_knowledge_base();
        $matched = array();

        foreach ($responses as $topicKey => $topic) {
            foreach ($topic['keywords'] as $kw) {
                if (mb_strpos($text, $kw) !== FALSE) {
                    $matched[$topicKey] = $topic; // prefer unique per topic
                    break;
                }
            }
        }

        if (!empty($matched)) {
            // If sub-intents inside a topic exist, try to pick the best answer
            $answers = array();
            foreach ($matched as $topic) {
                $topicAnswers = $this->select_topic_answers($text, $topic);
                $answers = array_merge($answers, $topicAnswers);
            }
            $answers = array_unique(array_filter($answers));
            if (!empty($answers)) {
                return implode("\n\n", $answers);
            }
        }

        // Try a secondary pass with generic cues
        if ($this->contains_any($text, array('help', 'bantuan', 'menu', 'fitur', 'what can you do'))) {
            return $this->menu_reply();
        }

        // Fallback
        return "I couldn’t find an exact match. Here are some things I can help with:\n\n" . $this->menu_reply();
    }

    private function select_topic_answers($text, $topic)
    {
        $answers = array();
        if (isset($topic['intents']) && is_array($topic['intents'])) {
            foreach ($topic['intents'] as $intent) {
                foreach ($intent['keywords'] as $kw) {
                    if (mb_strpos($text, $kw) !== FALSE) {
                        $answers[] = $intent['answer'];
                        // do not break; allow multiple sub-answers if query contains many cues
                        break;
                    }
                }
            }
        }
        // If nothing matched inside, return the topic summary if available
        if (empty($answers) && isset($topic['summary'])) {
            $answers[] = $topic['summary'];
        }
        return $answers;
    }

    private function get_knowledge_base()
    {
        // BPJS Health
        $bpjsSummary = "BPJS Health: registration via the intranet form; benefits include medical services, hospitalization, outpatient care, and preventive services for employees and family members.";
        $bpjs = array(
            'keywords' => array('bpjs', 'bpjs kesehatan', 'health insurance', 'kesehatan', 'bpjs health', 'asuransi'),
            'summary'  => $bpjsSummary,
            'intents'  => array(
                array(
                    'keywords' => array('register', 'registration', 'daftar', 'pendaftaran', 'enroll'),
                    'answer'   => "To register for BPJS Health, fill out the registration form on the company intranet. Benefits include medical services, hospitalization, outpatient care, and preventive health services for you and eligible family members."
                ),
                array(
                    'keywords' => array('change', 'update', 'perubahan', 'ubah', 'member data', 'family', 'keluarga', 'marriage', 'birth'),
                    'answer'   => "For changes to BPJS member data (e.g., marriage, birth), notify HR immediately with the updated information so we can process the change."
                ),
                array(
                    'keywords' => array('new employee', 'karyawan baru', 'otomatis', 'automatic'),
                    'answer'   => "New employees are automatically enrolled in BPJS Health upon joining. The membership card is typically issued within the first month."
                ),
                array(
                    'keywords' => array('check', 'status', 'keanggotaan', 'membership', 'cek'),
                    'answer'   => "Check your BPJS Health membership status on the BPJS website or mobile app using your membership number."
                )
            )
        );

        // Payroll
        $payrollSummary = "Payroll: processed on the last working day of each month. View pay slips via the employee portal. Report errors within 5 business days.";
        $payroll = array(
            'keywords' => array('payroll', 'gaji', 'salary', 'slip', 'payslip', 'pay slip', 'deduction', 'potongan'),
            'summary'  => $payrollSummary,
            'intents'  => array(
                array(
                    'keywords' => array('date', 'tanggal', 'processed', 'jadwal'),
                    'answer'   => "Payroll is processed on the last working day of each month. Deductions may include taxes, social security contributions, and other company-policy deductions."
                ),
                array(
                    'keywords' => array('slip', 'payslip', 'pay slip', 'lihat', 'view'),
                    'answer'   => "You can view your pay slips in the employee portal under the Payroll section."
                ),
                array(
                    'keywords' => array('error', 'kesalahan', 'complain', 'lapor', 'report'),
                    'answer'   => "Report payroll calculation errors within 5 business days of receiving your pay slip. Submit the correction form to HR via the portal."
                ),
                array(
                    'keywords' => array('component', 'komponen', 'allowance', 'tunjangan', 'deductions', 'potongan', 'insurance', 'asuransi', 'tax', 'pajak'),
                    'answer'   => "Salary components include base salary, allowances (e.g., transportation and meal), and deductions (e.g., taxes and insurance)."
                ),
                array(
                    'keywords' => array('increase', 'kenaikan', 'annual', 'tahunan', 'review', 'penilaian kinerja', 'performance'),
                    'answer'   => "Annual salary increases are based on performance evaluations by managers. Any changes are communicated during the annual review period."
                )
            )
        );

        // Attendance
        $attendanceSummary = "Attendance: mark attendance via the attendance system; report issues to HR/supervisor; leave requests at least 3 days in advance except emergencies.";
        $attendance = array(
            'keywords' => array('attendance', 'absen', 'absensi', 'leave', 'cuti', 'late', 'terlambat', 'absence', 'tidak hadir'),
            'summary'  => $attendanceSummary,
            'intents'  => array(
                array(
                    'keywords' => array('mark', 'tandai', 'absen', 'attendance system', 'how to'),
                    'answer'   => "Mark your attendance using the attendance management system. Exceptions for remote work or special circumstances should be communicated to HR."
                ),
                array(
                    'keywords' => array('cannot', 'can not', 'tidak bisa', 'masalah', 'issue', 'error'),
                    'answer'   => "If you cannot mark attendance, notify your supervisor or HR immediately so your attendance can be recorded."
                ),
                array(
                    'keywords' => array('correct', 'koreksi', 'perbaiki', 'ubah', 'records', 'rekam'),
                    'answer'   => "Attendance records can be corrected. Submit a request to HR with details of the error for correction."
                ),
                array(
                    'keywords' => array('leave', 'cuti', 'absence', 'izin', 'policy', 'kebijakan', 'advance'),
                    'answer'   => "Submit leave requests at least 3 days in advance (except emergencies). Unnotified absences may lead to disciplinary action."
                ),
                array(
                    'keywords' => array('late', 'terlambat', 'absent without notice', 'alpa', 'tanpa pemberitahuan'),
                    'answer'   => "If you are late or absent without notice, contact your supervisor as soon as possible. Repeated occurrences may result in disciplinary measures."
                )
            )
        );

        // HR Communication
        $commSummary = "HR communication: via direct emails, scheduled meetings, and the HR portal. Use these channels to submit inquiries or issues.";
        $communication = array(
            'keywords' => array('communication', 'komunikasi', 'report', 'lapor', 'concern', 'keluhan', 'feedback', 'saran', 'schedule', 'jadwal'),
            'summary'  => $commSummary,
            'intents'  => array(
                array(
                    'keywords' => array('process', 'proses', 'how'),
                    'answer'   => "HR communicates via direct emails, scheduled meetings, and the HR portal for inquiries or issues."
                ),
                array(
                    'keywords' => array('concern', 'keluhan', 'report', 'lapor'),
                    'answer'   => "Report work-related or personal concerns via HR email, the employee portal, or by scheduling a one-on-one meeting with HR."
                ),
                array(
                    'keywords' => array('feedback', 'saran', 'suggestion'),
                    'answer'   => "Provide feedback via the feedback form in the employee portal or during regular feedback sessions."
                ),
                array(
                    'keywords' => array('schedule', 'jadwal', 'change', 'ubah'),
                    'answer'   => "Request schedule changes through the HR portal with details and reasons for the request."
                )
            )
        );

        // Policies and wellness
        $policySummary = "Key policies: code of conduct, anti-discrimination, and workplace safety. Wellness programs and HR assistance are available via the intranet and HR contacts.";
        $policies = array(
            'keywords' => array('policy', 'policies', 'kebijakan', 'wellness', 'kesejahteraan', 'health screening', 'mental health', 'paperwork', 'dokumen', 'administrasi'),
            'summary'  => $policySummary,
            'intents'  => array(
                array(
                    'keywords' => array('key', 'utama', 'company', 'perusahaan', 'handbook'),
                    'answer'   => "Key company policies include the code of conduct, anti-discrimination policy, and workplace safety guidelines. See the employee handbook for details."
                ),
                array(
                    'keywords' => array('wellness', 'kesehatan', 'fitness', 'mental'),
                    'answer'   => "Employee wellness programs include health screenings, fitness classes, and mental health resources. Details are on the company intranet."
                ),
                array(
                    'keywords' => array('paperwork', 'dokumen', 'administrasi', 'bantuan'),
                    'answer'   => "For help with HR paperwork or administrative tasks, contact HR via email or phone for support."
                )
            )
        );

        // Additional features
        $featuresSummary = "I can remind you about payroll dates, attendance submissions, and BPJS deadlines; guide procedures; and point you to your portal data.";
        $features = array(
            'keywords' => array('reminder', 'pengingat', 'fitur', 'feature', 'procedure', 'prosedur', 'portal', 'data', 'support', 'bantuan'),
            'summary'  => $featuresSummary,
            'intents'  => array(
                array(
                    'keywords' => array('reminder', 'pengingat'),
                    'answer'   => "I can send reminders for payroll dates, attendance submissions, or BPJS registration deadlines."
                ),
                array(
                    'keywords' => array('procedure', 'prosedur', 'guide', 'panduan'),
                    'answer'   => "I provide guidance on HR procedures to help you navigate issues smoothly."
                ),
                array(
                    'keywords' => array('portal', 'employee portal', 'data', 'akses'),
                    'answer'   => "Check your payroll, leave balances, attendance records, and more through the employee portal."
                ),
                array(
                    'keywords' => array('support', 'real-time', 'segera', 'langsung'),
                    'answer'   => "I offer real-time assistance for HR-related concerns with quick answers and support."
                )
            )
        );

        return array(
            'bpjs'          => $bpjs,
            'payroll'       => $payroll,
            'attendance'    => $attendance,
            'communication' => $communication,
            'policies'      => $policies,
            'features'      => $features,
        );
    }

    private function menu_reply()
    {
        return "- BPJS Health: registration, benefits, changes, status\n- Payroll: dates, pay slips, errors, components, increases\n- Attendance: marking, issues, corrections, leave, lateness\n- HR Communication: process, concerns, feedback, schedule changes\n- Policies & Wellness: key policies, wellness programs, paperwork help\n- Bot Features: reminders, procedure guidance, portal data, real-time support";
    }

    private function contains_any($haystack, $needles)
    {
        foreach ($needles as $needle) {
            if (mb_strpos($haystack, $needle) !== FALSE) return TRUE;
        }
        return FALSE;
    }

    private function _json($payload)
    {
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
}