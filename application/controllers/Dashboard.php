<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * ResourceRegistry3
 *
 * @package   RR3
 * @author    Middleware Team HEAnet <middleware-noc@heanet.ie>
 * @author    Janusz Ulanowski <janusz.ulanowski@heanet.ie>
 * @copyright 2012 HEAnet Limited (http://www.heanet.ie)
 * @license   MIT http://www.opensource.org/licenses/mit-license.php
 */


class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    private function isMigrationUptodate()
    {
        $this->load->config('migration');
        $targetVersion = config_item('migration_version');
        /**
         * @var models\Migration[] $migrations
         */
        $migrations = $this->em->getRepository("models\Migration")->findAll();
        $currentVersion = 0;
        foreach ($migrations as $v) {
            $currentVersion = $v->getVersion();
        }
        if ($currentVersion < $targetVersion) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        if (!$this->j_auth->logged_in()) {
            $data['content_view'] = 'staticpages_view';
            /**
             * @var $frontpage models\Staticpage
             */
            try {
                $frontpage = $this->em->getRepository("models\Staticpage")->findOneBy(array('pcode' => 'front_page', 'enabled' => true, 'ispublic' => true));
            } catch (Exception $e) {

                log_message('error', __METHOD__ . ' ' . $e);
                show_error('Internal server error', 500);
            }
            if ($frontpage !== null) {
                $data['pcontent'] = jaggerTagsReplacer($frontpage->getContent());
                $data['ptitle'] = $frontpage->getTitle();
            }
            return $this->load->view('page', $data);
        }
        try {
            $this->load->library('zacl');
        } catch (Exception $e) {
            log_message('error', __METHOD__ . ' ' . $e);
            show_error('Internal server error', 500);
        }
        /**
         * @var models\Queue[] $queues
         */
        $queues = $this->em->getRepository("models\Queue")->findAll();
        $this->inqueue = count($queues);
        $acc = $this->zacl->check_acl('dashboard', 'read', 'default', '');
        $data['inqueue'] = $this->inqueue;
        if ($acc !== true) {
            $this->title = lang('title_accessdenied');
            $data['error'] = lang('rerror_nopermviewpage');
            $data['content_view'] = 'nopermission';
            return $this->load->view('page', $data);
        }
        if ($this->j_auth->isAdministrator()) {
            $isnotified = $this->session->userdata('alertnotified');
            if ($isnotified !== true) {
                $data['alertdashboard'] = array();
                $isSetupOn = $this->config->item('rr_setup_allowed');
                $isMigrationUptodate = $this->isMigrationUptodate();
                if ($isMigrationUptodate !== true) {
                    $data['alertdashboard'][] = 'Administration/System (migration) steps are required to make system uptodate';
                }
                if ($isSetupOn === true) {
                    $data['alertdashboard'][] = 'Jagger setup is still enabled. Please disable it in config file';
                }
                $this->session->set_userdata(array('alertnotified' => true));
            }
        }
        $this->title = lang('dashboard');
        $board = $this->session->userdata('board');
        if (!is_array($board)) {
            $curUser = $this->j_auth->current_user();
            /**
             * @var models\User $userObj
             */
            $userObj = $this->em->getRepository("models\User")->findOneBy(array('username' => $curUser));
            $board = $userObj->getBookmarks();
        }

        $bookmarList = $this->genBookmarkList($board);
        $data['idps'] = $bookmarList['idps'];
        $data['sps'] = $bookmarList['sps'];
        $data['feds'] = $bookmarList['feds'];
        $data['titlepage'] = lang('quick_access');
        $data['content_view'] = 'default_body';
        $this->load->view('page', $data);

    }

    private function genBookmarkList($board)
    {
        $idps = array();
        $sps = array();
        $feds = array();
        $baseurl = base_url();
        if (array_key_exists('idp', $board) && is_array($board['idp'])) {
            foreach ($board['idp'] as $key => $value) {
                $idps[$key] = '<a href="' . $baseurl . 'providers/detail/show/' . $key . '">' . $value['name'] . '</a><br /> <small>' . $value['entity'] . '</small>';
            }
        }
        if (array_key_exists('sp', $board) && is_array($board['sp'])) {
            foreach ($board['sp'] as $key => $value) {
                $sps[$key] = '<a href="' . $baseurl . 'providers/detail/show/' . $key . '">' . $value['name'] . '</a><br /><small>' . $value['entity'] . '</small>';
            }
        }
        if (array_key_exists('fed', $board) && is_array($board['fed'])) {
            foreach ($board['fed'] as $key => $value) {
                $feds[$key] = '<a href="' . $baseurl . 'federations/manage/show/' . $value['url'] . '">' . $value['name'] . '</a>';
            }
        }

        $result = array(
            'idps' => $idps,
            'sps' => $sps,
            'feds' => $feds
        );
        return $result;
    }

}
