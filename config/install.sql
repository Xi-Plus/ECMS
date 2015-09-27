CREATE TABLE IF NOT EXISTS `people` (
  `number` int(11) NOT NULL,
  `name` char(10) NOT NULL,
  `money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `record` (
  `number` int(11) NOT NULL,
  `date` date NOT NULL,
  `store` int(11) NOT NULL DEFAULT '0',
  `charge` int(11) NOT NULL DEFAULT '0',
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `setting` (
  `name` char(255) NOT NULL,
  `value` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
