CREATE DATABASE egm_receipts_book;

USE egm_receipts_book;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_created_by` int(11) NOT NULL,
  `user_last_update_by` int(11) DEFAULT NULL,
  `user_full_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_gender` enum('Male','Female') NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `user_role` enum('Admin','User') NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_created_at` datetime NOT NULL,
  `user_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY(user_id)
);

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_created_by` int(11) NOT NULL,
  `company_last_update_by` int(11) DEFAULT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_website` varchar(100) NOT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_city` varchar(100) NOT NULL,
  `company_country` varchar(100) NOT NULL,
  `company_zip_code` varchar(100) NOT NULL,
  `company_phone` varchar(100) DEFAULT NULL,
  `company_fax` varchar(100) DEFAULT NULL,
  `company_vat_number` varchar(100) NOT NULL,
  `company_number` varchar(100) NOT NULL,
  `company_created_at` datetime NOT NULL,
  `company_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY(company_id)
);


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_full_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  PRIMARY KEY(user_id)
);