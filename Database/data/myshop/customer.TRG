TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `insertlogs` AFTER INSERT ON `customer` FOR EACH ROW INSERT INTO logs VALUES(null,NEW.customer_id,\'Inserted\',NOW())'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=157191588724
