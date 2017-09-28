<?php

namespace Wpae\App\Controller;

use PMXE_Export_Record;
use PMXE_Input;
use WP_Error;
use Wpae\App\Service\TemplateManager;
use Wpae\Controller\BaseController;
use Wpae\Http\JsonResponse;
use Wpae\Http\Request;
use PMXE_Plugin;
use XmlExportEngine;

class ExportController extends BaseController
{
    private $input;

    private $errors;

    private $data = array();

    private $isWizard = true;

    public $baseUrlParamNames = array('page', 'pagenum', 'order', 'order_by', 'type', 's', 'f');

    public function saveAction(Request $request)
    {
        $params = $request->getJsonParams();
        $extraData = array();
        parse_str($params['extraData'], $extraData);

        $snippets = array();

        preg_match_all('/{([^}^\"^\']*)}/', $request->getRawContent(), $snippets);

        if(isset($params['update']) && $params['update']) {
            $this->isWizard = false;
        }

        return $this->legacySave($params, array_filter($snippets[1]), $extraData);
    }

    public function getAction(Request $request)
    {
        if(!$request->get('id')) {
            $sessionData = PMXE_Plugin::$session->get_session_data();
            $exportData = unserialize($sessionData['google_merchants_post_data']);
        } else {
            $id = $_GET['id'];
            $export = new \PMXE_Export_Record();
            if ($export->getById($id)->isEmpty()) { // specified import is not found
                wp_redirect(add_query_arg('page', 'pmxe-admin-manage', admin_url('admin.php'))); die();
            }

            $exportData = $export->options['google_merchants_post_data'];
        }

        if($exportData === 'false' || !$exportData) {
            $exportData = null;
        }

        return new JsonResponse($exportData);
    }

    private function legacySave($params, $snippets, $extraData)
    {
        $this->input = new PMXE_Input();
        $this->input->addFilter('trim');

        $this->errors = new WP_Error();

        $default = PMXE_Plugin::get_default_import_options();
        $default = $default + $extraData;

        $this->data['dismiss_warnings'] = 0;
        if ($this->isWizard) {
            $DefaultOptions = (PMXE_Plugin::$session->has_session() ? PMXE_Plugin::$session->get_clear_session_data() : array()) + $default;
            $post = $this->input->post($DefaultOptions);
            $post['google_merchants_post_data'] = $params;
            $post['xml_template_type'] = XmlExportEngine::EXPORT_TYPE_GOOLE_MERCHANTS;
            $post['export_to'] = XmlExportEngine::EXPORT_TYPE_XML;
            $post['snippets'] = $snippets;
            $post['cpt'] = array('product', 'product_variation');
            if ($params['template']['save'] and !empty($params['template']['name']) ) {
                $templateManager = new TemplateManager();
                $templateManager->saveTemplate($params, $post);
            }
        } else {
            $this->data['export'] = $export = new PMXE_Export_Record();

            $id = $params['exportId'];

            if ( ! $id or $export->getById($id)->isEmpty()) { // specified import is not found
                wp_redirect(add_query_arg('page', 'pmxe-admin-manage', admin_url('admin.php'))); die();
            }
            $DefaultOptions = (array)$this->data['export']->options + (array)$default;
            $post = $this->input->post($DefaultOptions);

            $post['scheduled'] = $this->data['export']->scheduled;
            $post['google_merchants_post_data'] = $params;
            $post['xml_template_type'] = XmlExportEngine::EXPORT_TYPE_GOOLE_MERCHANTS;
            $post['export_to'] = XmlExportEngine::EXPORT_TYPE_XML;
            $post['snippets'] = $snippets;
            $post['cpt'] = array('product', 'product_variation');
            foreach ($post as $key => $value) {
                PMXE_Plugin::$session->set($key, $value);
            }
            $this->data['dismiss_warnings'] = get_option('wpae_dismiss_warnings_' . $this->data['export']->id, 0);
        }

        $max_input_vars = @ini_get('max_input_vars');

        if (ctype_digit($max_input_vars) && count($_POST, COUNT_RECURSIVE) >= $max_input_vars) {
            $this->errors->add('form-validation', sprintf(__('You\'ve reached your max_input_vars limit of %d. Please contact your web host to increase it.', 'wp_all_export_plugin'), $max_input_vars));
        }

        PMXE_Plugin::$session->save_data();

        $this->data['post'] =& $post;

        PMXE_Plugin::$session->set('is_loaded_template', '');

        $this->data['engine'] = null;

        if ($this->isWizard) {
            foreach ($this->data['post'] as $key => $value) {
                PMXE_Plugin::$session->set($key, $value);
            }
            PMXE_Plugin::$session->save_data();
        } else {
            $post = $post + $extraData;

            $this->data['export']->set(array('options' => $post, 'settings_update_on' => date('Y-m-d H:i:s')))->save();
            if (!empty($post['friendly_name'])) {
                $this->data['export']->set(array('friendly_name' => $post['friendly_name'], 'scheduled' => (($post['is_scheduled']) ? $post['scheduled_period'] : '')))->save();
            }
            // Return an url to redirect here
            return new JsonResponse(array( 'redirect' => add_query_arg(array('page' => 'pmxe-admin-manage', 'pmxe_nt' => urlencode(__('Options updated', 'pmxi_plugin'))) + array_intersect_key($_GET, array_flip($this->baseUrlParamNames)), admin_url('admin.php'))));
        }

        return new JsonResponse(array());
    }
}