<?php
namespace Hadil\Jobs\Controller\Job;

class Testregistry extends \Magento\Framework\App\Action\Action
{
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context);
        $this->_registry = $registry;

    }

    public function execute()
    {
        $this->_registry->register('my_registry_var', 'my global value');

        echo $this->_registry->registry('my_registry_var');
    }
}
