<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hadil\Jobs\Cron;

class DisableJobs
{
    /**
     * @var \Hadil\Jobs\Model\Job
     */
    protected $_job;

    /**
     * @param \Hadil\Jobs\Model\Job $job
     */
    public function __construct(
        \Hadil\Jobs\Model\Job $job
    ) {
        $this->_job = $job;
    }

    /**
     * Disable jobs which date is less than the current date
     *
     * @param \Magento\Cron\Model\Schedule $schedule
     * @return void
     */
    public function execute(\Magento\Cron\Model\Schedule $schedule)
    {
        $nowDate = date('Y-m-d');
        $jobsCollection = $this->_job->getCollection()
            ->addFieldToFilter('date', array ('lt' => $nowDate));

        foreach($jobsCollection AS $job) {
            $job->setStatus($job->getDisableStatus());
            $job->save();
        }
    }
}
