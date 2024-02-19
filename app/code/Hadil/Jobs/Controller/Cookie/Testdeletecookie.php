<?php
namespace Hadil\Jobs\Controller\Cookie;
class Testdeletecookie extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected $_cookieManager;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
    )
    {
        $this->_cookieManager = $cookieManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_cookieManager->deleteCookie(
            \Hadil\Jobs\Controller\Cookie\Testaddcookie::JOB_COOKIE_NAME
        );

        echo('COOKIE DELETED');
    }
}
