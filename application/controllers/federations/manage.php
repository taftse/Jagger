<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * ResourceRegistry3
 * 
 * @package     RR3
 * @author      Middleware Team HEAnet 
 * @copyright   Copyright (c) 2012, HEAnet Limited (http://www.heanet.ie)
 * @license     MIT http://www.opensource.org/licenses/mit-license.php
 *  
 */

/**
 * Manage Class
 * 
 * @package     RR3
 * @author      Janusz Ulanowski <janusz.ulanowski@heanet.ie>
 */

/**
 * @todo add permission to check for public or private perms
 */
class Manage extends MY_Controller {

    private $tmp_providers;

    function __construct()
    {
        parent::__construct();
        $loggedin = $this->j_auth->logged_in();
        $this->current_site = current_url();
        if (!$loggedin)
        {
            $this->session->set_flashdata('target', $this->current_site);
            redirect('auth/login', 'refresh');
        }
        $this->load->library('table');
        $this->load->helper(array('cert'));
        $this->session->set_userdata(array('currentMenu' => 'federation'));
        /**
         * @todo add check loggedin
         */
        $this->tmp_providers = new models\Providers;
        $this->load->library('zacl');
    }

    function index()
    {
        $resource = 'fed_list';
        $federations = $this->em->getRepository("models\Federation")->findAll();
        $i = 0;
        $frow = array();
        foreach ($federations as $f)
        {
            if ($f->getPublic())
            {
                $public = "public";
            }
            else
            {
                $public = "<span class=\"orange\">not public</span>";
            }
            if ($f->getActive())
            {
                $active = "active";
            }
            else
            {
                $active = "<span class=\"alert\">inactive</span>";
            }

            if ($f->getLocal())
            {
                $local = "local";
            }
            else
            {
                $local = "<span class=\"orange\">external<span>";
            }



            $frow[$i++] = array(
                $active,
                anchor(current_url() . "/show/" . base64url_encode($f->getName()), $f->getName()),
                $f->getUrn(),
                $public,
                $local,
                $f->getDescription(),
            );
        }
        $this->title = 'Federations list';
        $data['fedlist'] = $frow;
        $data['content_view'] = 'federation/list_view.php';
        $this->load->view('page', $data);
    }

    function showcontactlist($fed_name,$type=NULL)
    {
       $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
       if (empty($federation))
       {
           show_error('Federation not found', 404);
           return;
       }
       $fed_members = $federation->getMembers();
       $members_ids = array();
       if(!empty($type) )
       {
           if($type == 'idp')
           {
               foreach($fed_members as $m)
               {
                   if($m->getType() == 'IDP' or $m->getType() == 'BOTH')
                   {
                       $members_ids[] = $m->getId();
                   }
               }
           }
           elseif($type == 'sp')
           {
               foreach($fed_members as $m)
               {
                   if($m->getType() == 'SP' or $m->getType() == 'BOTH')
                   {
                       $members_ids[] = $m->getId();
                   }
               }
           }
           else
           {
               show_error(404);
           }
      
      }
      else
      {
          foreach($fed_members as $m)
          {
              $members_ids[] = $m->getId();
          }
      } 

      if(count($members_ids) == 0)
      {   
           show_error('federation has no members yet',404);
           return;
      }   

      $contacts = $this->em->getRepository("models\Contact")->findBy(array('provider'=>$members_ids)) ;
      $cont_array = array(); 
      foreach($contacts as $c)
      {
        $cont_array[$c->getEmail()] = $c->getFullName();
      }
      $this->output->set_content_type('text/plain');
      $result = "";
      foreach($cont_array as $key=>$value)
      {
          $result .= $key."    <".trim($value).">\n";
      }
      $data['contactlist']= $result;
      $this->load->helper('download');
      $filename = 'federationcontactlist.txt';
      force_download($filename,$result,'text/plain');

    }

    function show($fed_name)
    {
        $this->load->library('show_element');
        $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
        if (empty($federation))
        {
            show_error('Federation not found', 404);
            return;
        }
        $resource = $federation->getId();
        $group = 'federation';
        $owner = $federation->getOwner();
        $matched_owner = FALSE;
        if ($owner == $this->j_auth->current_user())
        {
            $matched_owner = TRUE;
        }
        if (!empty($owner) && $matched_owner)
        {
            $has_read_access = TRUE;
            $has_write_access = TRUE;
        }
        else
        {
            $has_read_access = $this->zacl->check_acl('f_' . $resource, 'read', $group, '');
            $has_write_access = $this->zacl->check_acl('f_' . $resource, 'write', $group, '');
        }
        $has_addbulk_access = $this->zacl->check_acl('f_' . $resource, 'addbulk', $group, '');
        $has_manage_access = $this->zacl->check_acl('f_' . $resource, 'manage', $group, '');
        $this->title = 'Federation detail';

        if (!$has_read_access && ($federation->getPublic() === FALSE))
        {
            $data['content_view'] = 'nopermission';
            $data['error'] = "You have no access to display details for this federation";
            $this->load->view('page', $data);
            return;
        }
        $data['federation_name'] = $federation->getName();
        $data['federation_urn'] = $federation->getUrn();
        $data['federation_desc'] = $federation->getDescription();

        $data['federation_is_active'] = $federation->getActive();
        $federation_members = $federation->getMembers()->getValues();
        $required_attributes = $federation->getAttributesRequirement()->getValues();



        $data['meta_link'] = base_url() . "metadata/federation/" . base64url_encode($data['federation_name']) . "/metadata.xml";
        $data['meta_link_signed'] = base_url() . "signedmetadata/federation/" . base64url_encode($data['federation_name']) . "/metadata.xml";
        $data['content_view'] = 'federation/federation_show_view';
        $data['tbl'][] = array('data' => array('data' => 'Basic Information', 'class' => 'highlight', 'colspan' => 2));
        if (empty($data['federation_is_active']))
        {
            $data['tbl'][] = array('<span class="alert">warning!</span>', '<b>Federation is inactive</b>');
        }
        $data['tbl'][] = array('Federation name', $federation->getName());
        $data['tbl'][] = array('Federation URN', $federation->getUrn());
        $data['tbl'][] = array('Description', htmlentities($federation->getDescription()));
        $data['tbl'][] = array('Terms Of Use', htmlentities($federation->getTou()));
        $data['tbl'][] = array('Federation owner/creator', htmlentities($federation->getOwner()));
        $idp_contactlist = anchor(base_url().'federations/manage/showcontactlist/'.$fed_name.'/idp', 'Contact list of idp members');
        $sp_contactlist = anchor(base_url().'federations/manage/showcontactlist/'.$fed_name.'/sp', 'Contact list of sp members');
        $all_contactlist = anchor(base_url().'federations/manage/showcontactlist/'.$fed_name.'', 'Contact list of all federation members');
        $data['tbl'][] = array('Download contacts list in txt format', $idp_contactlist.'<br />'.$sp_contactlist.'<br />'.$all_contactlist);
        

        $image_link = "<img src=\"" . base_url() . "images/icons/pencil-field.png\"/>";
        $edit_attributes_link = "<span><a href=\"" . base_url() . "manage/attribute_requirement/fed/" . $federation->getId() . " \" class=\"edit\">" . $image_link . "</a></span>";
        if (!$has_write_access)
        {
            $edit_attributes_link = '';
        }
        $data['tbl'][] = array('data' => array('data' => 'Required attributes' . $edit_attributes_link . '', 'class' => 'highlight', 'colspan' => 2));
        if (!$has_write_access)
        {
            $data['tbl'][] = array('data' => array('data' => '<small><div class="notice">no access to edit</div></small>', 'colspan' => 2));
        }
        foreach ($required_attributes as $key)
        {
            $data['tbl'][] = array($key->getAttribute()->getName(), $key->getStatus() . "<br /><i>(" . $key->getReason() . ")</i>");
        }
        $data['tbl'][] = array('data' => array('data' => 'Membership management', 'class' => 'highlight', 'colspan' => 2));
        if (!$has_addbulk_access)
        {
            $data['tbl'][] = array('data' => array('data' => '<small><div class="notice">no access to bulk operations</div></small>', 'colspan' => 2));
        }
        else
        {
            $data['tbl'][] = array('IDPs', 'Add new Identity Providers to federation without invitation' . anchor(base_url() . 'federations/manage/addbulk/' . $fed_name . '/idp', '<img src="' . base_url() . 'images/icons/arrow.png"/>'));

            $data['tbl'][] = array('SPs', 'Add new Service Providers to federation without invitation' . anchor(base_url() . 'federations/manage/addbulk/' . $fed_name . '/sp', '<img src="' . base_url() . 'images/icons/arrow.png"/>'));
        }
        if ($has_write_access)
        {
            $data['tbl'][] = array('Invitation', 'Invite Identity/Service Provider to join your federation' . anchor(base_url() . 'federations/manage/inviteprovider/' . $fed_name . '', '<img src="' . base_url() . 'images/icons/arrow.png"/>'));
            $data['tbl'][] = array('Remove member', 'Remove Identity/Service Provider from your your federation' . anchor(base_url() . 'federations/manage/removeprovider/' . $fed_name . '', '<img src="' . base_url() . 'images/icons/arrow.png"/>'));
        }
        else
        {
            $data['tbl'][] = array('data' => array('data' => '<small><div class="notice">no access to invite other providers</div></small>', 'colspan' => 2));
        }

        
        $data['tbl'][] = array('data' => array('data' => 'Access management', 'class' => 'highlight', 'colspan' => 2));
      
        if($has_manage_access)
        {
             $data['tbl'][] = array('data' => array('data' => 'Access management ' .anchor(base_url().'manage/access_manage/federation/'.$resource,'<img src="'.base_url().'images/icons/arrow.png"/>'), 'colspan' => 2));
             
        } 
        else
        {
             $data['tbl'][] = array('data' => array('data' => '<small><div class="notice">no access to manage permissions</div></small>', 'colspan' => 2));
       }
        $data['tbl'][] = array('data' => array('data' => 'Metadata', 'class' => 'highlight', 'colspan' => 2));
        if (empty($data['federation_is_active']))
        {
            $data['tbl'][] = array('Federation metadata public link (unsigned)', "<span class=\"alert\">is inactive</span>" . anchor($data['meta_link']));
            $data['tbl'][] = array('Federation metadata public link (signed)', "<span class=\"alert\">is inactive</span>" . anchor($data['meta_link_signed']));
        }
        else
        {
            $table_of_members = $this->show_element->IdPMembersToTable($federation_members);
            $data['tbl'][] = array('Federation metadata public link (unsigned)', $data['meta_link'] . " " . anchor_popup($data['meta_link'], '<img src="' . base_url() . 'images/icons/arrow.png"/>'));
            $data['tbl'][] = array('Federation metadata public link (signed)', $data['meta_link_signed'] . " " . anchor_popup($data['meta_link_signed'], '<img src="' . base_url() . 'images/icons/arrow.png"/>'));
            $data['tbl'][] = array('data' => array('data' => 'Identity Providers Members', 'class' => 'highlight', 'colspan' => 2));
            $data['tbl'][] = array('data' => array('data' => $table_of_members['IDP'], 'colspan' => 2));
            $data['tbl'][] = array('data' => array('data' => 'Service Provider Members', 'class' => 'highlight', 'colspan' => 2));
            $data['tbl'][] = array('data' => array('data' => $table_of_members['SP'], 'colspan' => 2));
            $data['tbl'][] = array('data' => array('data' => 'Members who are IdPs and SPs', 'class' => 'highlight', 'colspan' => 2));
            $data['tbl'][] = array('data' => array('data' => $table_of_members['BOTH'], 'colspan' => 2));
        }
        $this->load->view('page', $data);
    }

    function members($fed_name)
    {
        $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
        if (empty($federation))
        {
            show_error('Federation not found', 404);
        }
        $resource = $federation->getId();
        $action = 'read';
        $group = 'federation';
        $has_read_access = $this->zacl->check_acl($resource, $action, $group, '');
        if (!$has_read_access)
        {
            $data['content_view'] = 'nopermission';
            $data['error'] = "No access to view federations list";
            $this->load->view('page', $data);
            return;
        }
        $data['federation_name'] = $federation->getName();
        $data['metadata_link'] = base_url() . "metadata/federation/" . base64url_encode($data['federation_name']);
        $members = $federation->getMembers()->getValues();
        $i = 0;
        foreach ($members as $m)
        {
            $type = strtolower($m->getType());
            $id = $m->getId();
            $link = base_url() . "providers/provider_detail/" . $type . "/" . $id;
            $data['m_list'][$i]['name'] = $m->getName();
            $data['m_list'][$i]['entity'] = $m->getEntityId();
            $data['m_list'][$i++]['link'] = anchor($link, '&gt;&gt');
        }
        $this->title = 'Federation members';
        $data['content_view'] = 'federation/federation_members_view';
        $this->load->view('page', $data);
    }

    function addbulk($fed_name, $type, $message = null)
    {
        $form_elements = array();

        $this->load->helper('form');
        if ($type == 'idp')
        {
            $this->load->library('show_element');
            $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
            if (empty($federation))
            {
                show_error('Federation not found', 404);
            }
            $resource = $federation->getId();
            $action = 'addbulk';
            $group = 'federation';
            $has_addbulk_access = $this->zacl->check_acl($resource, $action, $group, '');
            if (!$has_addbulk_access)
            {
                $data['content_view'] = 'nopermission';
                $data['error'] = "No access ";
                $this->load->view('page', $data);
                return;
            }
            $data['federation_name'] = $federation->getName();
            $data['federation_urn'] = $federation->getUrn();
            $data['federation_desc'] = $federation->getDescription();

            $data['federation_is_active'] = $federation->getActive();
            $federation_members = $federation->getMembers();
            $providers = $this->tmp_providers->getIdps();
            $memberstype = 'idp';
            $data['memberstype'] = $memberstype;
        }
        elseif ($type == 'sp')
        {
            $this->load->library('show_element');
            $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
            if (empty($federation))
            {
                show_error('Federation not found', 404);
            }
            $data['federation_name'] = $federation->getName();
            $data['federation_urn'] = $federation->getUrn();
            $data['federation_desc'] = $federation->getDescription();

            $data['federation_is_active'] = $federation->getActive();
            $federation_members = $federation->getMembers();
            $providers = $this->tmp_providers->getSps();
            $data['memberstype'] = 'sp';
        }
        else
        {
            log_message('error', $this->mid . 'type is expected to be sp or idp but ' . $type . 'given');
            show_error($this->mid . 'wrong type', 404);
        }
        //$rest_providers = array();
        foreach ($providers as $i)
        {
            if (!$federation_members->contains($i))
            {
                //$rest_providers[] = $i->getEntityId();
                $checkbox = array(
                    'id' => 'member[' . $i->getId() . ']',
                    'name' => 'member[' . $i->getId() . ']',
                    'value' => 1,);
                $form_elements[] = array(
                    'name' => $i->getName() . ' (' . $i->getEntityId() . ')',
                    'box' => form_checkbox($checkbox),
                );
            }
        }
        $data['content_view'] = 'federation/bulkadd_view';
        $data['form_elements'] = $form_elements;
        $data['fed_encoded'] = $fed_name;
        $data['message'] = $message;
        $this->load->view('page', $data);
    }

    public function bulkaddsubmit()
    {
        $message = null;
        $fed_name = $this->input->post('fed');
        $memberstype = $this->input->post('memberstype');
        $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
        if (!empty($federation))
        {
            $m = $this->input->post('member');
            if (!empty($m) && is_array($m) && count($m) > 0)
            {
                $m_keys = array_keys($m);
                if ($memberstype == 'idp')
                {
                    $new_members = $this->em->getRepository("models\Provider")->findBy(array('type' => array('IDP', 'BOTH'), 'id' => $m_keys));
                }
                elseif ($memberstype == 'sp')
                {
                    $new_members = $this->em->getRepository("models\Provider")->findBy(array('type' => array('SP', 'BOTH'), 'id' => $m_keys));
                }
                else
                {
                    log_message('error', $this->mid . 'missed or wrong membertype while adding new members to federation');
                    show_error($this->mid . 'Missed members type', 503);
                }
                foreach ($new_members as $nmember)
                {
                    $nmember->setFederation($federation);
                    $this->em->persist($nmember);
                }
                $this->em->flush();
                $message = "<div class=\"success\">New members have been added to federation</div>";
            }
            else
            {
                $message = "<div class=\"alert\">no " . $memberstype . " were selected</div>";
            }
        }
        else
        {
            show_error('federation not found', 404);
        }
        return $this->addbulk($fed_name, $memberstype, $message);
    }

    private function _invite_submitvalidate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('provider', 'Provider', 'required|numeric|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
        return $this->form_validation->run();
    }

    private function _remove_submitvalidate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('provider', 'Provider', 'required|numeric|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
        return $this->form_validation->run();
    }

    public function inviteprovider($fed_name)
    {
        $this->load->library('show_element');
        $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
        if (empty($federation))
        {
            show_error('Federation not found', 404);
        }
        $resource = $federation->getId();
        $owner = $federation->getOwner();
        $matched_owner = FALSE;
        if ($owner == $this->j_auth->current_user())
        {
            $matched_owner = TRUE;
        }
        if (!empty($owner) && $matched_owner)
        {
            $has_write_access = TRUE;
        }
        else
        {
            $has_write_access = $this->zacl->check_acl('f_' . $resource, 'write', 'federation', '');
        }
        if (!$has_write_access)
        {
            show_error('no access', 403);
            return;
        }
        $data['subtitle'] = 'Federation: ' . $federation->getName() . ' ' . anchor(base_url() . 'federations/manage/show/' . base64url_encode($federation->getName()), '<img src="' . base_url() . 'images/icons/arrow-in.png"/>');
        log_message('debug', '_________Before validation');
        if ($this->_invite_submitvalidate() === TRUE)
        {
            log_message('debug', 'Invitation form is valid');
            $provider_id = $this->input->post('provider');
            $message = $this->input->post('message');
            $inv_member = $this->tmp_providers->getOneById($provider_id);
            if (empty($inv_member))
            {
                $data['error'] = "Provider doesn\'t exist";
            }
            else
            {
                $inv_member_federations = $inv_member->getFederations();
                if ($inv_member_federations->contains($federation))
                {
                    $data['error'] = "Provider already member of " . $federation->getName();
                }
                else
                {
                    $this->load->library('approval');
                    /* create request in queue with flush */
                    $add_to_queue = $this->approval->invitationProviderToQueue($federation, $inv_member, 'Join');
                    if ($add_to_queue)
                    {
                        $mail_recipients = array();
                        $mail_sbj = "Invitation to join federation: " . $federation->getName();
                        $mail_body = "Hi,\r\nJust few moments ago Administator of federation \"" . $federation->getName() . "\"\r\n";
                        $mail_body .= "sent request to Administrator of Provider: \"" . $inv_member->getName() . "(" . $inv_member->getEntityId() . ")\"\r\n";
                        $mail_body .= "to join his federation.\r\n";
                        $mail_body .= "To accept or reject this request please go to Resource Registry\r\n";
                        $mail_body .= base_url() . "reports/awaiting\r\n";
                        $mail_body .= "\r\n\r\n======= additional message attached by requestor ===========\r\n";
                        $mail_body .= $message . "\r\n";
                        $mail_body .= "=============================================================\r\n";

                        $contacts = $inv_member->getContacts();
                        if (!empty($contacts))
                        {
                            foreach ($contacts as $cnt)
                            {
                                $mail_recipients[] = $cnt->getEmail();
                            }
                        }
                        $a = $this->em->getRepository("models\AclRole")->findOneBy(array('name' => 'Administrator'));
                        $a_members = $a->getMembers();
                        foreach ($a_members as $m)
                        {
                            $mail_recipients[] = $m->getEmail();
                        }
                        $mail_recipients = array_unique($mail_recipients);
                        $this->load->library('email_sender');

                        $this->email_sender->send($mail_recipients, $mail_sbj, $mail_body);
                    }
                }
            }
        }
        $current_members = $federation->getMembers();
        $local_providers = $this->tmp_providers->getLocalProviders();
        $list = array('IDP' => array(), 'SP' => array(), 'BOTH' => array());
        foreach ($local_providers as $l)
        {
            if (!$current_members->contains($l))
            {
                $name = $l->getName();
                if(empty($name))
                {
                    $name = $l->getEntityId();
                }
                $list[$l->getType()][$l->getId()] = $name;
            }
        }
        $list = array_filter($list);
        if (count($list) > 0)
        {
            $data['providers'] = $list;
        }
        else
        {
            $data['error_message'] = 'No providers available';
        }
        $data['fedname'] = $federation->getName();
        $this->load->helper('form');

        $data['content_view'] = 'federation/invite_provider_view';
        $this->load->view('page', $data);
    }

    public function removeprovider($fed_name)
    {


        $federation = $this->em->getRepository("models\Federation")->findOneBy(array('name' => base64url_decode($fed_name)));
        if (empty($federation))
        {
            show_error('Federation not found', 404);
        }
        $resource = $federation->getId();
        $owner = $federation->getOwner();
        $matched_owner = FALSE;
        if ($owner == $this->j_auth->current_user())
        {
            $matched_owner = TRUE;
        }
        if (!empty($owner) && $matched_owner)
        {
            $has_write_access = TRUE;
        }
        else
        {
            $has_write_access = $this->zacl->check_acl('f_' . $resource, 'write', 'federation', '');
        }
        if (!$has_write_access)
        {
            show_error('no access', 403);
            return;
        }
        log_message('debug', '_________Before validation');
        if ($this->_remove_submitvalidate() === TRUE)
        {
            log_message('debug', 'Remove provider from fed form is valid');
            $provider_id = $this->input->post('provider');
            $message = $this->input->post('message');
            $inv_member = $this->tmp_providers->getOneById($provider_id);
            if (empty($inv_member))
            {
                $data['error_message'] = "Provider you selected doesn\'t exist";
            }
            else
            {
                if ($this->config->item('rr_rm_member_from_fed') === TRUE)
                {
                    $p_tmp = new models\AttributeReleasePolicies;
                    $arp_fed = $p_tmp->getFedPolicyAttributesByFed($inv_member, $federation);
                    if (!empty($arp_fed) && is_array($arp_fed) && count($arp_fed) > 0)
                    {
                        foreach ($arp_fed as $r)
                        {
                            $this->em->remove($r);
                        }
                        $rm_arp_msg = "Also existing attribute release policy for this federation has been removed<br/>";
                        $rm_arp_msg .="It means when in the future you join this federation you will need to set attribute release policy for it again<br />";
                    }
                    else
                    {
                        $rm_arp_msg = '';
                    }
                    $inv_member->removeFederation($federation);
                    $provider_name = $inv_member->getName();
                    if(empty($provider_name))
                    {
                        $provider_name = $inv_member->getEntityId();
                    }
                    $this->em->persist($inv_member);
                    $this->em->flush();
                    $spec_arps_to_remove = $p_tmp->getSpecCustomArpsToRemove($inv_member);
                    if(!empty($spec_arps_to_remove) && is_array($spec_arps_to_remove) and count($spec_arps_to_remove) > 0)
                    {
                        foreach($spec_arps_to_remove as $rp)
                        {
                             $this->em->remove($rp);
                        }
                        $this->em->flush();
                    }
                    $data['success_message'] = "You just removed provider <b>" . $provider_name . "</b> from federation: <b>" . $federation->getName() . "</b><br />";
                    $data['success_message'] .= $rm_arp_msg;
                    if($this->config->item('notify_if_provider_rm_from_fed') === TRUE)
                    {
                        $mail_recipients = array();
                        $mail_sbj = "\"".$provider_name."\" has been removed from federation \"".$federation->getName()."\"";
                        $mail_body = "Hi,\r\nJust few moments ago Administator of federation \"" . $federation->getName() . "\"\r\n"; 
                        $mail_body .= "just removed ".$provider_name ." (".$inv_member->getEntityId().") from hist federation\r\n";
                        if(!empty($message))
                        {
                             $mail_body .= "\r\n\r\n======= additional message attached by administrator ===========\r\n";
                             $mail_body .= $message . "\r\n";
                             $mail_body .= "=============================================================\r\n";
                        }
                        $contacts = $inv_member->getContacts();
                        if (!empty($contacts))
                        {
                            foreach ($contacts as $cnt)
                            {
                                $mail_recipients[] = $cnt->getEmail();
                            }
                        }
                        $a = $this->em->getRepository("models\AclRole")->findOneBy(array('name' => 'Administrator'));
                        $a_members = $a->getMembers();
                        foreach ($a_members as $m)
                        {
                            $mail_recipients[] = $m->getEmail();
                        }
                        $mail_recipients = array_unique($mail_recipients);
                        $this->load->library('email_sender');
                        
                        $this->email_sender->send($mail_recipients, $mail_sbj, $mail_body);
                    }
                }
                else
                {
                    log_message('error', 'rr_rm_member_from_fed is not set in config');
                    show_error('missed some config setting, Please contact with admin.', 500);
                    return;
                }
            }
        }
        $data['subtitle'] = 'Federation: ' . $federation->getName() . ' ' . anchor(base_url() . 'federations/manage/show/' . base64url_encode($federation->getName()), '<img src="' . base_url() . 'images/icons/arrow-in.png"/>');

        $current_members = $federation->getMembers();
        if (!empty($current_members) && $current_members->count() > 0)
        {
            $list = array('IDP' => array(), 'SP' => array(), 'BOTH' => array());
            foreach ($current_members as $l)
            {
                $name = $l->getName();
                if(empty($name))
                {
                   $name = $l->getEntityId();
                }
                $list[$l->getType()][$l->getId()] = $name;
            }
            $list = array_filter($list);
            $data['providers'] = $list;
            $data['fedname'] = $federation->getName();
        }
        else
        {
            $data['error_message'] = 'Federation has no members to be removed';
        }
        $this->load->helper('form');
        $data['content_view'] = 'federation/remove_provider_view';
        $this->load->view('page', $data);
    }

}