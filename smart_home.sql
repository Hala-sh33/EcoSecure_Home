
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


ALTER TABLE `account`
    ADD PRIMARY KEY (`accountID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

ALTER TABLE `consumptionlog`
    ADD PRIMARY KEY (`readingNo`),

ALTER TABLE `emergencyentity`
    ADD PRIMARY KEY (`emergencyID`),
  ADD KEY `inventoryDeviceID` (`inventoryDeviceID`);

ALTER TABLE `emergencyincident`
    ADD PRIMARY KEY (`containsNo`),
  ADD KEY `inventoryDeviceID` (`inventoryDeviceID`),
  ADD KEY `emergencyID` (`emergencyID`);

ALTER TABLE `home`
    ADD PRIMARY KEY (`homeID`),
  ADD KEY `accountID` (`accountID`);

ALTER TABLE `inventorydevice`
    ADD PRIMARY KEY (`inventoryDeviceID`),
  ADD KEY `homeID` (`homeID`),
  ADD KEY `deviceID` (`deviceID`);

ALTER TABLE `member`
    ADD PRIMARY KEY (`memberID`),
  ADD KEY `accountID` (`accountID`);


ALTER TABLE `message`
    ADD PRIMARY KEY (`messageNumber`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `recipientID` (`recipientID`),
  ADD KEY `previousMessageNo` (`previousMessageNo`);

ALTER TABLE `operationschedule`
    ADD PRIMARY KEY (`scheduleID`),
  ADD KEY `inventoryDeviceID` (`inventoryDeviceID`);

ALTER TABLE `smartacsetting`
    ADD PRIMARY KEY (`acSettingID`),
  ADD KEY `inventoryDeviceID` (`inventoryDeviceID`);

ALTER TABLE `smartdevice`
    ADD PRIMARY KEY (`deviceID`);

ALTER TABLE `smartlightsetting`
    ADD PRIMARY KEY (`lightSettingID`),
  ADD KEY `inventoryDeviceID` (`inventoryDeviceID`);

ALTER TABLE `subscription`
    ADD PRIMARY KEY (`subscriptionID`),
  ADD KEY `accountID` (`accountID`);

ALTER TABLE `account`
    MODIFY `accountID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `consumptionlog`
    MODIFY `readingNo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `emergencyentity`
    MODIFY `emergencyID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `emergencyincident`
    MODIFY `containsNo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `home`
    MODIFY `homeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `inventorydevice`
    MODIFY `inventoryDeviceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
ALTER TABLE `member`
    MODIFY `memberID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `message`
    MODIFY `messageNumber` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `operationschedule`
    MODIFY `scheduleID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `smartacsetting`
    MODIFY `acSettingID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `smartdevice`
    MODIFY `deviceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `smartlightsetting`
    MODIFY `lightSettingID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `subscription`
    MODIFY `subscriptionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `consumptionlog`
    ADD CONSTRAINT `consumptionlog_ibfk_1` FOREIGN KEY (`inventoryDeviceID`) REFERENCES `inventorydevice` (`inventoryDeviceID`) ON DELETE CASCADE;

ALTER TABLE `emergencyentity`
    ADD CONSTRAINT `emergencyentity_ibfk_1` FOREIGN KEY (`inventoryDeviceID`) REFERENCES `inventorydevice` (`inventoryDeviceID`) ON DELETE CASCADE;


ALTER TABLE `emergencyincident`
    ADD CONSTRAINT `emergencyincident_ibfk_1` FOREIGN KEY (`inventoryDeviceID`) REFERENCES `inventorydevice` (`inventoryDeviceID`) ON DELETE CASCADE,
  ADD CONSTRAINT `emergencyincident_ibfk_2` FOREIGN KEY (`emergencyID`) REFERENCES `emergencyentity` (`emergencyID`) ON DELETE CASCADE;

ALTER TABLE `home`
    ADD CONSTRAINT `home_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE;

ALTER TABLE `inventorydevice`
    ADD CONSTRAINT `inventorydevice_ibfk_1` FOREIGN KEY (`homeID`) REFERENCES `home` (`homeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventorydevice_ibfk_2` FOREIGN KEY (`deviceID`) REFERENCES `smartdevice` (`deviceID`) ON DELETE CASCADE;

ALTER TABLE `member`
    ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE;

ALTER TABLE `message`
    ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`recipientID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`previousMessageNo`) REFERENCES `message` (`messageNumber`) ON DELETE SET NULL;

ALTER TABLE `operationschedule`
    ADD CONSTRAINT `operationschedule_ibfk_1` FOREIGN KEY (`inventoryDeviceID`) REFERENCES `inventorydevice` (`inventoryDeviceID`) ON DELETE CASCADE;

ALTER TABLE `smartacsetting`
    ADD CONSTRAINT `smartacsetting_ibfk_1` FOREIGN KEY (`inventoryDeviceID`) REFERENCES `inventorydevice` (`inventoryDeviceID`) ON DELETE CASCADE;

ALTER TABLE `smartlightsetting`
    ADD CONSTRAINT `smartlightsetting_ibfk_1` FOREIGN KEY (`inventoryDeviceID`) REFERENCES `inventorydevice` (`inventoryDeviceID`) ON DELETE CASCADE;

ALTER TABLE `subscription`
    ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE;
COMMIT;


