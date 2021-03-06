<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Affiliate / Form / Processing
 */
namespace PH7;
defined('PH7') or exit('Restricted access');

use PH7\Framework\Cache\Cache, PH7\Framework\Mvc\Request\Http;

class EditFormProcess extends Form
{

    public function __construct()
    {
        parent::__construct();

        $oAffModel = new AffiliateModel;
        $iProfileId = (AdminCore::auth() && !Affiliate::auth() && $this->httpRequest->getExists('profile_id')) ? $this->httpRequest->get('profile_id', 'int') : $this->session->get('affiliate_id');
        $oAff = $oAffModel->readProfile($iProfileId, 'Affiliates');

        if(!$this->str->equals($this->httpRequest->post('first_name'), $oAff->firstName))
        {
            $oAffModel->updateProfile('firstName', $this->httpRequest->post('first_name'), $iProfileId, 'Affiliates');
            $this->session->set('affiliate_first_name', $this->httpRequest->post('first_name'));

            (new Cache)->start(UserCoreModel::CACHE_GROUP, 'firstName' . $iProfileId . 'Affiliates', null)->clear();
        }

        if(!$this->str->equals($this->httpRequest->post('last_name'), $oAff->lastName))
            $oAffModel->updateProfile('lastName', $this->httpRequest->post('last_name'), $iProfileId, 'Affiliates');

        if(!$this->str->equals($this->httpRequest->post('sex'), $oAff->sex))
        {
            $oAffModel->updateProfile('sex', $this->httpRequest->post('sex'), $iProfileId, 'Affiliates');
            $this->session->set('affiliate_sex', $this->httpRequest->post('sex'));

            (new Cache)->start(UserCoreModel::CACHE_GROUP, 'sex' . $iProfileId . 'Affiliates', null)->clear();
        }

        if(!$this->str->equals($this->dateTime->get($this->httpRequest->post('birth_date'))->date('Y-m-d'), $oAff->birthDate))
            $oAffModel->updateProfile('birthDate', $this->dateTime->get($this->httpRequest->post('birth_date'))->date('Y-m-d'), $iProfileId, 'Affiliates');

        // Update dynamic fields.
        $oFields = $oAffModel->getInfoFields($iProfileId, 'AffiliatesInfo');
        foreach($oFields as $sColumn => $sValue)
        {
            $sHRParam = ($sColumn == 'description') ? Http::ONLY_XSS_CLEAN : null;
            if(!$this->str->equals($this->httpRequest->post($sColumn, $sHRParam), $sValue))
                $oAffModel->updateProfile($sColumn, $this->httpRequest->post($sColumn, $sHRParam), $iProfileId, 'AffiliatesInfo');
        }
        unset($oFields);

        $oAffModel->setLastEdit($iProfileId, 'Affiliates');

        $oAffCache = new Affiliate;
        $oAffCache->clearReadProfileCache($iProfileId, 'Affiliates');
        $oAffCache->clearInfoFieldCache($iProfileId, 'AffiliatesInfo');

        unset($oAffModel, $oAff, $oAffCache);

        \PFBC\Form::setSuccess('form_aff_edit_account', t('Profile has been saved successfully!'));
    }

}
