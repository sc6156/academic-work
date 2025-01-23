--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `bookingID` mediumint(8) PRIMARY KEY AUTO_INCREMENT,
  `accommodationID` mediumint(8) NOT NULL,
  `customerID` mediumint(8) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `num_guests` mediumint(2) NOT NULL,
  `total_booking_cost` DECIMAL(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `customerID` mediumint(8) PRIMARY KEY AUTO_INCREMENT,
  `email_address` varchar(255) NOT NULL,
  `password_hash` char(255) NOT NULL,
  `customer_forename` varchar(255) NOT NULL,
  `customer_surname` varchar(255) NOT NULL,
  `customer_postcode` varchar(255) NOT NULL,
  `customer_address1` varchar(255) NOT NULL,
  `customer_address2` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





