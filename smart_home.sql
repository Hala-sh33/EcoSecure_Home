
CREATE TABLE `account` (
  `accountID` int NOT NULL,
  `accountName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `accountType` enum('admin','homeowner','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `consumptionlog` (
  `readingNo` int NOT NULL,
  `inventoryDeviceID` int DEFAULT NULL,
  `startStamp` timestamp NOT NULL,
  `endStamp` timestamp NOT NULL,
  `consumption` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `emergencyentity` (
  `emergencyID` int NOT NULL,
  `inventoryDeviceID` int DEFAULT NULL,
  `emergencyName` varchar(255) NOT NULL,
  `emergencyDescription` text NOT NULL,
  `emergencyContact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `emergencyincident` (
  `containsNo` int NOT NULL,
  `inventoryDeviceID` int DEFAULT NULL,
  `emergencyID` int DEFAULT NULL,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `emergencyStatus` enum('resolved','ongoing','critical') NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `home` (
  `homeID` int NOT NULL,
  `accountID` int DEFAULT NULL,
  `streetName` varchar(255) NOT NULL,
  `homeNumber` varchar(50) NOT NULL,
  `homeType` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `numberOfRooms` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `inventorydevice` (
  `inventoryDeviceID` int NOT NULL,
  `homeID` int DEFAULT NULL,
  `deviceID` int DEFAULT NULL,
  `deviceLocation` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `is_on` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `member` (
  `memberID` int NOT NULL,
  `accountID` int DEFAULT NULL,
  `userName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `message` (
  `messageNumber` int NOT NULL,
  `accountID` int DEFAULT NULL,
  `previousMessageNo` int DEFAULT NULL,
  `reply` text,
  `recipientID` int DEFAULT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `operationschedule` (
  `scheduleID` int NOT NULL,
  `inventoryDeviceID` int DEFAULT NULL,
  `acSettingID` int DEFAULT NULL,
  `lightSettingID` int DEFAULT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `onTime` time NOT NULL,
  `offTime` time NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `smartacsetting` (
  `acSettingID` int NOT NULL,
  `inventoryDeviceID` int DEFAULT NULL,
  `acFan` enum('low','medium','high','auto') NOT NULL,
  `acTemperature` int NOT NULL,
  `acMode` enum('cool','heat','fan','dry','auto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `smartdevice` (
  `deviceID` int NOT NULL,
  `deviceStatus` enum('active','inactive','faulty') NOT NULL,
  `deviceType` varchar(100) NOT NULL,
  `deviceWarranty` date NOT NULL,
  `quantityOnHand` int NOT NULL,
  `Description` text NOT NULL,
  `year` int NOT NULL,
  `modelNo` varchar(100) NOT NULL,
  `modelin` varchar(100) NOT NULL,
  `specification` text NOT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `smartlightsetting` (
  `lightSettingID` int NOT NULL,
  `inventoryDeviceID` int DEFAULT NULL,
  `lightBrightness` int NOT NULL,
  `lightColor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `subscription` (
  `subscriptionID` int NOT NULL,
  `accountID` int DEFAULT NULL,
  `PaymentMethod` varchar(100) NOT NULL,
  `paymentAmount` decimal(10,2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `subscriptionStatus` enum('active','expired','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


