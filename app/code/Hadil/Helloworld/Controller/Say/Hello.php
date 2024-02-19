<?php
//namespace Hadil\Helloworld\Controller\Say;
//class Hello extends \Magento\Framework\App\Action\Action
//{
//    public function execute()
//    {
//        echo 'Execute Action Say_Hello OK';
//        die();
//    }
//}


namespace Hadil\Helloworld\Controller\Say;
class Hello extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
