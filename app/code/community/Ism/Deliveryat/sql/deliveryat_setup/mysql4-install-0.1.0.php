<?php
$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('news_articles')};
CREATE TABLE {$this->getTable('news_articles')} (
 `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(255) NOT NULL,
 `content` text,
 `announce` text,
 `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `published` int(2) DEFAULT 0,
 PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();