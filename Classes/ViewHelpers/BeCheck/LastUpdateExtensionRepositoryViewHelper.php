<?php
namespace In2code\Powermail\ViewHelpers\BeCheck;

use In2code\Powermail\Utility\ObjectUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * PowermailVersionViewHelper
 *
 * @package TYPO3
 * @subpackage Fluid
 */
class LastUpdateExtensionRepositoryViewHelper extends AbstractViewHelper
{

    /**
     * Return timestamp from last updated TER
     *
     * @return int
     */
    public function render()
    {
        if (!$this->extensionTableExists()) {
            return 0;
        }
        $select = 'last_update';
        $from = 'tx_extensionmanager_domain_model_repository';
        $where = 1;
        $res = ObjectUtility::getDatabaseConnection()->exec_SELECTquery($select, $from, $where, '', '', 1);
        if ($res) {
            $row = ObjectUtility::getDatabaseConnection()->sql_fetch_assoc($res);
            if (!empty($row['last_update'])) {
                return (int) $row['last_update'];
            }
        }
        return 0;
    }

    /**
     * @return bool
     */
    protected function extensionTableExists()
    {
        $allTables = ObjectUtility::getDatabaseConnection()->admin_get_tables();
        if (array_key_exists('tx_extensionmanager_domain_model_repository', $allTables)) {
            return true;
        }
        return false;
    }
}
