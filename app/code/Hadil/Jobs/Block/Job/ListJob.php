<?php
namespace Hadil\Jobs\Block\Job;
class ListJob extends \Magento\Framework\View\Element\Template
{

    protected $_job;

    protected $_department;

    protected $_resource;

    protected $_jobCollection = null;

    protected $_jobSession = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Hadil\Jobs\Model\Job $job
     * @param \Hadil\Jobs\Model\Department $department
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hadil\Jobs\Model\Job $job,
        \Hadil\Jobs\Model\Department $department,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Session\Generic $jobSession,
        array $data = []
    ) {
        $this->_job = $job;
        $this->_department = $department;
        $this->_resource = $resource;
        $this->_jobSession = $jobSession;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();


        // You can put these informations editable on BO
        $title = __('We are hiring');
        $description = __('Look at the jobs we have got for you');
        $keywords = __('job,hiring');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'jobs',
                [
                    'label' => $title,
                    'title' => $title,
                    'link' => false // No link for the last element
                ]
            );
        }

        $this->pageConfig->getTitle()->set($title);
        $this->pageConfig->setDescription($description);
        $this->pageConfig->setKeywords($keywords);


        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($title);
        }

        return $this;
    }


    protected function _getJobCollection()
    {
        if ($this->_jobCollection === null) {

            $jobCollection = $this->_job->getCollection()
                ->addFieldToSelect('*')
                ->addFieldToFilter('status', $this->_job->getEnableStatus())
                ->join(
                    array('department' => $this->_department->getResource()->getMainTable()),
                    'main_table.department_id = department.'.$this->_job->getIdFieldName(),
                    array('department_name' => 'name')
                );

//            var_dump($jobCollection->getSelect().'');

            $this->_jobCollection = $jobCollection;
        }
        return $this->_jobCollection;
    }


    public function getLoadedJobCollection()
    {
        return $this->_getJobCollection();
    }

    public function getListUrl(){
        return $this->getUrl('jobs/job');
    }

    public function getPagerUrl($numberByPage){
        return $this->getUrl('jobs/job', array('n' => $numberByPage));
    }

    public function getAvailablePager(){
        return array(
            1,
            3,
            10
        );
    }

    public function getJobUrl($job){
        if(!$job->getId()){
            return '#';
        }

        return $this->getUrl('jobs/job/view', ['id' => $job->getId()]);
    }

    public function getDepartmentUrl($job){
        if(!$job->getDepartmentId()){
            return '#';
        }

        return $this->getUrl('jobs/department/view', ['id' => $job->getDepartmentId()]);
    }

    public function getJobSession()
    {
        return $this->_jobSession;
    }
}


