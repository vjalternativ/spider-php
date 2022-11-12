<?php

class SitemapJobRuntime extends RuntimeBean
{

    /**
     *
     * @return mixed
     */
    public function getCountForId($id)
    {
        return $this->data['count'][$id];
    }

    /**
     *
     * @param mixed $count
     */
    public function setCountForId($id, $count)
    {
        $this->data['count'][$id] = $count;
    }

    public function getPath()
    {
        return "SiteMapJobRuntime";
    }
}
?>